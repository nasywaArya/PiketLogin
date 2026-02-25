@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('musers')

<!-- ================= HEADER ================= -->
<div class="flex justify-between items-center mb-5 max-w-6xl mx-auto">
    <h1 class="text-3xl font-semibold text-black">
        Manage Users
    </h1>
</div>

<div class="bg-[#b7dcd1] p-8 rounded-2xl max-w-6xl mx-auto">

    <!-- Card -->
    <div class="bg-white rounded-2xl p-10 border border-gray-300 p-8 max-w-7xl mx-auto">

        <!-- ================= FILTER ================= -->
<div class="mb-6">

    <form method="GET"
          action="{{ route('manageusers.index') }}"
          class="space-y-4">

        <!-- SEARCH -->
        <div class="relative">
            <input type="text"
           name="search"
           placeholder="Filter by name or email..."
           value="{{ request('search') }}"
           class="w-full bg-[#dcdcdc] border border-gray-400
                  rounded-full py-4 pl-6 pr-12 text-sm
                  focus:outline-none">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 absolute right-5 top-1/2 -translate-y-1/2 text-gray-600"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
            </svg>
        </div>

        <!-- DROPDOWN + BUTTON -->
        <div class="flex items-center justify-between">

            <!-- DROPDOWN -->
            <select name="division_id"
                    onchange="this.form.submit()"
                    class="bg-[#f4b860] px-6 py-2 rounded-lg
                           font-medium border border-gray-400 cursor-pointer">

                <option value="">All Divisions</option>

                @foreach($divisions as $division)
                    <option value="{{ $division->id }}"
                        {{ request('division_id') == $division->id ? 'selected' : '' }}>
                        {{ $division->division_name }}
                    </option>
                @endforeach

            </select>

            <!-- ADD BUTTON -->
            <a href="#addModal"
               class="bg-[#f4b860] px-6 py-2 rounded-lg
                      font-medium border border-gray-400
                      cursor-pointer">
                Add User
            </a>

        </div>

    </form>
