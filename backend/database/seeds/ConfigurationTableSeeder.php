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
        \DB::statement('DELETE FROM configuration');
        
        \DB::table('configuration')->insert([
            'config_id'=>"101",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_APP',
            'config_value'=>'SISTEM ELEKTRONIK PARA LEGAL MASYARAKAT',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  

        \DB::table('configuration')->insert([
            'config_id'=>"102",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_APP_ALIAS',
            'config_value'=>'SEPAKAT',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('configuration')->insert([
            'config_id'=>"103",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_KANWIL',
            'config_value'=>'KANTOR WILAYAH KEMENTRIAN HUKUM DAN HAM PROVINSI KEPULAUAN RIAU',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);        

        \DB::table('configuration')->insert([
            'config_id'=>"104",
            'config_group'=>'identitas',
            'config_key'=>'NAMA_KANWIL_ALIAS',
            'config_value'=>'KANWIL KEMENHUMKAN',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('configuration')->insert([
            'config_id'=>"201",
            'config_group'=>'basic',
            'config_key'=>'DEFAULT_TA',
            'config_value'=>date('Y'),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        
        \DB::table('configuration')->insert([
            'config_id'=>"301",
            'config_group'=>'wilayah',
            'config_key'=>'DEFAULT_PROVINSI',
            'config_value'=>21,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  
        
        \DB::table('configuration')->insert([
            'config_id'=>"302",
            'config_group'=>'wilayah',
            'config_key'=>'DEFAULT_KABUPATEN',
            'config_value'=>2102,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  

        \DB::table('configuration')->insert([
            'config_id'=>"303",
            'config_group'=>'wilayah',
            'config_key'=>'DEFAULT_KECAMATAN',
            'config_value'=>null,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  

        \DB::table('configuration')->insert([
            'config_id'=>"304",
            'config_group'=>'wilayah',
            'config_key'=>'DEFAULT_DESA',
            'config_value'=>null,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);  

        \DB::table('configuration')->insert([
            'config_id'=>"901",
            'config_group'=>'server',
            'config_key'=>'CAPTCHA_SITE_KEY',
            'config_value'=>'$',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        \DB::table('configuration')->insert([
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
