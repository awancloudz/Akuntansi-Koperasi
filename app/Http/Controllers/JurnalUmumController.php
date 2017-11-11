<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TransaksiSemua;
use App\JurnalUmum;

use Session;
use Auth;
use DB;

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
        $daftar = TransaksiSemua::all();
        $daftarjurnal = $daftar->where('id_users',$iduser);
        return view('jurnalumum.index', compact('daftarjurnal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
