<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'ドクターペッパー']
        ];
        \DB::table('master_products')->truncate();
        \DB::table('master_products')->insert($data);
    }
}
