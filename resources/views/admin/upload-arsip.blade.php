<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Arsip SK - BPS Kota Sukabumi</title>
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
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20">
        <div class="overflow-y-auto">
            <div class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px]">
                <div class="text-[13px] font-bold leading-tight uppercase tracking-tight text-black">
                    BPS <br> Kota Sukabumi
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-1 px-4">
                <a href="{{ url('/dashboard') }}" class="flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2491c9] hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-house nav-icon text-lg"></i> <span class="text-[14px]">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2491c9] hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-print nav-icon text-lg"></i> <span class="text-[14px]">Daftar Template SK</span>
                </a>
                <a href="#" class="flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2491c9] hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-database nav-icon text-lg"></i> <span class="text-[14px]">Data Master</span>
                </a>
                <a href="{{ url('/arsip') }}" class="nav-active-main flex items-center gap-4 px-3 py-2.5 rounded-md text-[#2491c9] font-medium hover:bg-gray-50 transition-colors">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i> <span class="text-[14px]">Arsip / Monitoring SK</span>
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0">
            <button class="w-[38px] h-[35px] bg-[#2491c9] rounded flex flex-col items-center justify-center gap-[4px] hover:bg-[#1d7aa9] transition">
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-[#2491c9] p-[2px]">
                <img src="https://i.pravatar.cc/150?img=11" alt="Profile" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-4 pb-10">
            <h1 class="text-[24px] font-bold text-gray-900 mb-6">Upload Arsip SK</h1>

            <div class="bg-white border border-gray-200 rounded-sm shadow-sm w-full max-w-[550px] p-8">
                <div class="space-y-5">
                    
                    <div>
                        <label class="block text-[#2491c9] text-[14px] mb-1.5">Nomor SK</label>
                        <input type="text" id="inpNomor" placeholder="Contoh: 001/002" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 focus:outline-none focus:border-[#2491c9] transition">
                    </div>

                    <div>
                        <label class="block text-[#2491c9] text-[14px] mb-1.5">Jenis SK</label>
                        <select id="inpJenis" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 bg-white focus:outline-none focus:border-[#2491c9] transition appearance-none">
                            <option value="">Pilih Jenis SK...</option>
                            <option value="SK Lapangan">SK Lapangan</option>
                            <option value="SK Kepanitiaan">SK Kepanitiaan</option>
                            <option value="SK Pengangkatan">SK Pengangkatan</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[#2491c9] text-[14px] mb-1.5">Tanggal</label>
                            <input type="number" id="inpTanggal" min="1" max="31" placeholder="1-31" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 focus:outline-none focus:border-[#2491c9] transition">
                        </div>
                        <div>
                            <label class="block text-[#2491c9] text-[14px] mb-1.5">Bulan</label>
                            <select id="inpBulan" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 bg-white focus:outline-none focus:border-[#2491c9] transition appearance-none">
                                <option value="">Pilih Bulan</option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[#2491c9] text-[14px] mb-1.5">Tahun</label>
                            <input type="number" id="inpTahun" placeholder="2026" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 focus:outline-none focus:border-[#2491c9] transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[#2491c9] text-[14px] mb-1.5">Pembuat</label>
                        <input type="text" id="inpPembuat" placeholder="Nama Pembuat" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-2 text-[14px] text-gray-700 focus:outline-none focus:border-[#2491c9] transition">
                    </div>

                    <div>
                        <label class="block text-[#2491c9] text-[14px] mb-1.5">File SK (PDF/Word)</label>
                        <input type="file" id="inpFile" class="w-full border border-[#90cce5] rounded-[4px] px-3 py-1.5 text-[14px] text-gray-700 bg-gray-50 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-[13px] file:font-medium file:bg-[#2491c9] file:text-white hover:file:bg-[#1d7aa9] transition cursor-pointer">
                    </div>

                </div>

                <div class="flex items-center justify-between mt-10">
                    <button type="button" onclick="window.location.href='{{ url('/arsip') }}'" class="w-[45%] border border-[#2491c9] text-[#2491c9] bg-white rounded-[4px] py-2 text-[14px] font-semibold tracking-wide hover:bg-blue-50 transition">
                        KEMBALI
                    </button>
                    
                    <button type="button" onclick="simpanDataDanKembali()" class="w-[45%] bg-[#2491c9] text-white rounded-[4px] py-2 text-[14px] font-semibold tracking-wide hover:bg-[#1d7aa9] transition">
                        SIMPAN
                    </button>
                </div>

            </div>
        </div>
    </main>

    <script>
        function simpanDataDanKembali() {
            // Mengambil nilai dari form
            const nomor = document.getElementById('inpNomor').value;
            const jenis = document.getElementById('inpJenis').value;
            const tanggal = document.getElementById('inpTanggal').value;
            const bulan = document.getElementById('inpBulan').value;
            const tahun = document.getElementById('inpTahun').value;
            const pembuat = document.getElementById('inpPembuat').value;

            // Validasi sederhana
            if(!nomor || !jenis || !tanggal || !bulan || !tahun) {
                alert("Mohon lengkapi Nomor, Jenis, Tanggal, Bulan, dan Tahun SK!");
                return;
            }

            // Menyusun data yang akan disimpan
            const dataBaru = {
                nomor: nomor,
                jenis: jenis,
                tanggalLengkap: `${tanggal} ${bulan}`,
                tahun: tahun,
                pembuat: pembuat
            };

            // Mengambil data lama dari LocalStorage, atau membuat array kosong jika belum ada
            let databaseSementara = JSON.parse(localStorage.getItem('databaseArsipSK')) || [];
            
            // Memasukkan data baru ke database sementara
            databaseSementara.push(dataBaru);
            
            // Menyimpan kembali ke LocalStorage
            localStorage.setItem('databaseArsipSK', JSON.stringify(databaseSementara));

            // Pindah ke halaman Arsip
            window.location.href = "{{ url('/arsip') }}"; 
        }
    </script>
</body>
</html>