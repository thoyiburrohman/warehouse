<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemDescription;
use App\Models\Mitra;
use App\Models\Role;
use App\Models\Status;
use App\Models\Technician;
use App\Models\Warehouse;
use App\Models\User;
use App\Models\Transaction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'area',
        ]);
        Role::create([
            'name' => 'so',
        ]);

        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 3,
            'name' => 'so',
            'email' => 'so@warehouse.com',
            'password' => bcrypt('sowarehouse'),
        ]);
        User::factory()->create([
            'role_id' => 1,
            'warehouse_id' => 1,
            'name' => 'admin',
            'email' => 'admin@warehouse.com',
            'password' => bcrypt('adminwarehouse'),
        ]);
        User::factory()->create([
            'role_id' => 2,
            'warehouse_id' => 2,
            'name' => 'area',
            'email' => 'area@warehouse.com',
            'password' => bcrypt('areawarehouse'),
        ]);

        Warehouse::create([
            'code' => 'WH01',
            'name' => 'Warehouse 1',
        ]);
        Warehouse::create([
            'code' => 'WH02',
            'name' => 'Warehouse 2',
        ]);
        Warehouse::create([
            'code' => 'WH03',
            'name' => 'Warehouse 3',
        ]);
    }
}
