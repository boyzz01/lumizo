<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('jenis_catalog')->insert([
            ['nama' => 'Project Management'],
            ['nama' => 'tataruang.co'],
            ['nama' => 'rumahuni'],
            ['nama' => 'Investor relation'],
            ['nama' => 'legalin.idn'],
            ['nama' => 'Laztia Land binjai'],
            ['nama' => 'Zevira Residence'],
            ['nama' => 'Pesona Khayangan Delitua']
        ]);
    }
}
