<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'naji',
            'surname'  => 'hadji',
            'email'    => 'najihadji@asswat.com',
            'password' => Hash::make('R7!k@92mQp#Xz4nT'),
            'image'    => 'default.png',
        ]);
    }
}
