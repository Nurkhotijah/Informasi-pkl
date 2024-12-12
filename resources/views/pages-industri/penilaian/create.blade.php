@extends('components.layout-industri')

@section('title', 'Tambah Penilaian User')

@section('content')

<div class="max-w-7xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Form Penilaian</h1>
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="flex flex-col">
                <label for="user_id" class="block text-gray-700 font-semibold mb-2">Nama User</label>
                <select name="user_id" id="user_id" class="w-full p-3 border border-gray-300 rounded-md">
                    @foreach ($siswa as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            @foreach (['sikap' => 'Penilaian Sikap', 'microteaching' => 'Penilaian Microteaching', 'kehadiran' => 'Penilaian Kehadiran', 'project' => 'Penilaian Project'] as $field => $label)
            <div class="flex flex-col">
                <label for="{{ $field }}" class="block text-gray-700 font-semibold mb-2">{{ $label }}</label>
                <select name="{{ $field }}" id="{{ $field }}" class="w-full p-3 border border-gray-300 rounded-md">
                    @foreach (['baik', 'cukup baik', 'sangat baik'] as $value)
                    <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>
    
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Simpan Penilaian
            </button>
        </div>
    </form>    
</div>

@endsection
