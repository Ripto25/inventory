<?php

namespace App\Http\Controllers;
use PDF;
use App\Bmasuk;
use App\Bkeluar;
use App\Barang;
use App\retur;
use App\Brusak;
use DB;
use App\Kategori;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;

class LaporanController extends Controller
{
    public function bm()
    {
      return view('Laporan.Bmlaporan.bm');
    }

    public function lapbmdwn()
    {
      $Bm = Bmasuk::all();
      $barang = Barang::all();
      $pdf = PDF::loadview('Laporan.Bmlaporan.lapbm', compact('Bm','barang'));
    return $pdf->download('BarangMasuk.pdf');
    }

     public function lapbmperiode()
    {
      return view('Laporan.Bmlaporan.lapbmperiode');
    }

    public function lapbmperiodetampil(Request $request)
    {
       // $b= new DateTime();
       // $h=$b->format('Y-m-d'.'00:00:00');
       $dari = $request->get('dari');
       $dari2 =strtotime($dari);
       $dari3 = date('Y-m-d H:i:s',$dari2);
        $sampai = $request->get('sampai'); 
        $sampai2 = strtotime($sampai);
        $sampai3 = date('Y-m-d H:i:s',$sampai2);
        $date = Carbon::now();
        
        $BmPeriode = Bmasuk::whereBetween('created_at', [$dari3,$sampai3])->get();

       $barang = Barang::all();
          $pdf = PDF::loadview('Laporan.Bmlaporan.BmPeriode', compact('BmPeriode'));
    return $pdf->download('BmPeriode.pdf');
                   // return dd($BmPeriode);
    

    }

    // <-- Laporan Barang keluar -->

    public function bk()
    {
        return view('Laporan.Bklaporan.Bk');
    }

    public function lapbkdwn()
    {
        $Bk = Bkeluar::all();
        $barang = Barang::all();
        $pdf = PDF::loadview('Laporan.Bklaporan.lapbk', compact('Bk','barang'));
        return $pdf->download('BarangKeluar.pdf');
    }

    public function lapbkperiode()
    {
        return view('Laporan.Bklaporan.lapbkperiode');
    }

     public function lapbkperiodetampil(Request $request)
    {

          $dari = $request->get('dari');
          $dari2 =strtotime($dari);
          $dari3 = date('Y-m-d H:i:s',$dari2);         
          $sampai = $request->get('sampai'); 
          $sampai2 = strtotime($sampai);
          $sampai3 = date('Y-m-d H:i:s',$sampai2);
          $date = Carbon::now();     
          $BkPeriode = Bkeluar::whereBetween('created_at', [$dari3,$sampai3])->get();

          $pdf = PDF::loadview('Laporan.Bklaporan.BkPeriode', compact('BkPeriode'));
        return $pdf->download('BarangKeluarPeriode.pdf');
                   // return dd($BmPeriode);

    }

    // <-- Laporan Barang retur -->

    public function bre()
    {
        return view('Laporan.Brelaporan.Bre');
    }

    public function lapbredwn()
    {
        $Bre = retur::all();
        $pdf = PDF::loadview('Laporan.Brelaporan.lapbre', compact('Bre'));
        return $pdf->download('BarangRetur.pdf');
    }

    public function lapbreperiode()
    {
        return view('Laporan.Brelaporan.lapbreperiode');
    }

    public function lapbreperiodetampil(Request $request)
    {

          $dari = $request->get('dari');
          $dari2 =strtotime($dari);
          $dari3 = date('Y-m-d H:i:s',$dari2);         
          $sampai = $request->get('sampai'); 
          $sampai2 = strtotime($sampai);
          $sampai3 = date('Y-m-d H:i:s',$sampai2);
          $date = Carbon::now();     
          $ReturPeriode = retur::whereBetween('created_at', [$dari3,$sampai3])->get();

          $pdf = PDF::loadview('Laporan.Brelaporan.BrePeriode', compact('ReturPeriode'));
        return $pdf->download('BarangReturPeriode.pdf');
                   // return dd($BmPeriode);

    }

    // <-- Laporan Barang rusak -->

