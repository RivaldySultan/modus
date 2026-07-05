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
        
        /* Pengaturan Live Preview Word */
        .docx-wrapper { background-color: transparent !important; padding: 0 !important; }
        .docx { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
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
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()?->nama ?? 'Admin') }}&background=2a93c9&color=fff" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 fade-in">
            
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Monitoring & Validasi SK</h1>
                </div>
                
                <button type="button" onclick="toggleFilter()" class="inline-flex items-center gap-2 px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    <i class="fa-solid fa-filter"></i> FILTER
                </button>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-[13px]">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-4 font-medium text-[13px] w-12 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Nomor SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Jenis / Kelompok</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Pembuat</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Status</th>
                            <th class="py-3 px-4 font-medium text-[13px] w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($arsip as $index => $item)
                        <tr class="arsip-row border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]"
                            data-nomor="{{ $item->nomor_sk }}" 
                            data-jenis="{{ $item->jenis_sk }}" 
                            data-kelompok="{{ $item->kelompok_sk }}" 
                            data-tanggal="{{ $item->tanggal_ditetapkan }}" 
                            data-tahun="{{ $item->tahun_anggaran }}">
                            
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100 text-center">{{ $index + 1 }}</td>
                            <td class="py-4 px-4 text-gray-700 font-bold border-r border-gray-100 text-left">{{ $item->nomor_sk }}</td>
                            <td class="py-4 px-4 border-r border-gray-100 text-left">
                                <div class="text-[#2a93c9] font-bold">{{ $item->jenis_sk }}</div>
                                <div class="text-gray-500 text-[11px]">{{ $item->kelompok_sk }}</div>
                            </td>
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100 font-medium">{{ $item->user->nama ?? 'Tidak Diketahui' }}</td>
                            
                            <td class="py-4 px-4 border-r border-gray-100">
                                @if($item->status_pengajuan == 'Selesai')
                                    <span class="bg-green-100 text-green-700 py-1 px-3 rounded text-[11px] font-bold">SELESAI</span>
                                @elseif($item->status_pengajuan == 'Revisi')
                                    <span class="bg-orange-100 text-orange-700 py-1 px-3 rounded text-[11px] font-bold">REVISI</span>
                                @elseif($item->status_pengajuan == 'Ditolak')
                                    <span class="bg-red-100 text-red-700 py-1 px-3 rounded text-[11px] font-bold">DITOLAK</span>
                                @else
                                    <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded text-[11px] font-bold">DIPROSES</span>
                                @endif

                                @if($item->catatan)
                                    <div class="mt-2 text-[10px] text-gray-500 bg-white p-1 border rounded line-clamp-2" title="{{ $item->catatan }}">
                                        "{{ $item->catatan }}"
                                    </div>
                                @endif
                            </td>
                            
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap justify-center gap-1.5 items-center">
                                    
                                    @if($item->file_sk)
                                        <button type="button" onclick="openPreview('/storage/{{ $item->file_sk }}', '{{ $item->nomor_sk }}')" class="bg-white border border-[#2a93c9] text-[#2a93c9] px-2.5 py-1.5 rounded hover:bg-blue-50 transition shadow-sm" title="Lihat Dokumen">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        
                                        <a href="{{ asset('storage/' . $item->file_sk) }}" target="_blank" class="bg-white border border-[#2a93c9] text-[#2a93c9] px-2.5 py-1.5 rounded hover:bg-blue-50 transition shadow-sm" title="Unduh File Word">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    @endif

                                    <form action="{{ url('/arsip/update-status/' . $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Setujui dan sahkan SK ini?')">
                                        @csrf
                                        <input type="hidden" name="status_pengajuan" value="Selesai">
                                        <button type="submit" class="bg-green-500 text-white px-2.5 py-1.5 rounded hover:bg-green-600 transition shadow-sm" title="Setujui (Selesai)">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>

                                    <button type="button" onclick="bukaModalTanggapan('{{ $item->id }}', '{{ $item->nomor_sk }}')" class="bg-orange-500 text-white px-2.5 py-1.5 rounded hover:bg-orange-600 transition shadow-sm" title="Beri Tanggapan / Minta Revisi">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </button>
                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400 italic">Belum ada data pengajuan SK / Arsip.</td>
                        </tr>
                        @endforelse
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
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Tanggal Ditetapkan</label>
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
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('Kepanitiaan', 'SK Umum - Kepanitiaan')">SK Kepanitiaan</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('Perjalanan', 'SK Umum - Perjalanan Dinas')">SK Perjalanan Dinas</div>
                                </div>
                            </div>

                            <div class="relative group">
                                <div class="px-4 py-2.5 hover:bg-blue-50 cursor-pointer flex justify-between items-center" onclick="pilihOpsiFilter('SK Teknis', 'SK Teknis (Semua)')">
                                    <span class="font-semibold text-gray-800">SK Teknis</span>
                                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                                </div>
                                <div class="hidden group-hover:block absolute left-full top-0 w-[220px] ml-1 bg-white border border-gray-200 rounded shadow-lg py-1 z-[101]">
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('Lapangan', 'SK Teknis - Lapangan')">SK Lapangan</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('Tim', 'SK Teknis - Tim Kerja')">SK Tim Kerja</div>
                                    <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer" onclick="pilihOpsiFilter('Pengolahan', 'SK Teknis - Pengolahan Data')">SK Pengolahan Data</div>
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

    <div id="previewModal" class="hidden fixed inset-0 bg-black/50 z-[60] flex items-center justify-center p-4">
        <div class="bg-white rounded shadow-xl w-full max-w-4xl h-[85vh] flex flex-col overflow-hidden">
            <div class="px-6 py-4 bg-[#2a93c9] text-white flex justify-between items-center flex-shrink-0">
                <h3 id="modalTitle" class="font-bold text-[14px] uppercase tracking-wide">Pratinjau Dokumen</h3>
                <button onclick="closePreview()" class="text-white hover:text-gray-200 text-2xl font-semibold">&times;</button>
            </div>
            <div class="flex-1 overflow-y-auto bg-gray-100 p-6 flex justify-center items-start relative">
                <div id="loadingTemplate" class="hidden absolute inset-0 bg-white/80 z-10 flex flex-col items-center justify-center gap-2">
                    <i class="fa-solid fa-spinner fa-spin text-3xl text-[#2a93c9]"></i>
                    <p class="text-[13px] text-gray-500 font-medium">Membaca isi dokumen...</p>
                </div>
                <div id="documentContainer" class="w-full max-w-[800px]"></div>
            </div>
        </div>
    </div>

    <div id="tanggapanModal" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-[70] flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-[#f8fafd] rounded-t-lg">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-comment-dots text-orange-500"></i> Beri Tanggapan
                </h3>
                <button onclick="tutupModalTanggapan()" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            
            <form id="formTanggapan" action="" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <p class="text-[12px] text-gray-500">SK: <span id="labelSkTanggapan" class="font-bold text-[#2a93c9]"></span></p>
                    
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-2">Tindakan</label>
                        <select name="status_pengajuan" class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required>
                            <option value="Revisi">Minta Revisi (Kembalikan ke Pegawai)</option>
                            <option value="Ditolak">Tolak Pengajuan (SK Tidak Sah)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-2">Catatan Kesalahan / Alasan</label>
                        <textarea name="catatan" rows="4" placeholder="Contoh: Tolong perbaiki NIP KPA, ada typo di bagian akhir..." class="w-full border border-gray-300 rounded px-3 py-2 text-[13px] focus:outline-none focus:border-orange-500" required></textarea>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 border-t border-gray-100 rounded-b-lg">
                    <button type="button" onclick="tutupModalTanggapan()" class="px-4 py-2 text-[13px] font-semibold text-gray-600 hover:text-gray-900 border rounded">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white rounded text-[13px] font-bold hover:bg-orange-600 shadow-sm transition">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="https://unpkg.com/docx-preview/dist/docx-preview.js"></script>

    <script>
        // --- LOGIKA FILTER MODAL DOM JS ---
        const modal = document.getElementById('filterModal');

        function toggleFilter() {
            modal.classList.toggle('hidden');
        }

        function terapkanFilter() {
            const inputNomor = document.getElementById('filterNomor').value.toLowerCase();
            const inputTanggal = document.getElementById('filterTanggal').value;
            const inputJenis = document.getElementById('filterJenis').value.toLowerCase();
            const inputTahun = document.getElementById('filterTahun').value;

            const rows = document.querySelectorAll('.arsip-row');

            rows.forEach(row => {
                const no = row.getAttribute('data-nomor').toLowerCase();
                const tgl = row.getAttribute('data-tanggal');
                const jenis = row.getAttribute('data-jenis').toLowerCase();
                const kelompok = row.getAttribute('data-kelompok').toLowerCase();
                const tahun = row.getAttribute('data-tahun');

                const matchNomor = no.includes(inputNomor);
                const matchTanggal = inputTanggal === "" || tgl === inputTanggal;
                const matchJenis = inputJenis === "" || jenis.includes(inputJenis) || kelompok.includes(inputJenis);
                const matchTahun = inputTahun === "" || tahun === inputTahun;

                if (matchNomor && matchTanggal && matchJenis && matchTahun) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            toggleFilter(); 
        }

        function resetFilter() {
            document.getElementById('filterNomor').value = "";
            document.getElementById('filterTanggal').value = "";
            document.getElementById('filterJenis').value = "";
            document.getElementById('customSelectLabel').innerText = "Semua Jenis / Kelompok"; 
            document.getElementById('filterTahun').value = "";
            
            document.querySelectorAll('.arsip-row').forEach(row => {
                row.style.display = '';
            });

            toggleFilter(); 
        }

        function toggleCustomSelect() {
            document.getElementById('customSelectMenu').classList.toggle('hidden');
        }

        function pilihOpsiFilter(nilai, labelTampil) {
            document.getElementById('filterJenis').value = nilai;
            document.getElementById('customSelectLabel').innerText = labelTampil;
            document.getElementById('customSelectMenu').classList.add('hidden');
        }

        document.addEventListener('click', function(event) {
            const container = document.getElementById('dropdownContainer');
            const menu = document.getElementById('customSelectMenu');
            if (container && !container.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // --- LOGIKA PRATINJAU DOKUMEN ---
        function openPreview(fileUrl, docTitle) {
            const previewModal = document.getElementById('previewModal');
            const container = document.getElementById('documentContainer');
            const loading = document.getElementById('loadingTemplate');
            
            document.getElementById('modalTitle').textContent = "Preview SK: " + docTitle;
            
            previewModal.classList.remove('hidden');
            loading.classList.remove('hidden');
            container.innerHTML = ""; 

            fetch(fileUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil file.');
                    return response.blob();
                })
                .then(blob => {
                    loading.classList.add('hidden');
                    docx.renderAsync(blob, container)
                        .catch(err => {
                            container.innerHTML = `<div class="p-6 text-center text-red-500 font-medium bg-white border">Format file tidak didukung oleh browser.</div>`;
                        });
                })
                .catch(error => {
                    loading.classList.add('hidden');
                    container.innerHTML = `<div class="p-6 text-center text-red-500 font-medium bg-white border">Gagal memuat dokumen. Pastikan Anda sudah menjalankan 'php artisan storage:link'</div>`;
                });
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('documentContainer').innerHTML = "";
        }

        // --- LOGIKA MODAL TANGGAPAN ---
        function bukaModalTanggapan(idPengajuan, nomorSk) {
            const tanggapanModal = document.getElementById('tanggapanModal');
            const form = document.getElementById('formTanggapan');
            
            form.action = `/arsip/update-status/${idPengajuan}`;
            document.getElementById('labelSkTanggapan').textContent = nomorSk;
            
            tanggapanModal.classList.remove('hidden');
        }

        function tutupModalTanggapan() {
            document.getElementById('tanggapanModal').classList.add('hidden');
            document.getElementById('formTanggapan').reset();
        }
    </script>
</body>
</html>