<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data KPA - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .form-input-custom { width: 100%; border: 1px solid #93c5fd; border-radius: 6px; height: 40px; padding: 0 12px; color: #4a5568; font-size: 13px; outline: none; background-color: white; transition: border-color 0.2s; }
        .form-input-custom:focus { border-color: #3b82f6; box-shadow: 0 0 0 1px #3b82f6; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-kpa'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="px-8 pt-10 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data KPA dan DIPA</h1>
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                    
                    <form action="{{ url('/edit-kpa/' . $kpa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-5 text-[12px]">
                                <ul>@foreach ($errors->all() as $error) <li>- {{ $error }}</li> @endforeach</ul>
                            </div>
                        @endif

                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tahun Anggaran</label>
                                <input type="number" name="tahun_anggaran" value="{{ $kpa->tahun_anggaran }}" class="form-input-custom" required>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama KPA</label>
                                <input type="text" name="nama_kpa" value="{{ $kpa->nama_kpa }}" class="form-input-custom" required>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP</label>
                                <input type="text" name="nip_kpa" value="{{ $kpa->nip_kpa }}" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nomor DIPA</label>
                                <input type="text" name="nomor_dipa" value="{{ $kpa->nomor_dipa }}" class="form-input-custom" required>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tanggal DIPA</label>
                                <input type="date" name="tanggal_dipa" value="{{ $kpa->tanggal_dipa }}" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <a href="{{ url('/data-kpa') }}" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">KEMBALI</a>
                                <button type="submit" class="bg-[#4a9bc8] text-white px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-[#3982a9] transition-colors uppercase">SIMPAN</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
</body>
</html>