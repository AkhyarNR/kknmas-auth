<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function beranda()
    {
        return view('layouts.beranda');
    }

    public function pendaftar()
    {
        return view('kkn.Pendaftar');
    }

    public function dpl()
    {
        return view('kkn.Dpl');
    }
    
    public function nilai()
    {
        return view('kkn.Nilai');
    }

    public function rekap_baju()
    {
        return view('kkn.RekapBaju');
    }

    public function kelompok()
    {
        return view('kkn.Kelompok');
    }

    public function lokasi()
    {
        return view('kkn.Lokasi');
    }

    public function perijinan()
    {
        return view('kkn.Perijinan');
    }

    public function periode()
    {
        return view('kkn.Periode');
    }

    public function universitas()
    {
        return view('kkn.Universitas');
    }

    public function mitra()
    {
        return view('kkn.Mitra');
    }
}
