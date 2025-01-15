<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pendaftaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_users' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_fakultas' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'id_prodi' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'nomor_pendaftaran' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nama_peserta' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-Laki', 'Perempuan'],
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'alamat_peserta' => [
                'type' => 'TEXT',
            ],
            'nama_orangtua' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'pekerjaan_orangtua' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_sekolah' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tahun_lulus' => [
                'type' => 'YEAR',
            ],
            'alamat_sekolah' => [
                'type' => 'TEXT',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'berkas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tahap_satu' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'tahap_dua' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'tahap_tiga' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'tanggal_pendaftaran' => [
                'type' => 'DATETIME',
            ],
            'status_pendaftaran' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default' => 'pending',
            ],
            'status_verifikasi' => [
                'type' => 'ENUM',
                'constraint' => ['unverified', 'verified'],
                'default' => 'unverified',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_users', 'users', 'id_users', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fakultas', 'fakultas', 'id_fakultas', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_prodi', 'prodi', 'id_prodi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pendaftaran');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran');
    }
}