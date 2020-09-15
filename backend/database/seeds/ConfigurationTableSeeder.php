<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\System\ConfigurationModel;
class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('DELETE FROM pe3_configuration');
        
        \DB::table('pe3_configuration')->insert([
            'config_id'=>"101",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_APP',
            'config_value'=>'SISTEM ELEKTRONIK PARA LEGAL MASYARAKAT',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  

        \DB::table('pe3_configuration')->insert([
            'config_id'=>"102",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_APP_ALIAS',
            'config_value'=>'SEPAKAT',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('pe3_configuration')->insert([
            'config_id'=>"103",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_KANWIL',
            'config_value'=>'KANTOR WILAYAH KEMENTRIAN HUKUM DAN HAM PROVINSI KEPULAUAN RIAU',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);        

        \DB::table('pe3_configuration')->insert([
            'config_id'=>"104",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_KANWIL_ALIAS',
            'config_value'=>'KANWIL KEMENHUMKAN',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('pe3_configuration')->insert([
            'config_id'=>"201",
            'config_group'=>'basic',
            'config_key'=>'DEFAULT_TA',
            'config_value'=>date('Y'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
   
        \DB::table('pe3_configuration')->insert([
            'config_id'=>"901",
            'config_group'=>'server',
            'config_key'=>'CAPTCHA_SITE_KEY',
            'config_value'=>'$',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('pe3_configuration')->insert([
            'config_id'=>"902",
            'config_group'=>'server',
            'config_key'=>'CAPTCHA_PRIVATE_KEY',
            'config_value'=>'$',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        
        ConfigurationModel::toCache();
    }
}
