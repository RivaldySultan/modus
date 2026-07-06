<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard MODUS - BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        
        /* CSS Khusus Dashboard */
        .card-title-container { position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 20px; }
        .card-title-container::after { content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 1.5px; background-color: #2a93c9; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'dashboard'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300">
        
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-[13px] font-bold text-gray-800">{{ auth()->user()->nama ?? 'Guest' }}</p>
                    <p class="text-[11px] text-gray-500 font-medium uppercase">{{ auth()->user()->role ?? '' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'U') }}&background=2a93c9&color=fff" class="rounded-full w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <h1 class="text-[26px] font-bold text-black mb-8">
                Dashboard <span class="text-[15px] font-semibold text-gray-800 ml-1 uppercase">{{ auth()->user()->role ?? '' }}</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8 hover:shadow-md transition-shadow">
                    <div class="card-title-container">
                        <h2 class="text-[#2a93c9] font-bold text-[16px] uppercase tracking-wide px-2">JUMLAH TEMPLATE SK</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2a93c9] leading-none mt-2">{{ $jumlahTemplate }}</span>
                </div>
                
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8 hover:shadow-md transition-shadow">
                    <div class="card-title-container">
                        <h2 class="text-[#2a93c9] font-bold text-[16px] uppercase tracking-wide px-2">TOTAL SK YANG DIBUAT</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2a93c9] leading-none mt-2">{{ $totalSk }}</span>
                </div>
                
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8 hover:shadow-md transition-shadow">
                    <div class="card-title-container">
                        <h2 class="text-[#2a93c9] font-bold text-[16px] uppercase tracking-wide px-2">SK BULAN INI</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2a93c9] leading-none mt-2">{{ $skBulanIni }}</span>
                </div>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm mt-8 overflow-hidden w-full max-w-[65%]">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="text-[#2a93c9] text-[13px] font-bold uppercase tracking-wide">Aktivitas Terakhir</h3>
                </div>
                
                @forelse($aktivitasTerakhir as $aktivitas)
                    <div class="px-5 py-3 border-b border-gray-100 flex justify-between items-center {{ $loop->even ? 'bg-[#fbfbfb]' : 'bg-white' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#2a93c9] flex items-center justify-center text-[12px]">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold text-gray-800">{{ $aktivitas->nomor_sk }}</p>
                                <p class="text-[11px] text-gray-500">Diajukan oleh: <span class="font-semibold">{{ $aktivitas->user->nama ?? 'Sistem' }}</span></p>
                            </div>
                        </div>
                        <span class="text-[11px] font-medium text-gray-400 bg-gray-50 px-2 py-1 rounded">
                            {{ \Carbon\Carbon::parse($aktivitas->created_at)->diffForHumans() }}
                        </span>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center bg-white border-b border-gray-100">
                        <p class="text-[12px] text-gray-500 italic">Belum ada aktivitas pengajuan SK.</p>
                    </div>
                @endforelse
                
                <div class="px-4 py-3 text-right bg-white">
                    <a href="{{ url('/arsip') }}" class="text-[#2a93c9] text-[11px] font-bold hover:underline uppercase transition">Lihat Semua ></a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>