<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Daftarulang;

class DaftarUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        try {
            if($user->role == 'siswa') {
                $data = Daftarulang::with(['users.jurusan','users.kelas','users.tahunajaran'])->where('id_user',$user->id)->get();
            } else {
                $data = Daftarulang::with(['users.jurusan','users.kelas','users.tahunajaran'])->get();
            }

            return response()->json(['status' => "show", "message" => "Menampilkan Data" , 'data' => $data]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        
        try {
            $find = Daftarulang::where('id_user',$user->id)
            ->whereNotIn('status',[2,3])
            ->count();

            if($find == 0) {

                $data = Daftarulang::create([
                    'nodu' => $request->nodu,
                    'id_user' => $user->id,
                    'status' => 0,
                ]);
                
                return response()->json(["status" => "success", "message" => "Berhasil Menambahkan Data"]);
            } else {
                return response()->json(["status" => "error", "message" => "Gagal Menambahkan, Anda masih memiliki draft atau pengajuan"]);    
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('pages/daftarulang');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $data = Daftarulang::findOrFail($id);
            $data->update($request->all());
            $data->save();        

            return response()->json(["status" => "success", "message" => "Berhasil Ubah Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function pengajuan(Request $request, $id)
    {
        try {

            $data = Daftarulang::findOrFail($id);
            if($data->lampiran == null) {
                return response()->json(["status" => "error", "message" => "Aksi Tidak di Izinkan"]); 
            } else {
                $data->update([
                    "status" => 1
                ]);
                $data->save();   
                return response()->json(["status" => "success", "message" => "Berhasil Melakukan pengajuan"]);
            }

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
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
        try {
            $data = Daftarulang::findOrFail($id);
            $data->delete();

            return response()->json(["status" => "success", "message" => "Berhasil Hapus Data"]);

        } catch (\Exception $e){

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function checkstatus($id)
    {
        $data = Daftarulang::findOrFail($id);
        if($data->status == 0) {
            return 200;
        } else if($data->status == 2){
            return 100;
        } else {
            return response()->json(["status" => "error", "message" => "Aksi Tidak di Izinkan"]); 
        }
    }

    public function printpdf($id) {
        $data = Daftarulang::where('id',$id)->with(['users.jurusan','users.kelas','users.tahunajaran'])->first();

        // return $data;

        $pdf = PDF::loadview('pdfdaftarulang',[
            'data'=>$data,
        ]);
	    return $pdf->stream();
    }

}
