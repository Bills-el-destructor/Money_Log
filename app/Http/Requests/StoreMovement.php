<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMovement extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); /* Retorna verdadero o true si esta autenticado o no */
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::in(['Egreso', 'Ingreso']) /* Indica que debe seleccionar una de las dos opciones */
            ],
            'movement_date' => 'required | date',
            'category_id' => 'required',
            'description' => 'required | min:3 | max:1000',
            'money_decimal' => 'required | numeric | min:0.01',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return[
            'type_required' => 'El campo tipo es requerido',
            'type_in' => 'El valor del campo tipo no es válido',
            'movement_date.required' => 'El campo fecha es requerido',
            'movement_date.date' => 'La fecha no es válida',
            'category_id.required' => 'La categoría es obligatoria',
            'description.required' => 'La descripción es requerida',
            'description.min' => 'La descripcion debe tener 3 caracteres o más',
            'description.max' => 'La descripcion no debe superar los 1000 caracteres',
            'money_decimal.required' => 'EL monto es obligatorio',
            'money_decimal.numeric' => 'El monto debe ser un numero',
            'money_decimal.min' => 'El monto debe ser mayor a cero',
            'image.image' => 'El archivo debe ser una imagen'
        ];
    }
}
