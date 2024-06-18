<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nte extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function assetNte()
    {
        return $this->belongsTo(AssetNte::class, 'asset_nte_id');
    }

    public function transaction()
    {
        return $this->hasOne(TransactionNte::class, 'nte_id');
    }
}
