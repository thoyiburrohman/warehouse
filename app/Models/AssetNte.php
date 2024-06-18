<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetNte extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function nte()
    {
        return $this->hasMany(Nte::class, 'asset_nte_id');
    }
}
