<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\NilaiKuesionerRequest;
use App\Kuesioner;
use App\NilaiKuesioner;
use Session;
use Auth;
class NilaiKuesionerController extends Controller
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
        $daftarkuesioner = NilaiKuesioner::where('id_users',$iduser)->get();
        $jumlahkuesioner = $daftarkuesioner->count();
        if($jumlahkuesioner > 0){
            $daftaraspek = Kuesioner::orderBy('id_aspekgrup', 'asc')->get();
            $daftarnilai = NilaiKuesioner::where('id_users',$iduser)->get();
            $daftargrup = NilaiKuesioner::distinct()->addSelect('id_aspekgrup')->where('id_users',$iduser)->get();
        }
        else{
            $daftaraspek = Kuesioner::orderBy('id_aspekgrup', 'asc')->get();
            foreach($daftaraspek as $aspek){
                $simpanaspek = New NilaiKuesioner;
                $simpanaspek->id_users = $iduser;
                $simpanaspek->id_aspekgrup = $aspek->aspekgrup->id;
                $simpanaspek->id_kuesioner = $aspek->id;
                $simpanaspek->pilihan = "tidak";
                $simpanaspek->save();
            }
            $daftarnilai = NilaiKuesioner::where('id_users',$iduser)->get();
            $daftargrup = NilaiKuesioner::distinct()->addSelect('id_aspekgrup')->where('id_users',$iduser)->get();
        }
        return view('nilaikuesioner.index', compact('daftaraspek','daftarnilai','daftargrup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiKuesioner $nilaikuesioner)
    {
        return view('nilaikuesioner.edit', compact('nilaikuesioner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NilaiKuesionerRequest $request, NilaiKuesioner $nilaikuesioner)
    {
        $input = $request->all();
        $nilaikuesioner->update($input);
        Session::flash('flash_message', 'Data Kuesioner berhasil diupdate');
        return redirect('nilaikuesioner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
