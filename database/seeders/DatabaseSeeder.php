<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kurikulum;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Post::factory(40)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        TahunAjaran::truncate();
        TahunAjaran::create([
            'uuid' => Str::orderedUuid(),
            'tahun_awal' => '2023',
            'tahun_akhir' => '2024',
            'status' => 1,
        ]);

        User::truncate();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        Kurikulum::truncate();
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'X IPA',
            'kurikulum' => '0'
        ]);
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'X IPS',
            'kurikulum' => '0'
        ]);
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'XI IPA',
            'kurikulum' => '1'
        ]);
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'XI IPS',
            'kurikulum' => '1'
        ]);
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'XII IPA',
            'kurikulum' => '1'
        ]);
        Kurikulum::create([
            'uuid' => Str::orderedUuid(),
            'kelas' => 'XII IPS',
            'kurikulum' => '1'
        ]);
    }
}
