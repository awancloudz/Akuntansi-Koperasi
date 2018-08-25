<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AspekRequest;
use App\Http\Requests;
use App\AspekGrup;
use Session;

class AspekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftaraspek = AspekGrup::orderBy('id', 'asc')->paginate(50);
        $jumlahaspek = AspekGrup::count();
        return view('aspekgrup.index', compact('daftaraspek','jumlahaspek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aspekgrup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AspekRequest $request)
    {
        $input = $request->all();
        //Simpan Data Aspek
        $aspekgrup = AspekGrup::create($input);
        Session::flash('flash_message', 'Data Aspek Kuesioner Berhasil Disimpan');
        return redirect('aspekgrup');
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
    public function edit(AspekGrup $aspekgrup)
    {
        return view('aspekgrup.edit', compact('aspekgrup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AspekGrup $aspekgrup, AspekRequest $request)
    {
        $input = $request->all();
        $aspekgrup->update($input);
        Session::flash('flash_message', 'Data Aspek Kuesioner berhasil diupdate');
        return redirect('aspekgrup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AspekGrup $aspekgrup)
    {
        $aspekgrup->delete();
        Session::flash('flash_message', 'Data Aspek Grup berhasil dihapus');       
        return redirect('aspekgrup');
    }
}
