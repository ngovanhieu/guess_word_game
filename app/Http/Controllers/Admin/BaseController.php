<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    /**
     * @var viewData
     */
    protected $viewData;

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
}
