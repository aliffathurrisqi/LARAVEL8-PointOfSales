<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableController extends Controller
{
    public function simple()
    {
        $data['titles'] = "Simple Table";
        return view('pages.tables.simple-tables', $data);
    }

    public function datatable()
    {
        $data['titles'] = "Datatable";
        return view('pages.tables.datatable', $data);
    }

    public function jsgrid()
    {
        $data['titles'] = "JSGrid";
        return view('pages.tables.jsgrid', $data);
    }
}
