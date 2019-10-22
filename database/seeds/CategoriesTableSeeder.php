<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Alimentación',
            'Transporte',
            'Arriendo',
            'Energía Eléctrica',
            'Acueducto',
            'Internet',
            'Telefono',
            'Televisión',
            'Netxflix',
            'Ropa'
        ];
        foreach ($names as $name){
            $category = Category::create(['name' => $name]);
        }
    }
}
