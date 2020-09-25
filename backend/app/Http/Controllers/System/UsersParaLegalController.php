<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDesa;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\Rule;

class UsersParaLegalController extends Controller {         
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
        if ($this->hasRole('paralegal'))
        {
            $data = User::where('default_role','paralegal')
                        ->where('id',$this->getUserid())
                        ->orderBy('username','ASC')
                        ->get();           
        }
        else
        {
            $this->hasPermissionTo('SYSTEM-USERS-PARALEGAL_BROWSE');
            $data = User::where('default_role','paralegal')
                        ->orderBy('username','ASC')
                        ->get();       
        }
        
                    
        $role = Role::findByName('paralegal');
        return Response()->json([
                                'status'=>1,
                                'pid'=>'fetchdata',
                                'role'=>$role,
                                'users'=>$data,
                                'message'=>'Fetch data users LEGAL berhasil diperoleh'
                            ],200);  
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->hasPermissionTo('SYSTEM-USERS-PARALEGAL_STORE');
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|string|email|unique:users',
            'nomor_hp'=>'required|string|unique:users',
            'username'=>'required|string|unique:users',
            'password'=>'required',            
            'desa_id'=>'required',
        ]);
        $user = \DB::transaction(function () use ($request){
            $now = \Carbon\Carbon::now()->toDateTimeString();        
            $user=User::create([
                'id'=>Uuid::uuid4()->toString(),
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'nomor_hp'=>$request->input('nomor_hp'),
                'username'=> $request->input('username'),
                'password'=>Hash::make($request->input('password')),                        
                'theme'=>'default',
                'default_role'=>'paralegal',            
                'foto'=> 'storage/images/users/no_photo.png',
                'created_at'=>$now, 
                'updated_at'=>$now
            ]);            
            $role='paralegal';   
            $user->assignRole($role);               
            
            $user_id=$user->id;
            $daftar_desa=json_decode($request->input('desa_id'),true);
            foreach($daftar_desa as $v)
            {
                $desa_id=$v;
                $sql = "
                    INSERT INTO usersdesa (                    
                        user_id, 
                        desa_id,
                        kecamatan_id,
                        nama_kecamatan,
                        nama_desa,                        
                        created_at, 
                        updated_at
                    ) 
                    SELECT
                        '$user_id',                    
                        A.id,                        
                        A.kecamatan_id,
                        B.nama,
                        A.nama,                        
                        NOW() AS created_at,
                        NOW() AS updated_at
                    FROM wilayah_desa A JOIN wilayah_kecamatan B ON (A.kecamatan_id=B.ID)                    
                    WHERE 
                        A.id='$desa_id' 
                ";

                \DB::statement($sql); 
            }

            $daftar_roles=json_decode($request->input('role_id'),true);
            foreach($daftar_roles as $v)
            {
                $user->assignRole($v);               
                $permission=Role::findByName($v)->permissions;
                $permissions=$permission->pluck('name');
                $user->givePermissionTo($permissions);                            
            }
            $user->syncRoles($daftar_roles);

            \App\Models\System\ActivityLog::log($request,[
                                            'object' => $this->guard()->user(), 
                                            'object_id' => $this->guard()->user()->id, 
                                            'user_id' => $this->getUserid(), 
                                            'message' => 'Menambah user LEGAL ('.$user->username.') berhasil'
                                        ]);

            return $user;
        });

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'store',
                                    'user'=>$user,                                    
                                    'message'=>'Data user LEGAL berhasil disimpan.'
                                ],200); 

    }
    /**
     * digunakan untuk mendapatkan informasi detail user dengan role program studi
     */
    public function show(Request $request, $id)
    {
        $this->hasPermissionTo('SYSTEM-USERS-PARALEGAL_SHOW');

        $user = User::find($id);
        if (is_null($user))
        {
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',                
                                    'message'=>["User ID ($id) gagal diperoleh"]
                                ],422); 
        }
        else
        {
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'user'=>$user,                                       
                                    'message'=>'Data user '.$user->username.' berhasil diperoleh.'
                                ],200); 
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->hasPermissionTo('SYSTEM-USERS-PARALEGAL_UPDATE');

        $user = User::find($id);
        if (is_null($user))
        {
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',                
                                    'message'=>["User ID ($id) gagal diupdate"]
                                ],422); 
        }
        else
        {
            $this->validate($request, [
                                        'username'=>[
                                                        'required',
                                                        'unique:users,username,'.$user->id
                                                    ],           
                                        'name'=>'required',            
                                        'email'=>'required|string|email|unique:users,email,'.$user->id,
                                        'nomor_hp'=>'required|string|unique:users,nomor_hp,'.$user->id,   
                                        'desa_id'=>'required',           
                                    ]); 
            $user = \DB::transaction(function () use ($request,$user){
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->nomor_hp = $request->input('nomor_hp');
                $user->username = $request->input('username');        
                if (!empty(trim($request->input('password')))) {
                    $user->password = Hash::make($request->input('password'));
                }    
                $user->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                $user->save();

                if ($request->input('role_dosen')=='true')
                {
                    $user->assignRole('dosen'); 
                    $permission=Role::findByName('dosen')->permissions;
                    $permissions=$permission->pluck('name');
                    $user->givePermissionTo($permissions);
                }
                elseif ($user->hasRole('dosen'))
                {
                    $user->removeRole('dosen');
                    $permission=Role::findByName('dosen')->permissions;
                    $permissions=$permission->pluck('name');
                    $user->revokePermissionTo($permissions);
                }    
                $user_id=$user->id;
                \DB::table('usersdesa')->where('user_id',$user_id)->delete();
                $daftar_desa=json_decode($request->input('desa_id'),true);
                foreach($daftar_desa as $v)
                {
                    $desa_id=$v;
                    $sql = "
                        INSERT INTO usersdesa (                    
                            user_id, 
                            desa_id,
                            kecamatan_id,
                            nama_kecamatan,
                            nama_desa,                            
                            created_at, 
                            updated_at
                        ) 
                        SELECT
                            '$user_id',                    
                            A.id,                        
                            A.kecamatan_id,
                            B.nama,
                            A.nama,                        
                            NOW() AS created_at,
                            NOW() AS updated_at
                        FROM wilayah_desa A JOIN wilayah_kecamatan B ON (A.kecamatan_id=B.ID)                    
                        WHERE 
                            A.id='$desa_id' 
                    ";
                    \DB::statement($sql); 
                }
                $daftar_roles=json_decode($request->input('role_id'),true);                
                if (($key= array_search('dosen',$daftar_roles))===false)
                {                    
                    $key= array_search('dosenwali',$daftar_roles);                    
                    if (isset($daftar_roles[$key]))
                    {
                        unset($daftar_roles[$key]);
                    }                    
                }
                $user->syncRoles($daftar_roles);
                $dosen=UserDesa::find($user->id);

                foreach($daftar_roles as $v)
                {
                    if ($v=='dosen'||$v=='dosenwali') // sementara seperti ini karena kalau bertambah tinggal diganti
                    {              
                        $permission=Role::findByName($v)->permissions;
                        $permissions=$permission->pluck('name');
                        $user->givePermissionTo($permissions);

                        if ($v=='dosen' && is_null($dosen))
                        {
                            UserDesa::create([
                                'user_id'=>$user->id,
                                'nama_dosen'=>$request->input('name'),                                                            
                            ]);
                        }
                        else if ($v=='dosen' && !is_null($dosen))
                        {
                            $dosen->active=1;
                            $dosen->save();
                        }
                        else if (!is_null($dosen))
                        {
                            $dosen->active=0;
                            $dosen->save();
                        }
                        //set dosen wali
                        if ($v=='dosenwali' && $v=='dosen')
                        {
                            \DB::table('pe3_dosen')
                                ->where('user_id',$user->id)
                                ->update(['is_dw'=>true]);
                        }
                        else
                        {
                            \DB::table('pe3_dosen')
                                ->where('user_id',$user->id)
                                ->update(['is_dw'=>false]);
                        }
                    }
                }

                \App\Models\System\ActivityLog::log($request,[
                                                            'object' => $this->guard()->user(), 
                                                            'object_id' => $this->guard()->user()->id, 
                                                            'user_id' => $this->getUserid(), 
                                                            'message' => 'Mengubah data user LEGAL ('.$user->username.') berhasil'
                                                        ]);
                return $user;
            });

            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'update',
                                    'user'=>$user,      
                                    'message'=>'Data user LEGAL '.$user->username.' berhasil diubah.'
                                ],200); 
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    { 
        $this->hasPermissionTo('SYSTEM-USERS-PARALEGAL_DESTROY');

        $user = User::where('isdeleted','1')
                    ->find($id); 
        
        if (is_null($user))
        {
            return Response()->json([
                                    'status'=>1,
                                    'pid'=>'destroy',                
                                    'message'=>["User ID ($id) gagal dihapus"]
                                ],422); 
        }
        else
        {
            $username=$user->username;
            $user->delete();

            \App\Models\System\ActivityLog::log($request,[
                                                                'object' => $this->guard()->user(), 
                                                                'object_id' => $this->guard()->user()->id, 
                                                                'user_id' => $this->getUserid(), 
                                                                'message' => 'Menghapus user LEGAL ('.$username.') berhasil'
                                                            ]);
        
            return Response()->json([
                                        'status'=>1,
                                        'pid'=>'destroy',                
                                        'message'=>"User LEGAL ($username) berhasil dihapus"
                                    ],200);         
        }
                  
    }
}