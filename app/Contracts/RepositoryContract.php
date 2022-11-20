<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface RepositoryContract {

    public function model(): string;

    public function makeQuery(): Builder;

}