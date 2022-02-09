<?php


namespace App\Models\SearchByFilters\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class CreatedAt implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereDate('created_at', Carbon::parse()->format($value));

    }
}
