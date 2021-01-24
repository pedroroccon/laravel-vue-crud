<?php

namespace Crud\Http\Controllers;

use App\Http\Controllers\Controller;
use Crud\Models\Produto;
use Crud\Filters\ProdutoFilters;
use Crud\Http\Requests\ProdutoRequest;
use Crud\Http\Resources\ProdutoCollection;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Crud\Filters\ProdutoFilters
     * @return \Illuminate\Http\Response
     */
    public function index(ProdutoFilters $filters)
    {
        $produtos = Produto::filter($filters)->get();
        return new ProdutoCollection($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Crud\Http\Requests\ProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $produto = (new Produto)->fill($request->all());
        $produto->save();

        return response($produto->toJson());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Crud\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return response($produto->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Crud\Http\Requests\ProdutoRequest  $request
     * @param  \Crud\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, Produto $produto)
    {        
        $produto->fill($request->all());
        $produto->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Crud\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
    }
}