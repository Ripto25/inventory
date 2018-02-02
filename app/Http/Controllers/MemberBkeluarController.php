<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bkeluar;
use App\Barang;
use DB;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;

class MemberBkeluarController extends Controller
{
     public function index()
    {
        $MBkeluar = Bkeluar::latest()->paginate(10);
        $Barang = Barang::all();
        return view('MBkeluar.index', compact('MBkeluar','Barang'));
    }

    public function create(Request $request)
    {
        $q = $request->get('q');  
        $kode = Barang::where('kode_barang', '=',$q)->orWhere('nama_barang', '=', "$q")
                ->get();
        // $Barang = Barang::pluck('kode_barang','id');
        return view('MBkeluar.create',compact('q','kode'));
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
         $this->validate($request, ['jumlah' => 'required|numeric',
                                      'peminta' => 'required',
                                        'divisi' => 'required' ]);

        $table="bkeluars";
        $primary="kode_bk";
        $prefix="BK";
        
        $MBkeluar = new Bkeluar;

        $MBkeluar->barang_id = $request->barang_id;
        $Barang = Barang::find($MBkeluar->barang_id);

        $cek_stok = $Barang->stok_akhir;
        $jumlah = $request->jumlah;

        if($jumlah > $cek_stok)
        {
            Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Stok Barang Tidak Mencukupi Silahkan Ulangi Transaksi !!! " 
        ]);

             return redirect('member/memberbkeluar/create');
        }

        else{
        
        $MBkeluar->kode_bk =$this->autonumber($table,$primary,$prefix);
        $MBkeluar->barang_id = $request->barang_id;
        $MBkeluar->keterangan =$request->keterangan;
        $MBkeluar->jumlah = $request->jumlah;
         $MBkeluar->peminta = $request->peminta;
          $MBkeluar->divisi = $request->divisi;
      
        $MBkeluar->user = Auth::user()->name;
        $MBkeluar->save();
	

	 $Barang = Barang::find($MBkeluar->barang_id);
       $stok_akhir = $Barang->stok_akhir;
      
      
       $Barang->stok_akhir = $stok_akhir  - $request->jumlah;
      
       $Barang->update();

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi " 
        ]);


         return redirect('member/memberbkeluar');
    }

  }

  public function edit($id)
    {
        $MBkeluar = Bkeluar::find($id);
        return view('MBkeluar.edit',compact('MBkeluar'));
    }

     public function update(Request $request, $id)
    {
        $this->validate($request, ['jumlah' => 'required|numeric',
                                    'peminta' => 'required',
                                        'divisi' => 'required']);  

        $MBkeluar = Bkeluar::find($id);
        $Barang = Barang::find($MBkeluar->barang_id);  

        $jumlah_lama1 = $MBkeluar->jumlah;
        $stok_lama1 = $Barang->stok_akhir;
   //     // dd($total_stok_lama);
        $total_sementara = $stok_lama1 + $jumlah_lama1;
        $Barang->stok_akhir = $total_sementara;
        $Barang->update();

       $cek_stok = $Barang->stok_akhir;
       $jumlah = $request->jumlah;





   if($jumlah > $cek_stok)
        {
            Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Stok Barang Tidak Mencukupi Silahkan Ulangi Transaksi !!! " 
        ]);

            
             return redirect()->route('member.memberbkeluar.edit', $id);
        }

   else{
        

    $tampung = $cek_stok - $jumlah;
    $MBkeluar->jumlah = $jumlah;
       $Barang->stok_akhir = $tampung;
       $MBkeluar->peminta = $request->peminta;
          $MBkeluar->divisi = $request->divisi;
      
       $MBkeluar->update();
       $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);


         return redirect('member/memberbkeluar');

          }


    }

}
