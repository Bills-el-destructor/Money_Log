@extends('layouts.app')
@section('content')
    <h1>Detalles del movimiento {{ $movement->id }}</h1>

    <table class="table table-border">
        <tr>
            <th>Tipo</th>
            <th>{{$movement->type}}</th>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{$movement->movement_date->format('Y-m-d')}}</td>
        </tr>
        <tr>
            <th>Categoría</th>
            <td>{{$movement->category->name}}</td>
        </tr>
        <tr>
            <th>Cantidad</th>
            <td>{{ number_format($movement->money_decimal, 2) }}</td>
        </tr>
        <tr>Descripción</tr>
        <th>{{ $movement->description}}</th>
    </table>
    @if($movement->image)
        <a href="{{ asset($movement->image)}}" class="thumbnail" target="blank">
            <img src="{{asset($movement->image)}} ">
        </a>    
    @endif

@endsection