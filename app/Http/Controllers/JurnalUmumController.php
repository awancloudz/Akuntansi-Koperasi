<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TransaksiSemua;
use App\JurnalUmum;

use Session;
use Auth;
use DB;
use PDF;

class JurnalUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSemua::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
        $daftarjurnal = $daftar->where('id_users',$iduser);
        return view('jurnalumum.index', compact('daftarjurnal'));
    }

    //pencarian
    public function cari(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            //$daftarjurnal = TransaksiSemua::whereBetween('tanggal', [$tgl_awal, $tgl_akhir]);
            $daftar = TransaksiSemua::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarjurnal = $daftar->where('id_users',$iduser);
            return view('jurnalumum.index', compact('daftarjurnal'));
        }
        return redirect('jurnalumum');
    }
    //cetak pdf jurnal
    public function getPdf()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSemua::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
        $daftarjurnal = $daftar->where('id_users',$iduser);
        $jumlahjurnal = $daftarjurnal->count();

        $pdf = PDF::loadView('jurnalumum.cetak',compact('daftarjurnal','jumlahjurnal'))->setPaper('a4','portrait');
        return $pdf->stream();
    }
}
