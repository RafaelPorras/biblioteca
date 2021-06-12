<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //llama al metodo truncateTablas para eliminar el contenido de las tablas pasadas en el array
        $this->truncateTablas([
            'rol',
            'permiso',
        ]);
        
        //ejecutar el seeder pasado
        $this->call(TablaRolSeeder::class);
        $this->call(TablaPermisoSeeder::class);
    }

    /**
     * metodo que va a truncar las tablas pasadas en el array
     * Previamente se desactivan las refencias a las foreign_key 
     * Se truncan las tablas
     * Se vuelve a activar las referencias
     */
    protected function truncateTablas(array $tablas){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
