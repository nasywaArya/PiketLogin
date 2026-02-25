@extends('layouts.app')

@section('content')

<div class="bg-[#b7dcd1] min-h-screen p-10">

    <!-- ================= OUTER CONTAINER ================= -->
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- ================= HEADER CARD ================= -->
        <div class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center">

            <h1 class="text-3xl font-semibold">
                {{ $division->division_name }}
            </h1>

            <a href="{{ route('divisions.index') }}"
               class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                Back
            </a>

        </div>


        <!-- ================= USER LIST CARD ================= -->
        <div class="bg-white rounded-2xl shadow-md p-6">

            <!-- Title + Count -->
            <div class="flex justify-between items-center mb-4">

                <h2 class="text-2xl font-semibold">
                    User List
                </h2>

                <span class="bg-gray-200 px-4 py-1 rounded-full text-sm font-medium">
                    {{ $division->users->count() }} Users
                </span>

            </div>

            <!-- Scroll Area -->
            <div class="max-h-[300px] overflow-y-auto space-y-3 pr-2">

                @forelse ($division->users as $user)
                    <div class="flex items-center gap-3 p-3 bg-gray-100 rounded-lg shadow-sm">

                        <div class="w-8 h-8 bg-green-400 rounded-full"></div>

                        <span class="font-medium">
                            {{ $user->name }}
                        </span>

                    </div>
                @empty
                    <p class="text-gray-500 text-center">
                        No users in this division.
                    </p>
                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection