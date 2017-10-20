<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KeanggotaanRequest;

use App\Keanggotaan;
use App\User;
use Session;
use Auth;

class KeanggotaanController extends Controller
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
        $daftar = Keanggotaan::all();
        $daftarkeanggotaan = $daftar->where('id_users',$iduser);
        $jumlahkeanggotaan = $daftarkeanggotaan->count();
        return view('keanggotaan.index', compact('daftarkeanggotaan','jumlahkeanggotaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keanggotaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeanggotaanRequest $request)
    {
        $input = $request->all();
        //Simpan Data Keanggotaan
        $keanggotaan = Keanggotaan::create($input);
        Session::flash('flash_message', 'Data Keanggotaan Berhasil Disimpan');
        return redirect('keanggotaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Keanggotaan $keanggotaan)
    {
        return view('keanggotaan.show',compact('keanggotaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Keanggotaan $keanggotaan)
    {
        return view('keanggotaan.edit', compact('keanggotaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Keanggotaan $keanggotaan, KeanggotaanRequest $request)
    {
        $input = $request->all();
        $keanggotaan->update($input);
        Session::flash('flash_message', 'Data Keanggotaan berhasil diupdate');
        return redirect('keanggotaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keanggotaan $keanggotaan)
    {
        $keanggotaan->delete();
        Session::flash('flash_message', 'Data Keanggotaan berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('keanggotaan');
    }
}
