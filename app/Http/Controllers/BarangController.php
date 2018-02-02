<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Barang;
use App\Bmasuk;
use DB;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Barang = Barang::latest()->paginate(10);
        return view('Barang.index', ['Barang' => $Barang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Barang.create');
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
        $this->validate($request, [
            'nama_barang' => 'required',
            'stok_awal' => 'required|numeric',
            'satuan_id' => 'required',
            'kategori_id' => 'required'
            ]);

        $table="barangs";
        $primary="kode_barang";
        $prefix="BRG";
        
        // return $kodeBarang;

        $Barang = new Barang;
        $Barang->kode_barang = $this->autonumber($table,$primary,$prefix);
        $Barang->nama_barang = $request->nama_barang;
        $Barang->stok_awal = $request->stok_awal;
        $Barang->satuan_id = $request->satuan_id;
        $Barang->kategori_id = $request->kategori_id;
        $Barang->stok_akhir = $request->stok_awal;
        

        $Barang->save();

        Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil menyimpan " .
        "<strong>" . $Barang->nama_barang. "</strong>" 
        ]);

        return redirect()->route('admin.barang.index');
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
        $Barang = Barang::find($id);
        return view('Barang.edit',compact('Barang'));
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
            
            'nama_barang' => 'required',
            'stok_awal' => 'required|numeric',
            'satuan_id' => 'required',
            'kategori_id' => 'required'
            ]);


        $Barang = Barang::find($id);
      
        $Barang->nama_barang = $request->nama_barang;
        $Barang->stok_awal = $request->stok_awal;
        $Barang->satuan_id = $request->satuan_id;
        $Barang->kategori_id = $request->kategori_id;
        $Barang->stok_akhir = $request->stok_awal;

        // if($Barang->stok_akhir != $Barang->stok_awal)
        // {
        //     $stok = Bmasuk::sum('jumlah');
        //     $Barang->stok_akhir = $stok + $request->stok_awal;
        // }
        // else{
        //     $Barang->stok_akhir = $request->stok_awal;
        // }
        
       

         Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Data " 
        ]);




        $Barang->update();

        // $Stok = Stok::where('id','=',$Barang->id)->first();
        // $Stok->stok_awal = $request->stok_awal;
        // $Stok->stok_akhir = $request->stok_awal;
        // $Stok->total_stok = $request->stok_awal;

        // // $Barang->stok()->update();
        // $Stok->update();
       return redirect()->route('admin.barang.index');
       // dd($Stok);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Barang = Barang::find($id);
        $Barang->delete();
        Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus " .
        "<strong>" . $Barang->nama_barang. "</strong>" 
        ]);
       return redirect()->route('admin.barang.index');
    }
}
