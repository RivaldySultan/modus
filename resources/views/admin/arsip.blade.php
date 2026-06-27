<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip/Monitoring SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .fade-in { animation: fadeIn 0.2s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'arsip'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 fade-in">
            
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Arsip/Monitoring SK</h1>
                    <button onclick="resetData()" class="hidden border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1 rounded text-[12px] font-semibold transition" id="btnReset">Reset Tabel</button>
                </div>
                
                <button type="button" onclick="toggleFilter()" class="inline-flex items-center gap-2 px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    <i class="fa-solid fa-filter"></i> FILTER
                </button>
            </div>

            <div class="bg-white rounded border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-4 font-medium text-[13px] w-12 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Nomor SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Jenis SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Kelompok SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Tanggal</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Tahun</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Pembuat</th>
                            <th class="py-3 px-4 font-medium text-[13px] w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="filterModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-[#f8fafd] rounded-t-lg">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-filter text-[#2a93c9]"></i> Filter Data Arsip
                </h3>
                <button onclick="toggleFilter()" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            
            <div class="p-6 space-y-5">
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Nomor SK</label>
                    <input type="text" id="filterNomor" placeholder="Cari nomor SK..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-[#2a93c9] focus:ring-1 focus:ring-[#2a93c9]">
                </div>
                
                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Tanggal Pembuat</label>
                    <input type="date" id="filterTanggal" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-[#2a93c9] focus:ring-1 focus:ring-[#2a93c9] text-gray-700">
                </div>
                
                <div class="relative" id="dropdownContainer">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Jenis / Kelompok SK</label>
                    
                    <div id="customSelectTrigger" onclick="toggleCustomSelect()" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] bg-white flex justify-between items-center cursor-pointer hover:border-[#2a93c9] transition-colors h-[38px]">
                        <span id="customSelectLabel" class="text-gray-700 truncate">Semua Jenis / Kelompok</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400"></i>
                    </div>

                    <input type="hidden" id="filterJenis" value="">
                    
                    <div id="customSelectMenu" class="hidden absolute z-[100] top-full left-0 mt-1 w-full bg-white border border-gray-200 rounded shadow-lg text-[13px] text-gray-700">
                        <div class="py-1">
                            <div class="px-4 py-2.5 hover:bg-blue-50 cursor-pointer border-b border-gray-100 font-medium" onclick="pilihOpsiFilter('', 'Semua Jenis / Kelompok')">
                                Semua Jenis / Kelompok
                            </div>
                            
                            <div class="relative group">
                                <div class="px-4 py-2.5 hover:bg-blue-50 cursor-pointer flex justify-between items-center" onclick="pilihOpsiFilter('SK Umum', 'SK Umum (Semua)')">
                                    <span class="font-semibold text-gray-800">SK Umum</span>
                                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                                </div>
                                <div class="hidden group-hover:block absolute left-full top-0 w-[220px] ml-1 bg-white border border-gray-200 rounded shadow-lg py-1 z-[101]">
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Kepanitiaan', 'SK Umum - Kepanitiaan')">SK Kepanitiaan</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Perjalanan Dinas', 'SK Umum - Perjalanan Dinas')">SK Perjalanan Dinas</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Pengangkatan', 'SK Umum - Pengangkatan')">SK Pengangkatan</div>
                                </div>
                            </div>

                            <div class="relative group">
                                <div class="px-4 py-2.5 hover:bg-blue-50 cursor-pointer flex justify-between items-center" onclick="pilihOpsiFilter('SK Teknis', 'SK Teknis (Semua)')">
                                    <span class="font-semibold text-gray-800">SK Teknis</span>
                                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                                </div>
                                <div class="hidden group-hover:block absolute left-full top-0 w-[220px] ml-1 bg-white border border-gray-200 rounded shadow-lg py-1 z-[101]">
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Lapangan', 'SK Teknis - Lapangan')">SK Lapangan</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Tim Kerja', 'SK Teknis - Tim Kerja')">SK Tim Kerja</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('SK Pengolahan Data', 'SK Teknis - Pengolahan Data')">SK Pengolahan Data</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Tahun</label>
                    <input type="number" id="filterTahun" placeholder="Contoh: 2026" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-[#2a93c9] focus:ring-1 focus:ring-[#2a93c9]">
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 border-t border-gray-100 rounded-b-lg">
                <button onclick="resetFilter()" class="px-4 py-2 text-[13px] font-semibold text-gray-600 hover:text-red-500 transition">Reset</button>
                <button onclick="terapkanFilter()" class="px-5 py-2 bg-[#2a93c9] text-white rounded text-[13px] font-bold hover:bg-[#1d7aa9] shadow-sm transition">Terapkan Filter</button>
            </div>
        </div>
    </div>

    <script>
        // --- LOGIKA DATA & RENDERING TABEL ---
        const tableBody = document.getElementById('tableBody');
        const btnReset = document.getElementById('btnReset');
        const modal = document.getElementById('filterModal');

        function loadData(filteredData = null) {
            const dataAsli = JSON.parse(localStorage.getItem('databaseArsipSK')) || [];
            const dataToRender = filteredData ? filteredData : dataAsli;

            if (dataToRender.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="8" class="py-10 text-center text-gray-400 italic">Data tidak ditemukan / Belum ada data arsip.</td></tr>`;
                if(!filteredData && btnReset) btnReset.classList.add('hidden');
            } else {
                if(!filteredData && btnReset) btnReset.classList.remove('hidden');
                let isiTabel = '';
                
                dataToRender.forEach((item, index) => {
                    isiTabel += `
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]">
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100 text-center">${index + 1}</td>
                            <td class="py-4 px-4 text-gray-700 font-medium border-r border-gray-100 text-left">${item.nomor || '-'}</td>
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${item.jenis || '-'}</td>
                            <td class="py-4 px-4 text-gray-700 border-r border-gray-100">${item.kelompok || '-'}</td>
                            <td class="py-4 px-4 text-gray-600 border-r border-gray-100">${item.tanggalLengkap || '-'}</td>
                            <td class="py-4 px-4 text-gray-600 border-r border-gray-100">${item.tahun || '-'}</td>
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${item.pembuat || '-'}</td>
                            <td class="py-4 px-4">
                                <div class="flex justify-center gap-3 text-lg">
                                    <i class="fa-solid fa-eye text-[#2a93c9] hover:opacity-70 cursor-pointer transition" title="Lihat Dokumen"></i>
                                    <i class="fa-solid fa-download text-[#2a93c9] hover:opacity-70 cursor-pointer transition" title="Unduh PDF"></i>
                                </div>
                            </td>
                        </tr>
                    `;
                });
                tableBody.innerHTML = isiTabel;
            }
        }

        // --- LOGIKA FILTER MODAL ---
        function toggleFilter() {
            modal.classList.toggle('hidden');
        }

        function terapkanFilter() {
            const dataAsli = JSON.parse(localStorage.getItem('databaseArsipSK')) || [];
            
            const inputNomor = document.getElementById('filterNomor').value.toLowerCase();
            const inputTanggal = document.getElementById('filterTanggal').value;
            const inputJenis = document.getElementById('filterJenis').value;
            const inputTahun = document.getElementById('filterTahun').value;

            const hasilFilter = dataAsli.filter(item => {
                const noAman = item.nomor ? item.nomor.toLowerCase() : "";
                const jenisAman = item.jenis || "";
                const kelompokAman = item.kelompok || "";
                const tanggalAman = item.tanggal || ""; 
                const tahunAman = item.tahun ? item.tahun.toString() : "";

                const matchNomor = noAman.includes(inputNomor);
                const matchTanggal = inputTanggal === "" || tanggalAman === inputTanggal;
                
                // Mampu memfilter berdasarkan Kelompok Utama (SK Umum/SK Teknis) ATAU Sub Jenis (Kepanitiaan, Lapangan, dll)
                const matchJenis = inputJenis === "" || jenisAman === inputJenis || kelompokAman === inputJenis;
                const matchTahun = inputTahun === "" || tahunAman === inputTahun;
                
                return matchNomor && matchTanggal && matchJenis && matchTahun;
            });

            loadData(hasilFilter); 
            toggleFilter(); 
        }

        function resetFilter() {
            document.getElementById('filterNomor').value = "";
            document.getElementById('filterTanggal').value = "";
            document.getElementById('filterJenis').value = "";
            document.getElementById('customSelectLabel').innerText = "Semua Jenis / Kelompok"; // Reset custom label
            document.getElementById('filterTahun').value = "";
            loadData(); 
            toggleFilter(); 
        }

        function resetData() {
            if(confirm('Yakin ingin menghapus semua data arsip tiruan ini?')) {
                localStorage.removeItem('databaseArsipSK');
                loadData();
            }
        }

        // --- LOGIKA CUSTOM DROPDOWN (CASCADING) ---
        function toggleCustomSelect() {
            document.getElementById('customSelectMenu').classList.toggle('hidden');
        }

        function pilihOpsiFilter(nilai, labelTampil) {
            document.getElementById('filterJenis').value = nilai;
            document.getElementById('customSelectLabel').innerText = labelTampil;
            document.getElementById('customSelectMenu').classList.add('hidden');
        }

        // Menutup custom dropdown jika mengklik area lain di layar
        document.addEventListener('click', function(event) {
            const container = document.getElementById('dropdownContainer');
            const menu = document.getElementById('customSelectMenu');
            if (container && !container.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Muat tabel saat halaman pertama kali dibuka
        document.addEventListener("DOMContentLoaded", () => loadData());
    </script>
</body>
</html>