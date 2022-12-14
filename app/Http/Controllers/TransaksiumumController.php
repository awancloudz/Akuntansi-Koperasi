<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiUmumRequest;

use App\TransaksiUmum;
use App\TransaksiSemua;
use App\JurnalUmum;
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
        //$daftar = TransaksiUmum::all();
        $daftarumum = TransaksiUmum::where('id_users',$iduser)->paginate(20);
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

        //Transaksi Input id jurnal
        $jurnalumum = New JurnalUmum;
        $jurnalumum->keterangan = $request->keterangan;
        $jurnalumum->save();
        //Seleksi id jurnal terakhir
        $kodejurnal = JurnalUmum::orderBy('id', 'desc')->first();
        //Seleksi Status
        $status = $request->input('status');
        if($status == 'debit'){
            $status_simpan = 'kredit';
            $status_kas = 'debit';
        }
        else{
            $status_simpan = 'debit';
            $status_kas = 'kredit';
        }

        //Transaksi Semua
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal;
        $transaksisemua->keterangan = $request->keterangan;
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = $status_simpan;
        //$transaksisemua->save();
        
        //Transaksi Input Data Kas
        $transaksisemua2 = New TransaksiSemua;
        $transaksisemua2->id_akun = $request->id_akun;
        $transaksisemua2->id_jurnalumum = $kodejurnal->id;
        $transaksisemua2->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua2->tanggal = $request->tanggal;
        $transaksisemua2->nominal = $request->nominal;
        $transaksisemua2->keterangan = "Kas";
        $transaksisemua2->id_users = $request->id_users;
        $transaksisemua2->status = $status_kas;
        //$transaksisemua2->save();
        //End Transaksi Semua

        if($status == 'debit'){
            $transaksisemua2->save();
            $transaksisemua->save();
        }
        else{
            $transaksisemua->save();
            $transaksisemua2->save();
        }
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
        $status = $request->input('status');
        if($status == 'debit'){
            $status_simpan = 'kredit';
            $status_kas = 'debit';
        }
        else{
            $status_simpan = 'debit';
            $status_kas = 'kredit';
        }
        //Transaksi Semua
        $kodetrans = $request->input('kodetransaksi');
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal;
        $transaksisemua->keterangan = $request->keterangan;
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = $status_simpan;
        $transaksisemua->update();

        //Transaksi Input Data Kas
        $kodekas = $request->input('kodetransaksi')."-KAS";
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodekas)->firstOrFail(); 
        $transaksisemua->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = $status_kas;
        $transaksisemua->update();
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
        //Seleksi ID Jurnal
        $kodetrans = $transaksiumum->kodetransaksi;
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        //Hapus Jurnal
        $kodejurnal = $transaksisemua->id_jurnalumum;
        $jurnal = JurnalUmum::where('id', $kodejurnal)->firstOrFail();
        $jurnal->delete();
        //End Hapus Jurnal
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
