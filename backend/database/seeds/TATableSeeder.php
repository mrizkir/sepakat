<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class TATableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('DELETE FROM ta');
        
        \DB::table('ta')->insert([
            'tahun'=>date('Y'),
            'tahun_data'=>date('Y').'/'.(date('Y')+1),            
        ]);        

    }
}
