<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class Sort implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        $column = $value[0];
        $direction = $value[1];

        return $builder->orderBy($column, $direction ?? 'asc');
    }
}
