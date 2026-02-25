@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('mdivision')

<!-- ================= HEADER ================= -->
<div class="flex justify-between items-center mb-5 max-w-6xl mx-auto  ">
    <h1 class="text-3xl font-semibold text-black">
        Manage Divisions
    </h1>

    <a href="#addModal"
       class="bg-blue-500 text-white px-5 py-2 rounded-lg shadow mr-10">
        + Add Division
    </a>
</div>


<!-- ================= CONTAINER ================= -->
<div class="bg-[#b7dcd1] p-8 rounded-2xl max-w-6xl mx-auto ">
    <div class="flex justify-center bg-white rounded-2xl p-10 border border-gray-300 max-w-6xl mx-auto ">

        <!-- ================= GRID CARD ================= -->
        <div class="grid grid-cols-2 gap-[5rem]  ">

            @foreach ($divisions as $division)
            <div class="border rounded-lg shadow-sm overflow-hidden w-[350px] ">

                <!-- CARD TOP -->
                <div class="p-5">
                    <h2 class="text-base font-semibold">
                        {{ $division->division_name }}
                    </h2>

                    <div class="flex justify-between text-xs text-gray-600 mt-2">
                        <span>Number of users :</span>
                       <span>{{ $division->users->count() }} Users</span>
                    </div>
                </div>

                <div class="border-t"></div>

                <!-- CARD BUTTON -->
                <div class="flex justify-between p-5">

                     
                    <a href="{{ route('divisions.show', $division->id) }}"
                        class="bg-pink-500 text-white px-5 py-1 rounded-full text-xs">
                    Detail
                    </a>

                    <a href="#editModal{{ $division->id }}"
                       class="bg-blue-500 text-white px-7 py-1 rounded-full text-xs">
                        Edit
                    </a>

                    <a href="#deleteModal{{ $division->id }}"
                       class="border border-red-400 text-red-500 px-5 py-1 rounded-full text-xs">
                        Delete
                    </a>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>


<!-- ================= ADD MODAL ================= -->
<div id="addModal"
     class="fixed inset-0 bg-black/50 hidden target:flex items-center justify-center">

    <div class="bg-[#b7dcd1] w-[320px] rounded-2xl p-6 shadow-xl">
        <h2 class="text-lg font-semibold mb-4">Add Division</h2>

        <form action="{{ route('divisions.store') }}" method="POST">
            @csrf

            <label class="text-sm">Division Name</label>
            <input type="text" name="division_name"
                   class="w-full p-2 rounded-lg border mt-1" required>

            <div class="flex justify-end gap-3 mt-5">
                <a href="#" class="px-4 py-2 bg-gray-400 rounded-lg">Cancel</a>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>


<!-- ================= EDIT MODAL ================= -->
@foreach ($divisions as $division)
<div id="editModal{{ $division->id }}"
     class="fixed inset-0 bg-black/50 hidden target:flex items-center justify-center">

    <div class="bg-[#b7dcd1] w-[320px] rounded-2xl p-6 shadow-xl">
        <h2 class="text-lg font-semibold mb-4">Edit Division</h2>

        <form action="{{ route('divisions.update', $division->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="text-sm">Division</label>
            <input type="text" name="division_name"
                   value="{{ $division->division_name }}"
                   class="w-full p-2 rounded-lg border mt-1">

            <div class="flex justify-end gap-3 mt-5">
                <a href="#" class="px-4 py-2 bg-gray-400 rounded-lg">Cancel</a>
                <button class="px-4 py-2 bg-yellow-400 rounded-lg">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach


<!-- ================= DELETE MODAL ================= -->
@foreach ($divisions as $division)
<div id="deleteModal{{ $division->id }}"
     class="fixed inset-0 bg-black/50 hidden target:flex items-center justify-center">

    <div class="bg-[#b7dcd1] w-[320px] rounded-2xl p-6 shadow-xl">
        <h2 class="text-lg font-semibold mb-3 text-red-600">
            Delete Division
        </h2>

        <p class="text-sm mb-4">
            Are you sure you want to delete
            <b>{{ $division->division_name }}</b>?
        </p>

        <div class="flex justify-end gap-3">
            <a href="#" class="px-4 py-2 bg-gray-400 rounded-lg">
                Cancel
            </a>

            <form action="{{ route('divisions.destroy', $division->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection