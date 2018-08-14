<?php

declare(strict_types = 1 );

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @return view
     */
    public function index(): view
    {
        return view('admin');
    }
}
