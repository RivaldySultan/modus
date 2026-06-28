<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Teknis - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-text { transition: all 0.2s ease; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-teknis'])

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
            
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data Teknis dan Administrasi</h1>
            
            <div class="flex justify-center w-full mt-4">
                <div class="bg-[#f8fafc] border border-gray-200 shadow-sm p-10 rounded-sm w-[450px]">
                    
                    <form action="{{ url('/edit-teknis/' . $teknis->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
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
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Kelompok Bagian</label>
                            <div class="relative">
                                <select name="keterangan" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 text-[#4a9bc8] text-[13px] outline-none appearance-none bg-white cursor-pointer" required>
                                    <option value="" disabled>Pilih Kelompok...</option>
                                    <option value="Umum" {{ $teknis->keterangan == 'Umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="Teknis" {{ $teknis->keterangan == 'Teknis' ? 'selected' : '' }}>Teknis</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#4a9bc8]">
                                    <i class="fa-solid fa-chevron-down text-[12px]"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Teknis/Administrasi</label>
                            <input type="text" name="nama_teknis" value="{{ $teknis->nama_teknis }}" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 text-gray-700 outline-none focus:ring-1 focus:ring-[#4a9bc8] bg-white" required>
                        </div>

                        <div class="mb-8">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Kode Teknis/Administrasi (Opsional)</label>
                            <input type="text" name="kode_teknis" value="{{ $teknis->kode_teknis }}" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 text-gray-700 outline-none focus:ring-1 focus:ring-[#4a9bc8] bg-white">
                        </div>

                        <div class="flex justify-between gap-4 mt-8">
                            <a href="/data-teknis" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] text-center flex-1 hover:bg-blue-50 transition-colors bg-white">
                                KEMBALI
                            </a>
                            <button type="submit" class="border border-[#4a9bc8] text-white bg-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] flex-1 hover:bg-[#3982a9] transition-colors">
                                SIMPAN
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </main>
</body>
</html>