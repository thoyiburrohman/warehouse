<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'users' => User::all(),
        ];
        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'warehouses' => Warehouse::all(),
            'roles' => Role::all(),
        ];
        return view('pages.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'warehouse_id' => 'required',
            'role_id' => 'required',
        ]);
        $store['telegram'] = $request->telegram;
        $store['password'] = bcrypt($store['password']);
        User::create($store);
        Session::flash('success', 'User berhasil ditambahkan');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = [

            'user' => User::find($user->id),
        ];
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'user' => User::find($user->id),
            'roles' => Role::all(),
            'warehouses' => Warehouse::all(),
        ];
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $update = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'warehouse_id' => 'required',
            'role_id' => 'required',
        ]);
        if ($request->password) {
            $update['password'] = bcrypt($request->password);
        }
        $update['telegram'] = $request->telegram;
        User::where('id', $user->id)->update($update);
        Session::flash('success', 'User berhasil diubah');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        Session::flash('success', 'User berhasil dihapus');
        return redirect()->route('user.index');
    }

    public function status(Request $request)
    {
        User::where('id', $request->id)->update(['status' => $request->status]);
        return redirect()->route('user.index');
    }
}
