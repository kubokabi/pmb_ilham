<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_users',
        'id_fakultas',
        'id_prodi',
        'nomor_pendaftaran',
        'nama_peserta',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'alamat_peserta',
        'nama_orangtua',
        'pekerjaan_orangtua',
        'nama_sekolah',
        'tahun_lulus',
        'alamat_sekolah',
        'foto',
        'berkas',
        'tahap_satu',
        'tahap_dua',
        'tahap_tiga',
        'tanggal_pendaftaran',
        'status_pendaftaran',
        'status_verifikasi',
        'created_at',
        'updated_at'
    ];
    // Dates
    protected $useTimestamps = false;
}