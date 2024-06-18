<?php

namespace App\Http\Controllers\Nte;

use App\Http\Controllers\Controller;
use App\Models\Nte;
use App\Models\Technician;
use App\Models\Warehouse;
use App\Models\TransactionNte;
use Illuminate\Http\Request;

class TransactionNteController extends Controller
{
    public function showDistribution()
    {
        $data = [
            'transactions' => TransactionNte::where('from_id', auth()->user()->warehouse_id)->where('type', 'distribution')->whereRelation('item', 'status', 'intech')->orWhereRelation('item', 'status', 'install')->get(),
        ];
        return view('pages.transaction.nte.distribution.index', $data);
    }
    public function showStockTransfer()
    {
        if (auth()->user()->role_id == 3) {
            $transactions = TransactionNte::where('type', 'stock transfer')->get();
        } else {
            $transactions = TransactionNte::where('type', 'stock transfer')->get();
        }
        $data = [
            'transactions' => $transactions,
        ];

        return view('pages.transaction.nte.tag-out', $data);
    }
    public function show(TransactionNte $transaction)
    {
        return response()->json(TransactionNte::find($transaction->id));
    }
    public function stockTransfer(Request $request)
    {
        $warehouse = Warehouse::where('id', $request->to_warehouse)->first();
        $request['type'] = 'stock transfer';
        $request['created_by'] = auth()->user()->name;
        $request['updated_by'] = auth()->user()->name;
        $request['from_warehouse'] = auth()->user()->warehouse_id;
        TransactionNte::create($request->all());
        Nte::where('id', $request->item_id)->update(['warehouse_id' => $warehouse->id]);
        return response()->json(['data' => $request->all()]);
    }

    public function distribution(Request $request)
    {
        $technician = Technician::where('id', $request->technician_id)->first();
        $request['type'] = 'distribution';
        $request['created_by'] = auth()->user()->name;
        $request['updated_by'] = auth()->user()->name;
        $request['from_warehouse'] = auth()->user()->warehouse_id;
        TransactionNte::create($request->all());
        Nte::where('id', $request->item_id)
            ->update([
                'status' => 'intech',
                'note' => 'intech di NIK ' . $technician->nik,
            ]);
        return response()->json(['data' => $request->all()]);
    }

    public function return(Request $request)
    {
        $transaction =  TransactionNte::where('id', $request->id)->first();

        // update status item dari intech menjadi installed
        Nte::where('id', $transaction->item_id)
            ->update([
                'status' => 'available',
                'note' => 'ready to user',
            ]);
    }

    public function dismantle(Request $request)
    {
        Nte::where('id', $request->id)->update(['status' => 'dismantle']);
    }
    public function damage(Request $request)
    {
        Nte::where('id', $request->id)->update(['type' => 'unvailable']);
    }

    public function installed(Request $request)
    {
        // mengambil data transaksi berdasarkan request id
        $transaction =  TransactionNte::where('id', $request->id)->first();

        // update status item dari intech menjadi installed
        Nte::where('id', $transaction->item_id)
            ->update([
                'status' => 'install',
                'note' => 'install di order ' . $transaction->order
            ]);
    }
    public function beritaAcara(Request $request)
    {
        // mengambil data transaksi berdasarkan request id
        $transaction =  TransactionNte::where('id', $request->id)->first();

        // update status item dari intech menjadi installed
        Nte::where('id', $transaction->item_id)
            ->update([
                'status' => 'install',
                'note' => 'install di order ' . $transaction->order
            ]);
        TransactionNte::where('id', $transaction->id)
            ->update([
                'order' => $request->order,
                'inet' => $request->inet,
                'berita_acara' => 'ok',
            ]);
    }
}
