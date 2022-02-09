<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class Comment implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->whereHas('comments', function ($q) use ($value) {
            $q->where('content', 'LIKE', '%'.$value.'%');
        });
    }
}
