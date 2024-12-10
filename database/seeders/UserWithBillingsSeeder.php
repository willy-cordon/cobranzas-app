<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Billing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserWithBillingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
        ->count(10) // Crea 10 usuarios
        ->has(Billing::factory()->count(3)) // Cada usuario con 3 facturas
        ->create();
    }
}
