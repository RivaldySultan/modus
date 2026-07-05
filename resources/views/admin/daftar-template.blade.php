<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Template SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .sidebar-text { transition: all 0.2s ease; }    
        
        /* Pengaturan agar tampilan dokumen Word di dalam modal rapi */
        .docx-wrapper { background-color: transparent !important; padding: 0 !important; }
        .docx { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'daftar-template'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-[13px] font-bold text-gray-800">{{ auth()->user()?->nama ?? 'Admin' }}</p>
                    <p class="text-[11px] text-gray-500 font-medium uppercase">{{ auth()->user()?->role ?? '' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full border border-gray-200 bg-white p-[2px] cursor-pointer hover:shadow-md transition">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->nama ?? 'A') }}&background=2a93c9&color=fff" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[24px] font-semibold text-black tracking-tight">Daftar Template SK</h1>
                <a href="{{ url('/upload-template') }}" class="inline-block px-8 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i> UPLOAD
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-4 font-medium text-[13px] w-16 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Kelompok SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Nama Template</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Tanggal Upload</th>
                            <th class="py-3 px-4 font-medium text-[13px] w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $index => $data)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]">
                                <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">{{ $index + 1 }}</td>
                                
                                <td class="py-4 px-4 text-gray-700 border-r border-gray-100 text-left">
                                    <span class="font-bold text-[#2a93c9] block">{{ $data->jenisSk->kelompok_sk ?? '-' }}</span>
                                    <span class="text-[11px] text-gray-500">{{ $data->jenisSk->nama_jenis_sk ?? '-' }}</span>
                                </td>
                                
                                <td class="py-4 px-4 text-gray-800 font-medium border-r border-gray-100 text-left">{{ $data->nama_template }}</td>
                                <td class="py-4 px-4 text-gray-600 border-r border-gray-100">{{ $data->created_at->format('d/m/Y') }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex justify-center gap-3 text-lg">
                                        
                                        <button type="button" onclick="openPreview('/storage/{{ $data->file_template }}', '{{ $data->nama_template }}')" class="text-green-500 hover:opacity-70 transition" title="Lihat langsung file">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <a href="{{ url('/edit-template/' . $data->id) }}" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit Template">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ url('/hapus-template/' . $data->id) }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Yakin ingin menghapus template ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:opacity-70 transition" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-400 italic">Belum ada template SK yang diupload.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="previewModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded shadow-xl w-full max-w-4xl h-[85vh] flex flex-col overflow-hidden">
            <div class="px-6 py-4 bg-[#2a93c9] text-white flex justify-between items-center flex-shrink-0">
                <h3 id="modalTitle" class="font-bold text-[14px] uppercase tracking-wide">Pratinjau Dokumen</h3>
                <button onclick="closePreview()" class="text-white hover:text-gray-200 text-2xl font-semibold focus:outline-none">&times;</button>
            </div>
            <div class="flex-1 overflow-y-auto bg-gray-100 p-6 flex justify-center items-start relative">
                <div id="loadingTemplate" class="hidden absolute inset-0 bg-white/80 z-10 flex flex-col items-center justify-center gap-2">
                    <i class="fa-solid fa-spinner fa-spin text-3xl text-[#2a93c9]"></i>
                    <p class="text-[13px] text-gray-500 font-medium">Membaca isi dokumen...</p>
                </div>
                
                <div id="documentContainer" class="w-full max-w-[800px]"></div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="https://unpkg.com/docx-preview/dist/docx-preview.js"></script>

    <script>
        function openPreview(fileUrl, docTitle) {
            const modal = document.getElementById('previewModal');
            const container = document.getElementById('documentContainer');
            const loading = document.getElementById('loadingTemplate');
            
            document.getElementById('modalTitle').textContent = "Melihat File: " + docTitle;
            
            modal.classList.remove('hidden');
            loading.classList.remove('hidden');
            container.innerHTML = ""; 

            if (fileUrl.toLowerCase().endsWith('.pdf')) {
                loading.classList.add('hidden');
                container.innerHTML = `<iframe src="${fileUrl}" class="w-full h-[70vh] border rounded bg-white"></iframe>`;
            } else {
                fetch(fileUrl)
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengambil file.');
                        return response.blob();
                    })
                    .then(blob => {
                        loading.classList.add('hidden');
                        docx.renderAsync(blob, container)
                            .catch(err => {
                                container.innerHTML = `<div class="p-6 text-center text-red-500 font-medium bg-white border">Format file tidak didukung oleh browser.</div>`;
                            });
                    })
                    .catch(error => {
                        loading.classList.add('hidden');
                        container.innerHTML = `<div class="p-6 text-center text-red-500 font-medium bg-white border">Gagal memuat dokumen dari server.</div>`;
                    });
            }
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('documentContainer').innerHTML = "";
        }
    </script>
</body>
</html>