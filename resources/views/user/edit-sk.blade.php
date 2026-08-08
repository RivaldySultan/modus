<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Revisi Pengajuan SK - BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #eef3f7; }
        .card-title-container { position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 20px; }
        .card-title-container::after { content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 1.5px; background-color: #2491c9; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <!-- Active diset ke dashboard karena user mengakses form ini dari tombol edit di dashboard -->
    @include('components.sidebar-user', ['active' => 'dashboard'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#eef3f7] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[38px] h-[35px] bg-[#2491c9] rounded flex flex-col items-center justify-center gap-[4px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
            </button>
            <div class="flex items-center gap-3">
                <span class="text-[14px] font-medium text-gray-600 hidden md:block">Halo, {{ auth()->user()?->nama ?? 'Pegawai' }}</span>
                <div class="w-10 h-10 rounded-full border border-[#2491c9] p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->nama ?? 'U') }}&background=2491c9&color=fff" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-6 pb-10">
            <div class="mb-6">
                <h1 class="text-[24px] font-bold text-gray-900">Revisi & Edit Pengajuan SK</h1>
                <p class="text-gray-500 text-[14px] mt-1" id="pageSubtitle">Langkah 3: Lengkapi Formulir Meta Data SK</p>
            </div>

            <!-- Banner Catatan Admin -->
            @if($sk->catatan)
                <div class="bg-orange-50 border-l-4 border-orange-500 p-4 mb-6 rounded shadow-sm max-w-[800px]">
                    <h3 class="font-bold text-orange-700 text-[14px] mb-1"><i class="fa-solid fa-comment-dots"></i> Catatan Revisi dari Admin:</h3>
                    <p class="text-gray-700 text-[13px] italic">"{{ $sk->catatan }}"</p>
                </div>
            @endif

            <div id="step1-jenis" class="hidden grid-cols-1 md:grid-cols-2 gap-6 max-w-[800px]">
                @forelse($dataKelompok as $kelompok => $items)
                <div onclick="pilihJenis('{{ $kelompok }}')" class="hover-card bg-white border-2 border-gray-200 rounded-lg p-8 cursor-pointer flex flex-col items-center text-center transition-all hover:border-[#2491c9] hover:shadow-md">
                    <div class="w-20 h-20 {{ $kelompok == 'SK Teknis' ? 'bg-orange-50' : 'bg-blue-50' }} rounded-full flex items-center justify-center mb-5">
                        <i class="fa-solid {{ $kelompok == 'SK Teknis' ? 'fa-cogs text-orange-500' : 'fa-folder-open text-[#2491c9]' }} text-3xl"></i>
                    </div>
                    <h3 class="text-[18px] font-bold text-gray-800 mb-2">{{ $kelompok }}</h3>
                    <p class="text-[13px] text-gray-500">Terdapat {{ count($items) }} template dokumen tersedia.</p>
                </div>
                @empty
                <div class="col-span-2 text-center py-10 bg-white rounded border border-dashed border-gray-300">
                    <p class="text-gray-500 mb-2">Belum ada template SK yang tersedia.</p>
                </div>
                @endforelse
            </div>

            <div id="step2-kelompok" class="hidden w-full max-w-[900px]">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[16px] font-bold text-gray-800 flex items-center gap-2">
                        <i id="iconJenis" class="fa-solid fa-folder text-[#2491c9]"></i>
                        Kategori: <span id="labelJenisTerpilih" class="text-[#2491c9]">SK Umum</span>
                    </h2>
                    <button onclick="kembaliKeLangkah1()" class="text-[13px] text-gray-500 hover:text-red-500 font-medium transition flex items-center gap-1.5 bg-white px-3 py-1.5 border border-gray-200 rounded shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i> Ganti Kelompok
                    </button>
                </div>
                <div id="wadahKelompokSK" class="grid grid-cols-1 md:grid-cols-3 gap-4"></div>
            </div>

            <!-- Form Edit Langsung Terbuka -->
            <div id="step3-form" class="block">
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm w-full max-w-[800px] p-8">
                    
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
                        <div>
                            <div class="text-[12px] font-bold text-gray-400 uppercase flex items-center gap-2">
                                <span id="breadJenis">{{ $sk->jenis_sk }}</span> <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </div>
                            <h2 id="labelKelompokTerpilih" class="text-[20px] font-bold text-[#2491c9] mt-1">{{ $sk->kelompok_sk }}</h2>
                        </div>
                        <button type="button" onclick="kembaliKeLangkah2()" class="text-[13px] text-gray-500 hover:text-red-500 font-medium transition flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-left"></i> Ganti Template
                        </button>
                    </div>

                    <!-- Arahkan action ke route update dengan method PUT -->
                    <form action="{{ route('user.sk.update', $sk->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jenis_sk" id="hidden_jenis_sk" value="{{ old('jenis_sk', $sk->jenis_sk) }}">
                        <input type="hidden" name="kelompok_sk" id="hidden_kelompok_sk" value="{{ old('kelompok_sk', $sk->kelompok_sk) }}">

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-[13px]">
                                <strong>Penyimpanan Gagal! Terdapat kesalahan:</strong>
                                <ul class="list-disc pl-5 mt-1">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div>
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-[#2491c9] pl-3 mb-4">Informasi Umum SK</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <div class="bg-blue-50 p-2 rounded mb-2 flex gap-2 items-center border border-blue-200">
                                        <i class="fa-solid fa-magic text-[#2491c9] ml-1"></i>
                                        <select class="w-full bg-transparent text-[12px] font-bold text-blue-800 outline-none cursor-pointer" onchange="document.getElementById('input_judul_sk').value = this.value">
                                            <option value="">-- AUTO-FILL DARI DATA KEGIATAN TEKNIS --</option>
                                            @foreach($kegiatanTeknis as $kt)
                                                <option value="{{ $kt->nama_survei }}">{{ $kt->nama_teknis }} - {{ $kt->nama_survei }} ({{ $kt->periode }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Judul SK / Nama Kegiatan</label>
                                    <input type="text" id="input_judul_sk" name="judul_sk" value="{{ old('judul_sk', $sk->judul_sk) }}" placeholder="Ketik manual atau pilih otomatis di atas..." class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nomor SK</label>
                                    <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $sk->nomor_sk) }}" placeholder="Contoh: 001/KPA/0821" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tahun Anggaran</label>
                                    <input type="number" name="tahun_anggaran" value="{{ old('tahun_anggaran', $sk->tahun_anggaran) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tanggal Ditetapkan SK</label>
                                    <input type="date" name="tanggal_ditetapkan" value="{{ old('tanggal_ditetapkan', $sk->tanggal_ditetapkan) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-green-500 pl-3 mb-4">Dasar DIPA</h3>
                            
                            <div class="bg-green-50 p-2 rounded mb-3 flex gap-2 items-center border border-green-200">
                                <i class="fa-solid fa-magic text-green-600 ml-1"></i>
                                <select class="w-full bg-transparent text-[12px] font-bold text-green-800 outline-none cursor-pointer" onchange="if(this.value){let d = this.value.split('|'); document.getElementById('input_no_dipa').value = d[0]; document.getElementById('input_tgl_dipa').value = d[1];}">
                                    <option value="">-- AUTO-FILL DARI DATA MASTER DIPA --</option>
                                    @foreach($dataDipa as $dipa)
                                        <option value="{{ $dipa->nomor_dipa }}|{{ $dipa->tanggal_dipa }}">DIPA Tahun {{ $dipa->tahun_anggaran ?? 'Aktif' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nomor DIPA</label>
                                    <input type="text" id="input_no_dipa" name="nomor_dipa" value="{{ old('nomor_dipa', $sk->nomor_dipa) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-green-500" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tanggal DIPA</label>
                                    <input type="date" id="input_tgl_dipa" name="tanggal_dipa" value="{{ old('tanggal_dipa', $sk->tanggal_dipa) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-green-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-purple-500 pl-3 mb-4">Penandatangan (KPA)</h3>
                            
                            <div class="bg-purple-50 p-2 rounded mb-3 flex gap-2 items-center border border-purple-200">
                                <i class="fa-solid fa-magic text-purple-600 ml-1"></i>
                                <select class="w-full bg-transparent text-[12px] font-bold text-purple-800 outline-none cursor-pointer" onchange="if(this.value){let k = this.value.split('|'); document.getElementById('input_kpa_nama').value = k[0]; document.getElementById('input_kpa_nip').value = k[1];}">
                                    <option value="">-- AUTO-FILL DARI DATA MASTER KPA --</option>
                                    @foreach($dataKpa as $kpa)
                                        <option value="{{ $kpa->nama_kpa }}|{{ $kpa->nip_kpa }}">{{ $kpa->nama_kpa }} ({{ $kpa->tahun_anggaran }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nama KPA</label>
                                    <input type="text" id="input_kpa_nama" name="kpa_nama" value="{{ old('kpa_nama', $sk->kpa_nama) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-purple-500" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">NIP KPA</label>
                                    <input type="text" id="input_kpa_nip" name="kpa_nip" value="{{ old('kpa_nip', $sk->kpa_nip) }}" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-purple-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-50 p-5 rounded border border-orange-100 mt-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-orange-500 pl-3">Data Peserta / Pegawai (Lampiran)</h3>
                            </div>
                            
                            <datalist id="jabatan_list">
                                @foreach($dataJabatan as $jab)
                                    <option value="{{ $jab->nama_jabatan }}"></option>
                                @endforeach
                            </datalist>

                            <div id="wadah-peserta" class="space-y-4"></div>
                            
                            <button type="button" onclick="tambahPesertaLama('', '', '', '')" class="mt-4 bg-white text-orange-600 border border-orange-200 hover:bg-orange-100 font-semibold px-4 py-2 rounded text-[12px] transition w-full shadow-sm flex justify-center items-center gap-2">
                                <i class="fa-solid fa-plus"></i> Tambah Data Pegawai Lainnya
                            </button>
                        </div>

                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="window.location.href='{{ url('/user/dashboard') }}'" class="px-5 py-2.5 text-[14px] font-semibold text-gray-600 hover:text-gray-900 transition border border-gray-300 rounded">
                                Batal
                            </button>
                            <button type="submit" class="bg-[#2491c9] text-white rounded px-6 py-2.5 text-[14px] font-bold hover:bg-[#1d7aa9] shadow transition tracking-wide">
                                Simpan Revisi & Ajukan Ulang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        const step1 = document.getElementById('step1-jenis');
        const step2 = document.getElementById('step2-kelompok');
        const step3 = document.getElementById('step3-form');
        const subtitle = document.getElementById('pageSubtitle');
        
        let stateJenis = '';
        let stateKelompok = '';

        // Data JSON dari Controller
        const dataKelompokSK = @json($dataKelompok);
        const dataPegawai = @json($dataPegawai);

        function pilihJenis(jenis) {
            stateJenis = jenis;
            document.getElementById('hidden_jenis_sk').value = jenis; 
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            
            subtitle.innerText = "Langkah 2: Pilih Template SK";
            document.getElementById('labelJenisTerpilih').innerText = jenis;
            
            const iconJenis = document.getElementById('iconJenis');
            if(jenis === 'SK Teknis') {
                iconJenis.className = "fa-solid fa-cogs text-orange-500";
                document.getElementById('labelJenisTerpilih').className = "text-orange-500";
            } else {
                iconJenis.className = "fa-solid fa-folder text-[#2491c9]";
                document.getElementById('labelJenisTerpilih').className = "text-[#2491c9]";
            }

            const wadahKelompok = document.getElementById('wadahKelompokSK');
            wadahKelompok.innerHTML = ''; 

            if(dataKelompokSK[jenis]) {
                dataKelompokSK[jenis].forEach(kel => {
                    const namaAman = kel.nama.replace(/'/g, "\\'");
                    wadahKelompok.innerHTML += `
                        <div onclick="pilihKelompok('${namaAman}')" class="hover-card bg-white border border-gray-200 rounded flex p-4 cursor-pointer gap-4 items-center shadow-sm hover:border-[#2491c9] transition-all">
                            <div class="w-12 h-12 rounded bg-gray-50 flex items-center justify-center flex-shrink-0 border border-gray-100">
                                <i class="fa-solid ${kel.icon} text-lg text-gray-600"></i>
                            </div>
                            <div>
                                <h4 class="text-[14px] font-bold text-gray-800">${kel.nama}</h4>
                                <p class="text-[12px] text-gray-500 mt-0.5 leading-tight">${kel.desc}</p>
                            </div>
                        </div>
                    `;
                });
            } else {
                wadahKelompok.innerHTML = `<div class="col-span-3 text-center py-6 text-gray-500 text-[13px] border border-dashed rounded">Belum ada template untuk kategori ini.</div>`;
            }
        }

        function kembaliKeLangkah1() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            step3.classList.add('hidden');
            subtitle.innerText = "Langkah 1: Pilih Kelompok Surat Keputusan";
        }

        function pilihKelompok(kelompok) {
            stateKelompok = kelompok;
            document.getElementById('hidden_kelompok_sk').value = kelompok; 
            step2.classList.add('hidden');
            step3.classList.remove('hidden');

            subtitle.innerText = "Langkah 3: Lengkapi Formulir Meta Data SK";
            document.getElementById('breadJenis').innerText = stateJenis;
            document.getElementById('labelKelompokTerpilih').innerText = stateKelompok;
        }

        function kembaliKeLangkah2() {
            // Karena sedang mode Edit, agar form tetap aman, kembali diarahkan ke step2
            // yang sudah auto-generate dari jenis_sk yang sedang aktif
            pilihJenis(document.getElementById('hidden_jenis_sk').value);
            step3.classList.add('hidden');
            step2.classList.remove('hidden');
            subtitle.innerText = "Langkah 2: Pilih Template SK";
        }

        // FUNGSI AUTO FILL UNTUK PEGAWAI DI DALAM LOOP
        function autoFillPegawai(selectElement) {
            const val = selectElement.value;
            if(!val) return;
            const [nama, nip] = val.split('|');
            const container = selectElement.closest('.peserta-item');
            container.querySelector('.input-nama-pegawai').value = nama;
            container.querySelector('.input-nip-pegawai').value = nip;
        }

        function tambahPesertaLama(namaVal = '', nipVal = '', jabVal = '', hnrVal = '') {
            const wadah = document.getElementById('wadah-peserta');
            const totalPeserta = wadah.children.length + 1;

            const optionsPegawai = `<option value="">-- AUTO-FILL DARI MASTER PEGAWAI --</option>` + 
                dataPegawai.map(p => `<option value="${p.nama}|${p.nip || '-'}">${p.nama}</option>`).join('');

            const elemenBaru = document.createElement('div');
            elemenBaru.className = 'peserta-item bg-white p-4 rounded border border-gray-200 relative shadow-sm mt-4';
            
            elemenBaru.innerHTML = `
                <h4 class="text-[12px] font-bold text-orange-600 mb-3 border-b border-gray-100 pb-2 flex justify-between items-center">
                    <span class="nomor-peserta">Peserta #${totalPeserta}</span>
                    <button type="button" onclick="hapusPeserta(this)" class="text-red-500 hover:text-red-700 bg-red-50 px-2 py-1 rounded text-[11px] font-medium transition">
                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                    </button>
                </h4>
                
                <div class="bg-orange-100 p-2 rounded mb-3 flex gap-2 items-center border border-orange-200">
                    <i class="fa-solid fa-magic text-orange-500 ml-1"></i>
                    <select class="w-full bg-transparent text-[12px] font-bold text-orange-800 outline-none cursor-pointer" onchange="autoFillPegawai(this)">
                        ${optionsPegawai}
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Nama Pegawai</label>
                        <input type="text" name="peserta_nama[]" value="${namaVal}" class="input-nama-pegawai w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">NIP Pegawai</label>
                        <input type="text" name="peserta_nip[]" value="${nipVal}" class="input-nip-pegawai w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Jabatan</label>
                        <input type="text" list="jabatan_list" name="peserta_jab[]" value="${jabVal}" placeholder="Pilih atau Ketik Jabatan..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Honor Per Bulan</label>
                        <input type="text" name="peserta_hnr[]" value="${hnrVal}" placeholder="Contoh: 1.150.000" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                </div>
            `;
            wadah.appendChild(elemenBaru);
        }

        function hapusPeserta(tombol) {
            const elemenPeserta = tombol.closest('.peserta-item');
            elemenPeserta.remove();
            perbaruiNomorPeserta();
        }

        function perbaruiNomorPeserta() {
            const semuaPeserta = document.querySelectorAll('.peserta-item');
            semuaPeserta.forEach((elemen, index) => {
                elemen.querySelector('.nomor-peserta').innerText = `Peserta #${index + 1}`;
            });
        }

        // LOGIKA SAAT HALAMAN DIMUAT (Otomatis menampilkan data yang sudah ada)
        window.onload = () => {
            // Ambil dari request old (jika ada error form), kalau kosong, pakai data database $sk
            const oldJenis = "{{ old('jenis_sk', $sk->jenis_sk) }}";
            const oldKelompok = "{{ old('kelompok_sk', $sk->kelompok_sk) }}";
            
            // Mengambil input peserta yang gagal tervalidasi (jika ada error submit)
            const oldNamas = @json(old('peserta_nama'));
            const oldNips = @json(old('peserta_nip'));
            const oldJabs = @json(old('peserta_jab'));
            const oldHnrs = @json(old('peserta_hnr'));

            // Mengambil data relasi pegawai/peserta dari database untuk SK ini
            // (Menggunakan asumsi nama relasinya 'peserta_sks' atau sejenisnya, ini akan otomatis diproses JSON)
            const dbPeserta = @json($sk->peserta_sks ?? $sk->pesertas ?? $sk->peserta ?? []);

            // Langsung set view ke langkah 3 (Form Meta Data)
            if(oldJenis && oldKelompok) {
                document.getElementById('hidden_jenis_sk').value = oldJenis;
                document.getElementById('hidden_kelompok_sk').value = oldKelompok;
                document.getElementById('breadJenis').innerText = oldJenis;
                document.getElementById('labelKelompokTerpilih').innerText = oldKelompok;
                
                // Cek apakah ada data old dari form error
                if(oldNamas && oldNamas.length > 0) {
                    for(let i=0; i < oldNamas.length; i++) {
                        tambahPesertaLama(oldNamas[i], oldNips[i] || '', oldJabs[i] || '', oldHnrs[i] || '');
                    }
                } 
                // Jika tidak ada error, isi dengan data peserta yang sudah tersimpan di database
                else if (dbPeserta && dbPeserta.length > 0) {
                    dbPeserta.forEach(p => {
                        // Antisipasi jika penamaan field database berbeda (misal: p.nama atau p.nama_pegawai)
                        const namaP = p.nama || p.nama_pegawai || p.peserta_nama || '';
                        const nipP = p.nip || p.nip_pegawai || p.peserta_nip || '';
                        const jabP = p.jabatan || p.peserta_jabatan || p.peserta_jab || '';
                        const hnrP = p.honor || p.honor_per_bulan || p.peserta_hnr || p.honor_bulan || '';
                        
                        tambahPesertaLama(namaP, nipP, jabP, hnrP);
                    });
                } 
                // Jika benar-benar kosong
                else {
                    tambahPesertaLama();
                }
            } else {
                tambahPesertaLama();
            }
        };
    </script>
</body>
</html>