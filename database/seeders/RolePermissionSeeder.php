<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Dua baris di bawah ini WAJIB ada agar Laravel mengenali Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus cache agar tidak ada bentrok data
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Membuat Role sesuai Spesifikasi Teknis
        $role_admin = Role::create(['name' => 'super-admin']);
        $role_staff = Role::create(['name' => 'staff']);
        $role_public = Role::create(['name' => 'public']);

        // 2. Membuat Permission (Contoh: akses ke halaman admin)
        $permission = Permission::create(['name' => 'akses dashboard']);

        // 3. Memberikan Permission ke Role
        // Super Admin & Staff bisa masuk dashboard, Public tidak bisa
        $role_admin->givePermissionTo($permission);
        $role_staff->givePermissionTo($permission);
    }
}