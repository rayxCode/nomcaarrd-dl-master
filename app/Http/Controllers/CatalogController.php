<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index()
    {
        // get all the sharks
        $catalogs = catalogs::all();

        // load the view and pass the sharks
        return View::make('catalogs.index')
            ->with('catalog', $catalogs);
    }
}
