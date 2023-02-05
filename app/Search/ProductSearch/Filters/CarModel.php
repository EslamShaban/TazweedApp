<?php

namespace App\Search\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class CarModel implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        if($value[0] == null)
            return $builder;

       return $builder->whereHas('car_models', function ($query) use ($value) {
            $query->whereIn('car_models.id', $value);
        });
    }
}