<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Retur;
use App\Barang;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;


class ReturController extends Controller
{
   
    public function index()
    {
         $Retur = Retur::latest()->paginate(10);
        $Barang = Barang::all();
        return view('Retur.index', compact('Retur','Barang'));
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
        return view('Retur.create',compact('q','kode'));
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
        
        $Retur = new Retur;

        $Retur->barang_id = $request->barang_id;
        $Barang = Barang::find($Retur->barang_id);

        $cek_stok = $Barang->stok_akhir;
        $jumlah = $request->jumlah;

        if($jumlah > $cek_stok)
        {
            Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Stok Barang Tidak Mencukupi Silahkan Ulangi Transaksi !!! " 
        ]);

             return redirect('admin/retur/create');
        }

        else{
        
        $Retur->kode_r =$this->autonumber($table,$primary,$prefix);
        $Retur->barang_id = $request->barang_id;
        $Retur->keterangan =$request->keterangan;
        $Retur->jumlah = $request->jumlah;
       
        $Retur->user = Auth::user()->name;
        $Retur->save();
        
        
       $Barang = Barang::find($Retur->barang_id);
       $stok_akhir = $Barang->stok_akhir;
       
       $Barang->stok_akhir = $stok_akhir  - $request->jumlah;
      
       $Barang->update();

        Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi" 
        ]);


         return redirect('admin/retur');

        }
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $Retur = Retur::find($id);
        return view('Retur.edit',compact('Retur'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request, ['jumlah' => 'required|numeric']);

         $Retur = Retur::find($id);
         $Barang = Barang::find($Retur->barang_id);  
   
       
       $jumlah_lama1 = $Retur->jumlah;
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

            
             return redirect()->route('admin.retur.edit', $id);
        }

        else{

            $tampung = $cek_stok - $jumlah;
            $Retur->jumlah = $jumlah;
            $Barang->stok_akhir = $tampung;
            
      
            $Retur->update();
            $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);


         return redirect('admin/retur');
        }


      //  $jumlah_tampung = $request->jumlah;

      //  $total_sementara = $total_stok_lama + $jumlah_lama;

      //  $total_baru = $total_sementara - $jumlah_tampung;

      //  $Retur->jumlah = $jumlah_tampung;
      //  $Barang->stok_akhir = $total_baru;
      //  $Barang->total_stok = $total_baru;

      // $Retur->update();
      //  $Barang->update();

      

      //  Session::flash("flash_notification", [
      //   "level" => "success",
      //   "message" => "Berhasil Merubah Transaksi" 
      //   ]);

      //   return redirect('retur');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $Retur = Retur::find($id);
        $Retur->delete();

         Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus Transaksi" 
        ]);
        return redirect('admin/retur');
    }
}
