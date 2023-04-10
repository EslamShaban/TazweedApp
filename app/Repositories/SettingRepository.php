<?php 
namespace App\Repositories;
 
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Setting;

class SettingRepository extends BaseRepository {
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return Setting::class;
    }
}