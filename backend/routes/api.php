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
    $router->post('/dashboard/pmb',['middleware'=>['role:superadmin|pmb'],'uses'=>'SPMB\SPMBController@index','as'=>'dashboardspmb.index']);
    $router->post('/dashboard/keuangan',['middleware'=>['role:superadmin'],'uses'=>'Keuangan\KeuanganController@index','as'=>'dashboardkeuangan.index']);

    //data master - kelas
    $router->post('/datamaster/kelas/store',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@store','as'=>'kelas.store']);
    $router->put('/datamaster/kelas/{id}',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@update','as'=>'kelas.update']);
    $router->delete('/datamaster/kelas/{id}',['middleware'=>['role:superadmin'],'uses'=>'DMaster\JenisKegiatanController@destroy','as'=>'`kelas`.destroy']);

    //konsultasi - kegiatan
    $router->get('/konsultasi/kegiatan',['middleware'=>['role:superadmin'],'uses'=>'Konsultasi\KonsultasiKegiatanController@index','as'=>'konsultasikegiatan.index']);
    $router->post('/konsultasi/kegiatan/store',['middleware'=>['role:superadmin'],'uses'=>'Konsultasi\KonsultasiKegiatanController@store','as'=>'konsultasikegiatan.store']);
    $router->put('/konsultasi/kegiatan/{id}',['middleware'=>['role:superadmin'],'uses'=>'Konsultasi\KonsultasiKegiatanController@update','as'=>'konsultasikegiatan.update']);
    $router->delete('/konsultasi/kegiatan/{id}',['middleware'=>['role:superadmin'],'uses'=>'Konsultasi\KonsultasiKegiatanController@destroy','as'=>'konsultasikegiatan.destroy']);

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
    $router->get('/system/usersparalegal',['middleware'=>['role:superadmin|keuangna'],'uses'=>'System\UsersParaLegalController@index','as'=>'usersparalegal.index']);
    $router->post('/system/usersparalegal/store',['middleware'=>['role:superadmin'],'uses'=>'System\UsersParaLegalController@store','as'=>'usersparalegal.store']);
    $router->put('/system/usersparalegal/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersParaLegalController@update','as'=>'usersparalegal.update']);
    $router->delete('/system/usersparalegal/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersParaLegalController@destroy','as'=>'usersparalegal.destroy']);

    //setting - users kades
    $router->get('/system/userskades',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKadesController@index','as'=>'userskades.index']);
    $router->post('/system/userskades/store',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKadesController@store','as'=>'userskades.store']);
    $router->put('/system/userskades/{id}',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKadesController@update','as'=>'userskades.update']);
    $router->delete('/system/userskades/{id}',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKadesController@destroy','as'=>'userskades.destroy']);

    //setting - users pmb
    $router->get('/system/userspmb',['middleware'=>['role:superadmin|pmb'],'uses'=>'System\UsersPMBController@index','as'=>'userspmb.index']);
    $router->post('/system/userspmb/store',['middleware'=>['role:superadmin|pmb'],'uses'=>'System\UsersPMBController@store','as'=>'userspmb.store']);
    $router->put('/system/userspmb/{id}',['middleware'=>['role:superadmin|pmb'],'uses'=>'System\UsersPMBController@update','as'=>'userspmb.update']);
    $router->delete('/system/userspmb/{id}',['middleware'=>['role:superadmin|pmb'],'uses'=>'System\UsersPMBController@destroy','as'=>'userspmb.destroy']);

    //setting - users obh
    $router->get('/system/usersobh',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@index','as'=>'usersobh.index']);
    $router->post('/system/usersobh/store',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@store','as'=>'usersobh.store']);
    $router->put('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@update','as'=>'usersobh.update']);
    $router->get('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@show','as'=>'usersobh.show']);
    $router->delete('/system/usersobh/{id}',['middleware'=>['role:superadmin'],'uses'=>'System\UsersOBHController@destroy','as'=>'usersobh.destroy']);

    //setting - users kumham
    $router->get('/system/userskumham',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKumhamController@index','as'=>'userskumham.index']);
    $router->post('/system/userskumham/store',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKumhamController@store','as'=>'userskumham.store']);
    $router->put('/system/userskumham/{id}',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKumhamController@update','as'=>'userskumham.update']);
    $router->delete('/system/userskumham/{id}',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\UsersKumhamController@destroy','as'=>'userskumham.destroy']);

    //system-migration
    $router->post('/system/migration',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\SystemMigrationController@index','as'=>'systemmigration.index']);
    $router->post('/system/migration/store',['middleware'=>['role:superadmin|akademik'],'uses'=>'System\SystemMigrationController@store','as'=>'systemmigration.store']);

    //untuk ui admin
    $router->get('/system/setting/uiadmin',['uses'=>'System\UIController@admin','as'=>'ui.admin']);

});
