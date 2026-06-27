<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jabatan - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-text { transition: all 0.2s ease; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-jabatan'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
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
                <div class="w-10 h-10 rounded-full border border-gray-200 p-[2px] bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'U') }}&background=2a93c9&color=fff" class="rounded-full w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Data Jabatan</h1>
            
            <div class="flex justify-center w-full">
                <div class="bg-white border border-gray-200 shadow-sm p-8 rounded-sm w-[450px]">
                    
                    <form action="{{ url('/tambah-jabatan') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5 text-[12px]">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>- {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan" value="{{ old('nama_jabatan') }}" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 focus:outline-none focus:ring-1 focus:ring-[#4a9bc8] text-[14px]" placeholder="Masukkan nama jabatan..." required>
                        </div>
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Keterangan <span class="text-gray-400 font-normal text-[12px]">(Opsional)</span></label>
                            <textarea name="keterangan" rows="3" class="w-full border border-[#4a9bc8] rounded p-3 focus:outline-none focus:ring-1 focus:ring-[#4a9bc8] text-[14px]" placeholder="Tambahkan keterangan jika perlu...">{{ old('keterangan') }}</textarea>
                        </div>
                        
                        <div class="flex justify-between mt-8 gap-4">
                            <a href="{{ url('/data-jabatan') }}" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 text-center flex-1 flex items-center justify-center">BATAL</a>
                            <button type="submit" class="border border-[#4a9bc8] text-white bg-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#398ab7] transition-colors duration-200 flex-1">SIMPAN</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

</body>
</html>