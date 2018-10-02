<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KomponenPenilaianRequest;
use App\KomponenPenilaian;
use Session;

class KomponenPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarkomponen= KomponenPenilaian::orderBy('id', 'asc')->paginate(50);
        $jumlahkomponen= KomponenPenilaian::count();
        return view('komponenpenilaian.index', compact('daftarkomponen','jumlahkomponen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('komponenpenilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KomponenPenilaianRequest $request)
    {
        $input = $request->all();
        //Simpan Data Komponen
        $komponenpenilaian = KomponenPenilaian::create($input);
        Session::flash('flash_message', 'Data Komponen Penilaian Berhasil Disimpan');
        return redirect('komponenpenilaian');
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
    public function edit(KomponenPenilaian $komponenpenilaian)
    {
        return view('komponenpenilaian.edit', compact('komponenpenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KomponenPenilaianRequest $request, KomponenPenilaian $komponenpenilaian)
    {
        $input = $request->all();
        $komponenpenilaian->update($input);
        Session::flash('flash_message', 'Data Komponen Penilaian berhasil diupdate');
        return redirect('komponenpenilaian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomponenPenilaian $komponenpenilaian)
    {
        $komponenpenilaian->delete();
        Session::flash('flash_message', 'Data Komponen Penilaian berhasil dihapus');    
        return redirect('komponenpenilaian');
    }
}
