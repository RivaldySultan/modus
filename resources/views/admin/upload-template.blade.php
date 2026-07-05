<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Template - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .sidebar-text { transition: all 0.2s ease; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'daftar-template'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
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
                <div class="w-10 h-10 rounded-full border border-gray-200 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->nama ?? 'A') }}&background=2a93c9&color=fff" class="rounded-full w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Upload Template</h1>
            
            <div class="flex justify-center w-full">
                <div class="bg-white border border-gray-200 shadow-sm p-8 rounded-sm w-[500px]">
                    
                    <form id="formUploadTemplate" action="{{ url('/upload-template') }}" method="POST" enctype="multipart/form-data">
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
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Nama Template</label>
                            <input type="text" name="nama_template" placeholder="Contoh: Template SK Kegiatan Sensus 2026" required
                                class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 focus:outline-none focus:ring-1 focus:ring-[#4a9bc8] text-[14px] text-gray-700 bg-white">
                        </div>
                        
                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Kelompok SK</label>
                            <div id="customSelectKelompok" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                <span id="selectTextKelompok" class="text-gray-700 text-[14px] opacity-70">Pilih Kelompok...</span> 
                                <i id="selectArrowKelompok" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                            </div>
                            <div id="dropdownOptionsKelompok" class="hidden absolute top-[75px] left-0 w-full bg-white border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30">
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40" data-value="SK Umum">SK Umum</div>
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50" data-value="SK Teknis">SK Teknis</div>
                            </div>
                            <input type="hidden" id="kelompokSkInput" required>
                        </div>
                        
                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Jenis SK</label>
                            <div class="relative">
                                <div id="customSelectJenis" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                    <span id="selectTextJenis" class="text-[#4a9bc8] text-[14px] opacity-70">Pilih Jenis...</span> 
                                    <i id="selectArrowJenis" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                                </div>
                                <div id="dropdownOptionsJenis" class="hidden absolute top-[45px] left-0 w-full bg-[#f8fafc] border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30"></div>
                                
                                <input type="hidden" name="jenis_sk_id" id="jenisSkIdInput" required>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Upload Dokumen</label>
                            <div class="w-full border border-[#4a9bc8] rounded h-[120px] bg-white cursor-pointer hover:bg-blue-50/30 transition relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center p-4 z-0 pointer-events-none">
                                    <span id="nama_file_tampil" class="text-[13px] text-[#4a9bc8] font-medium text-center truncate w-full hidden"></span>
                                    <div id="icon_file_tampil" class="text-center">
                                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-[#4a9bc8] mb-2"></i>
                                        <p class="text-[12px] text-[#4a9bc8]">Klik untuk memilih file</p>
                                    </div>
                                </div>
                                <input type="file" name="file_template" id="file_dokumen" accept=".docx" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>
                            <p class="text-[#4a9bc8] text-[11px] mt-1">*Maksimal 5MB, Format yang diterima hanya .docx (Microsoft Word)</p>
                        </div>
                        
                        <div class="flex justify-between mt-8 gap-4">
                            <a href="{{ url('/daftar-template') }}" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 text-center flex-1 flex items-center justify-center">KEMBALI</a>
                            <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 flex-1">UPLOAD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script>
        // 1. MENGAMBIL DATA LANGSUNG DARI DATABASE LARAVEL (Controller)
        const rawJenisSks = @json($jenisSks);
        
        // Buat object kosong, biarkan sistem yang mendeteksi nama kelompoknya otomatis
        const dataJenisSK = {};
        
        // Memasukkan data ke kelompoknya masing-masing berdasarkan database murni
        rawJenisSks.forEach(item => {
            const namaKelompok = item.kelompok_sk; // Bisa berisi "Umum", "Teknis", dll sesuai inputan DB
            if (!dataJenisSK[namaKelompok]) {
                dataJenisSK[namaKelompok] = [];
            }
            dataJenisSK[namaKelompok].push({ id: item.id, nama: item.nama_jenis_sk });
        });

        // Deklarasi Elemen HTML
        const customSelectKelompok = document.getElementById('customSelectKelompok');
        const dropdownOptionsKelompok = document.getElementById('dropdownOptionsKelompok');
        
        const customSelectJenis = document.getElementById('customSelectJenis');
        const selectTextJenis = document.getElementById('selectTextJenis');
        const dropdownOptionsJenis = document.getElementById('dropdownOptionsJenis');
        const hiddenInputJenisId = document.getElementById('jenisSkIdInput');

        // 2. RENDER KELOMPOK SK OTOMATIS DARI DATABASE
        dropdownOptionsKelompok.innerHTML = ''; // Bersihkan HTML bawaan
        Object.keys(dataJenisSK).forEach(kel => {
            const optionDiv = document.createElement('div');
            optionDiv.className = 'px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40 font-medium';
            optionDiv.textContent = kel; // Tampilkan sesuai data asli di Database
            
            optionDiv.onclick = (e) => { 
                e.stopPropagation(); // Mencegah dropdown tertutup ganda
                document.getElementById('selectTextKelompok').textContent = kel;
                document.getElementById('selectTextKelompok').classList.remove('opacity-70');
                document.getElementById('kelompokSkInput').value = kel;
                dropdownOptionsKelompok.classList.add('hidden');
                
                // Setelah kelompok dipilih, panggil fungsi render jenisnya
                renderJenisSK(kel); 
            };
            dropdownOptionsKelompok.appendChild(optionDiv);
        });

        // Jika tidak ada data sama sekali di Master Jenis SK
        if(Object.keys(dataJenisSK).length === 0) {
            dropdownOptionsKelompok.innerHTML = '<div class="px-4 py-2.5 text-red-500 text-[12px] italic">Belum ada kategori SK di Database.</div>';
        }

        // 3. FUNGSI RENDER JENIS SK
        function renderJenisSK(kelompok) {
            dropdownOptionsJenis.innerHTML = ''; 
            selectTextJenis.textContent = "Pilih Jenis...";
            selectTextJenis.classList.add('opacity-70');
            hiddenInputJenisId.value = '';

            if (dataJenisSK[kelompok] && dataJenisSK[kelompok].length > 0) {
                dataJenisSK[kelompok].forEach(jenis => {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = 'px-4 py-2.5 text-[#4a9bc8] text-[13px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40';
                    optionDiv.textContent = jenis.nama;
                    
                    optionDiv.onclick = (e) => { 
                        e.stopPropagation();
                        selectTextJenis.textContent = jenis.nama; 
                        selectTextJenis.classList.remove('opacity-70');
                        hiddenInputJenisId.value = jenis.id; // Mengirim ID spesifik ke backend
                        dropdownOptionsJenis.classList.add('hidden'); 
                    };
                    dropdownOptionsJenis.appendChild(optionDiv);
                });
            } else {
                dropdownOptionsJenis.innerHTML = '<div class="px-4 py-2.5 text-red-500 text-[12px] italic">Belum ada data untuk kategori ini.</div>';
            }
        }

        // 4. EVENT LISTENER BUKA/TUTUP DROPDOWN KUSTOM
        customSelectKelompok.onclick = (e) => { 
            e.stopPropagation(); 
            dropdownOptionsKelompok.classList.toggle('hidden'); 
            dropdownOptionsJenis.classList.add('hidden'); 
        };

        customSelectJenis.onclick = (e) => { 
            e.stopPropagation(); 
            if(document.getElementById('kelompokSkInput').value !== "") {
                dropdownOptionsJenis.classList.toggle('hidden'); 
                dropdownOptionsKelompok.classList.add('hidden'); 
            } else {
                alert("Silakan pilih Kelompok SK terlebih dahulu!");
            }
        };
        
        // Menutup dropdown ketika mengklik area layar luar
        document.addEventListener('click', () => {
            dropdownOptionsKelompok.classList.add('hidden');
            dropdownOptionsJenis.classList.add('hidden');
        });

        // 5. TAMPILAN NAMA FILE SAAT DI UPLOAD
        document.getElementById('file_dokumen').onchange = function() {
            if(this.files && this.files[0]) {
                document.getElementById('nama_file_tampil').textContent = this.files[0].name;
                document.getElementById('nama_file_tampil').classList.remove('hidden');
                document.getElementById('icon_file_tampil').classList.add('hidden');
            }
        };
    </script>
</body>
</html>