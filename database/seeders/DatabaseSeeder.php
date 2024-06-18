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
            'warehouse_id' => 1,
            'name' => 'thoyiburrohman',
            'email' => 'semanggi@warehouse.com',
            'password' => bcrypt('semanggi'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 2,
            'name' => 'aris sumarwan',
            'email' => 'slipi@warehouse.com',
            'password' => bcrypt('slipi'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 2,
            'name' => 'rika amelia',
            'email' => 'slipi2@warehouse.com',
            'password' => bcrypt('slipi'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 3,
            'name' => 'akhmad diqiyah',
            'email' => 'kedoya@warehouse.com',
            'password' => bcrypt('kedoya'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 3,
            'name' => 'andri saputra',
            'email' => 'kedoya2@warehouse.com',
            'password' => bcrypt('kedoya'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 4,
            'name' => 'cacu munjiat',
            'email' => 'meruya@warehouse.com',
            'password' => bcrypt('meruya'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 4,
            'name' => 'eko wibowo',
            'email' => 'meruya2@warehouse.com',
            'password' => bcrypt('meruya'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 5,
            'name' => 'sugeng suprayogi',
            'email' => 'cengkarengb@warehouse.com',
            'password' => bcrypt('cengkarengb'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 5,
            'name' => 'dian hermawan',
            'email' => 'cengkarengb2@warehouse.com',
            'password' => bcrypt('cengkarengb'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 6,
            'name' => 'muhammad abdul aziz',
            'email' => 'cengkarenga@warehouse.com',
            'password' => bcrypt('cengkarenga'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 6,
            'name' => 'laden soekarno',
            'email' => 'cengkarenga2@warehouse.com',
            'password' => bcrypt('cengkarenga'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 7,
            'name' => 'rizal bani adam',
            'email' => 'palmerah@warehouse.com',
            'password' => bcrypt('palmerah'),
        ]);
        User::factory()->create([
            'role_id' => 3,
            'warehouse_id' => 7,
            'name' => 'murainingsih',
            'email' => 'palmerah2@warehouse.com',
            'password' => bcrypt('palmerah'),
        ]);
        User::factory()->create([
            'role_id' => 1,
            'warehouse_id' => 8,
            'name' => 'admin',
            'email' => 'admin@warehouse.com',
            'password' => bcrypt('adminwarehouse'),
        ]);
        User::factory()->create([
            'role_id' => 2,
            'warehouse_id' => 8,
            'name' => 'muhamad renaldi',
            'email' => 'witel@warehouse.com',
            'password' => bcrypt('witel'),
        ]);
        User::factory()->create([
            'role_id' => 2,
            'warehouse_id' => 8,
            'name' => 'dea wingit pinandito',
            'email' => 'witel2@warehouse.com',
            'password' => bcrypt('witel'),
        ]);

        Warehouse::create([
            'code' => 'SMI',
            'name' => 'Semanggi',
        ]);
        Warehouse::create([
            'code' => 'SLP',
            'name' => 'Slipi',
        ]);
        Warehouse::create([
            'code' => 'KDY',
            'name' => 'Kedoya',
        ]);
        Warehouse::create([
            'code' => 'MRY',
            'name' => 'Meruya',
        ]);
        Warehouse::create([
            'code' => 'CKGB',
            'name' => 'Cengkareng B',
        ]);
        Warehouse::create([
            'code' => 'CKG A',
            'name' => 'Cengkareng A',
        ]);
        Warehouse::create([
            'code' => 'PLM',
            'name' => 'Palmerah',
        ]);
        Warehouse::create([
            'code' => 'WITEL',
            'name' => 'Area Jakarta Barat',
        ]);
    }
}
