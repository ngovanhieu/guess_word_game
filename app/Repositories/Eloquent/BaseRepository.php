<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Log;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var
     */
    protected $model;
    private $where;
 
    /**
     * @param App $app
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Triggered inaccessible methods
     *
     * @param Method   $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }

    /**
     * Specify Model class name
     * 
     * @return mixed
     */
    abstract function model();
 
    /**
     * @return Model
     * @throws Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
 
        if (!$model instanceof Model) {
            throw new Exception(trans('common/errors.exceptions.not-instance', ['model' => $this->model()]));
        }
 
        return $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->all();
    }

    /**
     * Retrieve data array for populate field select
     *
     * @param string      $column
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection|array
     */
    public function lists($column, $key = null)
    {  
        return $this->model->pluck($column, $key);
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null   $limit
     * @param array  $columns
     *
     * @return mixed
     */
    public function paginate($columns = ['*'], $limit = null)
    {
        $limit = is_null($limit) ? config('repository.pagination.limit') : $limit;

        return $this->model->paginate($limit, $columns);
    }

    /**   
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy($column, $option)
    {
        $data = $this->model->where($column, $option)->get();

        return $data;
    }

    public function eagerLoadTrashed()
    {
        if (!is_null($this->withTrashed)) {
            $this->model->withTrashed();
        } elseif (!is_null($this->onlyTrashed)) {
            $this->model->onlyTrashed();
        }

        return $this;
    }

    public function where($conditions, $operator = null, $value = null)
    {
        if (func_num_args() == 2) {
            list($value, $operator) = [$operator, '='];
        }

        return $this->model->where($conditions, $operator, $value);
    }
    
    /**
     * Save a new entity in repository
     *
     * @throws Exception
     *
     * @param array $input
     *
     * @return mixed
     */
    public function create(array $input)
    {   
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id
     *
     * @throws Exception
     *
     * @param array $input
     * @param       $id
     *
     * @return bool
     */
    public function update(array $data, $id, $withSoftDeletes = false)
    {
        try {

            if ($withSoftDeletes) {
                $this->newQuery()->eagerLoadTrashed();
            }

            $model = $this->model->find($id);
            $fillable = $this->model->getFillable();
            $data = array_only($data, $fillable);
            $model->fill($data);

            return $model->save();
        } catch (Exception $e) {
            Log::error($e);

            throw $e;
        }
    }
    
    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
