<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed data jabatan
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Manajer', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jabatan' => 'Pegawai', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed data area
        DB::table('area')->insert([
            ['nama_area' => 'Area A', 'tipe_area' => 'entitas', 'created_at' => now(), 'updated_at' => now()],
            ['nama_area' => 'Area B', 'tipe_area' => 'gudang', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed data users
        DB::table('users')->insert([
            [
                'username_nip' => '0000000000000001',
                'nama' => 'Admin Sistem',
                'no_telp' => '081234567890',
                'id_jabatan' => 1,
                'id_area' => 1,
                'password' => Hash::make('admin123'),
                'tipe_user' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username_nip' => '1471110101010001',
                'nama' => 'Manajer Utama',
                'no_telp' => '081234567891',
                'id_jabatan' => 1,
                'id_area' => 1,
                'password' => Hash::make('manager123'),
                'tipe_user' => 'manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username_nip' => '1471110101010002',
                'nama' => 'Pegawai Biasa',
                'no_telp' => '081234567892',
                'id_jabatan' => 2,
                'id_area' => 2,
                'password' => Hash::make('pegawai123'),
                'tipe_user' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed kategori masalah
        DB::table('kategori_masalah')->insert([
            [
                'nama_kategori' => 'Akun',
                'nama_subkategori' => 'Reset Password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Akun',
                'nama_subkategori' => 'Email Tidak Valid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Login',
                'nama_subkategori' => 'Akun Terkunci',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed FAQ
        DB::table('faq')->insert([
            [
                'id_kategori_masalah' => 1,
                'judul' => 'Bagaimana cara reset password?',
                'deskripsi' => 'Klik "Lupa Password" lalu ikuti instruksi di email.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori_masalah' => 2,
                'judul' => 'Kenapa email saya tidak valid?',
                'deskripsi' => 'Pastikan email yang dimasukkan sesuai format dan aktif.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori_masalah' => 3,
                'judul' => 'Akun saya terkunci',
                'deskripsi' => 'Hubungi admin untuk membuka kunci akun Anda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
