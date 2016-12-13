<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    /**
     * @var viewData
     */
    protected $viewData;

	/**
     * @var viewName
     */
    protected $viewName;

    /**
     * @var repository
     */
    protected $repository;

    public function __construct($repository = null)
    {
        if (!is_null($repository)) {
            $this->repository = $repository;
        }
    }

    public function show($id)
    {
        $this->viewData['data'] = $this->repository->show($id);

        $this->viewName .= '.detail'; 
    }

    public function viewRender($data = [], $viewName = null)
    {
        $viewName = $viewName ? $viewName : $this->viewName;
        $viewData = array_merge($data, $this->viewData);

        return view('front-end.' . $viewName, $viewData);
    }
}
