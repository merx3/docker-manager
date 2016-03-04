<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegistriesController extends Controller
{
    public function index()
    {
        return view('repository.index');
    }
}
