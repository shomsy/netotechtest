<?php


namespace App\Models\SearchByFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostId implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('post_id', '=', $value);
    }
}
