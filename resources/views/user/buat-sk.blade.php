<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan SK - BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #eef3f7; }
        .nav-icon { min-width: 24px; text-align: center; }
        
        .nav-active-main { position: relative; }
        .nav-active-main::before {
            content: ""; position: absolute; left: -16px; top: 50%;
            transform: translateY(-50%); width: 5px; height: 22px;
            background-color: #2491c9; border-radius: 0 4px 4px 0;
        }

        .hover-card { transition: all 0.2s ease; }
        .hover-card:hover { transform: translateY(-3px); border-color: #2491c9; box-shadow: 0 10px 15px -3px rgba(36, 145, 201, 0.1); }
        
        /* Custom scrollbar untuk form panjang */
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300">
        <div class="overflow-y-auto">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent transition-all duration-300 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">
                    BPS <br> Kota Sukabumi
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-1 px-4">
                <a href="{{ url('/user/dashboard') }}" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard User</span>
                </a>

                <a href="{{ url('/user/buat-sk') }}" class="nav-link nav-active-main flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2491c9] font-medium transition-all duration-300 hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-file-signature nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Buat SK</span>
                </a>
            </nav>
        </div>

        <div class="p-6 mb-2">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium transition-all duration-300 hover:text-red-500 overflow-hidden">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 custom-scroll">
        
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-white shadow-sm sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[38px] h-[35px] bg-[#2491c9] rounded flex flex-col items-center justify-center gap-[4px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
            </button>
            <div class="flex items-center gap-3">
                <span class="text-[14px] font-medium text-gray-600 hidden md:block">Halo, Nama Pegawai</span>
                <div class="w-10 h-10 rounded-full border border-[#2491c9] p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                    <img src="https://i.pravatar.cc/150?img=32" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-6 pb-10">
            
            <div class="mb-6">
                <h1 class="text-[24px] font-bold text-gray-900">Pengajuan SK Baru</h1>
                <p class="text-gray-500 text-[14px] mt-1" id="pageSubtitle">Langkah 1: Pilih Jenis Surat Keputusan</p>
            </div>

            <div id="step1-jenis" class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-[800px]">
                <div onclick="pilihJenis('SK Umum')" class="hover-card bg-white border-2 border-gray-200 rounded-lg p-8 cursor-pointer flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-5">
                        <i class="fa-solid fa-folder-open text-3xl text-[#2491c9]"></i>
                    </div>
                    <h3 class="text-[18px] font-bold text-gray-800 mb-2">SK Umum</h3>
                    <p class="text-[13px] text-gray-500">Pengajuan SK yang bersifat administratif umum, kepanitiaan internal, dan perjalanan dinas.</p>
                </div>

                <div onclick="pilihJenis('SK Teknis')" class="hover-card bg-white border-2 border-gray-200 rounded-lg p-8 cursor-pointer flex flex-col items-center text-center">
                    <div class="w-20 h-20 bg-orange-50 rounded-full flex items-center justify-center mb-5">
                        <i class="fa-solid fa-cogs text-3xl text-orange-500"></i>
                    </div>
                    <h3 class="text-[18px] font-bold text-gray-800 mb-2">SK Teknis</h3>
                    <p class="text-[13px] text-gray-500">Pengajuan SK yang berkaitan langsung dengan kegiatan teknis statistik, sensus, survei lapangan, dll.</p>
                </div>
            </div>

            <div id="step2-kelompok" class="hidden w-full max-w-[900px]">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[16px] font-bold text-gray-800 flex items-center gap-2">
                        <i id="iconJenis" class="fa-solid fa-folder text-[#2491c9]"></i>
                        Kategori: <span id="labelJenisTerpilih" class="text-[#2491c9]">SK Umum</span>
                    </h2>
                    <button onclick="kembaliKeLangkah1()" class="text-[13px] text-gray-500 hover:text-red-500 font-medium transition flex items-center gap-1.5 bg-white px-3 py-1.5 border border-gray-200 rounded shadow-sm">
                        <i class="fa-solid fa-arrow-left"></i> Ganti Jenis SK
                    </button>
                </div>
                <div id="wadahKelompokSK" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    </div>
            </div>

            <div id="step3-form" class="hidden">
                <div class="bg-white border border-gray-200 rounded-sm shadow-sm w-full max-w-[800px] p-8">
                    
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
                        <div>
                            <div class="text-[12px] font-bold text-gray-400 uppercase flex items-center gap-2">
                                <span id="breadJenis">SK Umum</span> <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </div>
                            <h2 id="labelKelompokTerpilih" class="text-[20px] font-bold text-[#2491c9] mt-1">SK Kepanitiaan</h2>
                        </div>
                        <button onclick="kembaliKeLangkah2()" class="text-[13px] text-gray-500 hover:text-red-500 font-medium transition flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-left"></i> Ganti Kelompok
                        </button>
                    </div>

                    <form id="formPengajuan" class="space-y-8" onsubmit="ajukanSK(event)">
                        
                        <div>
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-[#2491c9] pl-3 mb-4">Informasi Umum SK</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Judul SK / Nama Kegiatan <code class="text-blue-400 ml-1">&lt;&lt;judul&gt;&gt;</code></label>
                                    <input type="text" id="sk_judul" placeholder="Contoh: PENGELOLA ANGGARAN" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nomor SK <code class="text-blue-400 ml-1">&lt;&lt;no&gt;&gt;</code></label>
                                    <input type="text" id="sk_no" placeholder="Contoh: 001/KPA/0821" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tahun Anggaran <code class="text-blue-400 ml-1">&lt;&lt;thn&gt;&gt;</code></label>
                                    <input type="text" id="sk_thn" placeholder="Contoh: 2026" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tanggal Ditetapkan SK <code class="text-blue-400 ml-1">&lt;&lt;tgl_sk&gt;&gt;</code></label>
                                    <input type="date" id="sk_tgl" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-[#2491c9]" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-green-500 pl-3 mb-4">Dasar DIPA</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nomor DIPA <code class="text-blue-400 ml-1">&lt;&lt;no_dipa&gt;&gt;</code></label>
                                    <input type="text" id="dipa_no" placeholder="Masukkan Nomor DIPA..." class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-green-500" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Tanggal DIPA <code class="text-blue-400 ml-1">&lt;&lt;tgl_dipa&gt;&gt;</code></label>
                                    <input type="date" id="dipa_tgl" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-green-500" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-purple-500 pl-3 mb-4">Penandatangan (KPA)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">Nama KPA <code class="text-blue-400 ml-1">&lt;&lt;kpa&gt;&gt;</code></label>
                                    <input type="text" id="kpa_nama" placeholder="Masukkan Nama KPA..." class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-purple-500" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-[13px] font-medium mb-1.5">NIP KPA <code class="text-blue-400 ml-1">&lt;&lt;nip_kpa&gt;&gt;</code></label>
                                    <input type="text" id="kpa_nip" placeholder="Contoh: 197001012000031001" class="w-full border border-gray-300 rounded px-3 py-2 text-[14px] focus:outline-none focus:border-purple-500" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-50 p-5 rounded border border-orange-100">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-[14px] font-bold text-gray-800 border-l-4 border-orange-500 pl-3">Data Peserta / Pegawai (Lampiran)</h3>
                            </div>
                            
                            <div id="wadah-peserta" class="space-y-4">
                                <div class="peserta-item bg-white p-4 rounded border border-gray-200 relative shadow-sm">
                                    <h4 class="text-[12px] font-bold text-orange-600 mb-3 border-b border-gray-100 pb-2 flex justify-between">
                                        <span class="nomor-peserta">Peserta #1</span>
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Nama Pegawai <code class="text-blue-400 ml-1">&lt;&lt;nama01&gt;&gt;</code></label>
                                            <input type="text" name="peserta_nama[]" placeholder="Nama Lengkap..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-[12px] font-medium mb-1.5">NIP Pegawai <code class="text-blue-400 ml-1">&lt;&lt;nip_01&gt;&gt;</code></label>
                                            <input type="text" name="peserta_nip[]" placeholder="NIP Pegawai..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Jabatan <code class="text-blue-400 ml-1">&lt;&lt;jab&gt;&gt;</code></label>
                                            <input type="text" name="peserta_jab[]" placeholder="Jabatan dalam SK..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Honor Per Bulan <code class="text-blue-400 ml-1">&lt;&lt;hnr&gt;&gt;</code></label>
                                            <input type="text" name="peserta_hnr[]" placeholder="Contoh: 1.150.000" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" onclick="tambahPeserta()" class="mt-4 bg-white text-orange-600 border border-orange-200 hover:bg-orange-100 font-semibold px-4 py-2 rounded text-[12px] transition w-full shadow-sm flex justify-center items-center gap-2">
                                <i class="fa-solid fa-plus"></i> Tambah Data Peserta Lainnya
                            </button>

                        </div>

                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="window.location.href='{{ url('/user/dashboard') }}'" class="px-5 py-2.5 text-[14px] font-semibold text-gray-600 hover:text-gray-900 transition">
                                Batal
                            </button>
                            <button type="submit" class="bg-[#2491c9] text-white rounded px-6 py-2.5 text-[14px] font-bold hover:bg-[#1d7aa9] shadow transition tracking-wide">
                                Ajukan Pembuatan SK
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

    <script>
        // Toggle Sidebar
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const logoContainer = document.getElementById('logo-container');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const navLinks = document.querySelectorAll('.nav-link');

        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-[260px]');
            sidebar.classList.toggle('w-[80px]');
            textsToHide.forEach(text => text.classList.toggle('hidden'));
            logoContainer.classList.toggle('px-6');
            logoContainer.classList.toggle('justify-center');
            navLinks.forEach(link => {
                link.classList.toggle('justify-start'); link.classList.toggle('justify-center'); link.classList.toggle('px-3');
            });
        });

        // LOGIKA 3-STEP FORM
        const step1 = document.getElementById('step1-jenis');
        const step2 = document.getElementById('step2-kelompok');
        const step3 = document.getElementById('step3-form');
        const subtitle = document.getElementById('pageSubtitle');
        
        let stateJenis = '';
        let stateKelompok = '';

        const dataKelompokSK = {
            'SK Umum': [
                { nama: 'SK Kepanitiaan', icon: 'fa-users', desc: 'Acara, rapat, kepanitiaan kantor.' },
                { nama: 'SK Perjalanan Dinas', icon: 'fa-car', desc: 'Penugasan dalam/luar kota.' },
                { nama: 'SK Pengangkatan', icon: 'fa-user-tie', desc: 'Pengangkatan pegawai honorer.' }
            ],
            'SK Teknis': [
                { nama: 'SK Lapangan', icon: 'fa-map-location-dot', desc: 'Petugas sensus & survei.' },
                { nama: 'SK Tim Kerja (Pokja)', icon: 'fa-people-group', desc: 'Pembentukan kelompok kerja.' },
                { nama: 'SK Pengolahan Data', icon: 'fa-laptop-code', desc: 'Petugas entri & editing.' }
            ]
        };

        function pilihJenis(jenis) {
            stateJenis = jenis;
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            
            subtitle.innerText = "Langkah 2: Pilih Kelompok SK yang Spesifik";
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

            dataKelompokSK[jenis].forEach(kel => {
                wadahKelompok.innerHTML += `
                    <div onclick="pilihKelompok('${kel.nama}')" class="hover-card bg-white border border-gray-200 rounded flex p-4 cursor-pointer gap-4 items-center shadow-sm">
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
        }

        function kembaliKeLangkah1() {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            subtitle.innerText = "Langkah 1: Pilih Jenis Surat Keputusan";
        }

        function pilihKelompok(kelompok) {
            stateKelompok = kelompok;
            step2.classList.add('hidden');
            step3.classList.remove('hidden');

            subtitle.innerText = "Langkah 3: Lengkapi Formulir Meta Data SK";
            document.getElementById('breadJenis').innerText = stateJenis;
            document.getElementById('labelKelompokTerpilih').innerText = stateKelompok;
        }

        function kembaliKeLangkah2() {
            step3.classList.add('hidden');
            step2.classList.remove('hidden');
            subtitle.innerText = "Langkah 2: Pilih Kelompok SK yang Spesifik";
        }

        // ==========================================
        // LOGIKA DINAMIS TAMBAH/HAPUS PESERTA
        // ==========================================
        function tambahPeserta() {
            const wadah = document.getElementById('wadah-peserta');
            const totalPeserta = wadah.children.length + 1; // Hitung jumlah elemen anak

            // Buat Elemen Div Baru
            const elemenBaru = document.createElement('div');
            elemenBaru.className = 'peserta-item bg-white p-4 rounded border border-gray-200 relative shadow-sm mt-4';
            
            // Format angka untuk label <<nama02>>, <<nip_02>> dst.
            const fmtNum = totalPeserta < 10 ? '0' + totalPeserta : totalPeserta;

            elemenBaru.innerHTML = `
                <h4 class="text-[12px] font-bold text-orange-600 mb-3 border-b border-gray-100 pb-2 flex justify-between items-center">
                    <span class="nomor-peserta">Peserta #${totalPeserta}</span>
                    <button type="button" onclick="hapusPeserta(this)" class="text-red-500 hover:text-red-700 bg-red-50 px-2 py-1 rounded text-[11px] font-medium transition">
                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                    </button>
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Nama Pegawai <code class="text-blue-400 ml-1">&lt;&lt;nama${fmtNum}&gt;&gt;</code></label>
                        <input type="text" name="peserta_nama[]" placeholder="Nama Lengkap..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">NIP Pegawai <code class="text-blue-400 ml-1">&lt;&lt;nip_${fmtNum}&gt;&gt;</code></label>
                        <input type="text" name="peserta_nip[]" placeholder="NIP Pegawai..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Jabatan <code class="text-blue-400 ml-1">&lt;&lt;jab&gt;&gt;</code></label>
                        <input type="text" name="peserta_jab[]" placeholder="Jabatan dalam SK..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-[12px] font-medium mb-1.5">Honor Per Bulan <code class="text-blue-400 ml-1">&lt;&lt;hnr&gt;&gt;</code></label>
                        <input type="text" name="peserta_hnr[]" placeholder="Contoh: 1.150.000" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                    </div>
                </div>
            `;
            
            // Masukkan ke dalam wadah
            wadah.appendChild(elemenBaru);
        }

        function hapusPeserta(tombol) {
            // Hapus elemen bungkus terdekat (.peserta-item)
            const elemenPeserta = tombol.closest('.peserta-item');
            elemenPeserta.remove();
            
            // Perbarui penomoran urut agar tetap rapi setelah ada yang dihapus
            perbaruiNomorPeserta();
        }

        function perbaruiNomorPeserta() {
            const semuaPeserta = document.querySelectorAll('.peserta-item');
            semuaPeserta.forEach((elemen, index) => {
                const urutan = index + 1;
                const fmtNum = urutan < 10 ? '0' + urutan : urutan;
                
                // Update teks judul
                elemen.querySelector('.nomor-peserta').innerText = `Peserta #${urutan}`;
                
                // Update teks code label (opsional tapi bagus untuk visual template)
                const labelsCode = elemen.querySelectorAll('code');
                if(labelsCode.length >= 2) {
                    labelsCode[0].innerText = `<<nama${fmtNum}>>`;
                    labelsCode[1].innerText = `<<nip_${fmtNum}>>`;
                }
            });
        }

        function ajukanSK(event) {
            event.preventDefault(); // Mencegah reload halaman
            
            const judul = document.getElementById('sk_judul').value;
            const no = document.getElementById('sk_no').value;
            const jumlahPeserta = document.querySelectorAll('.peserta-item').length;
            
            alert(`Pengajuan berhasil!\n\nDokumen [${judul}] dengan nomor [${no}] beserta [${jumlahPeserta} Peserta] akan segera diproses oleh sistem.`);
            
            // Redirect kembali ke dashboard user
            window.location.href = "{{ url('/user/dashboard') }}";
        }
    </script>
</body>
</html>