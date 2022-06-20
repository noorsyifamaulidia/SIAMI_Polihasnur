<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attr = [
            [
                'code' => 'M',
                'name' => 'Melampaui',
                'type' => 'Temuan',
            ],
            [
                'code' => 'T',
                'name' => 'Tercapai',
                'type' => 'Temuan',
            ],
            [
                'code' => 'O',
                'name' => 'Observasi',
                'type' => 'Temuan',
            ],
            [
                'code' => 'KTS',
                'name' => 'Ketidaksesuaian',
                'type' => 'Temuan',
            ],
        ];

        Category::insert($attr);
    }
}