     public function bru()
    {
        return view('Laporan.Brulaporan.Bru');
    }

    public function lapbrudwn()
    {
        $Bru = Brusak::all();
        $pdf = PDF::loadview('Laporan.Brulaporan.lapbru', compact('Bru'));
        return $pdf->download('BarangRusak.pdf');
    }

    public function lapbruperiode()
    {
        return view('Laporan.Brulaporan.lapbruperiode');
    }

    public function lapbruperiodetampil(Request $request)
    {

          $dari = $request->get('dari');
          $dari2 =strtotime($dari);
          $dari3 = date('Y-m-d H:i:s',$dari2);         
          $sampai = $request->get('sampai'); 
          $sampai2 = strtotime($sampai);
          $sampai3 = date('Y-m-d H:i:s',$sampai2);
          $date = Carbon::now();     
          $RusakPeriode = Brusak::whereBetween('created_at', [$dari3,$sampai3])->get();

          $pdf = PDF::loadview('Laporan.Brulaporan.BruPeriode', compact('RusakPeriode'));
        return $pdf->download('BarangRusakPeriode.pdf');
                   // return dd($BmPeriode);

    }



    // <-- Laporan Data Barang-->

     public function brg()
    {
        return view('Laporan.Brglaporan.Brg');
    }

    public function lapbrgdwn()
    {
        $Brg = Barang::all();
        $pdf = PDF::loadview('Laporan.Brglaporan.lapbrg', compact('Brg'));
        return $pdf->download('Barang.pdf');
    }

    public function lapbrgperiode()
    {
        return view('Laporan.Brglaporan.lapbrgperiode');
    }

    public function lapbrgperiodetampil(Request $request)
    {

          $dari = $request->get('dari');
          $dari2 =strtotime($dari);
          $dari3 = date('Y-m-d H:i:s',$dari2);         
          $sampai = $request->get('sampai'); 
          $sampai2 = strtotime($sampai);
          $sampai3 = date('Y-m-d H:i:s',$sampai2);
          $date = Carbon::now();     
          $BarangPeriode = Barang::whereBetween('created_at', [$dari3,$sampai3])->get();

          $pdf = PDF::loadview('Laporan.Brglaporan.BrgPeriode', compact('BarangPeriode'));
        return $pdf->download('BarangPeriode.pdf');
                   // return dd($BmPeriode);

    }


    public function lapbmkat()
    {
       $kategori = Barang::all();
        return view('Laporan.Bmlaporan.Bmkatview', compact('kategori'));
    }




     public function lapbmkattampil(Request $request)
    {
       // $Kategori = $request->get('kategori_id');

       //  $Barangku = Barang::where('kategori_id','=',$Kategori)->get();




        
// return dd($Kategori );


        //berhasil
        $Kategori = $request->get('kategori_id');
        $Barang = Bmasuk::where('barang_id', '=',$Kategori)->get();
          $pdf = PDF::loadview('Laporan.Bmlaporan.Bmkattampil', compact('Barang'));
        return $pdf->download('Barangmasuk.pdf');
    }

     public function lapbkkat()
    {
       $kategori = Barang::all();
        return view('Laporan.Bklaporan.Bkkatview', compact('kategori'));
    }


      public function lapbkkattampil(Request $request)
    {
      

        //berhasil
        $Kategori = $request->get('kategori_id');
        $Barang = Bkeluar::where('barang_id', '=',$Kategori)->get();
          $pdf = PDF::loadview('Laporan.Bklaporan.Bkkattampil', compact('Barang'));
        return $pdf->download('Barangkeluar.pdf');
    }

    public function lapbrkat()
    {
       $kategori = Barang::all();
        return view('Laporan.Brelaporan.Brkatview', compact('kategori'));
    }


      public function lapbrkattampil(Request $request)
    {
      

        //berhasil
        $Kategori = $request->get('kategori_id');
        $Barang = Retur::where('barang_id', '=',$Kategori)->get();
          $pdf = PDF::loadview('Laporan.Brelaporan.Brkattampil', compact('Barang'));
        return $pdf->download('Barangretur.pdf');
    }

}
