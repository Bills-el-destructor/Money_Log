<div class="form-group {{ $errors->has('movement_date') ? 'has-error' : '' }}">
    {!! Form::label('movement_date', 'Fecha') !!}

    {!! Form::date('movement_date',
        ($movement->movement_date) ? $movement->movement_date->format('Y-m-d') : date('Y-m-d'),
        [
            'required',
            'class' => 'form-control'    
        ]
    ) !!}

    @if($errors->has('movement_date'))
    <span class="help-block">
        <strong>{{ $errors->first('movement_date') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    {!! Form::label('type', 'Tipo') !!}

    {!! Form::select('type',
        ['Egreso' => 'Egreso', 'Ingreso' => 'Ingreso', ],
        null,
        [
            'required',
            'class' => 'form-control'    
        ]
    ) !!}

    @if($errors->has('type'))
    <span class="help-block">
        <strong>{{ $errors->first('type') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">

    {!! Form::label('category_id', 'Categoría') !!}

    {!! Form::select('category_id',
        $categories,
        null,
        [
            'required',
            'class' => 'form-control'
        ]
    )!!}

    @if($errors->has('category_id'))
    <span class="help-block">
        <strong>{{ $errors->first('category_id') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">

    {!! Form::label('description', 'descripción') !!}

    {!! Form::textarea('description',
        null,
        [
            'required',
            'placeholder' => 'Descripción',
            'autocomplete' => 'off',
            'maxlength' => 1000,
            'class' => 'form-control'
        ]
    )!!}

    @if($errors->has('description'))
    <span class="help-block">
        <strong>{{ $errors->first('description') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('money_decimal') ? 'has-error' : '' }}">

    {!! Form::label('money_decimal', 'Monto') !!}

    {!! Form::number('money_decimal',
        null,
        [
            'required',
            'placeholder' => 'Monto',
            'min' => 0,00,
            'step' => 0.01,
            'class' => 'form-control'
        ]
    )!!}

    @if($errors->has('money_decimal'))
    <span class="help-block">
        <strong>{{ $errors->first('money_decimal') }}</strong>
    </span>
    @endif
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">

    {!! Form::label('image', 'Imagen') !!}

    {!! Form::file('image',
        ['class' => 'form-control']
    )!!}

    @if($errors->has('image'))
    <span class="help-block">
        <strong>{{ $errors->first('image') }}</strong>
    </span>
    @endif
</div>
<div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar</button>
</div>

@section('scripts')
    <script>
        jQuery(function($){
            $('#category_id').select2({
                placeholder: 'Seleccione una categoria',
                tags: true,
                tokenSeparators: [',']
            });
        })
    </script>
@endsection