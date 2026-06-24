<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminPassword = env('ADMIN_PASSWORD');

        if (! $adminPassword) {
            $adminPassword = 'KuaPurbalingga!' . date('Y');
            $this->command?->warn('ADMIN_PASSWORD tidak diset. Gunakan password sementara: ' . $adminPassword);
        }

        User::factory()->create([
            'name' => 'Admin KUA',
            'email' => 'admin@kua.com',
            'password' => Hash::make($adminPassword),
            'is_admin' => true,
        ]);

        $this->call(PostSeeder::class);
    }
}
