<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #eef3f7; }
        .card-title-container { position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 20px; }
        .card-title-container::after { content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 1.5px; background-color: #2491c9; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        
        /* Pengaturan Live Preview Word */
        .docx-wrapper { background-color: transparent !important; padding: 0 !important; }
        .docx { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar-user', ['active' => 'dashboard'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
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

        <div class="px-8 pt-2 pb-10">
            <div class="mb-8">
                <h1 class="text-[26px] font-bold text-black">Selamat Datang!</h1>
                <p class="text-gray-500 text-[14px] mt-1">Pantau status Surat Keputusan (SK) yang telah Anda ajukan di sini.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-[13px]">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container"><h2 class="text-[#2491c9] font-bold text-[15px] uppercase tracking-wide px-2">TOTAL PENGAJUAN SK</h2></div>
                    <span class="text-[55px] font-[900] text-[#2491c9] leading-none mt-2">{{ $totalPengajuan ?? 0 }}</span>
                </div>
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container"><h2 class="text-[#f59e0b] font-bold text-[15px] uppercase tracking-wide px-2">SK SEDANG DIPROSES</h2></div>
                    <span class="text-[55px] font-[900] text-[#f59e0b] leading-none mt-2">{{ $sedangDiproses ?? 0 }}</span>
                </div>
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container"><h2 class="text-[#10b981] font-bold text-[15px] uppercase tracking-wide px-2">SK SELESAI / ARSIP</h2></div>
                    <span class="text-[55px] font-[900] text-[#10b981] leading-none mt-2">{{ $selesai ?? 0 }}</span>
                </div>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm mt-8 overflow-hidden w-full">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-[#fbfdfd]">
                    <h3 class="text-[#2491c9] text-[15px] font-bold">Riwayat Pengajuan SK Anda</h3>
                    <a href="{{ url('/user/buat-sk') }}" class="bg-[#2491c9] hover:bg-[#1d7aa9] text-white px-4 py-2 rounded text-[13px] font-semibold transition">
                        <i class="fa-solid fa-plus mr-1"></i> Buat SK Baru
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-[#2491c9] text-white text-[13px] tracking-wide">
                                <th class="py-3 px-6 font-medium text-center w-16">No</th>
                                <th class="py-3 px-6 font-medium">Jenis SK / Judul</th>
                                <th class="py-3 px-6 font-medium">Tanggal Pengajuan</th>
                                <th class="py-3 px-6 font-medium text-center">Status & Tanggapan</th>
                                <th class="py-3 px-6 font-medium text-center">Aksi / Dokumen</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-[14px]">
                            @forelse($riwayatPengajuan ?? [] as $index => $riwayat)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="py-4 px-6 text-center text-[#2491c9] font-semibold">{{ $index + 1 }}</td>
                                    
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-[#2491c9]">{{ $riwayat->kelompok_sk }}</div>
                                        <div class="text-[12px] text-gray-500 font-semibold">{{ $riwayat->nomor_sk }}</div>
                                        <div class="text-[12px] text-gray-500 italic mt-0.5">{{ $riwayat->judul_sk }}</div>
                                    </td>
                                    
                                    <td class="py-4 px-6">{{ \Carbon\Carbon::parse($riwayat->created_at)->translatedFormat('d F Y') }}</td>
                                    
                                    <!-- Kolom Status & Tanggapan -->
                                    <td class="py-4 px-6 text-center">
                                        @if($riwayat->status_pengajuan == 'Selesai')
                                            <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-[11px] font-bold inline-block mb-1">SELESAI DIPERIKSA</span>
                                        @elseif($riwayat->status_pengajuan == 'Revisi')
                                            <span class="bg-orange-100 text-orange-700 py-1 px-3 rounded-full text-[11px] font-bold inline-block mb-1">BUTUH REVISI</span>
                                        @elseif($riwayat->status_pengajuan == 'Ditolak')
                                            <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-[11px] font-bold inline-block mb-1">DITOLAK</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-700 py-1 px-3 rounded-full text-[11px] font-bold inline-block mb-1">MENUNGGU PENGECEKAN</span>
                                        @endif
                                        
                                        <!-- Menampilkan Catatan/Alasan Admin -->
                                        @if($riwayat->catatan)
                                            <div class="mt-2 text-[11px] text-left bg-blue-50 p-2 border border-blue-100 rounded text-gray-700 shadow-sm">
                                                <div class="font-bold text-[#2491c9] mb-1"><i class="fa-solid fa-comment-dots"></i> Alasan/Catatan Admin:</div>
                                                <span class="italic">"{{ $riwayat->catatan }}"</span>
                                            </div>
                                        @elseif($riwayat->status_pengajuan == 'pending' || $riwayat->status_pengajuan == 'Diproses')
                                            <div class="text-[11px] text-gray-400 mt-1 italic">Belum ada tanggapan</div>
                                        @endif
                                    </td>
                                    
                                    <!-- Kolom Dokumen & Aksi Edit -->
                                    <td class="py-4 px-6">
                                        <div class="flex justify-center gap-2 items-center">
                                            @if($riwayat->status_pengajuan == 'Ditolak' || $riwayat->status_pengajuan == 'Revisi')
                                                <!-- Tombol Edit & Ajukan Ulang -->
                                                <a href="{{ url('/user/edit-sk/' . $riwayat->id) }}" class="bg-orange-500 text-white hover:bg-orange-600 px-3 py-2 rounded text-[12px] font-semibold transition flex items-center gap-1.5 shadow-sm" title="Edit dan Ajukan Ulang Dokumen">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit & Ajukan Ulang
                                                </a>
                                            @elseif($riwayat->file_sk)
                                                <!-- Tombol Lihat/Unduh (Jika Selesai) -->
                                                <button type="button" onclick="openPreview('/storage/{{ $riwayat->file_sk }}', '{{ $riwayat->nomor_sk }}')" class="bg-white border border-[#2491c9] text-[#2491c9] hover:bg-blue-50 px-3 py-1.5 rounded text-[12px] font-semibold transition flex items-center gap-1.5" title="Lihat Dokumen">
                                                    <i class="fa-solid fa-eye"></i> Lihat
                                                </button>
                                                <a href="{{ asset('storage/' . $riwayat->file_sk) }}" target="_blank" class="bg-[#2491c9] text-white hover:bg-[#1d7aa9] px-3 py-1.5 rounded text-[12px] font-semibold transition flex items-center gap-1.5" title="Download SK">
                                                    <i class="fa-solid fa-download"></i> Unduh
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-[12px] italic"><i class="fa-solid fa-clock"></i> Memproses file...</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-gray-400 italic text-[13px]">Belum ada riwayat pengajuan SK.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Preview Dokumen -->
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

    <!-- Script Library Preview Dokumen -->
    <script src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="https://unpkg.com/docx-preview/dist/docx-preview.js"></script>

    <script>
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
                    container.innerHTML = `<div class="p-6 text-center text-red-500 font-medium bg-white border">Gagal memuat dokumen. Pastikan Anda terkoneksi ke server.</div>`;
                });
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('documentContainer').innerHTML = "";
        }
    </script>
</body>
</html>