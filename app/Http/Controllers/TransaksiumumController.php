<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiUmumRequest;

use App\TransaksiUmum;
use App\TransaksiSemua;
use App\Akun;
use Session;
use Auth;

class TransaksiumumController extends Controller
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
        $daftar = TransaksiUmum::all();
        $daftarumum = $daftar->where('id_users',$iduser);
        $jumlahumum = $daftarumum->count();
        return view('transaksiumum.index', compact('daftarumum','jumlahumum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar = TransaksiUmum::all();
        $kodeakhir = TransaksiUmum::orderBy('id', 'desc')->first();
        return view('transaksiumum.create', compact('kodeakhir','daftar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiUmumRequest $request)
    {
        $input = $request->all();
        $nominal = $request->input('nominal_simpan');
        //Simpan Data Transaksi
        $transaksiumum = TransaksiUmum::create($input);
        //Transaksi Semua
        $transaksisemua = TransaksiSemua::create($input);
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksiumum');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiUmum $transaksiumum)
    {
        return view('transaksiumum.show',compact('transaksiumum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiUmum $transaksiumum)
    {
        return view('transaksiumum.edit', compact('transaksiumum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiUmum $transaksiumum, TransaksiUmumRequest $request)
    {
        $input = $request->all();
        $transaksiumum->update($input);
        //Transaksi Semua
        $kodetrans = $request->input('kodetransaksi');
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        $transaksisemua->update($input);
        //End Transaksi Semua
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksiumum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiUmum $transaksiumum)
    {
        $transaksiumum->delete();
        //Transaksi Semua
        $kodetrans = $transaksiumum->kodetransaksi;
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        $transaksisemua->delete();
        //End Transaksi Semua
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksiumum');
    }
    //pencarian
    public function cari(Request $request){
        $kata_kunci = $request->input('kata_kunci');    //Ambil value dari inputan pencarian
        if(!empty($kata_kunci)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $query = TransaksiUmum::where('kodetransaksi', 'LIKE', '%' . $kata_kunci . '%');

            $daftarumum = $query->paginate(10);

            //Url Pagination
            $pagination = $daftarumum->appends($request->except('page'));
            $jumlahumum = $daftarumum->total();
            return view('transaksiumum.index', compact('daftarumum','kata_kunci','pagination','jumlahumum'));
        }
        return redirect('transaksiumum');
    }
}
