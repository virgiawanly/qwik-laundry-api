<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::create([
            'name' => 'Cleandry',
            'slug' => 'cleandry',
            'is_active' => 1,
            'owner_id' => null,
        ]);

        $outlet = Outlet::create([
            'company_id' => $company->id,
            'name' => 'Outlet 1',
            'address' => 'Jl. Perintis Kemerdekaan No. 1',
            'phone' => '081234567890',
        ]);

        $user = User::create([
            'name' => 'Cleandry Admin',
            'email' => 'example@cleandry.id',
            'password' => bcrypt('cleandry'),
            'company_id' => $company->id,
            'outlet_id' => $outlet->id,
            'role' => UserRole::Admin->value,
        ]);

        $company->update([
            'owner_id' => $user->id,
        ]);
    }
}
