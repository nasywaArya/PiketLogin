<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
   public function index()
{
    $divisions = Division::withCount('users')->get();

    return view('admin.divisions.index', compact('divisions'));
}

public function show(Division $division)
{
    $division->load('users');

    return view('admin.divisions.detail-users',
        compact('division'));
}


     // MENYIMPAN DATA BARU
    public function store(Request $request)
    {
        Division::create([
            'division_name' => $request->division_name,
            'total_users' => 0
        ]);

        return back();
    }

    // MENGUPDATE DATA
    public function update(Request $request, $id)
    {
        $division = Division::find($id);
        $division->division_name = $request->division_name;
        $division->save();

        return back();
    }

    // MENGHAPUS DATA
    public function destroy($id)
    {
        $division = Division::find($id);
        $division->delete();

        return back();
    }
}
