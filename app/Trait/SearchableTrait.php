<?php

namespace App\Trait;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait SearchableTrait {

    public function scopeSearch($query,$search,array $columns = [])
    {
        $tableColumns = [];

        if(!is_null($this->searchable) && is_array($this->searchable)) {
            $tableColumns = $this->searchable;
        } else if(!empty($columns)) {
            $tableColumns = $columns;
        } else {
            $tableColumns = Schema::getColumnListing($this->getTable());
        }

        $search = is_null($search) ? '' : $search;

        $search = mb_strtolower($search);

        $query->where(DB::raw('LOWER('.array_shift($tableColumns).')'),'like',"%$search%");

        foreach($tableColumns as $column) {
            $query->orWhere(DB::raw("LOWER($column)"),'like',"%$search%");
        }

        return $query;
    }
}