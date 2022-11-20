<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Abstracts\RepositoryAbstract;
use App\Models\Reservation;

class ReservationRepository extends RepositoryAbstract {

    public function model(): string {
        return Reservation::class;
    }

    public function createNewAndReturnModel(array $data): Reservation {
        return $this->makeQuery()->create($data);
    }
}