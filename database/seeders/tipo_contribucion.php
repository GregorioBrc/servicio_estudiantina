<?php

namespace Database\Seeders;

use App\Models\tipo_contribucion as ModelsTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipo_contribucion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tipo1 = new ModelsTipo();
        $Tipo2 = new ModelsTipo();
        $Tipo3 = new ModelsTipo();

        $Tipo1->nombre_contribucion = "Autor";
        $Tipo2->nombre_contribucion = "Compositor";
        $Tipo3->nombre_contribucion = "Arreglista";

        $Tipo1->save();
        $Tipo2->save();
        $Tipo3->save();
    }
}
