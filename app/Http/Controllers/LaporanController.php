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
                    //Pemakaian
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

    public function neraca()
    {
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        $daftar = TransaksiSemua::all();
        $daftarneraca = $daftar->where('id_users',$iduser);

        //Variabel SHU
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
        
        //Variabel Neraca
        $kas = 0;
        $piutang = 0;
        $peralatan = 0;
        $hutangusaha = 0;
        $simpanansukarela = 0;
        $hutangbunga = 0;
        $hutangbank = 0;
        $simpananpokok = 0;
        $simpananwajib = 0;
        //Total Neraca 
        $aktivalancar = 0;
        $aktivatetap = 0;
        $totalaktiva = 0;
        $hutanglancar = 0;
        $hutangjangkapanjang = 0;
        $ekuitas = 0;
        $totalpasiva = 0;

        foreach($daftarneraca as $neraca){
            if($neraca->keterangan == 'Kas'){
            //SHU
                //Pinjaman
                if($neraca->akun->id_header == 12){
                    $pinjaman = $pinjaman + $neraca->nominal;
                }
                //Provisi
                if($neraca->akun->id_header == 13){
                    $provisi = $provisi + $neraca->nominal;
                }
                //Beban
                if($neraca->akun->id_header == 14){
                    $beban = $beban + $neraca->nominal;
                }
                //Gaji
                if($neraca->akun->id_header == 15){
                    $gaji = $gaji + $neraca->nominal;
                }
                //Penyusutan
                if($neraca->akun->id_header == 5){
                    $penyusutan = $penyusutan + $neraca->nominal;
                }
                //Pemakaian
                if($neraca->akun->id_header == 3){
                    $pemakaian = $pemakaian + $neraca->nominal;
                }
            //NERACA
                //Kas
                if($neraca->akun->id_header == 1){
                    $kas = $kas + $neraca->nominal;
                }
                //Piutang
                if($neraca->akun->id_header == 2){
                    $piutang = $piutang + $neraca->nominal;
                }
                //Peralatan
                if($neraca->akun->id_header == 4){
                    $peralatan = $peralatan + $neraca->nominal;
                }
                //Hutang Usaha
                if($neraca->akun->id_header == 6){
                    $hutangusaha = $hutangusaha + $neraca->nominal;
                }
                //Simpanan Sukarela
                if($neraca->akun->id_header == 8){
                    $simpanansukarela = $simpanansukarela + $neraca->nominal;
                }
                //Hutang Bunga
                if($neraca->akun->id_header == 7){
                    $hutangbunga = $hutangbunga + $neraca->nominal;
                }
                //Hutang Bank
                if($neraca->akun->id_header == 9){
                    $hutangbank = $hutangbank + $neraca->nominal;
                }
                //Simpanan Pokok
                if($neraca->akun->id_header == 10){
                    $simpananpokok = $simpananpokok + $neraca->nominal;
                }
                //Simpanan Wajib
                if($neraca->akun->id_header == 11){
                    $simpananwajib = $simpananwajib + $neraca->nominal;
                }
            }
        }
        //Total SHU
        $bruto = $pinjaman + $provisi;
        $netto = $bruto - $beban;
        $operasi = $gaji + $penyusutan + $pemakaian;
        $shutotal = $netto - $operasi;
        //Total Neraca
        $aktivalancar = $kas + $piutang + $pemakaian;
        $aktivatetap = $peralatan - $penyusutan;
        $totalaktiva = $aktivalancar + $aktivatetap;
        $hutanglancar = $hutangusaha + $simpanansukarela + $hutangbunga;
        $hutangjangkapanjang = $hutangbank;
        $ekuitas = $simpananpokok + $simpananwajib + $shutotal;
        $totalpasiva = $hutanglancar + $hutangjangkapanjang + $ekuitas;
        return view('laporan.neraca', compact('daftarneraca','aktivalancar','aktivatetap','totalaktiva','hutanglancar','hutangjangkapanjang','ekuitas','totalpasiva','kas','piutang','pemakaian','penyusutan','peralatan','hutangusaha','simpanansukarela','hutangbunga','hutangbank','simpananpokok','simpananwajib','shutotal'));
    }

    //pencarian
    public function carineraca(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiSemua::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftarneraca = $daftar->where('id_users',$iduser);

            //Variabel SHU
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
            
            //Variabel Neraca
            $kas = 0;
            $piutang = 0;
            $peralatan = 0;
            $hutangusaha = 0;
            $simpanansukarela = 0;
            $hutangbunga = 0;
            $hutangbank = 0;
            $simpananpokok = 0;
            $simpananwajib = 0;
            //Total Neraca 
            $aktivalancar = 0;
            $aktivatetap = 0;
            $totalaktiva = 0;
            $hutanglancar = 0;
            $hutangjangkapanjang = 0;
            $ekuitas = 0;
            $totalpasiva = 0;

            foreach($daftarneraca as $neraca){
                if($neraca->keterangan == 'Kas'){
                //SHU
                    //Pinjaman
                    if($neraca->akun->id_header == 12){
                        $pinjaman = $pinjaman + $neraca->nominal;
                    }
                    //Provisi
                    if($neraca->akun->id_header == 13){
                        $provisi = $provisi + $neraca->nominal;
                    }
                    //Beban
                    if($neraca->akun->id_header == 14){
                        $beban = $beban + $neraca->nominal;
                    }
                    //Gaji
                    if($neraca->akun->id_header == 15){
                        $gaji = $gaji + $neraca->nominal;
                    }
                    //Penyusutan
                    if($neraca->akun->id_header == 5){
                        $penyusutan = $penyusutan + $neraca->nominal;
                    }
                    //Pemakaian
                    if($neraca->akun->id_header == 3){
                        $pemakaian = $pemakaian + $neraca->nominal;
                    }
                //NERACA
                    //Kas
                    if($neraca->akun->id_header == 1){
                        $kas = $kas + $neraca->nominal;
                    }
                    //Piutang
                    if($neraca->akun->id_header == 2){
                        $piutang = $piutang + $neraca->nominal;
                    }
                    //Peralatan
                    if($neraca->akun->id_header == 4){
                        $peralatan = $peralatan + $neraca->nominal;
                    }
                    //Hutang Usaha
                    if($neraca->akun->id_header == 6){
                        $hutangusaha = $hutangusaha + $neraca->nominal;
                    }
                    //Simpanan Sukarela
                    if($neraca->akun->id_header == 8){
                        $simpanansukarela = $simpanansukarela + $neraca->nominal;
                    }
                    //Hutang Bunga
                    if($neraca->akun->id_header == 7){
                        $hutangbunga = $hutangbunga + $neraca->nominal;
                    }
                    //Hutang Bank
                    if($neraca->akun->id_header == 9){
                        $hutangbank = $hutangbank + $neraca->nominal;
                    }
                    //Simpanan Pokok
                    if($neraca->akun->id_header == 10){
                        $simpananpokok = $simpananpokok + $neraca->nominal;
                    }
                    //Simpanan Wajib
                    if($neraca->akun->id_header == 11){
                        $simpananwajib = $simpananwajib + $neraca->nominal;
                    }
                }
            }
            //Total SHU
            $bruto = $pinjaman + $provisi;
            $netto = $bruto - $beban;
            $operasi = $gaji + $penyusutan + $pemakaian;
            $shutotal = $netto - $operasi;
            //Total Neraca
            $aktivalancar = $kas + $piutang + $pemakaian;
            $aktivatetap = $peralatan - $penyusutan;
            $totalaktiva = $aktivalancar + $aktivatetap;
            $hutanglancar = $hutangusaha + $simpanansukarela + $hutangbunga;
            $hutangjangkapanjang = $hutangbank;
            $ekuitas = $simpananpokok + $simpananwajib + $shutotal;
            $totalpasiva = $hutanglancar + $hutangjangkapanjang + $ekuitas;

            return view('laporan.neraca', compact('daftarneraca','aktivalancar','aktivatetap','totalaktiva','hutanglancar','hutangjangkapanjang','ekuitas','totalpasiva','kas','piutang','pemakaian','penyusutan','peralatan','hutangusaha','simpanansukarela','hutangbunga','hutangbank','simpananpokok','simpananwajib','shutotal'));            
        }
        return redirect('laporan.neraca');
    }
}
