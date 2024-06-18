<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(TransactionMaterial::class, 'transaction_material_id');
    }

    public function assets()
    {
        return $this->belongsTo(AssetMaterial::class, 'asset_material_id');
    }
}
