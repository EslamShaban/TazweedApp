<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
//use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements RepositoryInterface {
 
    /**
     * @var App
     */
    private $app;
 
    /**
     * @var
     */
    protected $model;
 
    /**
     * @param App $app
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }
 
    /**
     * Specify Model class name
     * 
     * @return mixed
     */
    abstract function model();
 
    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());
 
        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
 
        return $this->model = $model->newQuery();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')) {
        return $this->model->get($columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = array('*')) {
        return $this->model->first($columns);
    }


        
    /**
     * @return mixed
     */
    public function firstOrCreate($data = array()) {
        
        return $this->model->firstOrCreate($data);
    }
    
    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
       
        return $this->model->create($data);
    }
 
    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id=null, $attribute="id") {
        
        //return $this->model->where($attribute, '=', $id)->update($data);
        $query = $id != null ? $this->model->find($id) : $this->model;
        return $query->update($data);
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        //return $this->model->destroy($id);
        $query = $this->model->find($id);
        return $query->delete();
    }
 
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }
 
    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }


    /**
     * @param array $fields
     * @param array $columns
     * @return mixed
     */
    public function where(array $fields, $columns = array('*'))
    {
        $query = $this->model;

        foreach ($fields as $key => $value)
        {
            $query->where($key, $value);
        }
        return $query->get($columns);
    }

    /**
     * @param $fields
     * @param array $columns
     * @return mixed
     */
    public function whereIn(array $fields, $columns = array('*')) {

        $query = $this->model;

        foreach ($fields as $key => $value)
        {
            $query->whereIn($key, $value);
        }
        return $query->get($columns);
    }

     /**
     * @param $fields
     * @param array $columns
     * @return mixed
     */
    public function whereNotIn(array $fields, $columns = array('*')) {

        $query = $this->model;

        foreach ($fields as $key => $value)
        {
            $query->whereNotIn($key, $value);
        }
        return $query->get($columns);
    }


    /**
     * @param $field
     * @return mixed
     */
    public function groupBy($field, $columns = array('*')) {
        return $this->model->select($columns)->groupBy($field)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * @param $num
     * @param array $columns
     * @return mixed
     */
    public function take($num, $columns = array('*')) {
        
        return $this->model->take($num)->get($columns);

    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function latest($columns = array('*')) {
        return $this->model->latest()->get($columns);
    }

     /**
     * @param array $roles
     * @param array $columns
     * @return mixed
     */
    public function getUserBaseRole(array $roles, $columns = array('*'))
    {
        return $this->model->whereRoleIs($roles)->get($columns);
    }
 
}
