<?php 
namespace App\Repositories;
 
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\CarModel;

class CarModelRepository extends BaseRepository {
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CarModel::class;
    }
}