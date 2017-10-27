<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiSimpananRequest;

use App\TransaksiSimpanan;
use App\Akun;
use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;
use DB;

class TransaksipenarikanController extends Controller
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
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('status','kredit','id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();
        return view('transaksipenarikan.index', compact('daftarsimpanan','jumlahsimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //HITUNG SALDO SIMPANAN NASABAH 
        $data = DB::table('transaksi_simpanan')
        //->select('id_nasabah','status','id_users', DB::raw('SUM(nominal_simpan) as saldo'))
        //->where('status','debit')
        ->select('id_nasabah','id_users')
        ->where('id_users',$iduser)
        ->groupBy('id_nasabah')
        ->get();
        $daftarnasabah = collect($data)->toJson();
        //return $data;
        return view('transaksipenarikan.create', compact('daftarnasabah'));*/
        //return view('transaksipenarikan.create');
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
        $transaksipenarikan = TransaksiSimpanan::create($input);
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksipenarikan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiSimpanan $transaksipenarikan)
    {
        return view('transaksipenarikan.show',compact('transaksipenarikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiSimpanan $transaksipenarikan)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $nasabah = Nasabah::all();
        $daftarnasabah = $nasabah->where('id_users',$iduser);
        $anggota = Keanggotaan::all();
        $daftarkeanggotaan = $anggota->where('id_users',$iduser);
        return view('transaksipenarikan.edit', compact('transaksipenarikan','daftarkeanggotaan','daftarnasabah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiSimpanan $transaksipenarikan, TransaksiSimpananRequest $request)
    {
        $input = $request->all();
        $transaksipenarikan->update($input);
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksipenarikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiSimpanan $transaksipenarikan)
    {
        $transaksipenarikan->delete();
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksipenarikan');

    }
}
