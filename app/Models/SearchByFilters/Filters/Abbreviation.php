<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class Abbreviation implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('abbreviation', 'LIKE', $value);
    }
}
