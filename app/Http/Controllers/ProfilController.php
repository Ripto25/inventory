<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    
    public function editprofil()
    {
         return view('Profil.profil');
    }

   
    public function updateprofil(Request $request)
    {
		$user = Auth::user();
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|unique:users,email,' . $user->id
		]);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->save();

		Session::flash("flash_notification", [
			"level"=>"success",
			"message"=>"Profil berhasil diubah"
		]);

		return redirect('profil');  
    }

    public function editpassword()
    {
    	return view('Profil.password');
    }

    public function updatepassword(Request $request)
    {
		 $user = Auth::user();
		$this->validate($request, [
		'password' => 'required|passcheck:' . $user->password,
		'new_password' => 'required|confirmed|min:6',
		], [
		'password.passcheck' => 'Password lama tidak sesuai'
		]);

		$user->password = bcrypt($request->get('new_password'));
		$user->save();
		Session::flash("flash_notification", [
		"level"=>"success",
		"message"=>"Password berhasil diubah"
		]);
		return redirect('password');
		    }

    
}
