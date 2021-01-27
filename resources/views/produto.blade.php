@extends('layouts.app')
@section('title', 'Listando produto')
@section('content')
    <div class="row">
        <div class="offset-lg-3 col-lg-6">
            <produtos-show id="{{ $id }}"/>
        </div>
    </div>
@endsection