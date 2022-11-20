<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Abstracts\RepositoryAbstract;
use App\Models\ReservationTable;

class ReservationTableRepository extends RepositoryAbstract {

    public function model(): string {
        return ReservationTable::class;
    }

    public function createNew(int $tableId, int $reservationId, int $startDate, int $endDate): ReservationTable{
        return $this->makeQuery()->create([
            'restaurant_table_id' => $tableId, 'reservation_id' => $reservationId, 'start_from' => $startDate,
            'end_to' => $endDate,
        ]);
    }
}