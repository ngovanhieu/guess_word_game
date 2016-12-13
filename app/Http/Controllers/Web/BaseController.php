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
     * @var repository
     */
    protected $repository;
}
