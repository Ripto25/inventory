<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bmasuk;
use App\Barang;
use DB;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;


class MemberBmasukController extends Controller
{
    public function index()
    {
        $MBmasuk = Bmasuk::latest()->paginate(10);
        $MBarang = Barang::all();
        return view('MBmasuk.index', compact('MBmasuk','MBarang'));
    }

    public function create(Request $request)
    {
        $q = $request->get('q');  
        $kode = Barang::where('kode_barang', '=',$q)->orWhere('nama_barang', '=', "$q")
                ->get();
        // $Barang = Barang::pluck('kode_barang','id');
        return view('MBmasuk.create',compact('q','kode'));
    }


    public static function autonumber( $table,$primary,$prefix){
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
        $this->validate($request, ['jumlah' => 'required|numeric' ]);

        $table="bmasuks";
        $primary="kode_bm";
        $prefix="BM";
        
        $MBmasuk = new Bmasuk;

        
        $MBmasuk->kode_bm =$this->autonumber($table,$primary,$prefix);
        $MBmasuk->barang_id = $request->barang_id;
        $MBmasuk->keterangan =$request->keterangan;
        $MBmasuk->jumlah = $request->jumlah;
       
        $MBmasuk->user = Auth::user()->name;
        $MBmasuk->save();

       $Barang = Barang::find($MBmasuk->barang_id);
       $stok_akhir = $Barang->stok_akhir;
      
       $Barang->stok_akhir = $stok_akhir  + $request->jumlah;
      
       $Barang->update();

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi " 
        ]);


         return redirect('member/memberbmasuk');
    }


     public function edit($id)
    {

        $MBmasuk = Bmasuk::find($id);
        return view('MBmasuk.edit',compact('MBmasuk'));
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
        $this->validate($request, ['jumlah' => 'required|numeric'
                                     ]);

        

        $MBmasuk = Bmasuk::find($id);

        $Barang = Barang::find($MBmasuk->barang_id);  
   
       
         $jumlah_lama = $MBmasuk->jumlah;


       $total_stok_lama = $Barang->stok_akhir;

       // dd($total_stok_lama);

       $jumlah_tampung = $request->jumlah;

       $total_sementara = $total_stok_lama - $jumlah_lama;

       $total_baru = $total_sementara + $jumlah_tampung;

       $MBmasuk->jumlah = $jumlah_tampung;
       $Barang->stok_akhir = $total_baru;
       
       

      $MBmasuk->update();
       $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);

       


         return redirect('member/memberbmasuk');
    }
}
