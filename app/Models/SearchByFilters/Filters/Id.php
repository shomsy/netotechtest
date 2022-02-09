<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class Id implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('id', '=', $value);
    }
}
