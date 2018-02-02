<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kategori;
use DB;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Kategori = Kategori::paginate(10);
        return view('Kategori.index',['Kategori' => $Kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public static function autonumber($table,$primary,$prefix){
        $q=DB::table($table)->select(DB::raw('MAX(RIGHT('.$primary.',3)) as kd_max'));
        $prx=$prefix;
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = $prx."001";
        }

        return $kd;
    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'nama_kategori' => 'required'
            ]);

          $table="kategoris";
        $primary="kode_kategori";
        $prefix="K";

        $Kategori = new Kategori;
        $Kategori->kode_kategori = $this->autonumber($table,$primary,$prefix);
        $Kategori->nama_kategori = $request->nama_kategori;
        $Kategori->save();

        Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil menyimpan " .
        "<strong>" . $Kategori->nama_kategori. "</strong>" 
        ]);

        return redirect()->route('admin.kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Kategori = Kategori::find($id);
        return view('Kategori.edit', compact('Kategori'));
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
        $this->validate($request, [
           
            'nama_kategori' => 'required'
            ]);
        $Kategori = Kategori::find($id);
        $Kategori->update($request->all());

         Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Data " 
        ]);
        return redirect()->route('admin.kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Kategori = Kategori::find($id);
        $Kategori->delete();

        Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus " .
        "<strong>" . $Kategori->nama_kategori. "</strong>" 
        ]);

        return redirect()->route('admin.kategori.index');
    }
}
