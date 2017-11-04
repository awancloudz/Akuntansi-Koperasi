<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TransaksiSimpanan;
use App\TransaksiPinjaman;
use App\DetailAngsuran;
use App\TransaksiUmum;
use App\Akun;

use Session;
use Auth;
use DB;
class LaporanController extends Controller
{
    public function simpanan()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('id_users',$iduser);
        return view('laporan.simpanan', compact('daftarsimpanan'));
    }
    //pencarian
    public function carisimpanan(Request $request){
        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftarsimpanan = TransaksiSimpanan::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            return view('laporan.simpanan', compact('daftarsimpanan'));
        }
        return redirect('laporan.simpanan');
    }

    public function pinjaman()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiPinjaman::all();
        $daftarpinjaman = $daftar->where('id_users',$iduser);
        return view('laporan.pinjaman', compact('daftarpinjaman'));
    }
    //pencarian
    public function caripinjaman(Request $request){
        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftarpinjaman = TransaksiPinjaman::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            return view('laporan.pinjaman', compact('daftarpinjaman'));
        }
        return redirect('laporan.pinjaman');
    }
    public function umum()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiUmum::all();
        $daftarumum = $daftar->where('id_users',$iduser);
        return view('laporan.umum', compact('daftarumum'));
    }
    //pencarian
    public function cariumum(Request $request){
        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftarumum = TransaksiUmum::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            return view('laporan.umum', compact('daftarumum'));
        }
        return redirect('laporan.umum');
    }
}
