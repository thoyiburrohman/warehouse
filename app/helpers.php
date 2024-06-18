<?php

use App\Models\AssetNte;
use App\Models\Nte;
use App\Models\TransactionNte;

// global
function roleId()
{
  return auth()->user()->role_id;
}
function warehouseId()
{
  return auth()->user()->warehouse_id;
}

// Nte
function distributionNteGudang()
{
  return TransactionNte::where('from_id', auth()->user()->warehouse_id)->where('type', 'distribution');
}
function tagOutNteAll()
{
  return TransactionNte::where('type', 'tag out')->orderBy('created_at', 'desc')->get();
}
function tagOutNteGudang()
{
  return TransactionNte::where('from_id', auth()->user()->warehouse_id)->where('type', 'tag out')->orderBy('created_at', 'desc')->get();
}
function returnNteAll()
{
  return TransactionNte::where('type', 'return');
}
function returnNteGudang()
{
  return TransactionNte::where('from_id', auth()->user()->warehouse_id)->where('type', 'return');
}

function totalNte($type)
{
  if (roleId() != 3) {
    return count(Nte::where('status', 'available')->whereRelation('assetNte', 'type', $type)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->whereRelation('assetNte', 'type', $type)->get());
}
function totalAssetNteGudang($id)
{
  if (roleId() != 3) {
    return count(Nte::where('status', 'available')->where('asset_nte_id', $id)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('asset_nte_id', $id)->get());
}
function totalAssetNteAll()
{
  if (roleId() != 3) {
    return count(Nte::where('status', 'available')->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->get());
}
function totalItemAssetNteTselGudang($id, $warehouse)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id', $warehouse)->where('owner', 'TSEL')->where('status', 'available')->where('asset_nte_id', $id)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'TSEL')->where('asset_nte_id', $id)->get());
}
function totalItemAssetNteEbisGudang($id, $warehouse)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id', $warehouse)->where('owner', 'EBIS')->where('status', 'available')->where('asset_nte_id', $id)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'EBIS')->where('asset_nte_id', $id)->get());
}
function totalAssetNteTselGudang($id)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id', $id)->where('owner', 'TSEL')->where('status', 'available')->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'TSEL')->get());
}
function totalAssetNteEbisGudang($id)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id', $id)->where('owner', 'EBIS')->where('status', 'available')->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'EBIS')->get());
}
function totalAssetNteTselAll($id)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id')->where('owner', 'TSEL')->where('status', 'available')->where('asset_nte_id', $id)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'TSEL')->get());
}
function totalAssetNteEbisAll($id)
{
  if (roleId() != 3) {
    return count(Nte::where('warehouse_id')->where('owner', 'EBIS')->where('status', 'available')->where('asset_nte_id', $id)->get());
  }
  return count(Nte::where('warehouse_id', warehouseId())->where('status', 'available')->where('owner', 'EBIS')->get());
}

function umurHari($id)
{
  $transaction = TransactionNte::find($id);
  $date1 = DateTime::createFromFormat('m/d/Y', $transaction->date);
  $date2 = new DateTime();
  $diff = $date2->diff($date1);
  return $diff->days . ' Hari';
}
