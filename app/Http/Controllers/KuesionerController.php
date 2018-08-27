<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\KuesionerRequest;
use App\Kuesioner;
use Session;

class KuesionerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarkuesioner= Kuesioner::orderBy('id', 'asc')->paginate(50);
        $jumlahkuesioner= Kuesioner::count();
        return view('kuesioner.index', compact('daftarkuesioner','jumlahkuesioner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kuesioner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KuesionerRequest $request)
    {
        $input = $request->all();
        //Simpan Data Kuesioner
        $kuesioner = Kuesioner::create($input);
        Session::flash('flash_message', 'Data Kuesioner Berhasil Disimpan');
        return redirect('kuesioner');
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
    public function edit(Kuesioner $kuesioner)
    {
        return view('kuesioner.edit', compact('kuesioner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KuesionerRequest $request, Kuesioner $kuesioner)
    {
        $input = $request->all();
        $kuesioner->update($input);
        Session::flash('flash_message', 'Data Kuesioner berhasil diupdate');
        return redirect('kuesioner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuesioner $kuesioner)
    {
        $kuesioner->delete();
        Session::flash('flash_message', 'Data Kuesioner berhasil dihapus');    
        return redirect('kuesioner');
    }
}
