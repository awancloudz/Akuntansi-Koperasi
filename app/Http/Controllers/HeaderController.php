<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\HeaderRequest;

use App\Grup;
use App\Header;
use App\Akun;
use Session;
//use PDF;
//use DB;
//use Excel;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarheader = Header::orderBy('id', 'asc')->paginate(50);
        $jumlahheader = Header::count();
        return view('header.index', compact('daftarheader','jumlahheader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('header.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeaderRequest $request)
    {
        $input = $request->all();
        //Simpan Data Header
        $header = Header::create($input);
        Session::flash('flash_message', 'Data Header Berhasil Disimpan');
        return redirect('header');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        return view('header.show',compact('header'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        return view('header.edit', compact('header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Header $header, HeaderRequest $request)
    {
        $input = $request->all();
        $header->update($input);
        Session::flash('flash_message', 'Data Header berhasil diupdate');
        return redirect('header');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Header $header)
    {
        $header->delete();
        Session::flash('flash_message', 'Data Header berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('header');
    }
}
