<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AkunRequest;

use App\Header;
use App\Akun;
use Session;
//use PDF;
use DB;
use Excel;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftarakun = Akun::orderBy('id', 'asc')->paginate(50);
        $jumlahakun = Akun::count();
        return view('akun.index', compact('daftarakun','jumlahakun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AkunRequest $request)
    {
        $input = $request->all();
        //Simpan Data Akun
        $akun = Akun::create($input);
        Session::flash('flash_message', 'Data Akun Berhasil Disimpan');
        return redirect('akun');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        return view('akun.show',compact('akun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Akun $akun, AkunRequest $request)
    {
        $input = $request->all();
        $akun->update($input);
        Session::flash('flash_message', 'Data Akun berhasil diupdate');
        return redirect('akun');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();
        Session::flash('flash_message', 'Data Akun berhasil dihapus');
        Session::flash('Penting', true);        
        return redirect('akun');
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
                    $insert[] = ['id'=>'' ,'id_header' => $value->id_header ,'kode_akun'=>$value->kode_akun ,'nama_akun' => $value->nama_akun ,'status' => $value->status];
                }
                if(!empty($insert)){
                    DB::table('akun')->insert($insert);
                    Session::flash('flash_message', 'Import Data Akun Berhasil');
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
}
