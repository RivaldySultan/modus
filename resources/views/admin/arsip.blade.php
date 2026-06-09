<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip/Monitoring SK - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .nav-active-indicator { position: relative; }
        .nav-active-indicator::before { content: ""; position: absolute; left: -48px; top: 50%; transform: translateY(-50%); width: 5px; height: 22px; background-color: #2a93c9; border-radius: 0 4px 4px 0; }
        .sidebar-text { transition: all 0.2s ease; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'arsip'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px]">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border p-[2px] bg-white">
                <img src="https://i.pravatar.cc/150?img=11" class="rounded-full">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h1 class="text-[24px] font-semibold text-black tracking-tight">Arsip/Monitoring SK</h1>
                    <button onclick="resetData()" class="hidden border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1 rounded text-[12px] font-semibold transition" id="btnReset">Reset Tabel</button>
                </div>
                
                <button type="button" class="inline-flex items-center gap-2 px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableBody = document.getElementById('tableBody');
            const btnReset = document.getElementById('btnReset');
            
            // Ambil data dari LocalStorage
            const dataArsip = JSON.parse(localStorage.getItem('databaseArsipSK')) || [];

            // Jika tidak ada data, tampilkan tabel kosong
            if (dataArsip.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7" class="py-10 text-center text-gray-400 italic font-normal">Belum ada data arsip SK yang dibuat.</td></tr>`;
            } 
            // Jika ada data, buatkan barisnya
            else {
                btnReset.classList.remove('hidden'); // Munculkan tombol reset
                let isiTabel = '';
                
                dataArsip.forEach((item, index) => {
                    isiTabel += `
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]">
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${index + 1}</td>
                            <td class="py-4 px-4 text-gray-700 font-medium border-r border-gray-100">${item.nomor}</td>
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${item.jenis}</td>
                            <td class="py-4 px-4 text-gray-600 border-r border-gray-100">${item.tanggalLengkap}</td>
                            <td class="py-4 px-4 text-gray-600 border-r border-gray-100">${item.tahun}</td>
                            <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${item.pembuat}</td>
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
        });

        // Fungsi untuk mengosongkan tabel (hapus memori)
        function resetData() {
            if(confirm('Yakin ingin menghapus semua data tiruan di tabel ini?')) {
                localStorage.removeItem('databaseArsipSK');
                location.reload(); // Refresh halaman
            }
        }
    </script>
</body>
</html>