<?php

declare(strict_types=1);

namespace App\Abstracts;

use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

abstract class RepositoryAbstract implements RepositoryContract {

    abstract public function model(): string;

    protected function makeModel(): Model {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new RuntimeException('Class '.$this->model().' must be an instance of '.Model::class);
        }

        return $model;
    }

    public function makeQuery(): Builder {
        return $this->makeModel()->newQuery();
    }
}