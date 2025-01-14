<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
//use Illuminate\View\Pages\Breweries;

class BreweriesController extends Controller
{
    public function show(): View
    {
        return view('app', [
            'page' => ['component'=>'Breweries'],
            'user' => 'Luca'
        ]);
    }
}
