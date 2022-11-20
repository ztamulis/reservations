<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Abstracts\RepositoryAbstract;
use App\Models\Restaurant;

class RestaurantRepository extends RepositoryAbstract {

    public function model(): string {
        return Restaurant::class;
    }

    public function createNew(array $values): Restaurant {
        return $this->makeQuery()->create($values);
    }

    public function getById(int $id): ?Restaurant {
        return $this->makeQuery()->where('id', $id)->first();
    }
}