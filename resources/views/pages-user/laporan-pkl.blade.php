@extends('components.layout-user')

@section('title', 'Upload Laporan PKL')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Laporan PKL</h1>
            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col sm:flex-row items-center gap-4 mb-4">
                <!-- File Upload Button -->
                <div class="flex items-center w-full sm:w-auto">
                    <input type="file" id="fileUpload" name="file" accept=".pdf" class="hidden" onchange="handleFileUpload(event)">
                    <button type="button" onclick="document.getElementById('fileUpload').click()" 
                            class="bg-blue-500 text-white text-sm px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out w-full sm:w-auto flex items-center justify-center">
                        <i class="fas fa-upload mr-2"></i> Upload Laporan PKL
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center w-full sm:w-auto">
                    <button type="submit" class="mt-2 sm:mt-0 bg-green-500 text-white text-sm px-4 py-2 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out w-full sm:w-auto">
                        Simpan
                    </button>
                </div>
            </div>
        </form>

        <!-- Preview Section -->
        <div id="previewContainer" class="hidden mt-4 w-full sm:w-auto">
            <h2 class="text-lg font-semibold mb-2">Pratinjau Laporan PKL</h2>
            <div class="border rounded-lg overflow-hidden">
                <iframe id="filePreview" src="" class="w-full h-96 sm:h-[450px]"></iframe>
            </div>
        </div>
    </div>
</main>

<script>
    function handleFileUpload(event) {
        const file = event.target.files[0];

        if (file && file.type === 'application/pdf') {
            const fileURL = URL.createObjectURL(file);
            const previewContainer = document.getElementById('previewContainer');
            const filePreview = document.getElementById('filePreview');

            // Set file preview URL
            filePreview.src = fileURL;

            // Show the preview container
            previewContainer.classList.remove('hidden');
        } else {
            alert('Harap unggah file PDF.');
        }
    }
</script>

@endsection
