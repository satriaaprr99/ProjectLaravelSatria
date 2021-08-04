<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Satria Putra Ramadhan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'), //Hash default laravel
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('siswa')->insert([
            'foto' => '0cad0e163966b2e98e62847d049824e8.jpg',
            'nama' => 'Satria Putra Ramadhan',
            'kelas' => 'XII RPL 2',
            'angkatan' => '2018/2021',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
