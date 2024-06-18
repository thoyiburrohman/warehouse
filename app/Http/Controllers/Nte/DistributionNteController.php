<?php

namespace App\Http\Controllers\Nte;

use App\Http\Controllers\Controller;
use App\Models\Nte;
use App\Models\Technician;
use App\Models\TransactionNte;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Api;



class DistributionNteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Api $bot)
    {

        if (roleId() != 3) {
            $return = returnNteAll();
            $distribution =   TransactionNte::where('type', 'distribution')->where(function ($query) {
                $query->whereRelation('nte', 'status', 'intech')
                    ->orWhereRelation('nte', 'status', 'install');
            })->orderBy('created_at', 'desc')->get();
            $distributionInstall =   TransactionNte::where('type', 'distribution')->WhereRelation('nte', 'status', 'install')->get();
            $distributionIntech =   TransactionNte::where('type', 'distribution')->WhereRelation('nte', 'status', 'intech')->get();
        } else {
            $return = returnNteGudang();
            $distribution =   distributionNteGudang()->where(function ($query) {
                $query->whereRelation('nte', 'status', 'intech')
                    ->orWhereRelation('nte', 'status', 'install');
            })->orderBy('created_at', 'desc')->get();
            $distributionInstall =   distributionNteGudang()->WhereRelation('nte', 'status', 'install')->get();
            $distributionIntech =   distributionNteGudang()->WhereRelation('nte', 'status', 'intech')->get();
        }

        $data = [
            'distributions' => $distribution,
            'distributionReturn' => $return,
            'distributionInstall' => $distributionInstall,
            'distributionIntech' => $distributionIntech,
        ];
        return view('pages.transaction.nte.distribution.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'ntes' => Nte::where('warehouse_id', warehouseId())->where('status', 'available')->get(),
            'technician' => Technician::all(),
            'warehouses' => Warehouse::whereNot('id', warehouseId())->get(),
        ];
        return view('pages.transaction.nte.distribution.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Api $bot)
    {
        $request->validate([
            'sn_id' => 'required',
        ]);
        Nte::whereIn('id', $request->sn_id)
            ->update([
                'status' => 'intech',
                'note' => 'pengebonan baru'
            ]);
        $nte = [];
        for ($i = 0; $i < count($request->sn_id); $i++) {
            $nte[] = TransactionNte::create([
                'number' => $request->number,
                'from_id' => auth()->user()->warehouse_id,
                'to_id' => $request->to_id,
                'nte_id' => $request->sn_id[$i],
                'type' => 'distribution',
                'date' => $request->date,
                'order' => $request->order[$i],
                'inet' => $request->inet[$i],
                'berita_acara' => $request->berita_acara,
                'created_by' => auth()->user()->name,
                'updated_by' => auth()->user()->name,
            ]);
        }
        $teknisi = Technician::where('id',  $request->to_id)->first();
        if ($teknisi->telegram) {

            $serial = Nte::whereIn('id',  $request->sn_id)->get();
            $serialNumber = "";
            foreach ($serial as $nte) {
                $serialNumber .= '_' . $nte->assetNte->type . ' \| ' . $nte->owner . ' \| ' . $nte->serial_number . '_' . "\n"; // Assuming 'serial_number' is the column name
            }
            $date = \Carbon\Carbon::parse($request->date)->format('d F Y');
            $serialNumber = rtrim($serialNumber, " ");
            $bot->sendMessage([
                'chat_id' => $teknisi->telegram,
                'parse_mode' => 'MarkdownV2',
                'text' => 'Hallo ' . $teknisi->name . ',' . "\n" .
                    'Berikut adalah detail pengambilan NTE tanggal ' .   $date . ' :' . "\n" . "\n" .
                    'Warehouse *' . auth()->user()->warehouse->name . '*' . "\n" . "\n" .
                    '*Jenis \| Owner \| Serial Number*' . "\n" .
                    $serialNumber .  "\n" .
                    'Silahkan cek *inbox Myi / MyStaff* untuk menerima pengambilan NTE' . "\n" .
                    'Terimakasih',
            ]);
        }
        Session::flash('success', 'Transaksi berhasil');
        return redirect()->route('distribution.nte.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionNte $transaction, $id)
    {
        $data = [
            'ntes' => Nte::where('warehouse_id', warehouseId())->where('status', 'available')->get(),
            'technician' => Technician::all(),
            'transactions' => TransactionNte::find($id),
        ];
        return view('pages.transaction.nte.distribution.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->item_damage) {
            $item_damage = $request->item_damage;
        } else {
            $item_damage = null;
        }
        TransactionNte::where('id', $id)
            ->update([
                'order' => $request->order,
                'inet' => $request->inet,
                'berita_acara' => $request->berita_acara,
                'item_damage' => $item_damage,
                'date' => $request->date,
                'updated_by' => auth()->user()->name,
            ]);
        if ($request->note) {
            $note = $request->note;
        } else {
            $note = null;
        }
        $transaction = TransactionNte::find($id);
        Nte::whereRelation('transaction', 'id', $transaction->id)->where('id', $transaction->nte_id)
            ->update([
                'status' => $request->status,
                'note' => $note
            ]);
        Session::flash('success', 'Update Transaksi berhasil');
        return redirect()->route('distribution.nte.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionNte $transaction)
    {
        //
    }

    public function return($id)
    {
        $transaction = TransactionNte::find($id);
        Nte::where('id', $transaction->nte_id)
            ->update([
                'status' => 'available',
                'note' => 'ready to use again'
            ]);
        TransactionNte::where('id', $transaction->id)
            ->update([
                'type' => 'return',
                'updated_by' => auth()->user()->name,
            ]);
        Session::flash('success', 'Return berhasil');
        return redirect()->route('distribution.nte.index');
    }
}
