<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\KomponenPenilaian;
use App\DetailPenilaian;
use App\NilaiKuesioner;
use App\TransaksiSemua;
use App\User;
use Session;
use Auth;
class KesehatanKoperasiController extends Controller
{
    public function indexadmin(){
        $daftaruser = User::orderBy('id', 'asc')->paginate(50);
        $jumlahuser = $daftaruser->count();
        return view('kesehatankoperasi.indexadmin', compact('daftaruser','jumlahuser')); 
    }
    public function showadmin(User $user){
        $iduser = $user->id;
        $daftarpenilaian = DetailPenilaian::where('id_users',$iduser)->get();
        $jumlahpenilaian = $daftarpenilaian->count();
        if($jumlahpenilaian > 0){
            $daftaraspek = KomponenPenilaian::orderBy('id_aspekpenilaian', 'asc')->get();
            $daftarnilai = DetailPenilaian::where('id_users',$iduser)->get();
            $daftargrup = DetailPenilaian::distinct()->addSelect('id_aspekpenilaian')->where('id_users',$iduser)->get();
        }
        else{
            $daftaraspek = KomponenPenilaian::orderBy('id_aspekpenilaian', 'asc')->get();
            foreach($daftaraspek as $aspek){
                $simpanaspek = New DetailPenilaian;
                $simpanaspek->id_users = $iduser;
                $simpanaspek->id_aspekpenilaian = $aspek->aspekpenilaian->id;
                $simpanaspek->id_komponenpenilaian = $aspek->id;
                $simpanaspek->save();
            }
            $daftarnilai = DetailPenilaian::where('id_users',$iduser)->get();
            $daftargrup = DetailPenilaian::distinct()->addSelect('id_aspekpenilaian')->where('id_users',$iduser)->get();
        }
        return view('kesehatankoperasi.showadmin', compact('daftaraspek','daftarnilai','daftargrup','user'));  
    }
    public function index()
    {
        if(Auth::check()){
            $iduser = Auth::user()->id;
            }
            $daftarpenilaian = DetailPenilaian::where('id_users',$iduser)->get();
            $jumlahpenilaian = $daftarpenilaian->count();
            if($jumlahpenilaian > 0){
                $daftaraspek = KomponenPenilaian::orderBy('id_aspekpenilaian', 'asc')->get();
                $daftarnilai = DetailPenilaian::where('id_users',$iduser)->get();
                $daftargrup = DetailPenilaian::distinct()->addSelect('id_aspekpenilaian')->where('id_users',$iduser)->get();
            }
            else{
            //I. HITUNG PENILAIAN PEMODALAN
                $daftarneraca = TransaksiSemua::where('id_users',$iduser)->get();
                //Variabel SHU
                $pinjaman = 0; $provisi = 0; $beban = 0; $gaji = 0; $penyusutan = 0; $pemakaian = 0; $bruto = 0; $netto = 0; $operasi = 0; $shutotal = 0;
                //Variabel Neraca
                $kas = 0; $piutang = 0; $peralatan = 0; $hutangusaha = 0; $simpanansukarela = 0; $hutangbunga = 0; $hutangbank = 0; $simpananpokok = 0; $simpananwajib = 0;
                //Modal Tertimbang
                $sumbangan = 0; $cadangan = 0; $cadanganres = 0; $penyertaan = 0; $simpanankhusus = 0; $penyetaraan = 0; 
                //Total Neraca 
                $aktivalancar = 0; $aktivatetap = 0; $totalaktiva = 0; $hutanglancar = 0; $hutangjangkapanjang = 0; $ekuitas = 0; $totalpasiva = 0; $totalmodal = 0; $persentase = 0; $nilaikredit = 0;
                //Hitung Neraca & Modal
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
                    //MODAL
                        //Modal Sumbangan
                        if($neraca->akun->id_header == 17){
                            $sumbangan = $sumbangan + $neraca->nominal;
                        }
                        //Cadangan Umum
                        if($neraca->akun->id_header == 18){
                            $cadangan = $cadangan + $neraca->nominal;
                        }
                        //Cadangan Resiko
                        if($neraca->akun->id_header == 19){
                            $cadanganres = $cadanganres + $neraca->nominal;
                        }
                        //Modal Penyertaan
                        if($neraca->akun->id_header == 20){
                            $penyertaan = $penyertaan + $neraca->nominal;
                        }
                        //Simpanan Khusus
                        if($neraca->akun->id_header == 21){
                            $simpanankhusus = $simpanankhusus + $neraca->nominal;
                        }
                        //Modal Penyetaraan
                        if($neraca->akun->id_header == 22){
                            $penyetaraan = $penyetaraan + $neraca->nominal;
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
                //Total Modal
                $totalmodal = $simpananpokok + $simpananwajib + $sumbangan + $cadangan + $cadanganres + $penyertaan + $simpanankhusus + $penyetaraan + $shutotal;
                
            //II. HITUNG PENILAIAN KUALITAS AKTIVA PRODUKTIF

            //III. HITUNG PENILAIAN MANAJEMEN
                $daftarkuesioner = NilaiKuesioner::where('id_users',$iduser)->get();
                $aspek1 = 0; $aspek2 = 0; $aspek3 = 0; $aspek4 = 0; $aspek5 = 0;
                foreach($daftarkuesioner as $kuesioner){
                    if(($kuesioner->id_aspekgrup == 1) && ($kuesioner->pilihan == 'ya')){
                        $aspek1 = $aspek1 + 1;
                    }
                    if(($kuesioner->id_aspekgrup == 2) && ($kuesioner->pilihan == 'ya')){
                        $aspek2 = $aspek2 + 1;
                    }
                    if(($kuesioner->id_aspekgrup == 3) && ($kuesioner->pilihan == 'ya')){
                        $aspek3 = $aspek3 + 1;
                    }
                    if(($kuesioner->id_aspekgrup == 4) && ($kuesioner->pilihan == 'ya')){
                        $aspek4 = $aspek4 + 1;
                    }
                    if(($kuesioner->id_aspekgrup == 5) && ($kuesioner->pilihan == 'ya')){
                        $aspek5 = $aspek5 + 1;
                    }
                }
                
            //IV. HITUNG PENILAIAN EFISIENSI

            //V. HITUNG PENILAIAN LIKUIDITAS

            //VI. HITUNG PENILAIAN KEMANDIRIAN & PERTUMBUHAN

            //VII. HITUNG JATI DIRI KOPERASI

            //SIMPAN VALUE PENILAIAN AWAL
                $daftaraspek = KomponenPenilaian::orderBy('id_aspekpenilaian', 'asc')->get();
                foreach($daftaraspek as $aspek){
                    $simpanaspek = New DetailPenilaian;
                    $simpanaspek->id_users = $iduser;
                    $simpanaspek->id_aspekpenilaian = $aspek->aspekpenilaian->id;
                    $simpanaspek->id_komponenpenilaian = $aspek->id;
                    //Hitung Nilai per-Aspek
                    if($aspek->id == 1){
                        $persentase = ($totalmodal / $totalpasiva) * 100;
                        $simpanaspek->persen = number_format($persentase,2);
                        if($persentase < 20 ){
                            $nilaikredit = 25;
                        }
                        else if($persentase < 40 ){
                            $nilaikredit = 50;
                        }
                        else if($persentase < 60 ){
                            $nilaikredit = 100;
                        }
                        else if($persentase > 100 ){
                            $nilaikredit = 100;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 2){
                        $resiko = 1;
                        $persentase = ($totalmodal / $resiko) * 100;
                        $simpanaspek->persen = $persentase;
                        if($persentase < 20 ){
                            $nilaikredit = 25;
                        }
                        else if($persentase < 40 ){
                            $nilaikredit = 50;
                        }
                        else if($persentase < 60 ){
                            $nilaikredit = 100;
                        }
                        else if($persentase > 100 ){
                            $nilaikredit = 100;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 8){
                        $simpanaspek->nilaikredit = $aspek1;
                        $simpanaspek->skor = ($aspek1 / 12) * $aspek->bobot;
                    }
                    if($aspek->id == 9){
                        $simpanaspek->nilaikredit = $aspek2;
                        $simpanaspek->skor = ($aspek2 / 6) * $aspek->bobot;
                    }
                    if($aspek->id == 10){
                        $simpanaspek->nilaikredit = $aspek3;
                        $simpanaspek->skor = ($aspek3 / 5) * $aspek->bobot;
                    }
                    if($aspek->id == 11){
                        $simpanaspek->nilaikredit = $aspek4;
                        $simpanaspek->skor = ($aspek4 / 10) * $aspek->bobot;
                    }
                    if($aspek->id == 12){
                        $simpanaspek->nilaikredit = $aspek5;
                        $simpanaspek->skor = ($aspek5 / 5) * $aspek->bobot;
                    }
                    $simpanaspek->save();
                }

                //TAMPILKAN DETAIL PENILAIAN SETELAH DIHITUNG
                $daftarnilai = DetailPenilaian::where('id_users',$iduser)->get();
                $daftargrup = DetailPenilaian::distinct()->addSelect('id_aspekpenilaian')->where('id_users',$iduser)->get();
            }
            return view('kesehatankoperasi.index', compact('daftaraspek','daftarnilai','daftargrup')); 
    }
    public function create(){
        //
    }
    public function store(Request $request){
        //
    }
    public function show($id){
        //   
    }
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        //
    }
    public function destroy($id){
        //
    }
}
