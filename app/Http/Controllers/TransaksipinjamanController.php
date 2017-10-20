<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiPinjamanRequest;

use App\TransaksiPinjaman;
use App\Akun;
use App\Nasabah;
use Session;
use Auth;

class TransaksipinjamanController extends Controller
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
        $daftar = TransaksiPinjaman::all();
        $daftarpinjaman = $daftar->where('id_users',$iduser);
        $jumlahpinjaman = $daftarpinjaman->count();
        return view('transaksipinjaman.index', compact('daftarpinjaman','jumlahpinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksipinjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiPinjamanRequest $request)
    {
        $input = $request->all();
        //Simpan Data Transaksi
        $transaksipinjaman = TransaksiPinjaman::create($input);
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksipinjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPinjamanRequest $request)
    {
        return view('transaksipinjaman.show',compact('transaksipinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPinjaman $transaksipinjaman)
    {
        return view('transaksipinjaman.edit', compact('transaksipinjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiPinjaman $transaksipinjaman, TransaksiPinjamanRequest $request)
    {
        $input = $request->all();
        $transaksipinjaman->update($input);
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksipinjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiPinjaman $transaksipinjaman)
    {
        $transaksipinjaman->delete();
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksipinjaman');
    }
}
