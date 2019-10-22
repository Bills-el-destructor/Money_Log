@extends('layouts.app')
@section('content')
    <h1>Editar el movimiento {{ $movement->id }}</h1>

    {!! Form::model(
        $movement,
        [
            'route' => ['movements.update', $movement],
            'files' => 'true',
            'method' => 'PUT',

        ]
    )!!}

    @include('movements.partials.form') <!-- mandamos la informacion a¿hacia aqui -->

    {!! Form::close()!!}
@endsection