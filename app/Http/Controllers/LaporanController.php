<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TransaksiSimpanan;
use App\TransaksiPinjaman;
use App\DetailAngsuran;
use App\TransaksiUmum;
use App\TransaksiSemua;
use App\Akun;

use Session;
use Auth;
use DB;
class LaporanController extends Controller
{
    public function simpanan()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSimpanan::all();
        $daftarsimpanan = $daftar->where('id_users',$iduser);
        return view('laporan.simpanan', compact('daftarsimpanan'));
    }
    //pencarian
    public function carisimpanan(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiSimpanan::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarsimpanan = $daftar->where('id_users',$iduser);
            return view('laporan.simpanan', compact('daftarsimpanan'));
        }
        return redirect('laporan.simpanan');
    }

    public function pinjaman()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiPinjaman::all();
        $daftarpinjaman = $daftar->where('id_users',$iduser);
        return view('laporan.pinjaman', compact('daftarpinjaman'));
    }
    //pencarian
    public function caripinjaman(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiPinjaman::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarpinjaman = $daftar->where('id_users',$iduser);
            return view('laporan.pinjaman', compact('daftarpinjaman'));
        }
        return redirect('laporan.pinjaman');
    }
    public function umum()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiUmum::all();
        $daftarumum = $daftar->where('id_users',$iduser);
        return view('laporan.umum', compact('daftarumum'));
    }
    //pencarian
    public function cariumum(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiUmum::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarumum = $daftar->where('id_users',$iduser);
            return view('laporan.umum', compact('daftarumum'));
        }
        return redirect('laporan.umum');
    }
    public function shu()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSemua::all();
        $daftarshu_ = $daftar->where('id_users',$iduser);
        //Variabel
        $pinjaman = 0;
        $provisi = 0;
        $beban = 0;
        $gaji = 0;
        $penyusutan = 0;
        $pemakaian = 0;
        $bruto = 0;
        $netto = 0;
        $operasi = 0;
        $shutotal = 0;

        foreach($daftarshu_ as $shu){
            if($shu->keterangan == 'Kas'){
                //Pinjaman
                if($shu->akun->id_header == 12){
                    $pinjaman = $pinjaman + $shu->nominal;
                }
                //Provisi
                if($shu->akun->id_header == 13){
                    $provisi = $provisi + $shu->nominal;
                }
                //Beban
                if($shu->akun->id_header == 14){
                    $beban = $beban + $shu->nominal;
                }
                //Gaji
                if($shu->akun->id_header == 15){
                    $gaji = $gaji + $shu->nominal;
                }
                //Penyusutan
                if($shu->akun->id_header == 5){
                    $penyusutan = $penyusutan + $shu->nominal;
                }
                //Penyusutan
                if($shu->akun->id_header == 3){
                    $pemakaian = $pemakaian + $shu->nominal;
                }
            }
        }
        $bruto = $pinjaman + $provisi;
        $netto = $bruto - $beban;
        $operasi = $gaji + $penyusutan + $pemakaian;
        $shutotal = $netto - $operasi;
        /*$data =
        ['pinjaman' => $pinjaman, 'provisi' => $provisi, 'beban' => $beban, 'gaji' => $gaji, 'penyusutan' => $penyusutan, 'pemakaian' => $pemakaian,
        'bruto' => $bruto, 'netto' => $netto, 'operasi' => $operasi, 'shutotal' => $shutotal];   
        $daftarshu = collect($data);
        $daftarshu->toJson();*/
        return view('laporan.shu', compact('daftarshu_','pinjaman','provisi','beban','gaji','penyusutan','pemakaian','bruto','netto','operasi','shutotal'));
    }

    //pencarian
    public function carishu(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiSemua::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarshu_ = $daftar->where('id_users',$iduser);
            //Variabel
            $pinjaman = 0;
            $provisi = 0;
            $beban = 0;
            $gaji = 0;
            $penyusutan = 0;
            $pemakaian = 0;
            $bruto = 0;
            $netto = 0;
            $operasi = 0;
            $shutotal = 0;

            foreach($daftarshu_ as $shu){
                if($shu->keterangan == 'Kas'){
                    //Pinjaman
                    if($shu->akun->id_header == 12){
                        $pinjaman = $pinjaman + $shu->nominal;
                    }
                    //Provisi
                    if($shu->akun->id_header == 13){
                        $provisi = $provisi + $shu->nominal;
                    }
                    //Beban
                    if($shu->akun->id_header == 14){
                        $beban = $beban + $shu->nominal;
                    }
                    //Gaji
                    if($shu->akun->id_header == 15){
                        $gaji = $gaji + $shu->nominal;
                    }
                    //Penyusutan
                    if($shu->akun->id_header == 5){
                        $penyusutan = $penyusutan + $shu->nominal;
                    }
                    //Penyusutan
                    if($shu->akun->id_header == 3){
                        $pemakaian = $pemakaian + $shu->nominal;
                    }
                }
            }
            $bruto = $pinjaman + $provisi;
            $netto = $bruto - $beban;
            $operasi = $gaji + $penyusutan + $pemakaian;
            $shutotal = $netto - $operasi;
            return view('laporan.shu', compact('daftarshu_','pinjaman','provisi','beban','gaji','penyusutan','pemakaian','bruto','netto','operasi','shutotal'));
        }
        return redirect('laporan.shu');
    }
}
