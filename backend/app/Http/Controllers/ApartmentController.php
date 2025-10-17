<?php

namespace App\Http\Controllers;

use App\Models\Apartment;

class ApartmentController extends Controller
{
    public function index()
    {
        return Apartment::query()
            ->orderBy('price')
            ->get(['id','name','description','price','capacity','size','image','location','features']);
    }
}


