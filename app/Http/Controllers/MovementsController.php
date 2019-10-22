<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreMovement;
use App\Movement;
use Illuminate\Http\Request;

class MovementsController extends Controller
{
    public function __construct() /* Función para asegurarnos que el usurario esta realmente autenticado */
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Movimientos";
        $movements = Movement::where('user_id', auth()->user()->id);
        if($request->has('type')){
            $movements = $movements->where('type', $request->get('type'));
            $title = 'Movimiento '. $request->get('type');
        }
        $movements = $movements->orderBy('movement_date', 'desc')->paginate(10);

        return view('movements.index', compact('movements', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('movements.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovement $request)
    {
        $movement = new Movement($request->all()); /* Llene todos los campos que viene con el Request */
        $movement->money = $request->get('money_decimal') * 100;

        $category = $request->get('category_id');

        if(!is_numeric($category)){
            $newCategory = Category::firstOrCreate(['name' => ucwords($category)]);
            $movement->category_id = $newCategory;  
        }

        $movement->user_id = auth()->user()->id;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $file = $image->store('images/movements');

            $movement->image = $file;
        }

        $movement->save();
        
        return redirect()->route('movements.show', $movement->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movement = Movement::where('user_id', auth()->user()->id) /* Verficar que el usuario es el que esta autenticado */
        ->where('id', $id) /* donde el id del movimiento sea al que estamos recibiendo */
        ->first();

        return view('movements.show', compact('movement'));
    }




















    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        $movement = Movement::where('user_id', auth()->user()->id)
        ->where('id', $id)
        ->first();
        return view('movements.edit', compact('categories', 'movement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovement $request, $id)
    {
        $movement = Movement::where('user_id', auth()->user()->id)
        ->where('id', $id)
        ->first();

        $movement->type = $request->get('type');
        $movement->movement_date = $request->get('movement_date');
        $movement->money = $request->get('money_decimal')*100;
        $movement->description = $request->get('description');

        $category = $request->get('category_id');
        if(!is_numeric($category)){
            $newCategory = Category::firstOrCreate(['name'=>ucwords($category)]);
            $movement->category_id = $newCategory->id;
        }
        if($request->hasFile('image')){
            $image = $request->file('image');
            $file = $image->store('images/movements');

            $movement->image = $file;
        }

        $movement->save();
        return redirect()->route('movements.show', $movement->id);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
