<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AspekPenilaianRequest;
use App\Http\Requests;
use App\AspekPenilaian;
use Session;

class AspekPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftaraspek = AspekPenilaian::orderBy('id', 'asc')->paginate(50);
        $jumlahaspek = AspekPenilaian::count();
        return view('aspekpenilaian.index', compact('daftaraspek','jumlahaspek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aspekpenilaian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AspekPenilaianRequest $request)
    {
        $input = $request->all();
        //Simpan Data Aspek
        $aspekpenilaian = AspekPenilaian::create($input);
        Session::flash('flash_message', 'Data Aspek Penilaian Kesehatan Berhasil Disimpan');
        return redirect('aspekpenilaian');
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
    public function edit(AspekPenilaian $aspekpenilaian)
    {
        return view('aspekpenilaian.edit', compact('aspekpenilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AspekPenilaianRequest $request, AspekPenilaian $aspekpenilaian)
    {
        $input = $request->all();
        $aspekpenilaian->update($input);
        Session::flash('flash_message', 'Data Aspek Penilaian Kesehatan berhasil diupdate');
        return redirect('aspekpenilaian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AspekPenilaian $aspekpenilaian)
    {
        $aspekpenilaian->delete();
        Session::flash('flash_message', 'Data Aspek Penilaian Kesehatan berhasil dihapus');       
        return redirect('aspekpenilaian');
    }
}
