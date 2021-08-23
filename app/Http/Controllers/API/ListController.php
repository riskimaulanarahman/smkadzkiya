<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Jabatan;
use App\SuratMasuk;
use App\SuratKeluar;
use App\Disposisi;
use App\Karyawan;
use Illuminate\Support\Carbon;
use Auth;


class ListController extends Controller
{

    public function listKelas() {
        return DB::table('kelas')->select('id','nama_kelas')->get();
    }

    public function listJurusan() {
        return DB::table('jurusan')->select('id','nama_jurusan')->get();
    }

    public function listTahunajaran() {
        return DB::table('tahunajaran')->select('id','tahun_ajaran')->get();
    }

}
