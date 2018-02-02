<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Barang;

class MemberBarangController extends Controller
{
    public function index()
    {
        $Barang = Barang::latest()->paginate(10);
        return view('MBarang.index', ['Barang' => $Barang]);
    }
}
