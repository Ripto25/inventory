<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Retur;
use App\Barang;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;

class MemberReturController extends Controller
{
     public function index()
    {
          $MRetur = Retur::latest()->paginate(10);
        $Barang = Barang::all();
        return view('MRetur.index', compact('MRetur','Barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $q = $request->get('q');  
        $kode = Barang::where('kode_barang', '=',$q)->orWhere('nama_barang', '=', "$q")
                ->get();
        // $Barang = Barang::pluck('kode_barang','id');
        return view('MRetur.create',compact('q','kode'));
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

        $table="returs";
        $primary="kode_r";
        $prefix="BR";
        
         $MRetur = new Retur;

          $MRetur->barang_id = $request->barang_id;
        $Barang = Barang::find($MRetur->barang_id);

        $cek_stok = $Barang->stok_akhir;
        $jumlah = $request->jumlah;

        if($jumlah > $cek_stok)
        {
            Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Stok Barang Tidak Mencukupi Silahkan Ulangi Transaksi !!! " 
        ]);

             return redirect('member/memberretur/create');
        }

        else{

        
         $MRetur->kode_r =$this->autonumber($table,$primary,$prefix);
         $MRetur->barang_id = $request->barang_id;
         $MRetur->keterangan =$request->keterangan;
         $MRetur->jumlah = $request->jumlah;
        
         $MRetur->user = Auth::user()->name;
         $MRetur->save();

        $Barang = Barang::find( $MRetur->barang_id);
       $stok_akhir = $Barang->stok_akhir;
       
       $Barang->stok_akhir = $stok_akhir  - $request->jumlah;
       
       $Barang->update();

 		Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi" 
        ]);


         return redirect('member/memberretur');
    }
    }

    public function edit($id)
    {
        $MRetur = Retur::find($id);
        return view('MRetur.edit',compact('MRetur'));
    }

     public function update(Request $request, $id)
    {
        $this->validate($request, ['jumlah' => 'required|numeric']);

         $MRetur = Retur::find($id);
         $Barang = Barang::find($MRetur->barang_id);  
   
       
       $jumlah_lama1 = $MRetur->jumlah;
       $stok_lama1 = $Barang->stok_akhir;

       // dd($total_stok_lama);
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

            
             return redirect()->route('member.memberretur.edit', $id);
        }

        else{

            $tampung = $cek_stok - $jumlah;
            $MRetur->jumlah = $jumlah;
            $Barang->stok_akhir = $tampung;
             
      
            $MRetur->update();
            $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);


         return redirect('member/memberretur');
        }
    }

}
