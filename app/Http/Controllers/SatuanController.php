<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Satuan;
use DB;
use Illuminate\Support\Facades\Session;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Satuan = Satuan::paginate(10);
        return view('Satuan.index',['Satuan' => $Satuan]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_satuan' => 'required'
            ]);

         $table="satuans";
        $primary="kode_satuan";
        $prefix="S";
        
        $Satuan = new Satuan;
        $Satuan->kode_satuan = $this->autonumber($table,$primary,$prefix);
        $Satuan->nama_satuan = $request->nama_satuan;
        $Satuan->save();

         Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil menyimpan " .
        "<strong>" . $Satuan->nama_satuan. "</strong>" 
        ]);
        return redirect()->route('admin.satuan.index');
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
        $Satuan = Satuan::find($id);
        return view('Satuan.edit', compact('Satuan'));
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
        $this->validate($request,[
           
            'nama_satuan' => 'required'
             ]);

        $Satuan =Satuan::find($id);

         $Satuan->update($request->all());

          Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Data " 
        ]);
       return redirect()->route('admin.satuan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Satuan = Satuan::find($id);
        $Satuan->delete();

         Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus " .
        "<strong>" . $Satuan->nama_satuan. "</strong>" 
        ]);
        return redirect()->route('admin.satuan.index');
    }
}
