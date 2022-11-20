<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Repositories\ReservationRepository;
use App\Repositories\ReservationTableRepository;
use App\Repositories\RestaurantTableRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class ReservationsService {

    private RestaurantTableRepository $restaurantTableRepository;

    private ReservationTableRepository $reservationTableRepository;


    private ReservationRepository $reservationRepository;

    public function __construct(
        RestaurantTableRepository $restaurantTableRepository,
        ReservationTableRepository $reservationTableRepository,
        ReservationRepository $reservationRepository
    ) {
        $this->restaurantTableRepository = $restaurantTableRepository;
        $this->reservationTableRepository = $reservationTableRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function makeReservation(array $values): bool {
        $startDate = Carbon::parse($values['start_from'])->timestamp;
        $endDate = $startDate + $values['length'] * 3600;

        $availableTables = $this->restaurantTableRepository->getAvailableTables(
            (int)$values['restaurant_id'],
            $startDate,
            $endDate);

        if ($availableTables->isEmpty()) {
            $this->throwNotEnoughTablesError();
        }

        $customerCount = count($values['costumer_first_name']) + 1;

        $possibleOneTables = $this->getPossibleOneTables($availableTables, $customerCount);

        if (!$possibleOneTables->isEmpty()) {
            $this->singleTableReservation($possibleOneTables, $values, $startDate, $endDate);
        } elseif ($possibleOneTables->isEmpty() && $availableTables->count() > 1) {
            $this->multipleTablesReservation($availableTables, $values, $customerCount, $startDate, $endDate);
        } else {
            $this->throwNotEnoughTablesError();
        }

        return true;
    }

    private function singleTableReservation(
        Collection $possibleOneTable,
        array $values,
        int $startDate,
        int $endDate
    ): bool {
        $table = $possibleOneTable->sortBy('chairs')->first();
        $reservationData = $this->getReservationDataForModel($values, $startDate, $endDate);
        $reservation = $this->reservationRepository->createNewAndReturnModel($reservationData);


        $costumerInfo = $this->groupCostumersInfo($values);
        $reservation->costumersInfo()->createMany($costumerInfo);
        $this->reservationTableRepository->createNew($table->id, $reservation->id, $startDate, $endDate);
        return true;
    }

    private function multipleTablesReservation(
        Collection $availableTables,
        array $values,
        int $customerCount,
        int $startDate,
        int $endDate
    ): bool {
        $reservationTables = [];
        $customersLeft = $customerCount;
        foreach ($availableTables->sortByDesc('chairs') as $table) {
            if ($customersLeft <= 0) {
                break;
            }
            $customersLeft = $customersLeft - $table->chairs;
            $reservationTables[] = $table;
        }

        if ($customersLeft > 0) {
            $this->throwNotEnoughTablesError();
        }

        $reservationData = $this->getReservationDataForModel($values, $startDate, $endDate);
        $reservation = $this->reservationRepository->createNewAndReturnModel($reservationData);

        $costumersInfo = $this->groupCostumersInfo($values);
        $reservation->costumersInfo()->createMany($costumersInfo);

        foreach ($reservationTables as $table) {
            $this->reservationTableRepository->createNew($table->id, $reservation->id, $startDate, $endDate);
        }
        return true;
    }

    private function getPossibleOneTables(Collection $availableTables, int $customerCount): Collection {
        return $availableTables->filter(function ($value) use ($customerCount) {
            return $value['chairs'] >= $customerCount;
        });
    }

    private function getReservationDataForModel(array $values, int $startDate, int $endDate): array {
        return [
            'start_from' => $startDate, 'end_to' => $endDate, 'orderer_first_name' => $values['orderer_first_name'],
            'orderer_last_name' => $values['orderer_last_name'], 'orderer_email' => $values['orderer_email'],
            'orderer_phone' => $values['orderer_phone'],
        ];
    }

    private function groupCostumersInfo(array $values): array {
        $costumerInfo = [];
        foreach ($values['costumer_first_name'] as $key => $val) {
            $costumerInfo[] = [
                'first_name' => $val, 'last_name' => $values['costumer_last_name'][$key],
                'email' => $values['costumer_email'][$key],
            ];
        }

        return $costumerInfo;
    }

    private function throwNotEnoughTablesError() {
        $error = ValidationException::withMessages([
            'reservation' => ['Nėra laisvų staliukų šia data'],
        ]);
        throw $error;
    }

}