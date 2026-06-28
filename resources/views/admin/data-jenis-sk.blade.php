<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jenis SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-text { transition: all 0.2s ease; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-jenis-sk'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'U') }}&background=2a93c9&color=fff" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Jenis SK</h1>
                
                <a href="{{ url('/tambah-jenis-sk') }}" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-blue-50 transition-all duration-300 tracking-wide bg-white">
                    TAMBAH
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-6 font-medium text-[13px] w-16 border-r border-[#3a9ed0] text-center">No</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0] text-center">Kelompok SK</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Jenis SK</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0] text-center">Periode</th>
                            <th class="py-3 px-6 font-medium text-[13px] w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#4a9bc8] font-medium text-[13px]">
                        @forelse($jenisSk as $index => $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-center">
                                <td class="py-4 px-6 border-r border-gray-100">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 border-r border-gray-100">{{ $item->kelompok_sk }}</td>
                                <td class="py-4 px-6 border-r border-gray-100 text-left">{{ $item->nama_jenis_sk }}</td>
                                <td class="py-4 px-6 border-r border-gray-100">{{ $item->periode ?? '-' }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center gap-3 text-lg">
                                        <a href="{{ url('/edit-jenis-sk/' . $item->id) }}" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ url('/hapus-jenis-sk/' . $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus Data Jenis SK ini?');">
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
                                <td colspan="5" class="py-10 text-center text-gray-400 italic font-normal">Belum ada data. Silakan klik Tambah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>