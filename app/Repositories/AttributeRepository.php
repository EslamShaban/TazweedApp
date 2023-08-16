<?php
namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Category;
use App\Models\Attribute;

class AttributeRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Attribute::class;
    }
}
