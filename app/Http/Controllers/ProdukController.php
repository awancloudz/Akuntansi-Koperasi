<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Produk;
use App\Distributor;
use App\KategoriProduk;
use App\Profile;
use Storage;
use Validator;
use App\Http\Requests\ProdukRequest;
use Session;
use PDF;
use DB;
use Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mencari = 0;
        $produk_list = Produk::orderBy('kodeproduk', 'asc')->paginate(10);
        $jumlah_produk = Produk::count();
        return view('produk.index', compact('produk_list','jumlah_produk','mencari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        $input = $request->all();

        if($request->hasFile('foto')){
            $input['foto'] = $this->uploadFoto($request);
        }
        else{
            $input['foto'] = "noimage.png";
        }
        
        //Simpan Data produk
        $produk = Produk::create($input);
        Session::flash('flash_message', 'Data Produk Berhasil Disimpan');
        return redirect('produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('produk.show',compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {  
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Produk $produk, ProdukRequest $request)
    {
        $input = $request->all();

        if($request->hasFile('foto')){
            //Hapus foto lama
            $this->hapusFoto($produk);
            //Upload foto baru
            $input['foto'] = $this->uploadFoto($request);
        }

        $produk->update($input);

        Session::flash('flash_message', 'Data Produk berhasil diupdate');
        return redirect('produk');
    }

    //Upload foto ke direktori lokal
    public function uploadFoto(ProdukRequest $request){
        $foto = $request->file('foto');
        $ext = $foto->getClientOriginalExtension();

        if($request->file('foto')->isValid()){
            $foto_name = date('YmdHis'). ".$ext";
            $upload_path = 'fotoupload';
            $request->file('foto')->move($upload_path, $foto_name);
            return $foto_name;
        }
        return false;
    }

    //Hapus foto di direktori lokal
    public function hapusFoto(Produk $produk){
        $exist = Storage::disk('foto')->exists($produk->foto);
        if(isset($produk->foto) && $exist){
           $delete = Storage::disk('foto')->delete($produk->foto);
           if($delete){
            return true;
           }
           return false;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $recat = $produk->id_kategoriproduk;
        $this->hapusFoto($produk);
        $produk->delete();
        Session::flash('flash_message', 'Data Produk berhasil dihapus');
        Session::flash('Penting', true);
        return redirect('kategori/' . $recat);
        //return redirect('produk');
    }

    //pencarian
    public function cari(Request $request){
        $mencari = 0;
        $kata_kunci = $request->input('kata_kunci');
        if(!empty($kata_kunci)){
            //Query
            $query = Produk::where('namaproduk', 'LIKE', '%' . $kata_kunci . '%');
            $produk_list = $query->paginate(10);
            //Url Pagination
            $pagination = $produk_list->appends($request->except('page'));
            $jumlah_produk = $produk_list->total();
            return view('produk.index', compact('produk_list','kata_kunci','pagination','jumlah_produk','mencari'));
        }
        return redirect('produk');
    }

    //pencarian barcode
    public function caribarcode(Request $request){
        $mencari = 0;
        $kata_kunci_barcode = $request->input('kata_kunci_barcode');
        if(!empty($kata_kunci_barcode)){
            //Query
            $produk_list = Produk::where('kodeproduk',$kata_kunci_barcode)->orderBy('kodeproduk', 'desc')->paginate(10);
            $seleksi = $produk_list->all();
            foreach ($seleksi as $key => $value) {
            return redirect('produk/' . $value->id . '/edit');
            }
        }
        return redirect('produk');
    }
    //Kategori Produk
    public function kategori($cat)
    {   
        $mencari = 1;
        $produk_list = Produk::where('id_kategoriproduk',$cat)->orderBy('kodeproduk', 'asc')->paginate(10);
        $jumlah_produk = $produk_list->count();
        $kategorinya = KategoriProduk::all();
        return view('produk.index', compact('produk_list','jumlah_produk','kategorinya','cat','mencari'));
    }
    //Cetak Produk
    public function getPdf(Produk $produk)
    {
        $profiletoko = Profile::all();
        //$pdf = PDF::loadView('produk.pdf',compact('produk'))->setPaper('a4','portrait');
        $pdf = PDF::loadView('produk.print',compact('produk','profiletoko'))->setPaper(array(0,0,113.39,166.30),'landscape');
        return $pdf->stream();
    }
    //Import Excel
    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['id'=>'' ,'kodeproduk' => $value->kodeproduk ,'jenisproduk'=>'' ,'id_distributor'=>'1' ,'id_kategoriproduk'=>$request->cat1 ,'namaproduk' => $value->namaproduk ,'seriproduk' => $value->seriproduk ,'hargajual' => $value->hargajual ,'hargagrosir' => $value->hargagrosir ,'hargadistributor' => $value->hargadistributor ,'diskon'=> $value->diskon ,'stok'=> $value->stok ,'foto'=>''];
                }
                if(!empty($insert)){
                    DB::table('produk')->insert($insert);
                    Session::flash('flash_message', 'Import Data Produk Berhasil');
                }
            }
            else{
                Session::flash('flash_message', 'Data Kosong');
            }
        }
        else{
            Session::flash('flash_message', 'Silahkan Pilih File Excel (.xlsx / .xls / .csv) terlebih dahulu');
        }
        return back();
    }
    //Export Excel
    public function exportExcel($type)
    {
        $data = Produk::get()->toArray();
        return Excel::create('Data Produk', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
