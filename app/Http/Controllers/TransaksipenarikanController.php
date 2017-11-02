<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiSimpananRequest;

use App\TransaksiSimpanan;
use App\TransaksiSemua;
use App\JurnalUmum;
use App\Akun;
use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;
use DB;

class TransaksipenarikanController extends Controller
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
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('status','kredit','id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();
        return view('transaksipenarikan.index', compact('daftarsimpanan','jumlahsimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiSimpananRequest $request)
    {
        $input = $request->all();
        $nasabah = $request->input('id_nasabah');
        $saldo = $request->input('saldo');
        $nominal = $request->input('nominal_simpan');
        if($nominal > $saldo){
        Session::flash('flash_message', 'Nominal Penarikan melebihi saldo');
        }
        else{
        //Simpan Data Transaksi
        $transaksipenarikan = TransaksiSimpanan::create($input);
        //Transaksi Input id jurnal
        $jurnalumum = New JurnalUmum;
        $jurnalumum->keterangan = "Penarikan Nasabah ( ID : ".$nasabah." )";
        $jurnalumum->save();
        //Seleksi id jurnal terakhir
        $kodejurnal = JurnalUmum::orderBy('id', 'desc')->first();

        //Transaksi Semua
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Penarikan Nasabah";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "debit";
        $transaksisemua->save();

        //Transaksi Kas
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "kredit";
        $transaksisemua->save();
        //End Transaksi Semua
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        }
        return redirect('nasabah/simpanan/'.$nasabah);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiSimpanan $transaksipenarikan)
    {
        return view('transaksipenarikan.show',compact('transaksipenarikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiSimpanan $transaksipenarikan)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $nasabah = Nasabah::all();
        $daftarnasabah = $nasabah->where('id_users',$iduser);
        $anggota = Keanggotaan::all();
        $daftarkeanggotaan = $anggota->where('id_users',$iduser);
        return view('transaksipenarikan.edit', compact('transaksipenarikan','daftarkeanggotaan','daftarnasabah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiSimpanan $transaksipenarikan, TransaksiSimpananRequest $request)
    {
        $input = $request->all();
        $transaksipenarikan->update($input);
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksipenarikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiSimpanan $transaksipenarikan)
    {
        $transaksipenarikan->delete();
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksipenarikan');

    }
}
