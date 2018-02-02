<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bmasuk;
use App\Stok;
use App\Barang;
use App\User;
use DB;
use Auth;
use Invoice;
use App\Role;
use App\Permission;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class BmasukController extends Controller
{

   
    public function index()
    {
        $Bmasuk = Bmasuk::latest()->paginate(10);
        $Barang = Barang::all();
        return view('Bmasuk.index', compact('Bmasuk','Barang'));
    }

   
    public function create(Request $request)
    {
        $q = $request->get('q');  
        $kode = Barang::where('kode_barang', '=',$q)->orWhere('nama_barang', '=', "$q")
                ->get();
        // $Barang = Barang::pluck('kode_barang','id');
        return view('Bmasuk.create',compact('q','kode'));
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
        
        $Bmasuk = new Bmasuk;

        
        $Bmasuk->kode_bm =$this->autonumber($table,$primary,$prefix);
        $Bmasuk->barang_id = $request->barang_id;
        $Bmasuk->keterangan =$request->keterangan;
        $Bmasuk->jumlah = $request->jumlah;
        
        $Bmasuk->user = Auth::user()->name;
        
        $Bmasuk->save();

        // DB::table('bmasuks')->insert([
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        //     ]);
        
        
        //  $Bmasuk = Bmasuk::create($request->all());
          
        
       //  $Stok = Stok::find($Bmasuk->id);
       // return  dd($Stok);
      
       // $Stok2= DB::table('stoks')->select('stok_akhir')->where('id', '=', $Bmasuk->id)->first();

       //  // $Stok1 = $request->jumlah;
       //  $Stok2->stok_akhir = $Stok2 + $request->jumlah;

       //  $Stok2->update();
       // $Barang = new Barang;
       $Barang = Barang::find($Bmasuk->barang_id);
       $stok_akhir = $Barang->stok_akhir;
      
       $Barang->stok_akhir = $stok_akhir  + $request->jumlah;
       
       $Barang->update();

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Menyimpan Transaksi " 
        ]);


         return redirect('admin/bmasuk');
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

        $Bmasuk = Bmasuk::find($id);
        return view('Bmasuk.edit',compact('Bmasuk'));
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
        $this->validate($request, ['jumlah' => 'required|numeric']);

        

        $Bmasuk = Bmasuk::find($id);

        $Barang = Barang::find($Bmasuk->barang_id);  
   
       
         $jumlah_lama = $Bmasuk->jumlah;


       $total_stok_lama = $Barang->stok_akhir;

       // dd($total_stok_lama);

       $jumlah_tampung = $request->jumlah;

       $total_sementara = $total_stok_lama - $jumlah_lama;

       $total_baru = $total_sementara + $jumlah_tampung;

       $Bmasuk->jumlah = $jumlah_tampung;
       $Barang->stok_akhir = $total_baru;
       

       

      $Bmasuk->update();
       $Barang->update();

      

       Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil Merubah Transaksi" 
        ]);

       


         return redirect('admin/bmasuk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Bmasuk = Bmasuk::find($id);
        $Bmasuk->delete();
        Session::flash("flash_notification", [
        "level" => "danger",
        "message" => "Berhasil Menghapus Transaksi" 
        ]);
        return redirect('admin/bmasuk');

        
    }
}
