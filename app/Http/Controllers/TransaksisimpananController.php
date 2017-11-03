<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiSimpananRequest;

use App\TransaksiSimpanan;
use App\TransaksiSemua;
use App\JurnalUmum;
use App\Akun;
use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;

class TransaksisimpananController extends Controller
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
        //$daftar = TransaksiSimpanan::all();
        $daftarsimpanan = TransaksiSimpanan::where('status','debit')->where('id_users',$iduser)->paginate(20);
        $jumlahsimpanan = $daftarsimpanan->count();
        return view('transaksisimpanan.index', compact('daftarsimpanan','jumlahsimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $nasabah = Nasabah::all();
        $daftarnasabah = $nasabah->where('id_users',$iduser);
        $anggota = Keanggotaan::all();
        $daftarkeanggotaan = $anggota->where('id_users',$iduser);
        $daftar = TransaksiSimpanan::all();
        $kodeakhir = TransaksiSimpanan::orderBy('id', 'desc')->first();
        return view('transaksisimpanan.create', compact('daftarkeanggotaan','daftarnasabah','kodeakhir','daftar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiSimpananRequest $request)
    {
        $input = $request->all();        
        //Simpan Data Transaksi
        $transaksisimpanan = TransaksiSimpanan::create($input);

        //Transaksi Input id jurnal
        $jurnalumum = New JurnalUmum;
        $jurnalumum->keterangan = "Simpanan Nasabah ( ID : ".$request->id_nasabah." )";
        $jurnalumum->save();
        //Seleksi id jurnal terakhir
        $kodejurnal = JurnalUmum::orderBy('id', 'desc')->first();

        //Transaksi Input Data Kas
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "debit";
        $transaksisemua->save();

        //Transaksi Semua
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Simpanan Nasabah";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "kredit";
        $transaksisemua->save();
        //End Transaksi Semua
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksisimpanan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiSimpanan $transaksisimpanan)
    {
        return view('transaksisimpanan.show',compact('transaksisimpanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiSimpanan $transaksisimpanan)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $nasabah = Nasabah::all();
        $daftarnasabah = $nasabah->where('id_users',$iduser);
        $anggota = Keanggotaan::all();
        $daftarkeanggotaan = $anggota->where('id_users',$iduser);
        return view('transaksisimpanan.edit', compact('transaksisimpanan','daftarkeanggotaan','daftarnasabah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiSimpanan $transaksisimpanan, TransaksiSimpananRequest $request)
    {
        $input = $request->all();
        $transaksisimpanan->update($input);
        
        //Transaksi update kas
        $kodekas = $kodetrans."-KAS";
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodekas)->firstOrFail();
        $transaksisemua->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "debit";
        $transaksisemua->update();

        //Transaksi Semua
        $kodetrans = $request->input('kodetransaksi');
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_simpan;
        $transaksisemua->keterangan = "Simpanan Nasabah";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "kredit";
        $transaksisemua->update();
        //End Transaksi Semua
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksisimpanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiSimpanan $transaksisimpanan)
    {
        $transaksisimpanan->delete();
        //Seleksi ID Jurnal
        $kodetrans = $transaksisimpanan->kodetransaksi;
        $transaksisemua = New TransaksiSemua;
        $transaksisemua = TransaksiSemua::where('kodetransaksi', $kodetrans)->firstOrFail();
        //Hapus Jurnal
        $kodejurnal = $transaksisemua->id_jurnalumum;
        $jurnal = JurnalUmum::where('id', $kodejurnal)->firstOrFail();
        $jurnal->delete();
        //End Hapus Jurnal

        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksisimpanan');

    }

    //pencarian
    public function cari(Request $request){
        $kata_kunci = $request->input('kata_kunci');    //Ambil value dari inputan pencarian
        if(!empty($kata_kunci)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $query = TransaksiSimpanan::where('kodetransaksi', 'LIKE', '%' . $kata_kunci . '%');

            $daftarsimpanan = $query->paginate(10);

            //Url Pagination
            $pagination = $daftarsimpanan->appends($request->except('page'));
            $jumlahsimpanan = $daftarsimpanan->total();
            return view('transaksisimpanan.index', compact('daftarsimpanan','kata_kunci','pagination','jumlahsimpanan'));
        }
        return redirect('transaksisimpanan');
    }
}
