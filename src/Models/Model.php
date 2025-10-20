<?php

namespace Deli\App\Models;

class Model {
    protected string $table;

    public function getTable(): string {
        return $this->table;
    }
}