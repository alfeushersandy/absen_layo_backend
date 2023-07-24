<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            //dashboard
            ['name' => 'dashboard.index'], ['name' => 'dashboard.izin'], ['name' => 'dashboard.absen'], 
            //master karyawan
            ['name' => 'karyawan.index'],['name' => 'karyawan.create'],  ['name' => 'karyawan.edit'], ['name' => 'karyawan.delete'],
            //izin
            ['name' => 'izin.index'], ['name' => 'izin.create'], ['name' => 'izin.delete'], ['name' => 'izin.approve'],['name' => 'izin.edit'],
            //absen
            ['name' => 'absen.index'], ['name' => 'absen.create'], ['name' => 'absen.delete'], ['name' => 'absen.approve'],['name' => 'absen.edit'],
            //lembur
            
            //permission
            ['name' => 'permission.index'], ['name' => 'permission.create'], ['name' => 'permission.delete'], ['name' => 'permission.edit'],
            //user
            ['name' => 'user.index'], ['name' => 'user.create'], ['name' => 'user.delete'], ['name' => 'user.edit'],
            //laporan
            ['name' => 'laporan.index'],
        ])->each(fn ($data) => Permission::create($data));
    }
}
