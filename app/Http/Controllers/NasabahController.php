<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NasabahRequest;

use App\Nasabah;
use App\Keanggotaan;
use Session;
use Auth;
use App\TransaksiSimpanan;
use App\TransaksiPinjaman;
use PDF;
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
    
    public function simpanan(Nasabah $nasabah)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('id_nasabah',$nasabah->id,'id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();
        return view('nasabah.simpanan',compact('nasabah','daftarsimpanan','jumlahsimpanan'));
    }
    public function penarikan(Nasabah $nasabah)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('id_nasabah',$nasabah->id,'id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();
        $saldo = 0;
        foreach($daftarsimpanan as $simpanan){
            if($simpanan->status == 'debit'){
                $saldo = $saldo + $simpanan->nominal_simpan;
            }
            else if($simpanan->status == 'kredit'){
                $saldo = $saldo - $simpanan->nominal_simpan;
            }
        }
        if($saldo > 0){
            $kodeakhir = TransaksiPinjaman::orderBy('id', 'desc')->first();
            return view('transaksipenarikan.create',compact('nasabah','saldo','kodeakhir','daftar'));
        }
        else{
            Session::flash('flash_message', 'Maaf Saldo tidak mencukupi');
            return redirect('nasabah');
        }
    }

    public function pinjaman(Nasabah $nasabah)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiPinjaman::all();
        $daftarpinjaman = $daftar->where('id_nasabah',$nasabah->id,'id_users',$iduser);
        $jumlahpinjaman = $daftarpinjaman->count();
        return view('nasabah.pinjaman',compact('nasabah','daftarpinjaman','jumlahpinjaman'));
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
    //cetak pdf simpanan
    public function getPdf(Nasabah $nasabah)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('id_nasabah',$nasabah->id,'id_users',$iduser);
        $jumlahsimpanan = $daftarsimpanan->count();

        $pdf = PDF::loadView('nasabah.printsimpanan',compact('nasabah','daftarsimpanan','jumlahsimpanan'))->setPaper('a4','portrait');
        return $pdf->stream();
    }

    //pencarian
    public function cari(Request $request){
        $kata_kunci = $request->input('kata_kunci');    //Ambil value dari inputan pencarian
        if(!empty($kata_kunci)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $query = Nasabah::where('nama', 'LIKE', '%' . $kata_kunci . '%');

            $daftarnasabah = $query->paginate(10);

            //Url Pagination
            $pagination = $daftarnasabah->appends($request->except('page'));
            $jumlahnasabah = $daftarnasabah->total();
            return view('nasabah.index', compact('daftarnasabah','kata_kunci','pagination','jumlahnasabah'));
        }
        return redirect('nasabah');
    }
}
