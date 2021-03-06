<?php
$router->get('/', function () use ($router) {
    return 'SEPAKAT API';
});

$router->group(['prefix'=>'v1'], function () use ($router)
{

    //dmaster - provinsi
    $router->get('/datamaster/provinsi',['uses'=>'DMaster\ProvinsiController@index','as'=>'provinsi.index']);
    $router->get('/datamaster/provinsi/{id}/kabupaten',['uses'=>'DMaster\ProvinsiController@kabupaten','as'=>'provinsi.kabupaten']);

    //dmaster - kabupaten
    $router->get('/datamaster/kabupaten',['uses'=>'DMaster\KabupatenController@index','as'=>'kabupaten.index']);
    $router->get('/datamaster/kabupaten/{id}/kecamatan',['uses'=>'DMaster\KabupatenController@kecamatan','as'=>'kabupaten.kecamatan']);
    $router->get('/datamaster/kabupaten/{id}/desa',['uses'=>'DMaster\KabupatenController@desa','as'=>'kabupaten.desa']);

    //dmaster - kecamatan
    $router->get('/datamaster/kecamatan',['uses'=>'DMaster\KecamatanController@index','as'=>'kecamatan.index']);
    $router->get('/datamaster/kecamatan/{id}/desa',['uses'=>'DMaster\KecamatanController@desa','as'=>'kecamatan.desa']);

    //dmaster - tahun akademik
    $router->get('/datamaster/tahundata',['uses'=>'DMaster\TahunDataController@index','as'=>'tahundata.index']);
    
    //dmaster - jenis kegiatan
    $router->get('/datamaster/jeniskegiatan',['uses'=>'DMaster\JenisKegiatanController@index','as'=>'jeniskegiatan.index']);

    //untuk uifront
    $router->get('/system/setting/uifront',['uses'=>'System\UIController@frontend','as'=>'uifront.frontend']);

    $router->post('/auth/login',['uses'=>'AuthController@login','as'=>'auth.login']);
});

