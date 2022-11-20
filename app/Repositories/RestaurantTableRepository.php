<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Abstracts\RepositoryAbstract;
use App\Models\RestaurantTable;

class RestaurantTableRepository extends RepositoryAbstract {

    public function model(): string {
        return RestaurantTable::class;
    }

    public function getAvailableTables(int $restaurantId, int $startDate, int $endDate) {
        return $this->makeQuery()->where('restaurant_id',
            $restaurantId)->whereDoesntHave('reservations',
            function ($query) use ($startDate, $endDate) {
                $query->where('start_from', '<', $startDate)
                    ->where('end_to', '>', $endDate);
                $query->orWhereBetween('start_from', [$startDate, $endDate])->orWhereBetween('end_to',
                    [$startDate, $endDate]);
            })->get();
    }

    public function createNew(array $values): RestaurantTable {
        return $this->makeQuery()->create($values);
    }
}