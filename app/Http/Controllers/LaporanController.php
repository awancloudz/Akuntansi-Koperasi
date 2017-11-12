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
    public function simpanan(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSimpanan::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
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
    public function pinjaman(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiPinjaman::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
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
    public function umum(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiUmum::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
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
    public function shu(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSemua::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
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
                if($shu->akun->id_header == 16){
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
                    if($shu->akun->id_header == 16){
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
    public function neraca(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSemua::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
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
                if($neraca->akun->id_header == 16){
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
                    if($neraca->akun->id_header == 16){
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
    public function aruskas(){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }
        
        //$awalbulanlalu = date("Y-m-1",  strtotime('-1 month', strtotime($hariini)));
        //$akhirbulanlalu = date("Y-m-t", strtotime('-1 month', strtotime($hariini)));

        //Tanggal
        $hariini = date("Y-m-d");
        $awalbulanini = date("Y-m-1", strtotime($hariini));
        $akhirbulanini = date("Y-m-t", strtotime($hariini));
        $daftar = TransaksiSemua::whereBetween('tanggal', [$awalbulanini, $akhirbulanini])->get();
        $daftararuskas = $daftar->where('id_users',$iduser);

        //$daftar_lalu = TransaksiSemua::whereBetween('tanggal', [$awalbulanlalu, $akhirbulanlalu])->get();
        //$daftararuskas_lalu = $daftar_lalu->where('id_users',$iduser);

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
        //Variabel Arus Kas
        $piutang = 0;
        $satu = 0;
        $dua = 0;
        $tiga = 0;
        $jumlahpendek = 0;
        $hutangpendek = 0;
        $pemakaian = 0;
        $perlengkapan = 0;
        $peralatan = 0;
        $hutangbank = 0;
        $simpananpokok = 0;
        $simpananwajib = 0;
        $totaloperasi = 0;
        $totalinvestasi = 0;
        $totalpembiayaan = 0;
        $kasawal = 0;
        $kasakhir = 0;

        foreach($daftararuskas as $aruskas){
            if($aruskas->keterangan == 'Kas'){
            //SHU
                //Pinjaman
                if($aruskas->akun->id_header == 12){
                    $pinjaman = $pinjaman + $aruskas->nominal;
                }
                //Provisi
                if($aruskas->akun->id_header == 13){
                    $provisi = $provisi + $aruskas->nominal;
                }
                //Beban
                if($aruskas->akun->id_header == 14){
                    $beban = $beban + $aruskas->nominal;
                }
                //Gaji
                if($aruskas->akun->id_header == 15){
                    $gaji = $gaji + $aruskas->nominal;
                }
                //Penyusutan
                if($aruskas->akun->id_header == 5){
                    $penyusutan = $penyusutan + $aruskas->nominal;
                }
                //Pemakaian
                if($aruskas->akun->id_header == 16){
                    $pemakaian = $pemakaian + $aruskas->nominal;
                }
            //ARUS KAS
                //Piutang
                if($aruskas->akun->id_header == 2){
                    $piutang = $piutang + $aruskas->nominal;
                }
                //hutang jangka pendek
                if($aruskas->akun->id_header == 6){
                    $satu = $satu + $aruskas->nominal;
                }
                if($aruskas->akun->id_header == 7){
                    $dua = $dua + $aruskas->nominal;
                }
                if($aruskas->akun->id_header == 8){
                    $tiga = $tiga + $aruskas->nominal;
                }
                $jumlahpendek = $satu + $dua + $tiga;
                $hutangpendek = $hutangpendek + $jumlahpendek;
                //Perlengkapan
                if($aruskas->akun->id_header == 3){
                    $perlengkapan = $perlengkapan + $aruskas->nominal;
                }
                //Peralatan
                if($aruskas->akun->id_header == 4){
                    $peralatan = $peralatan + $aruskas->nominal;
                }
                //Hutang Bank
                if($aruskas->akun->id_header == 9){
                    $hutangbank = $hutangbank + $aruskas->nominal;
                }
                //Simpanan Pokok
                if($aruskas->akun->id_header == 10){
                    $simpananpokok = $simpananpokok + $aruskas->nominal;
                }
                //Simpanan Wajib
                if($aruskas->akun->id_header == 11){
                    $simpananwajib = $simpananwajib + $aruskas->nominal;
                }
            }
        }
        //Total SHU
        $bruto = $pinjaman + $provisi;
        $netto = $bruto - $beban;
        $operasi = $gaji + $penyusutan + $pemakaian;
        $shutotal = $netto - $operasi;
        //Total Aruskas
        $totaloperasi = $shutotal - ($piutang + $hutangpendek + $pemakaian + $penyusutan);
        $totalinvestasi = $perlengkapan + $peralatan;
        $totalpembiayaan = $hutangbank + $simpananpokok + $simpananwajib;
        $kasakhir = $totaloperasi + $totalinvestasi + $totalpembiayaan;

        return view('laporan.aruskas', compact('daftararuskas','piutang','hutangpendek','pemakaian','penyusutan','totaloperasi','perlengkapan','peralatan','totalinvestasi','hutangbank','simpananpokok','simpananwajib','totalpembiayaan','kasakhir','shutotal'));        
    }
    public function cariaruskas(Request $request){
        if(Auth::check()){
        $iduser = Auth::user()->id;
        }

        $tgl_awal = $request->tgl_awal;    //Ambil value dari inputan pencarian
        $tgl_akhir = $request->tgl_akhir;
        if(!empty($tgl_awal)){                        //Jika kata kunci tidak kosong, maka... 
            //Query
            $daftar = TransaksiSemua::whereBetween('tanggal', [$tgl_awal, $tgl_akhir])->get();
            $daftararuskas = $daftar->where('id_users',$iduser);

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
            //Variabel Arus Kas
            $piutang = 0;
            $satu = 0;
            $dua = 0;
            $tiga = 0;
            $jumlahpendek = 0;
            $hutangpendek = 0;
            $pemakaian = 0;
            $perlengkapan = 0;
            $peralatan = 0;
            $hutangbank = 0;
            $simpananpokok = 0;
            $simpananwajib = 0;
            $totaloperasi = 0;
            $totalinvestasi = 0;
            $totalpembiayaan = 0;
            $kasawal = 0;
            $kasakhir = 0;

            foreach($daftararuskas as $aruskas){
                if($aruskas->keterangan == 'Kas'){
                //SHU
                    //Pinjaman
                    if($aruskas->akun->id_header == 12){
                        $pinjaman = $pinjaman + $aruskas->nominal;
                    }
                    //Provisi
                    if($aruskas->akun->id_header == 13){
                        $provisi = $provisi + $aruskas->nominal;
                    }
                    //Beban
                    if($aruskas->akun->id_header == 14){
                        $beban = $beban + $aruskas->nominal;
                    }
                    //Gaji
                    if($aruskas->akun->id_header == 15){
                        $gaji = $gaji + $aruskas->nominal;
                    }
                    //Penyusutan
                    if($aruskas->akun->id_header == 5){
                        $penyusutan = $penyusutan + $aruskas->nominal;
                    }
                    //Pemakaian
                    if($aruskas->akun->id_header == 16){
                        $pemakaian = $pemakaian + $aruskas->nominal;
                    }
                //ARUS KAS
                    //Piutang
                    if($aruskas->akun->id_header == 2){
                        $piutang = $piutang + $aruskas->nominal;
                    }
                    //hutang jangka pendek
                    if($aruskas->akun->id_header == 6){
                        $satu = $satu + $aruskas->nominal;
                    }
                    if($aruskas->akun->id_header == 7){
                        $dua = $dua + $aruskas->nominal;
                    }
                    if($aruskas->akun->id_header == 8){
                        $tiga = $tiga + $aruskas->nominal;
                    }
                    $jumlahpendek = $satu + $dua + $tiga;
                    $hutangpendek = $hutangpendek + $jumlahpendek;
                    //Perlengkapan
                    if($aruskas->akun->id_header == 3){
                        $perlengkapan = $perlengkapan + $aruskas->nominal;
                    }
                    //Peralatan
                    if($aruskas->akun->id_header == 4){
                        $peralatan = $peralatan + $aruskas->nominal;
                    }
                    //Hutang Bank
                    if($aruskas->akun->id_header == 9){
                        $hutangbank = $hutangbank + $aruskas->nominal;
                    }
                    //Simpanan Pokok
                    if($aruskas->akun->id_header == 10){
                        $simpananpokok = $simpananpokok + $aruskas->nominal;
                    }
                    //Simpanan Wajib
                    if($aruskas->akun->id_header == 11){
                        $simpananwajib = $simpananwajib + $aruskas->nominal;
                    }
                }
            }
            //Total SHU
            $bruto = $pinjaman + $provisi;
            $netto = $bruto - $beban;
            $operasi = $gaji + $penyusutan + $pemakaian;
            $shutotal = $netto - $operasi;
            //Total Aruskas
            $totaloperasi = $shutotal - ($piutang + $hutangpendek + $pemakaian + $penyusutan);
            $totalinvestasi = $perlengkapan + $peralatan;
            $totalpembiayaan = $hutangbank + $simpananpokok + $simpananwajib;
            $kasakhir = $totaloperasi + $totalinvestasi + $totalpembiayaan;

            return view('laporan.aruskas', compact('daftararuskas','piutang','hutangpendek','pemakaian','penyusutan','totaloperasi','perlengkapan','peralatan','totalinvestasi','hutangbank','simpananpokok','simpananwajib','totalpembiayaan','kasakhir','shutotal'));        
        }
        return redirect('laporan.aruskas');
    }
}
