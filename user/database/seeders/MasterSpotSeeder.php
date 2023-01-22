<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => '自動販売機'],
            ['id' => 2, 'name' => 'コンビニ'],
            ['id' => 3, 'name' => 'カルディコーヒー'],
            ['id' => 4, 'name' => 'その他']
        ];
        \DB::table('master_spots')->truncate();
        \DB::table('master_spots')->insert($data);
    }
}
