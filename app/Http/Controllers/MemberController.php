<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\User;
use App\Role;
use DB;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Member = User::latest()->paginate(3);
        // $Member = User::where()
      $Member = Role::where('name', 'member')->first()->users;
        return view('Member.index',['Member'=>$Member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $data = $request->all();
        $member = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
       
        // $data = $request->all();
       
        // // bypass verifikasi
        // $data['is_verified'] = 1;
        // $member = User::create($data);
        // set role
        $memberRole = Role::where('name', 'member')->first();
        $member->attachRole($memberRole);
       
        Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil menyimpan member dengan email " .
        "<strong>" . $data['email'] . "</strong>" .
        " dan password <strong>" . $data['password'] . "</strong>."
        ]);
        return redirect()->route('admin.member.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Members = User::find($id);
        return view('Member.edit',['Members'=> $Members]);
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
        $member = User::find($id);
        $member->update($request->all());

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $member->name"
        ]);

        return redirect()->route('admin.member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Member = User::find($id);
        $Member->delete();
        Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus  $Member->name" 
        ]);
        return redirect()->route('admin.member.index');
    }
}
