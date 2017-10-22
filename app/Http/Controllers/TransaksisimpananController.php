<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiSimpananRequest;

use App\TransaksiSimpanan;
use App\Akun;
use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;

class TransaksisimpananController extends Controller
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
        $daftarsimpanan = $daftar->where('status','debit','id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();
        return view('transaksisimpanan.index', compact('daftarsimpanan','jumlahsimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $nasabah = Nasabah::all();
        $daftarnasabah = $nasabah->where('id_users',$iduser);
        $anggota = Keanggotaan::all();
        $daftarkeanggotaan = $anggota->where('id_users',$iduser);
        return view('transaksisimpanan.create', compact('daftarkeanggotaan','daftarnasabah'));
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
        //Simpan Data Transaksi
        $transaksisimpanan = TransaksiSimpanan::create($input);
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksisimpanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiSimpanan $transaksisimpanan)
    {
        return view('transaksisimpanan.show',compact('transaksisimpanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiSimpanan $transaksisimpanan)
    {
        return view('transaksisimpanan.edit', compact('transaksisimpanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiSimpanan $transaksisimpanan, TransaksiSimpananRequest $request)
    {
        $input = $request->all();
        $transaksisimpanan->update($input);
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksisimpanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiSimpanan $transaksisimpanan)
    {
        $transaksisimpanan->delete();
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksisimpanan');

    }
}
