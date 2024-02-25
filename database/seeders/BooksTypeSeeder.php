<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\BooksType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Digital','Fisik'
        ];

        foreach ($data as $value) {
            BooksType::insert([
                'name' => $value
            ]);
        }
    }
}