$router->group(['prefix'=>'v1','middleware'=>'auth:api'], function () use ($router)
{
    //authentication
    $router->post('/auth/logout',['uses'=>'AuthController@logout','as'=>'auth.logout']);
    $router->get('/auth/refresh',['uses'=>'AuthController@refresh','as'=>'auth.refresh']);
    $router->get('/auth/me',['uses'=>'AuthController@me','as'=>'auth.me']);

    // dashboard
    $router->get('/dashboard',['uses'=>'DashboardController@index','as'=>'dashboard.index']);

    //data master - kelas
    $router->post('/datamaster/kelas/store',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@store','as'=>'kelas.store']);
    $router->put('/datamaster/kelas/{id}',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@update','as'=>'kelas.update']);
    $router->delete('/datamaster/kelas/{id}',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@destroy','as'=>'`kelas`.destroy']);

    //konsultasi - kegiatan
    $router->get('/konsultasi/kegiatan',['middleware'=>['role:superadmin|paralegal|obh|pmb|kades|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@index','as'=>'konsultasikegiatan.index']);
    $router->post('/konsultasi/kegiatan/store',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@store','as'=>'konsultasikegiatan.store']);
    $router->get('/konsultasi/kegiatan/{id}',['middleware'=>['role:superadmin|paralegal|obh|pmb|kades|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@show','as'=>'konsultasikegiatan.show']);
    $router->put('/konsultasi/kegiatan/{id}',['middleware'=>['role:superadmin|paralegal|obh|pmb|kades|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@update','as'=>'konsultasikegiatan.update']);
    $router->put('/konsultasi/kegiatan/verifikasi/{id}',['middleware'=>['role:superadmin|obh|pmb|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@verifikasi','as'=>'konsultasikegiatan.verifikasi']);
    
    $router->post('/konsultasi/kegiatan/uploadktppemohon/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@uploadktppemohon','as'=>'konsultasikegiatan.uploadktppemohon']);
    $router->post('/konsultasi/kegiatan/hapusktppemohon/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@hapusktppemohon','as'=>'konsultasikegiatan.hapusktppemohon']);
    
    $router->post('/konsultasi/kegiatan/uploaddaftarhadir/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@uploaddaftarhadir','as'=>'konsultasikegiatan.uploaddaftarhadir']);
    $router->post('/konsultasi/kegiatan/hapusdaftarhadir/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@hapusdaftarhadir','as'=>'konsultasikegiatan.hapusdaftarhadir']);
    
    $router->post('/konsultasi/kegiatan/uploaddokumentasikegiatan/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@uploaddokumentasikegiatan','as'=>'konsultasikegiatan.uploaddokumentasikegiatan']);
    $router->post('/konsultasi/kegiatan/hapusdokumentasikegiatan/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@hapusdokumentasikegiatan','as'=>'konsultasikegiatan.hapusdokumentasikegiatan']);
    
    $router->delete('/konsultasi/kegiatan/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'Konsultasi\KonsultasiKegiatanController@destroy','as'=>'konsultasikegiatan.destroy']);
    
    //konsultasi - komentar kegiatan
    $router->get('/konsultasi/komentar/{id}',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Konsultasi\KomentarKegiatanController@index','as'=>'komentar.index']);
    $router->post('/konsultasi/komentar/store',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Konsultasi\KomentarKegiatanController@store','as'=>'komentar.store']);    
    $router->put('/konsultasi/komentar/{id}',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Konsultasi\KomentarKegiatanController@update','as'=>'komentar.update']);    
    $router->delete('/konsultasi/komentar/{id}',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Konsultasi\KomentarKegiatanController@destroy','as'=>'komentar.destroy']);

    //report - kegiatan
    $router->get('/report/kegiatan',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Report\ReportKegiatanController@index','as'=>'reportkegiatan.index']);
    $router->post('/report/kegiatan/printpdf',['middleware'=>['role:superadmin|paralegal|kades|pmb|obh|kumham'],'uses'=>'Report\ReportKegiatanController@printpdf','as'=>'reportkegiatan.printpdf']);

    //setting - permissions
    $router->get('/system/setting/permissions',['middleware'=>['role:superadmin'],'uses'=>'System\PermissionsController@index','as'=>'permissions.index']);
    $router->post('/system/setting/permissions/store',['middleware'=>['role:superadmin'],'uses'=>'System\PermissionsController@store','as'=>'permissions.store']);
    $router->delete('/system/setting/permissions/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\PermissionsController@destroy','as'=>'permissions.destroy']);

    //setting - roles
    $router->get('/system/setting/roles',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@index','as'=>'roles.index']);
    $router->post('/system/setting/roles/store',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@store','as'=>'roles.store']);
    $router->post('/system/setting/roles/storerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@storerolepermissions','as'=>'roles.storerolepermissions']);
    $router->post('/system/setting/roles/revokerolepermissions',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@revokerolepermissions','as'=>'users.revokerolepermissions']);
    $router->put('/system/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@update','as'=>'roles.update']);
    $router->delete('/system/setting/roles/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@destroy','as'=>'roles.destroy']);
    $router->get('/system/setting/roles/{id}/permission',['middleware'=>['role:superadmin'],'uses'=>'System\RolesController@rolepermissions','as'=>'roles.permission']);

    //setting - variables
    $router->get('/system/setting/variables',['middleware'=>['role:superadmin'],'uses'=>'System\VariablesController@index','as'=>'variables.index']);
    $router->get('/system/setting/variables/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\VariablesController@show','as'=>'variables.show']);
    $router->put('/system/setting/variables',['middleware'=>['role:superadmin'],'uses'=>'System\VariablesController@update','as'=>'variables.update']);
    $router->post('/system/setting/variables/clear',['middleware'=>['role:superadmin'],'uses'=>'System\VariablesController@clear','as'=>'variables.clear']);

    //setting - users
    $router->get('/system/users',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@index','as'=>'users.index']);
    $router->post('/system/users/store',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@store','as'=>'users.store']);
    $router->put('/system/users/updatepassword/{id}',['uses'=>'System\UsersController@updatepassword','as'=>'users.updatepassword']);
    $router->post('/system/users/uploadfoto/{id}',['uses'=>'System\UsersController@uploadfoto','as'=>'users.uploadfoto']);
    $router->post('/system/users/resetfoto/{id}',['uses'=>'System\UsersController@resetfoto','as'=>'users.resetfoto']);
    $router->post('/system/users/syncallpermissions',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@syncallpermissions','as'=>'users.syncallpermissions']);
    $router->post('/system/users/storeuserpermissions',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@storeuserpermissions','as'=>'users.storeuserpermissions']);
    $router->post('/system/users/revokeuserpermissions',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@revokeuserpermissions','as'=>'users.revokeuserpermissions']);
    $router->put('/system/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@update','as'=>'users.update']);
    $router->get('/system/users/{id}',['uses'=>'System\UsersController@show','as'=>'users.show']);
    $router->delete('/system/users/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@destroy','as'=>'users.destroy']);
    $router->get('/system/users/{id}/permission',['middleware'=>['role:superadmin|bapelitbang|opd'],'uses'=>'System\UsersController@userpermissions','as'=>'users.permission']);
    $router->get('/system/users/{id}/desa',['middleware'=>['role:superadmin'],'uses'=>'System\UsersController@usersdesa','as'=>'users.desa']);
    $router->get('/system/users/{id}/roles',['uses'=>'System\UsersController@roles','as'=>'users.roles']);

    //setting - users paralegal
    $router->get('/system/usersparalegal',['middleware'=>['role:superadmin|paralegal|kumham|obh|kades|pmd'],'uses'=>'System\UsersParaLegalController@index','as'=>'usersparalegal.index']);
    $router->post('/system/usersparalegal/store',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'System\UsersParaLegalController@store','as'=>'usersparalegal.store']);
    $router->put('/system/usersparalegal/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'System\UsersParaLegalController@update','as'=>'usersparalegal.update']);
    $router->delete('/system/usersparalegal/{id}',['middleware'=>['role:superadmin|paralegal|kumham'],'uses'=>'System\UsersParaLegalController@destroy','as'=>'usersparalegal.destroy']);

    //setting - users kades
    $router->get('/system/userskades',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKadesController@index','as'=>'userskades.index']);
    $router->post('/system/userskades/store',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKadesController@store','as'=>'userskades.store']);
    $router->put('/system/userskades/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKadesController@update','as'=>'userskades.update']);
    $router->delete('/system/userskades/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKadesController@destroy','as'=>'userskades.destroy']);

    //setting - users pmb
    $router->get('/system/userspmb',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersPMBController@index','as'=>'userspmb.index']);
    $router->post('/system/userspmb/store',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersPMBController@store','as'=>'userspmb.store']);
    $router->put('/system/userspmb/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersPMBController@update','as'=>'userspmb.update']);
    $router->delete('/system/userspmb/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersPMBController@destroy','as'=>'userspmb.destroy']);

    //setting - users obh
    $router->get('/system/usersobh',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@index','as'=>'usersobh.index']);
    $router->post('/system/usersobh/store',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@store','as'=>'usersobh.store']);
    $router->put('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@update','as'=>'usersobh.update']);
    $router->get('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@show','as'=>'usersobh.show']);
    $router->delete('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@destroy','as'=>'usersobh.destroy']);

    //setting - users kumham
    $router->get('/system/userskumham',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKumhamController@index','as'=>'userskumham.index']);
    $router->post('/system/userskumham/store',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKumhamController@store','as'=>'userskumham.store']);
    $router->put('/system/userskumham/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKumhamController@update','as'=>'userskumham.update']);
    $router->delete('/system/userskumham/{id}',['middleware'=>['role:superadmin|kumham'],'uses'=>'System\UsersKumhamController@destroy','as'=>'userskumham.destroy']);

    //untuk ui admin
    $router->get('/system/setting/uiadmin',['uses'=>'System\UIController@admin','as'=>'ui.admin']);

});
