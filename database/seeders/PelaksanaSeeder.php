<?php

namespace Database\Seeders;

use App\Models\Pelaksana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelaksanaSeeder extends Seeder
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
                'name' => 'UPM',
                'description' => 'Unit Pelaksana Mutu',
            ],
            [
                'name' => 'Ka UPM',
                'description' => 'Kepala UPM',
            ],
            [
                'name' => 'Tim Auditor',
                'description' => 'Tim Auditor',
            ],
            [
                'name' => 'Ka Auditor',
                'description' => 'Kepala Auditor',
            ],
            [
                'name' => 'Auditee',
                'description' => 'Auditee',
            ],
            [
                'name' => 'Direktur',
                'description' => 'Direktur',
            ],
            [
                'name' => 'Wadir 1',
                'description' => 'Wadir 1',
            ],
            [
                'name' => 'Wadir 2',
                'description' => 'Wadir 2',
            ],
            [
                'name' => 'Ka Prodi',
                'description' => 'Ketua Prodi',
            ],
        ];
        
        Pelaksana::insert($attr);
    }
}
