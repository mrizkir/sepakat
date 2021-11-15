<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Rules\IgnoreIfDataIsEqualValidation;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsersKumhamController extends Controller {         
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{           
		$this->hasPermissionTo('SYSTEM-USERS-KUMHAM_BROWSE');
		$data = User::where('default_role','kumham')
					->orderBy('username','ASC')
					->get();

		$role = Role::findByName('kumham');

		return Response()->json([
								'status'=>1,
								'pid'=>'fetchdata',
								'role'=>$role,
								'users'=>$data,
								'message'=>'Fetch data users berhasil diperoleh'
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
		$this->hasPermissionTo('SYSTEM-USERS-KUMHAM_STORE');
		$this->validate($request, [
			'name'=>'required',
			'email'=>'required|string|email|unique:users',
			'nomor_hp'=>'required|string|unique:users',
			'username'=>'required|string|unique:users',
			'password'=>'required',
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
				'email_verified_at'=>\Carbon\Carbon::now(),
				'theme'=>'default',            
				'default_role'=>'kumham',            
				'foto'=> 'storage/images/users/no_photo.png',
				'created_at'=>$now, 
				'updated_at'=>$now
			]);            
			$role='kumham';   
			$user->assignRole($role);               
			
			$permission=Role::findByName('kumham')->permissions;
			$permissions=$permission->pluck('name');
			$user->givePermissionTo($permissions);

			$daftar_roles=json_decode($request->input('role_id'),true);
			foreach($daftar_roles as $v)
			{
				if ($v!='kumham' && $v!='superadmin')
				{
					$user->assignRole($v);               
					$permission=Role::findByName($v)->permissions;
					$permissions=$permission->pluck('name');
					$user->givePermissionTo($permissions);
				}
			}
			\App\Models\System\ActivityLog::log($request,[
											'object' => $this->guard()->user(), 
											'object_id' => $this->guard()->user()->id, 
											'user_id' => $this->getUserid(), 
											'message' => 'Menambah user ('.$user->username.') berhasil'
										]);

			return $user;
		});
		return Response()->json([
									'status'=>1,
									'pid'=>'store',
									'user'=>$user,                                    
									'message'=>'Data user berhasil disimpan.'
								],200); 

	}
	/**
	 * digunakan untuk mendapatkan detail user
	 */
	public function show(Request $request,$id)
	{
		
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
		$this->hasPermissionTo('SYSTEM-USERS-KUMHAM_UPDATE');

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
									]);  
			
			$user = \DB::transaction(function () use ($request,$user){
				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->username = $request->input('username');                        
				$user->nomor_hp = $request->input('nomor_hp');                        
				if (!empty(trim($request->input('password')))) {
					$user->password = Hash::make($request->input('password'));
				}    
				$user->updated_at = \Carbon\Carbon::now()->toDateTimeString();
				$user->save();                
				
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
				foreach($daftar_roles as $v)
				{
					if ($v!='kumham' && $v!='superadmin')
					{              
						$permission=Role::findByName($v)->permissions;
						$permissions=$permission->pluck('name');
						$user->givePermissionTo($permissions);
					}
				}
				
				$role='kumham';   
				$user->assignRole($role);

				\App\Models\System\ActivityLog::log($request,[
																'object' => $this->guard()->user(), 
																'object_id' => $this->guard()->user()->id, 
																'user_id' => $this->getUserid(), 
																'message' => 'Mengubah data user ('.$user->username.') berhasil'
															]);

				return Response()->json([
											'status'=>1,
											'pid'=>'update',
											'user'=>$user,                                    
											'message'=>'Data user '.$user->username.' berhasil diubah.'
										],200); 
			});
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
		$this->hasPermissionTo('SYSTEM-USERS-KUMHAM_DESTROY');

		$user = User::where('isdeleted',true)
					->find($id); 

		if (is_null($user))
		{
			return Response()->json([
									'status'=>0,
									'pid'=>'destroy',                                      
									'message'=>["User dengan id ($id) gagal dihapus"]
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
																'message' => 'Menghapus user ('.$username.') berhasil'
															]);

			return Response()->json([
									'status'=>1,
									'pid'=>'destroy',  
									'user'=>$user,              
									'message'=>"User ($username) berhasil dihapus"
								],200);    
		}
			 
				  
	}    
}