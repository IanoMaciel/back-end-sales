<?php

namespace Database\Seeders;

// use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;
    public function run(): void {
        UserType::factory()->count(3)->create();
    }
}
