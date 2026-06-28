<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .form-input-custom { width: 100%; border: 1px solid #93c5fd; border-radius: 6px; height: 40px; padding: 0 12px; color: #4a5568; font-size: 13px; outline: none; background-color: white; transition: border-color 0.2s; }
        .form-input-custom:focus { border-color: #3b82f6; box-shadow: 0 0 0 1px #3b82f6; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-pegawai'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="px-8 pt-10 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data Pegawai/Mitra</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white rounded border border-[#e2e8f0] shadow-sm w-full max-w-[500px] p-10">
                    
                    <form action="{{ url('/edit-pegawai/' . $pegawai->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-5 text-[12px]">
                                <ul>@foreach ($errors->all() as $error) <li>- {{ $error }}</li> @endforeach</ul>
                            </div>
                        @endif

                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ $pegawai->nama }}" class="form-input-custom" required>
                            </div>
                            
                            @php
                                $defaultStatus = ['PNS', 'PPPK', 'Mitra Statistik Sobat'];
                                $isLainnya = !in_array($pegawai->status_pegawai, $defaultStatus);
                            @endphp

                            <div class="relative">
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Status</label>
                                <select name="status_pegawai" id="statusDropdown" class="form-input-custom appearance-none text-gray-700" required onchange="cekStatusLainnya()">
                                    <option value="PNS" {{ $pegawai->status_pegawai == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ $pegawai->status_pegawai == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="Mitra Statistik Sobat" {{ $pegawai->status_pegawai == 'Mitra Statistik Sobat' ? 'selected' : '' }}>Mitra Statistik Sobat</option>
                                    <option value="Mitra Lainnya" {{ $isLainnya ? 'selected' : '' }}>Mitra Lainnya</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                    <i class="fa-solid fa-chevron-down text-[12px]"></i>
                                </div>
                            </div>

                            <div id="inputStatusLainnya" class="{{ $isLainnya ? '' : 'hidden' }} animate-[fade-in_0.3s_ease-out]">
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Ketik Status Mitra</label>
                                <input type="text" name="status_lainnya" id="statusManual" value="{{ $isLainnya ? $pegawai->status_pegawai : '' }}" class="form-input-custom" placeholder="Contoh: Mitra Pengolahan Data">
                            </div>

                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP / NIK</label>
                                <input type="text" name="nip" value="{{ $pegawai->nip }}" class="form-input-custom" required>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Alamat</label>
                                <input type="text" name="alamat" value="{{ $pegawai->alamat }}" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">No Telepon</label>
                                <input type="text" name="no_telepon" value="{{ $pegawai->no_telepon }}" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <a href="{{ url('/data-pegawai') }}" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">KEMBALI</a>
                                <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">SIMPAN</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <script>
        function cekStatusLainnya() {
            var dropdown = document.getElementById('statusDropdown');
            var divLainnya = document.getElementById('inputStatusLainnya');
            var inputManual = document.getElementById('statusManual');

            if (dropdown.value === 'Mitra Lainnya') {
                divLainnya.classList.remove('hidden');
                inputManual.setAttribute('required', 'required');
            } else {
                divLainnya.classList.add('hidden');
                inputManual.removeAttribute('required');
                inputManual.value = ''; 
            }
        }
    </script>
</body>
</html>