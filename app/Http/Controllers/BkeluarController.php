<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Bkeluar;
use App\Barang;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;

class BkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Bkeluar = Bkeluar::latest()->paginate(10);
        $Barang = Barang::all();
        return view('Bkeluar.index', compact('Bkeluar','Barang'));
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
        return view('Bkeluar.create',compact('q','kode'));
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
        
        $Bkeluar = new Bkeluar;
         $Bkeluar->barang_id = $request->barang_id;
          $Barang = Barang::find($Bkeluar->barang_id);

        $cek_stok = $Barang->stok_akhir;
        $jumlah = $request->jumlah;

        if($jumlah > $cek_stok)
        {
            Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Stok Barang Tidak Mencukupi Silahkan Ulangi Transaksi !!! " 
        ]);

             return redirect('admin/bkeluar/create');
        }

        else{
        
        $Bkeluar->kode_bk =$this->autonumber($table,$primary,$prefix);
        $Bkeluar->barang_id = $request->barang_id;
        $Bkeluar->keterangan =$request->keterangan;
        $Bkeluar->jumlah = $jumlah;
        $Bkeluar->peminta = $request->peminta;
        $Bkeluar->divisi = $request->divisi;
        $Bkeluar->user = Auth::user()->name;
        $Bkeluar->save();
        
        
        
     
       $stok_akhir = $Barang->stok_akhir;
      
      
       $Barang->stok_akhir = $stok_akhir  - $request->jumlah;
     
       $Barang->update();

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi " 
        ]);


         return redirect('admin/bkeluar');

             }
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
        $Bkeluar = Bkeluar::find($id);
        return view('Bkeluar.edit',compact('Bkeluar'));
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
        $this->validate($request, ['jumlah' => 'required|numeric',
                                    'peminta' => 'required',
                                        'divisi' => 'required']);  

        $Bkeluar = Bkeluar::find($id);
        $Barang = Barang::find($Bkeluar->barang_id);  

        $jumlah_lama1 = $Bkeluar->jumlah;
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

            
             return redirect()->route('admin.bkeluar.edit', $id);
        }

   else{
         // $Barang = Barang::find($Bkeluar->barang_id);  
         // $jumlah_lama = $Bkeluar->jumlah;
         // $total_stok_lama = $Barang->stok_akhir;
         // $jumlah_tampung = $request->jumlah;

       // dd($total_stok_lama);

     

       // $total_sementara = $total_stok_lama + $jumlah_lama;

       // $total_baru = $total_stok_lama - $jumlah_tampung;

       // $Bkeluar->jumlah = $jumlah_tampung;

    $tampung = $cek_stok - $jumlah;
    $Bkeluar->jumlah = $jumlah;
       $Barang->stok_akhir = $tampung;
       $Bkeluar->peminta = $request->peminta;
        $Bkeluar->divisi = $request->divisi;
      
       $Bkeluar->update();
       $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);


         return redirect('admin/bkeluar');

          }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Bkeluar = Bkeluar::find($id);
        $Bkeluar->delete();

        Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus Transaksi "
        ]);
        return redirect('admin/bkeluar');
    }
}
