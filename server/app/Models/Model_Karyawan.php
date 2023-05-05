<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_Karyawan extends Model
{
    function viewData() {
        $query = DB::table('tb_karyawan')
        ->select(
            "nik AS kode_karyawan",
            "nama AS nama_karyawan",
            "alamat AS alamat_karyawan",
            "telepon AS telepon_karyawan",
            "jabatan AS jabatan_karyawan"
        )
        ->orderBy("kode_karyawan")
        ->get();
        
        return $query;
    }

    function detailData($parameter) {
        $query = DB::table('tb_karyawan')
        ->select(
            "nik AS kode_karyawan",
            "nama AS nama_karyawan",
            "alamat AS alamat_karyawan",
            "telepon AS telepon_karyawan",
            "jabatan AS jabatan_karyawan"
        )
        // ->where("MD5(nik)", "=", $parameter)
        // gunakan md5(nik) / base64
        // ->whereRaw("MD5(nik) = '$parameter'")
        // ->where(DB::raw("MD5(nik)"), "=", $parameter)
        // ->whereRaw("TO_BASE64(nik) = '$parameter'")
        ->where(DB::raw("TO_BASE64(nik)"), "=", $parameter)
        ->get();
        
        return $query;
    }

    // Buat fungsi untuk hapus data //
    function deleteData($parameter) {
        DB::table("tb_karyawan")
        ->where(DB::raw("TO_BASE64(nik)"),"=",$parameter)
        ->delete();
    }

    // Buat fungsi untuk simpan data
    function saveData($nik, $nama, $alamat, $telepon, $jabatan) {
        DB::table("tb_karyawan")
        ->insert([
            "nik"=> $nik,
            "nama"=> $nama,
            "alamat"=> $alamat,
            "telepon"=> $telepon,
            "jabatan"=> $jabatan,
        ]);
    }

    //fungis untuk ubah data
    function checkUpdate($nik_lama, $nik_baru)
    {
        //tampilkan datanya
        $query = DB::table("tb_karyawan")
        ->select("nik")
        ->where("nik", "=", $nik_baru)
        // ->where(DB::raw("TO_BEST64(nik)"), '!=', $nik_lama)
        ->where(DB::raw("nik"), '!=', $nik_lama)
        ->get();

        return $query;
    }

    function updateData($nik, $nama, $alamat, $telepon, $jabatan, $nik_lama)
    {
        DB::table("tb_karyawan")
        ->where(DB::raw("TO_BASE64(nik)"),"=",$nik_lama)
        ->update([
            "nik"       => $nik,
            "nama"      => $nama,
            "alamat"    => $alamat,
            "telepon"   => $telepon,
            "jabatan"   => $jabatan,
        ]);
    }
}
