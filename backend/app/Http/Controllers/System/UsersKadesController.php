<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\Rule;

class UsersKadesController extends Controller {         
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
        if ($this->hasRole('kades'))
        {
            $data = User::where('default_role','kades')
                        ->where('id',$this->getUserid())
                        ->orderBy('username','ASC')
                        ->get();           
        }
        else
        {
            $this->hasPermissionTo('SYSTEM-USERS-KADES_BROWSE');
            $data = User::where('default_role','kades')
                        ->orderBy('username','ASC')
                        ->get();       
        }
        
                    
        $role = Role::findByName('kades');
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
        $this->hasPermissionTo('SYSTEM-USERS-KADES_STORE');
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
                'default_role'=>'kades',            
                'foto'=> 'storage/images/users/no_photo.png',
                'created_at'=>$now, 
                'updated_at'=>$now
            ]);            
            $role='kades';   
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
        $this->hasPermissionTo('SYSTEM-USERS-KADES_SHOW');

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
        $this->hasPermissionTo('SYSTEM-USERS-KADES_UPDATE');

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
        $this->hasPermissionTo('SYSTEM-USERS-KADES_DESTROY');

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