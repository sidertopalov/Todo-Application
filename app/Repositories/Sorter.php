<?php

namespace App\Repositories;

trait Sorter
{

    public function setOrder(&$query, $sortField, $sortDirection)
    {
        if (!empty($sortField)) {
            $query->orderBy($sortField, $sortDirection);
        }
    }
}
