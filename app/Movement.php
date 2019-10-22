<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{   

    protected $table = "movements";
    protected $fillable = [
        'type',
        'movement_date',
        'category_id',
        'description',
        'money',
    ];
    protected $dates = ['movement_date'];

    public function getMoneyDecimalAttribute(){
        /* cuando ingresemos 100.99 Laravel toma este valor y lo convierte en enter, Así -> 10099 */
        //pero la funcion nos retorna 100.99

        return $this->attributes['money']/100;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
