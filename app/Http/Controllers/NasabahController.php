<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NasabahRequest;

use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;
//use PDF;
//use DB;
//use Excel;

class NasabahController extends Controller
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
        $daftar = Nasabah::all();
        $daftarnasabah = $daftar->where('id_users',$iduser);
        $jumlahnasabah = $daftarnasabah->count();
        return view('nasabah.index', compact('daftarnasabah','jumlahnasabah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nasabah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NasabahRequest $request)
    {
        $input = $request->all();
        //Simpan Data Nasabah
        $nasabah = Nasabah::create($input);
        Session::flash('flash_message', 'Data Nasabah Berhasil Disimpan');
        return redirect('nasabah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nasabah $nasabah)
    {
        return view('nasabah.show',compact('nasabah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Nasabah $nasabah, NasabahRequest $request)
    {
        $input = $request->all();
        $nasabah->update($input);
        Session::flash('flash_message', 'Data Nasabah berhasil diupdate');
        return redirect('nasabah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nasabah $nasabah)
    {
        $nasabah->delete();
        Session::flash('flash_message', 'Data Nasabah berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('nasabah');
    }
}
