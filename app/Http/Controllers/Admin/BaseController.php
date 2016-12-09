<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    /**
     * @var viewData
     */
    private $viewData;

    /**
     * @var repository
     */
    private $repository;
}
