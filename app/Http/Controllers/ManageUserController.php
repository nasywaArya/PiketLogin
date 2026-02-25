<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Models\Division;
use App\Models\User;
 

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index(Request $request)
    {
        $query = User::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
            });
        }      
        
        // FILTER DIVISION
         if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }   
        
        // SORTING
        if ($request->sort == 'az') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort == 'za') {
            $query->orderBy('name', 'desc');
        } else {
            $query->orderBy('id', 'asc');
        }

        $users = $query->with('division')
               ->paginate(5)
               ->withQueryString();
        $divisions = Division::all();
        $lastId = User::orderBy('id', 'desc')->value('id') ?? 0;
        $nextId = \App\Models\User::count() + 1;

        return view('admin.musers.index', compact('users', 'divisions', 'nextId'));
        return view('admin.musers.index', compact('users', 'divisions'));
 

    }

    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
 
        $divisions = Division::all();
       return view('manageusers.index', compact('divisions'));
 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
 
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'division_id' => 'required|exists:divisions,id',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $photoPath = null;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('users', 'public');
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'division_id' => $request->division_id,
        'photo' => $photoPath
    ]);

    return redirect()->route('manageusers.index')
                     ->with('success', 'User berhasil ditambahkan');
}

 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 
    public function update(Request $request, User $manageuser)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $manageuser->id,
        'division_id' => 'required|exists:divisions,id',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'division_id' => $request->division_id
    ];

    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('users', 'public');
    }

    $manageuser->update($data);

    return redirect()->route('manageusers.index')
                     ->with('success', 'User berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(User $manageuser)
    {
        $manageuser->delete();

        return redirect()->route('manageusers.index');
 
    }

}
