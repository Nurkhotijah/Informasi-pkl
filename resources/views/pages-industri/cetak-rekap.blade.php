@extends('components.layout-industri')

@section('title', 'Laporan Kehadiran PKL')

@section('content')

<div class="container">
    <h2>Penilaian Siswa: {{ $student->name }}</h2>
    <form action="{{ route('assessments.store', $student->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="attitude" class="block text-sm font-medium text-gray-700">Sikap</label>
            <select name="attitude" id="attitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="baik">Baik</option>
                <option value="cukup baik">Cukup Baik</option>
                <option value="sangat baik">Sangat Baik</option>
            </select>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan Penilaian</button>
    </form>
</div>

@endsection
