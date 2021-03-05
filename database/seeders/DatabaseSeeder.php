<?php

namespace Database\Seeders;

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

        DB::table('products')->insert([
            'name' => 'camisa',
            'description' => 'camisa manga larga arturo calle',
            'photo' => 'https://arturocalle.vteximg.com.br/arquivos/ids/308906-530-706/HOMBRE-CAMISA-10099868-AZUL-740_1.jpg?v=637456368079070000',
            'price' => 30000
          ]);
    }
}
