<?php
/**
 * Created by PhpStorm.
 * User: Hussein Mirzaki
 * Date: 9/7/2018
 * Time: 8:59 PM
 */

namespace App\Http\Controllers;


trait ControllersTrait
{
    /**
     * @param               $model_name
     *
     * @param               $view
     * @param \Closure|null $closure
     * @param int           $paginate
     *
     * @param string        $name
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateView($model_name, $view, \Closure $closure = null, $name = 'transition.index', $paginate = 10)
    {
        $model = $model_name;
        $table = $this->getTable($model);
        if ($closure) {
            $models = $closure($table);
            if ($models->count() > 0) {
                $models = $models->paginate($paginate);
            } else {
                $models = collect([]);
            }
        } else {
            if ($model::count() > 0) {
                $models = $model::paginate($paginate);
            } else {
                $models = collect([]);
            }
        }

        $columns = $this->getTableColumns($table);

        return view($view, compact('models', 'table', 'columns', 'name'));
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getTable($model)
    {
        return (new $model)->getTable();
    }

    /**
     * @param $table
     *
     * @return mixed
     */
    public function getTableColumns($table)
    {
        return \Illuminate\Support\Facades\Schema::getColumnListing($table);
    }

    /**
     * @param         $data
     * @param         $model
     *
     * @param         $view
     *
     * @param         $name
     *
     * @param null    $backName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditView($data, $model, $name, $backName = null)
    {
        $table = $this->getTable($model);
        $columns = $this->getTableColumns($table);
        $view = 'models.edit_details';
        if ($backName == null)
            $backName = $name . '.create';
        return view($view, compact('model', 'columns', 'data', 'table', 'name', 'backName'));
    }
}