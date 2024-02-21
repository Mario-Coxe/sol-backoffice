<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provincias;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [
            'Bengo',
            'Benguela',
            'Bié',
            'Cabinda',
            'Cuando Cubango',
            'Cuanza Norte',
            'Cuanza Sul',
            'Cunene',
            'Huambo',
            'Huíla',
            'Luanda',
            'Lunda Norte',
            'Lunda Sul',
            'Malanje',
            'Moxico',
            'Namibe',
            'Uíge',
            'Zaire',
        ];

        foreach ($provincias as $provincia) {
            Provincias::create([
                'name' => $provincia,
            ]);
        }
    }
}