<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use DB;

class AdminController extends Controller
{
	public function user()
	{
		$users = User::all();

		return response()->json($users);
	}

	public function createuser(Request $request)
	{
		$request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password
		]);

		return response()->json([
            'message' => 'Great success! New user created',
            'task' => $user
        ]);
	}

	public function delete1($id)
	{
		$user = User::where('id',$id)->delete();

        return response()->json([
            'message' => 'Successfully deleted task!'
        ]);
	}

    public function getRole()
    {
    	$roles = Role::all();

    	return response()->json($roles);
    }

    public function updateRole($user_id,$role_id)
    {
    	$verify = DB::table('role_user')->where('user_id', $user_id)->get()->toArray();
    	//dd($verify);
    	if (empty($verify)) {
    		$update_role = DB::table('role_user')->insert(['user_id' => $user_id, 'role_id' => $role_id]);
    	} else {
    		$update_role = DB::table('role_user')
    					   ->where('user_id', $user_id)
    					   ->update(['role_id' => $role_id]);
    	}
    	return response()->json([
            'message' => 'Great success! Role Successfully updated'
        ]);
    }
}