</div>

        <!-- ================= TABLE ================= -->
        <div class="mt-6">
            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-500 text-left">
                        <th class="py-3">ID</th>
                        <th>Name</th>
                        <th>Division</th>
                        <th>Email</th>
                        <th class="text-center">Edit</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-gray-400">
                        <td class="py-4">{{ str_pad($loop->iteration, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->division->division_name ?? '-' }}</td>
                        <td>{{ $user->email }}</td>

                        <td class="text-center flex justify-center gap-4 py-4">

                            <!-- Edit -->
                            <a href="#editUserModal{{ $user->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-black"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M11 5h2m-1-1v2m6.586 2.586a2 2 0 010 2.828L9 21H5v-4L16.586 6.586a2 2 0 012.828 0z"/>
                                </svg>
                            </a>

                            <!-- Delete -->
                            <a href="#deleteUserModal{{ $user->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-red-600"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M6 7h12M9 7V4h6v3m-8 0v13h10V7"/>
                                </svg>                                
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>


<!-- ================= ADD USER MODAL ================= -->
<div id="addModal"
     class="fixed inset-0 bg-black/40 hidden target:flex items-center justify-center">

    <div class="bg-[#9fc3b7] w-[700px] rounded-3xl p-8 shadow-xl relative">

        <h2 class="text-2xl font-semibold mb-6">
            Manage User
        </h2>

        <form action="{{ route('manageusers.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="flex gap-10">

                <!-- LEFT SIDE -->
                <div class="flex-1 space-y-4">

                    <!-- AUTO ID -->
                    <div>
                        <label class="block font-medium">ID</label>
                        
<input type="text"
       value="{{ str_pad($nextId, 5, '0', STR_PAD_LEFT) }}"
       disabled
       class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <!-- NAME -->
                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text"
                               name="name"
                               required
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <!-- DIVISION -->
                    <div>
                        <label class="block font-medium">Division</label>
                        <select name="division_id"
                                class="w-full p-3 rounded-xl bg-gray-200 border">
                            <option value="">-- Select Division --</option>

                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">
                                    {{ $division->division_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email"
                               name="email"
                               required
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="block font-medium">Password</label>
                        <input type="password"
                               name="password"
                               required
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                </div>

                <!-- RIGHT SIDE -->
<div class="flex flex-col items-center gap-4">

    <div class="bg-white w-[180px] h-[220px]
                rounded-2xl flex flex-col
                items-center justify-center shadow p-3">

        <!-- PREVIEW IMAGE -->
        <img id="photoPreview"
             src=""
             class="w-32 h-32 object-cover rounded-xl mb-3 hidden">

        <!-- DEFAULT TEXT -->
        <div id="noPhotoText"
             class="w-32 h-32 bg-gray-200 rounded-xl
                    flex items-center justify-center text-gray-400 mb-3">
            No Photo
        </div>

        <!-- FILE INPUT -->
        <label class="cursor-pointer bg-gray-200 px-4 py-2 rounded-lg text-sm">
            Pilih Foto
            <input type="file"
                   name="photo"
                   accept="image/*"
                   onchange="previewPhoto(event)"
                   class="hidden">
        </label>
    </div>

    <button type="submit"
            class="bg-yellow-400 px-6 py-2 rounded-xl
                   font-semibold shadow">
        Add User
    </button>

    <a href="#"
        class="bg-gray-400 px-6 py-2 rounded-xl
                  font-semibold shadow w-[120px]
                  text-center hover:bg-gray-500 transition">
                  Cancel
    </a>
</div>

            </div>
        </form>

    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
@foreach ($users as $user)
<div id="editUserModal{{ $user->id }}"
     class="fixed inset-0 bg-black/40 hidden target:flex items-center justify-center z-50">

    <div class="bg-[#9fc3b7] w-[700px] rounded-3xl p-8 shadow-xl relative">

        <h2 class="text-2xl font-semibold mb-6">
            Edit User
        </h2>

        <form action="{{ route('manageusers.update', $user->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex gap-10">

                <!-- LEFT SIDE -->
                <div class="flex-1 space-y-4">

                    <div>
                        <label class="block font-medium">ID</label>
                        <input type="text"
                               value="{{ str_pad($loop->iteration, 5, '0', STR_PAD_LEFT) }}"
                               disabled
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <div>
                        <label class="block font-medium">Name</label>
                        <input type="text"
                               name="name"
                               value="{{ $user->name }}"
                               required
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <div>
                        <label class="block font-medium">Division</label>
                        <select name="division_id"
                                class="w-full p-3 rounded-xl bg-gray-200 border">
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ $user->division_id == $division->id ? 'selected' : '' }}>
                                    {{ $division->division_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ $user->email }}"
                               required
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                    <div>
                        <label class="block font-medium">
                            Password (Kosongkan jika tidak diubah)
                        </label>
                        <input type="password"
                               name="password"
                               class="w-full p-3 rounded-xl bg-gray-200 border">
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="flex flex-col items-center gap-4">

                    <div class="bg-white w-[180px] h-[220px]
                                rounded-2xl flex flex-col
                                items-center justify-center shadow p-3">

                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}"
                                 class="w-32 h-32 object-cover rounded-xl mb-3">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-xl
                                        flex items-center justify-center text-gray-400 mb-3">
                                No Photo
                            </div>
                        @endif

                        <label class="cursor-pointer bg-gray-200 px-4 py-2 rounded-lg text-sm">
                            Pilih Foto
                            <input type="file"
                                   name="photo"
                                   class="hidden">
                        </label>
                    </div>

                    <button type="submit"
                            class="bg-yellow-400 px-6 py-2 rounded-xl
                                   font-semibold shadow w-[180px]">
                        Update User
                    </button>

                    <a href="#"
                       class="bg-gray-400 px-6 py-2 rounded-xl
                              font-semibold shadow w-[180px]
                              text-center hover:bg-gray-500 transition">
                        Cancel
                    </a>

                </div>

            </div> <!-- tutup flex gap-10 -->

        </form>

    </div>

</div>
@endforeach

<!-- ================= DELETE USER MODAL ================= -->
@foreach ($users as $user)
<div id="deleteUserModal{{ $user->id }}"
     class="fixed inset-0 bg-black/50 hidden target:flex items-center justify-center">

    <div class="bg-[#b7dcd1] w-[320px] rounded-2xl p-6 shadow-xl">
        
        <h2 class="text-lg font-semibold mb-3 text-red-600">
            Delete User
        </h2>

        <p class="text-sm mb-4">
            Are you sure you want to delete
            <b>{{ $user->name }}</b>?
        </p>

        <div class="flex justify-end gap-3">

            <!-- CANCEL -->
            <a href="#"
               class="px-4 py-2 bg-gray-400 rounded-lg">
                Cancel
            </a>

            <!-- DELETE -->
            <form action="{{ route('manageusers.destroy', $user->id) }}"
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


<script>
function previewPhoto(event) {
    const input = event.target;
    const preview = document.getElementById('photoPreview');
    const noPhotoText = document.getElementById('noPhotoText');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            noPhotoText.classList.add('hidden');
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection