<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('DELETE FROM roles');
        \DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1;');
        \DB::table('roles')->insert([
            [
                'name'=>'superadmin',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ], 
            [
                'name'=>'paralegal',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],    
            [
                'name'=>'kades',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],    
            [
                'name'=>'pmb',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],   
            [
                'name'=>'obh',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],    
            [
                'name'=>'kumham',
                'guard_name'=>'api',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ],                
        ]);
        
        $role = Role::findByName('paralegal');
        $records=[
            'DASHBOARD_SHOW',
            'DMASTER-JENISKEGIATAN_BROWSE',
            'KONSULTASI-GROUP',
            
            'KONSULTASI-KEGIATAN_BROWSE',
            'KONSULTASI-KEGIATAN_SHOW',
            'KONSULTASI-KEGIATAN_DESTROY',
            'KONSULTASI-KEGIATAN_UPDATE',
            'KONSULTASI-KEGIATAN_STORE',
            
            'KONSULTASI-KOMENTAR-KEGIATAN_BROWSE',
            'KONSULTASI-KOMENTAR-KEGIATAN_SHOW',
            'KONSULTASI-KOMENTAR-KEGIATAN_DESTROY',
            'KONSULTASI-KOMENTAR-KEGIATAN_UPDATE',
            'KONSULTASI-KOMENTAR-KEGIATAN_STORE',

            'REPORT-GROUP',
            'REPORT-KEGIATAN_BROWSE',

            'SYSTEM-USERS-PARALEGAL_BROWSE',            
            
        ]; 
        $role->syncPermissions($records);

        $role = Role::findByName('kumham');
        $records=[
            'DASHBOARD_SHOW',
            'DMASTER-JENISKEGIATAN_BROWSE',
            'KONSULTASI-GROUP',
            
            'KONSULTASI-KEGIATAN_BROWSE',
            'KONSULTASI-KEGIATAN_SHOW',
            'KONSULTASI-KEGIATAN_DESTROY',
            'KONSULTASI-KEGIATAN_UPDATE',
            'KONSULTASI-KEGIATAN_STORE',
            
            'KONSULTASI-KOMENTAR-KEGIATAN_BROWSE',
            'KONSULTASI-KOMENTAR-KEGIATAN_SHOW',
            'KONSULTASI-KOMENTAR-KEGIATAN_DESTROY',
            'KONSULTASI-KOMENTAR-KEGIATAN_UPDATE',
            'KONSULTASI-KOMENTAR-KEGIATAN_STORE',          

            'REPORT-GROUP',
            'REPORT-KEGIATAN_BROWSE',

            'SYSTEM-USERS-KUMHAM_BROWSE',            
            'SYSTEM-USERS-KUMHAM_UPDATE',            
            'SYSTEM-USERS-KUMHAM_SHOW',            
            'SYSTEM-USERS-KUMHAM_UPDATE',            
            'SYSTEM-USERS-KUMHAM_DESTROY',            
            
            'SYSTEM-USERS-PARALEGAL_BROWSE',            
            'SYSTEM-USERS-PARALEGAL_UPDATE',            
            'SYSTEM-USERS-PARALEGAL_SHOW',            
            'SYSTEM-USERS-PARALEGAL_UPDATE',            
            'SYSTEM-USERS-PARALEGAL_DESTROY',            
            
        ]; 
        $role->syncPermissions($records);

        $role = Role::findByName('obh');
        $records=[
            'DASHBOARD_SHOW',
            'DMASTER-JENISKEGIATAN_BROWSE',
            'KONSULTASI-GROUP',
            
            'KONSULTASI-KEGIATAN_BROWSE',
            'KONSULTASI-KEGIATAN_SHOW',            
            'KONSULTASI-KEGIATAN_UPDATE',            
            
            'KONSULTASI-KOMENTAR-KEGIATAN_BROWSE',
            'KONSULTASI-KOMENTAR-KEGIATAN_SHOW',
            'KONSULTASI-KOMENTAR-KEGIATAN_DESTROY',
            'KONSULTASI-KOMENTAR-KEGIATAN_UPDATE',
            'KONSULTASI-KOMENTAR-KEGIATAN_STORE',

            'REPORT-GROUP',
            'REPORT-KEGIATAN_BROWSE',

            'SYSTEM-USERS-PARALEGAL_BROWSE',            
            
        ]; 
        $role->syncPermissions($records);
        
        $role = Role::findByName('pmb');
        $records=[
            'DASHBOARD_SHOW',
            'DMASTER-JENISKEGIATAN_BROWSE',
            'KONSULTASI-GROUP',
            
            'KONSULTASI-KEGIATAN_BROWSE',
            'KONSULTASI-KEGIATAN_SHOW',            
            'KONSULTASI-KEGIATAN_UPDATE',            
            
            'KONSULTASI-KOMENTAR-KEGIATAN_BROWSE',
            'KONSULTASI-KOMENTAR-KEGIATAN_SHOW',
            'KONSULTASI-KOMENTAR-KEGIATAN_DESTROY',
            'KONSULTASI-KOMENTAR-KEGIATAN_UPDATE',
            'KONSULTASI-KOMENTAR-KEGIATAN_STORE',

            'REPORT-GROUP',
            'REPORT-KEGIATAN_BROWSE',

            'SYSTEM-USERS-PARALEGAL_BROWSE',            
            
        ]; 
        $role->syncPermissions($records);
        
        $role = Role::findByName('kades');
        $records=[
            'DASHBOARD_SHOW',
            'DMASTER-JENISKEGIATAN_BROWSE',
            'KONSULTASI-GROUP',
            
            'KONSULTASI-KEGIATAN_BROWSE',
            'KONSULTASI-KEGIATAN_SHOW',                       
            
            'KONSULTASI-KOMENTAR-KEGIATAN_BROWSE',
            'KONSULTASI-KOMENTAR-KEGIATAN_SHOW',
            'KONSULTASI-KOMENTAR-KEGIATAN_DESTROY',
            'KONSULTASI-KOMENTAR-KEGIATAN_UPDATE',
            'KONSULTASI-KOMENTAR-KEGIATAN_STORE',

            'REPORT-GROUP',
            'REPORT-KEGIATAN_BROWSE',

            'SYSTEM-USERS-PARALEGAL_BROWSE',            
            
        ]; 
        $role->syncPermissions($records);
        
    }
}
