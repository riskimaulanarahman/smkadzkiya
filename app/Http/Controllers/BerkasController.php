<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Daftarulang;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $module)
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$module)
    {
        if($module == 'bukti-pembayaran') { // module
            $file = $request->file('buktipembayaran'); // name value
            $nama_file = $module."_".time()."_".$file->getClientOriginalName(); //  nama file
            $tujuan_upload = 'upload'; // tujuan upload
            $file->move($tujuan_upload,$nama_file); // memindahkan data ke folder upload
            
            $data = Daftarulang::findOrFail($id); // get id_cust pada table customer
            $data->update([
                'lampiran' => $nama_file
            ]); // update column foto_cust
        }
        
 
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
