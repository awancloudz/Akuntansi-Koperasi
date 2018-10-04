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
                $aktivalancar = 0; $aktivatetap = 0; $totalaktiva = 0; $hutanglancar = 0; $hutangjangkapanjang = 0; $ekuitas = 0; $totalpasiva = 0; $totalmodal = 0; $totalmodal2 =0; $persentase = 0; $nilaikredit = 0;
                //Aktiva Tertimbang
                $pinjamanang = 0; $pinjamannon = 0; $piutanglain = 0; $penyisihanpiutang = 0; $suratberharga = 0; $premi = 0; $sewadibayar = 0; $penyertaankop =0; $penyertaannon =0; $aktivalancarlain =0; $tanah =0; $bangunan =0; $kendaran =0;
                $perlengkapan = 0; $peralatankantor = 0; $inventarislain = 0; $penyusutanaktiva = 0; $aktivatetaplain = 0; $praoperasional = 0; $amorbiaya = 0; $rupaaktiva = 0;
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
                    //AKTIVA TERTIMBANG
                        //Pinjaman Anggota
                        if($neraca->id_akun == 3){
                            $pinjamanang = $pinjamanang + $neraca->nominal;
                        }
                        //Pinjaman Non Anggota
                        if($neraca->id_akun == 23){
                            $pinjamannon = $pinjamannon + $neraca->nominal;
                        }
                        //Piutang Lain
                        if($neraca->id_akun == 24){
                            $piutanglain = $piutanglain + $neraca->nominal;
                        }
                        //Penyisihan Piutang
                        if($neraca->id_akun == 25){
                            $penyisihanpiutang = $penyisihanpiutang + $neraca->nominal;
                        }
                        //Surat berharga
                        if($neraca->id_akun == 26){
                            $suratberharga = $suratberharga + $neraca->nominal;
                        }
                        //Premi Asuransi
                        if($neraca->id_akun == 27){
                            $premi = $premi + $neraca->nominal;
                        }
                        //Sewa Dibayar di Muka
                        if($neraca->id_akun == 28){
                            $sewadibayar = $sewadibayar + $neraca->nominal;
                        }
                        //Penyertaan Koperasi lainnya
                        if($neraca->id_akun == 29){
                            $penyertaankop = $penyertaankop + $neraca->nominal;
                        }
                        //Penyertaan Non Koperasi
                        if($neraca->id_akun == 30){
                            $penyertaannon = $penyertaannon + $neraca->nominal;
                        }
                        //Aktiva Lancar lain
                        if($neraca->id_akun == 31){
                            $aktivalancarlain = $aktivalancarlain + $neraca->nominal;
                        }
                        //Tanah
                        if($neraca->id_akun == 32){
                            $tanah = $tanah + $neraca->nominal;
                        }
                        //Bangunan
                        if($neraca->id_akun == 33){
                            $bangunan = $bangunan + $neraca->nominal;
                        }
                        //Kendaraan
                        if($neraca->id_akun == 34){
                            $kendaraan = $kendaraan + $neraca->nominal;
                        }
                        //Perlengkapan
                        if($neraca->id_akun == 4){
                            $perlengkapan = $perlengkapan + $neraca->nominal;
                        }
                        //Perlengkapan
                        if($neraca->id_akun == 4){
                            $perlengkapan = $perlengkapan + $neraca->nominal;
                        }
                        //Peralatan Kantor
                        if($neraca->id_akun == 5){
                            $peralatankantor = $peralatankantor + $neraca->nominal;
                        }
                        //Inventaris Lain
                        if($neraca->id_akun == 35){
                            $inventarislain = $inventarislain + $neraca->nominal;
                        }
                        //Penyusutan Aktiva
                        if($neraca->id_akun == 6){
                            $penyusutanaktiva = $penyusutanaktiva + $neraca->nominal;
                        }
                        //Aktiva Tetap Lain
                        if($neraca->id_akun == 36){
                            $aktivatetaplain = $aktivatetaplain + $neraca->nominal;
                        }
                        //Biaya Pra Operasional
                        if($neraca->id_akun == 37){
                            $praoperasional = $praoperasional + $neraca->nominal;
                        }
                        //Amor Biaya Operasional
                        if($neraca->id_akun == 38){
                            $amorbiaya = $amorbiaya + $neraca->nominal;
                        }
                        //Rupa Aktiva Lain
                        if($neraca->id_akun == 39){
                            $rupaaktiva = $rupaaktiva + $neraca->nominal;
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
                $totalmodal2 = $simpananpokok + $simpananwajib + $sumbangan + $cadangan + (($cadanganres * 50) / 100) + $penyertaan + $simpanankhusus + $penyetaraan;
                $aktivatertimbang = $pinjamanang + $pinjamannon + $piutanglain + (($penyisihanpiutang * 50) / 100) + (($suratberharga * 50) / 100) + $premi + (($sewadibayar * 50) / 100) + $penyertaankop + $penyertaannon + (($aktivalancarlain * 50) / 100) + (($tanah * 70) / 100) + (($bangunan * 70) / 100) + (($kendaran * 70) / 100) + (($perlengkapan * 70) / 100) + (($peralatankantor * 70) / 100) + (($inventarislain * 70) / 100) + (($penyusutanaktiva * 70) / 100) + (($aktivatetaplain * 70) / 100) + (($praoperasional * 50) / 100) + (($amorbiaya * 50) / 100) + (($rupaaktiva * 50) / 100);
                $pinjamanberesiko = 1;
            //II. HITUNG PENILAIAN KUALITAS AKTIVA PRODUKTIF
                $aktivaproduktif1 = ($pinjamanang / ($pinjamanang + $pinjamannon)) * 100;
                //Status Pinjaman Nasabah 
                $pinjamankrglancar = 1; $pinjamandiragukan = 1; $pinjamanmacet = 1;

                $aktivaproduktif2 = ((($pinjamankrglancar * 0.5) + ($pinjamandiragukan * 0.75) + $pinjamanmacet) / ($pinjamanang + $pinjamannon)) * 100;
                $aktivaproduktif3 = ((($penyisihanpiutang * -1) + $cadanganres) / (($pinjamankrglancar * 0.5) + ($pinjamandiragukan * 0.75) + $pinjamanmacet)) * 100; 
                $aktivaproduktif4 = ($pinjamanberesiko / ($pinjamanang + $pinjamannon)) * 100;
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
                        $persentase = ($totalmodal / $pinjamanberesiko) * 100;
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
                    if($aspek->id == 3){
                        $persentase = ($totalmodal2 / $aktivatertimbang) * 100;
                        $simpanaspek->persen = $persentase;
                        if($persentase <= 4 ){
                            $nilaikredit = 0;
                        }
                        else if($persentase <= 6 ){
                            $nilaikredit = 50;
                        }
                        else if($persentase <= 8 ){
                            $nilaikredit = 75;
                        }
                        else if($persentase > 8 ){
                            $nilaikredit = 100;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 4){
                        $persentase = $aktivaproduktif1;
                        $simpanaspek->persen = $persentase;
                        if($persentase <= 25 ){
                            $nilaikredit = 0;
                        }
                        else if($persentase <= 50 ){
                            $nilaikredit = 50;
                        }
                        else if($persentase <= 75 ){
                            $nilaikredit = 75;
                        }
                        else if($persentase > 75 ){
                            $nilaikredit = 100;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 5){
                        $persentase = number_format($aktivaproduktif2,2);
                        $simpanaspek->persen = $persentase;
                        if($persentase > 45 ){
                            $nilaikredit = 0;
                        }
                        else if($persentase > 40 ){
                            $nilaikredit = 10;
                        }
                        else if($persentase > 30 ){
                            $nilaikredit = 20;
                        }
                        else if($persentase > 20 ){
                            $nilaikredit = 40;
                        }
                        else if($persentase > 10 ){
                            $nilaikredit = 60;
                        }
                        else if($persentase > 0 ){
                            $nilaikredit = 80;
                        }
                        else{
                            $nilaikredit = 100;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 6){
                        $persentase = number_format($aktivaproduktif3,2,",",".");
                        $simpanaspek->persen = $persentase;
                        if($persentase > 100 ){
                            $nilaikredit = 100;
                        }
                        else{
                            $nilaikredit = 0;
                        }
                        $simpanaspek->nilaikredit = $nilaikredit;
                        $simpanaspek->skor = ($nilaikredit * $aspek->bobot) / 100;
                    }
                    if($aspek->id == 7){
                        $persentase = number_format($aktivaproduktif4,2);
                        $simpanaspek->persen = $persentase;
                        if($persentase > 30 ){
                            $nilaikredit = 25;
                        }
                        else if($persentase > 26 ){
                            $nilaikredit = 50;
                        }
                        else if($persentase > 21 ){
                            $nilaikredit = 75;
                        }
                        else{
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
