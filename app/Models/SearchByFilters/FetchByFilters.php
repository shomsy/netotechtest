<?php

namespace App\Models\SearchByFilters;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class FetchByFilters
{
    /**
     * @param  \Illuminate\Http\Request  $filters
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  bool  $results
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array
     */
    public static function apply(Request $filters, Model $model, $results = false): Collection|Builder|array
    {
        $query = static::applyDecoratorsFromRequest($filters, (new $model)->newQuery());

        if ($results) {
            return static::getResults($query);
        }

        return $query;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private static function applyDecoratorsFromRequest(Request $request, Builder $query): Builder
    {
        foreach ($request->all() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                if (Str::contains($decorator, 'Sort')) {
                    $value = [$value, $request->get('direction')];
                }

                $query = $decorator::apply($query, $value);
            }

        }

        return $query;
    }

    /**
     * @param $name
     *
     * @return string
     */
    private static function createFilterDecorator($name): string
    {
        return 'App\\Models\\SearchByFilters\\Filters\\'.Str::studly($name);
    }

    /**
     * @param $decorator
     *
     * @return bool
     */
    private static function isValidDecorator($decorator): bool
    {
        return class_exists($decorator);
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    private static function getResults(Builder $query): Collection|array
    {
        return $query->get();
    }
}
