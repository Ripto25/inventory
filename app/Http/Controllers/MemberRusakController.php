<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Brusak;
use App\Barang;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;

class MemberRusakController extends Controller
{
    public function index()
    {
        $MBrusak = Brusak::latest()->paginate(10);
        $Barang = Barang::all();
        return view('MBrusak.index', compact('MBrusak','Barang'));
    }

    
    public function create(Request $request)
    {
        $q = $request->get('q');  
        $kode = Barang::where('kode_barang', '=',$q)->latest()->get();
        // $Barang = Barang::pluck('kode_barang','id');
        return view('MBrusak.create',compact('q','kode'));
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
         $this->validate($request, ['jumlah' => 'required' ]);

        $table="brusaks";
        $primary="kode_br";
        $prefix="BR";
        
        $MBrusak = new Brusak;

        
          $MBrusak->kode_br =$this->autonumber($table,$primary,$prefix);
       $MBrusak->barang_id = $request->barang_id;
        $MBrusak->keterangan =$request->keterangan;
        $MBrusak->jumlah = $request->jumlah;
        $MBrusak->user = Auth::user()->name;
        $MBrusak->save();
        
        $Barang = Barang::find($MBrusak->barang_id);
      
       $total_stok = $Barang->total_stok;
      
       $Barang->total_stok = $total_stok  + $request->jumlah;
       $Barang->update();
       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi " 
        ]);


         return redirect('memberbrusak');
    }
}
