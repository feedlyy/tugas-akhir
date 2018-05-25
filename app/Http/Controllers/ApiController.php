<?php

namespace App\Http\Controllers;

use App\Http\Resources\StafResource;
use App\Staff;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function index()
    {
        return StafResource::collection(Staff::all());
    }
}
