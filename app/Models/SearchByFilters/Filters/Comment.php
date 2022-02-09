<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class Comment implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('comments', function ($q) use ($value) {
            $q->where('content', 'LIKE', '%'.$value.'%');
        });
    }
}
