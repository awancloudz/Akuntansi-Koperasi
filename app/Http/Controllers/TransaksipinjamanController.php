<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransaksiPinjamanRequest;

use App\TransaksiPinjaman;
use App\TransaksiSemua;
use App\JurnalUmum;
use App\DetailAngsuran;
use App\Akun;
use App\Nasabah;
use Session;
use Auth;
use PDF;
use Carbon\Carbon;

class TransaksipinjamanController extends Controller
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
        //$daftar = TransaksiPinjaman::all();
        $daftarpinjaman = TransaksiPinjaman::where('id_users',$iduser)->paginate(20);
        $jumlahpinjaman = $daftarpinjaman->count();
        return view('transaksipinjaman.index', compact('daftarpinjaman','jumlahpinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daftar = TransaksiPinjaman::all();
        $kodeakhir = TransaksiPinjaman::orderBy('id', 'desc')->first();
        return view('transaksipinjaman.create', compact('kodeakhir','daftar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiPinjamanRequest $request)
    {
        $input = $request->all();
        //Simpan Data Transaksi
        $transaksipinjaman = TransaksiPinjaman::create($input);

        //Transaksi Input id jurnal
        $jurnalumum = New JurnalUmum;
        $jurnalumum->keterangan = "Pinjaman Nasabah ( ID : ".$request->id_nasabah." )";
        $jurnalumum->save();
        //Seleksi id jurnal terakhir
        $kodejurnal = JurnalUmum::orderBy('id', 'desc')->first();

        //Transaksi Semua
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi;
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_pinjam;
        $transaksisemua->keterangan = "Pinjaman Nasabah";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "debit";
        $transaksisemua->save();

        //Transaksi Input ke Kas
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->id_akun = $request->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->kodetransaksi = $request->kodetransaksi."-KAS";
        $transaksisemua->tanggal = $request->tanggal;
        $transaksisemua->nominal = $request->nominal_pinjam;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $request->id_users;
        $transaksisemua->status = "kredit";
        $transaksisemua->save();
        //End Transaksi Semua
        
        //Deklarasi Variabel
        $id_trans_pinjam = TransaksiPinjaman::orderBy('id', 'desc')->first();
        $saldo = $request->input('nominal_pinjam');
        $kali = $request->input('kali_angsuran');
        $persentase = 0.02; //Cek
        $angsuran = $saldo / $kali;
        $jasa = 0;
        $totalbayar = 0;
        //Deklarasi Variabel Jatuh Tempo
        $tgl = new Carbon();
        $tgl = Carbon::now();
        //Perulangan
        for($i=0; $i < $kali; $i++){
            //Hitungan
            $jasa = $saldo * $persentase;
            $totalbayar = $angsuran + $jasa;
            $saldo = $saldo - $angsuran;
            //Deklarasi Variabel Detail angsuran per jatuh tempo
            $detailangsuran = new DetailAngsuran;
            $detailangsuran->id_transaksi_pinjaman = $id_trans_pinjam->id;
            $detailangsuran->angsuran = $angsuran;
            $detailangsuran->jasa_uang = $jasa;
            $detailangsuran->total_bayar = $totalbayar;
            $detailangsuran->saldo = $saldo;
            $detailangsuran->jatuh_tempo = $tgl->addMonths(1)->format('Y-m-d');;
            $detailangsuran->status_bayar = 'belum';
            //Simpan ke database
            $transaksipinjaman->detailangsuran()->save($detailangsuran);
        }
        Session::flash('flash_message', 'Data Transaksi Berhasil Disimpan');
        return redirect('transaksipinjaman');
    }

    public function angsuran(TransaksiPinjaman $transaksipinjaman)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = DetailAngsuran::all();
        $daftarangsuran = $daftar->where('id_transaksi_pinjaman',$transaksipinjaman->id,'id_users',$iduser);
        $jumlahangsuran = $daftarangsuran->count();
        return view('transaksipinjaman.angsuran',compact('transaksipinjaman','nasabah','daftarangsuran','jumlahangsuran'));
    }

    public function bayar(DetailAngsuran $angsuran, Request $request)
    {
        $input = $request->all();
        $angsuran->update($input);
        //Transaksi Input id jurnal
        $jurnalumum = New JurnalUmum;
        $jurnalumum->keterangan = "Angsuran Nasabah";
        $jurnalumum->save();
        //Seleksi id jurnal terakhir
        $kodejurnal = JurnalUmum::orderBy('id', 'desc')->first();

        //Transaksi Semua
        $idtrans = $angsuran->id_transaksi_pinjaman;
        $transaksipinjaman = New TransaksiPinjaman;
        $transaksipinjaman = TransaksiPinjaman::findOrFail($idtrans);
        
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->kodetransaksi = $transaksipinjaman->kodetransaksi."-".$angsuran->id;
        $transaksisemua->id_akun = $transaksipinjaman->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->tanggal = $request->tanggal_bayar;
        $transaksisemua->nominal = $angsuran->total_bayar;
        $transaksisemua->keterangan = "Angsuran Nasabah";
        $transaksisemua->id_users = $transaksipinjaman->id_users;
        $transaksisemua->status = "kredit";
        $transaksisemua->save();

        //Transaksi kas
        $transaksisemua = New TransaksiSemua;
        $transaksisemua->kodetransaksi = $transaksipinjaman->kodetransaksi."-".$angsuran->id."-KAS";
        $transaksisemua->id_akun = $transaksipinjaman->id_akun;
        $transaksisemua->id_jurnalumum = $kodejurnal->id;
        $transaksisemua->tanggal = $request->tanggal_bayar;
        $transaksisemua->nominal = $angsuran->total_bayar;
        $transaksisemua->keterangan = "Kas";
        $transaksisemua->id_users = $transaksipinjaman->id_users;
        $transaksisemua->status = "debit";
        $transaksisemua->save();
        //End Transaksi Semua
        Session::flash('flash_message', 'Angsuran sudah dibayar');
        return redirect('transaksipinjaman/angsuran/'.$angsuran->id_transaksi_pinjaman);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPinjamanRequest $request)
    {
        return view('transaksipinjaman.show',compact('transaksipinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPinjaman $transaksipinjaman)
    {
        return view('transaksipinjaman.edit', compact('transaksipinjaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiPinjaman $transaksipinjaman, TransaksiPinjamanRequest $request)
    {
        $input = $request->all();
        $transaksipinjaman->update($input);
        Session::flash('flash_message', 'Data Transaksi berhasil diupdate');
        return redirect('transaksipinjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiPinjaman $transaksipinjaman)
    {
        $transaksipinjaman->delete();
        Session::flash('flash_message', 'Data Transaksi berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('transaksipinjaman');
    }

    //cetak pdf simpanan
    public function getPdf(TransaksiPinjaman $transaksipinjaman)
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = DetailAngsuran::all();
        $daftarangsuran = $daftar->where('id_transaksi_pinjaman',$transaksipinjaman->id,'id_users',$iduser);
        $jumlahangsuran = $daftarangsuran->count();

        $pdf = PDF::loadView('transaksipinjaman.printangsuran',compact('transaksipinjaman','daftarangsuran','jumlahangsuran'))->setPaper('a4','portrait');
        return $pdf->stream();
    }
    //pencarian
    public function cari(Request $request){
        $kata_kunci = $request->input('kata_kunci');    //Ambil value dari inputan pencarian
        if(!empty($kata_kunci)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $query = TransaksiPinjaman::where('kodetransaksi', 'LIKE', '%' . $kata_kunci . '%');

            $daftarpinjaman = $query->paginate(10);

            //Url Pagination
            $pagination = $daftarpinjaman->appends($request->except('page'));
            $jumlahpinjaman = $daftarpinjaman->total();
            return view('transaksipinjaman.index', compact('daftarpinjaman','kata_kunci','pagination','jumlahpinjaman'));
        }
        return redirect('transaksipinjaman');
    }
}
