<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Teknis - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-text { transition: all 0.2s ease; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">
    
    @include('components.sidebar', ['active' => 'kegiatan-teknis'])
    
    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'U') }}&background=2a93c9&color=fff" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Data Kegiatan Teknis</h1>
                <a href="/tambah-kegiatan-teknis" class="bg-[#2a93c9] text-white px-4 py-2 rounded text-sm font-semibold hover:bg-[#1d7aa9]">
                    <i class="fa-solid fa-plus mr-2"></i>Tambah Kegiatan
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#2a93c9] text-white">
                        <tr>
                            <th class="py-3 px-4 font-medium text-[13px]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px]">Nama Teknis</th>
                            <th class="py-3 px-4 font-medium text-[13px]">Nama Survei</th>
                            <th class="py-3 px-4 font-medium text-[13px]">Periode</th>
                            <th class="py-3 px-4 font-medium text-[13px] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatan as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4 text-[13px] text-gray-600 border-r border-gray-100">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 text-[13px] text-gray-600 border-r border-gray-100">{{ $item->nama_teknis }}</td>
                            <td class="py-3 px-4 text-[13px] text-gray-600 border-r border-gray-100">{{ $item->nama_survei }}</td>
                            <td class="py-3 px-4 text-[13px] text-gray-600 border-r border-gray-100">{{ $item->periode }}</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex justify-center gap-3 text-lg">
                                        <a href="{{ url('/edit-kegiatan-teknis/' . $item->id) }}" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ url('/hapus-kegiatan-teknis/' . $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data pegawai/mitra ini?');">
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
                                <td colspan="7" class="py-10 text-center text-gray-400 italic font-normal">Data belum tersedia. Silakan klik Tambah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>