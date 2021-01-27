<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function show($id)
    {
        return view('produto', compact('id'));
    }
}
