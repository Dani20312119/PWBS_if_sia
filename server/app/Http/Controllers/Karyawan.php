<?php

namespace App\Http\Controllers;

use App\Models\Model_Karyawan;
use Illuminate\Http\Request;

class Karyawan extends Controller
{
    function __construct()
    {
        $this->modelKaryawan = new Model_Karyawan();    
    }

    function view()
    {
        // ambil fungsi viewData dari model karyawan
        $data = $this->modelKaryawan->viewData();

        // tampilkan hasil dari "tb_karyawan"
        return response([
            "karyawan" => $data
        ],http_response_code());
       
    }

    function detail($parameter)
    {
        // ambil fungsi detailData dari model karyawan
        $data = $this->modelKaryawan->detailData($parameter);

        // tampilkan hasil detail karyawan dari "tb_karyawan"
        return response([
            "karyawan" => $data
        ],http_response_code());
       
    }

    // Function Untuk Hapus Data
    function delete($parameter)
    {
        // Cek data dari detail data (berdasarkan nik) //
        $data = $this->modelKaryawan->detailData($parameter);
        // Jika data ditemukan //
        if(count($data) != 0)
        {
            // Lakukan penghapusan data (panggil fungsi deleteData dari modelKaryawan) //
            $this->modelKaryawan->deleteData($parameter);
            // Buat pesan dan status hasil penghapusan data //
            $status = "Sukses";
            $pesan = "Data Berhasil Dihapus";
        }
        // Jika data tidak ditemukan //
        else
        {
            // Tampilkan Pesan Data Gagal Dihapus //
            $status = "Gagal";
            $pesan = "Data Gagal Dihapus! (NIK Tidak Ditemukan!)";
        }
        // Tampilkan Hasi Response Hapus Data //
        return response([
            "status" => $status,
            "pesan" => $pesan
        ], http_response_code());
    }

    // buat fungsi insert data
    function insert(Request $req) {
        // ambil data hasil input
        $data = [
            "nik"       => $req->nik_karyawan,
            "nama"      => $req->nama_karyawan,
            "alamat"    => $req->alamat_karyawan,
            "telepon"   => $req->telepon_karyawan,
            "jabatan"   => $req->jabatan_karyawan,
            // "parameter"   => base64_encode($req->nik_karyawan),
        ];
        $parameter = base64_encode($data["nik"]);
        // cek apakah data keryawan (nik) sudah pernah tersimpan atau belum
        // $check = $this->modelKaryawan->detailData($data["parameter"]);
        $check = $this->modelKaryawan->detailData($parameter);
        // jika data tidak ditemukan
        if (count($check) == 0) {
            // lakukan proses penyimpanan fungsi saveData
            $this->modelKaryawan->saveData(
                $data["nik"],
                $data["nama"],
                $data["alamat"],
                $data["telepon"],
                $data["jabatan"],
            );
            // buat pesan dan status hasil penyimpanan data
            $status = "Sukses";
            $pesan = "Data Berhasil Disimpan";
        } 
        // jika data tidak ditemukan
        else {
            // buat pesan dan status hasil penyimpanan data
            $status = "Gagal";
            $pesan = "Data Gagal Disimpan! (NIK Sudah Ada!)";
        }

        // Tampilkan Hasi Response Insert Data
        return response([
            "status" => $status,
            "pesan" => $pesan
        ], http_response_code());
    }

    //buat fungsi untuk ubah data
    function update($parameter, Request $req)
    {

        // ambil data hasil input
        $data = [
            "nik"       => $req->nik_karyawan,
            "nama"      => $req->nama_karyawan,
            "alamat"    => $req->alamat_karyawan,
            "telepon"   => $req->telepon_karyawan,
            "jabatan"   => $req->jabatan_karyawan,
            // "parameter"   => base64_encode($req->nik_karyawan),
        ];
        $parameter = base64_encode($data["nik"]);

        //cek apakah data karyawan ada atau tidak
        $cek = $this->modelKaryawan->checkUpdate($parameter, $data ["nik"]);
        
        //jika data tidak dtemukan
        if(count($cek) == 0 ) {
            //ubah data
            $this->modelKaryawan->updateData(
                $data["nik"],
                $data["nama"],
                $data["alamat"],
                $data["telepon"],
                $data["jabatan"],
                $parameter
            );
            ///tampilkan pesan
            $status = "Sukses";
            $pesan = "data berhasil di ubah";
        }
        //jika data ditemukan
        else
        {
            //tampilkan pesan
            $status = "Gagal";
            $pesan = "data gagal diubah ( NIK sudah pernah di simpan )";
        }

        // Tampilkan Hasi Response Insert Data
        return response([
            "status" => $status,
            "pesan" => $pesan
        ], http_response_code());
    }
}
