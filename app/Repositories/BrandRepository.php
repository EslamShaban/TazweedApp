<?php
namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Category;
use App\Models\Brand;

class BrandRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Brand::class;
    }
}
