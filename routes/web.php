<?php

use Illuminate\Support\Facades\Route;

use App\Models\Nte;
use App\Models\AssetNte;
use App\Models\TransactionNte;
use App\Http\Controllers\AssetNteController;
use App\Http\Controllers\Nte\NteController;
use App\Http\Controllers\Nte\DistributionNteController;
use App\Http\Controllers\Nte\TagOutNteController;
use App\Http\Controllers\Nte\TransactionNteController;

use App\Models\Material;
use App\Models\AssetMaterial;
use App\Models\DetailTransaction;
use App\Models\TransactionMaterial;
use App\Http\Controllers\AssetMaterialController;
use App\Http\Controllers\Material\MaterialController;
use App\Http\Controllers\Material\DistributionMaterialController;
use App\Http\Controllers\Material\TagOutMaterialController;

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\MitraController;

use App\Models\Technician;
use App\Http\Controllers\TechnicianController;
use App\Models\Warehouse;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        $data = [
            'assetNte' => AssetNte::orderBy('type', 'asc')->get(),
            'warehouse' => Warehouse::all(),
            'nteIntech' => TransactionNte::where('type', 'distribution')->whereRelation('nte', 'status', 'intech')->orderBy('date', 'asc')->get(),
        ];
        return view('pages.index', $data);
    })->name('index');

    // Asset NTE Route
    Route::get('asset-nte/import', [AssetNteController::class, 'import'])->name('asset-nte.import');
    Route::post('asset-nte/import', [AssetNteController::class, 'importing'])->name('asset-nte.importing');
    Route::get('asset-nte/{asset_nte}/delete', [AssetNteController::class, 'destroy'])->name('asset-nte.delete');
    Route::resource('asset-nte', AssetNteController::class);

    // NTE
    Route::get('nte/get-data', [NteController::class, 'getData'])->name('nte.getData');
    Route::get('nte/{nte}/delete', [NteController::class, 'destroy'])->name('nte.delete');
    Route::get('nte/{nte}/damage', [NteController::class, 'damage'])->name('nte.damage');
    Route::get('nte/{nte}/dismantle', [NteController::class, 'dismantle'])->name('nte.dismantle');
    Route::get('nte/intech/export', [NteController::class, 'exportIntech'])->name('nte.intech.export');
    Route::get('nte/tsel/export', [NteController::class, 'exportTsel'])->name('nte.tsel.export');
    Route::get('nte/ebis/export', [NteController::class, 'exportEbis'])->name('nte.ebis.export');
    Route::get('nte/import', [NteController::class, 'import'])->name('nte.import');
    Route::post('nte/import', [NteController::class, 'importing'])->name('nte.importing');
    Route::resource('nte', NteController::class);

    // Asset Material Route
    Route::get('asset-material/import', [AssetMaterialController::class, 'import'])->name('asset-material.import');
    Route::post('asset-material/import', [AssetMaterialController::class, 'importing'])->name('asset-material.importing');
    Route::get('asset-material/{asset_material}/delete', [AssetMaterialController::class, 'destroy'])->name('asset-material.delete');
    Route::resource('asset-material', AssetMaterialController::class);

    // Material
    Route::get('material/{material}/delete', [MaterialController::class, 'destroy'])->name('material.delete');
    Route::get('material/import', [MaterialController::class, 'import'])->name('material.import');
    Route::post('material/import', [MaterialController::class, 'importing'])->name('material.importing');
    Route::resource('material', MaterialController::class);

    // distribution route
    Route::name('distribution.')->prefix('distribution')->group(function () {
        // NTE
        Route::get('nte/return/{nte}', [DistributionNteController::class, 'return'])->name('nte.return');
        Route::resource('nte', DistributionNteController::class);

        // Material
        Route::get('material/return/{material}', [DistributionMaterialController::class, 'return'])->name('material.return');
        Route::resource('material', DistributionMaterialController::class);
    });

    // tag out route
    Route::name('tag-out.')->prefix('tag-out')->group(function () {
        // NTE 
        Route::resource('nte', TagOutNteController::class);

        // Material
        Route::resource('material', TagOutMaterialController::class);
    });

    // tag in route
    Route::name('tag-in.')->prefix('tag-in')->group(function () {
        // NTE
        Route::get('nte', function () {
            $data = [
                'tagIn' => TransactionNte::where('type', 'tag in')->where('to_id', warehouseId())->get()
            ];
            return view('pages.transaction.nte.tag-in.index', $data);
        })->name('nte.index');

        // Material
        Route::get('material', function () {
            $data = [
                'tagIn' => TransactionMaterial::where('type', 'tag in')->where('to_id', warehouseId())->get()
            ];
            return view('pages.transaction.material.tag-in.index', $data);
        })->name('material.index');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    // mitra route
    Route::get('mitra/import', [MitraController::class, 'import'])->name('mitra.import');
    Route::post('mitra/import', [MitraController::class, 'importing'])->name('mitra.importing');
    Route::get('mitra/{mitra}/delete', [MitraController::class, 'destroy'])->name('mitra.delete');
    Route::resource('mitra', MitraController::class);

    Route::get('technician/import', [TechnicianController::class, 'import'])->name('technician.import');
    Route::post('technician/import', [TechnicianController::class, 'importing'])->name('technician.importing');
    Route::get('technician/{technician}/delete', [TechnicianController::class, 'destroy'])->name('technician.delete');
    Route::resource('technician', TechnicianController::class);

    Route::get('user/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
    Route::resource('user', UserController::class);

    Route::get('warehouse/{warehouse}', function (Warehouse $warehouse) {
        return response()->json(Warehouse::find($warehouse->id));
    });
});
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authentication'])->name('login.authentication');
});
Route::get('allitem', function () {
    $data = [
        'assetNte' => AssetNte::all(),
        'assetMaterial' => AssetMaterial::all(),
        'ntes' => Nte::all(),
        'technician' => Technician::all(),
        'warehouse' => Warehouse::all(),
        'user' => User::all(),
        'Material' => Material::all(),
        'transactionNte' => TransactionNte::all(),
        'transactionMateiral' => TransactionMaterial::all(),
        'detailTransaction' => DetailTransaction::all(),
    ];
    return response()->json($data);
});
