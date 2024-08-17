<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Landing extends BaseController
{
    public function index()
    {
        $module = 'Landing Page';
        return view('landing.index', compact('module'));
    }
}
