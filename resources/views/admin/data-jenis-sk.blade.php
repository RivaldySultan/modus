<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jenis SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .nav-active-indicator { position: relative; }
        .nav-active-indicator::before {
            content: ""; position: absolute; left: -48px; top: 50%;
            transform: translateY(-50%); width: 5px; height: 22px;
            background-color: #2a93c9; border-radius: 0 4px 4px 0;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">
                    BPS <br> KOTA SUKABUMI
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="/dashboard" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md font-medium text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard</span>
                </a>
                
                <a href="/manajemen-user" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md font-medium text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-users nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Manajemen User</span>
                </a>

                <a href="/daftar-template" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md font-medium text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-print nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Daftar Template SK</span>
                </a>

                <div class="flex flex-col">
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center justify-start gap-4 px-3 py-2.5 rounded-md font-medium text-[#2a93c9] transition-all duration-300 cursor-pointer">
                        <i class="fa-solid fa-hard-drive nav-icon text-lg"></i>
                        <span class="sidebar-text text-[14px] whitespace-nowrap">Data Master</span>
                        <i class="fa-solid fa-chevron-down ml-auto text-[10px] sidebar-text" id="arrow"></i>
                    </button>
                    
                    <div id="submenuDataMaster" class="hidden flex-col pl-12 pr-3 py-2 space-y-4 transition-all duration-300">
                        <a href="/data-teknis" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors"><span>&middot;</span> Data Teknis dan Administrasi</a>
                        <a href="/data-kpa" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors"><span>&middot;</span> Data KPA & DIPA</a>
                        <a href="/data-pegawai" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors"><span>&middot;</span> Data Pegawai dan Mitra Statistik</a>
                        <a href="/data-jenis-sk" class="sidebar-text text-[13px] flex items-center gap-2 whitespace-nowrap transition-colors text-[#2a93c9] font-semibold nav-active-indicator"><span>&middot;</span> Data Jenis SK</a>
                        <a href="/data-jabatan" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors"><span>&middot;</span> Data Jabatan Peserta</a>
                    </div>
                </div>

                <a href="/arsip" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Arsip / Monitoring SK</span>
                </a>
                <a href="/pengaturan" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-gear nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Pengaturan</span>
                </a>
            </nav>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-white sticky bottom-0">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium hover:text-red-500 transition-all duration-300">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
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
                <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Jenis SK</h1>
                
                <a href="/tambah-jenis-sk" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-blue-50 transition-all duration-300 tracking-wide bg-white">
                    TAMBAH
                </a>
            </div>

            <div class="bg-white border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-6 font-medium text-[13px] w-16 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Kelompok SK</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Jenis SK</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Periode</th>
                            <th class="py-3 px-6 font-medium text-[13px] w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="text-[#4a9bc8] font-medium text-[13px]">
                        </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        let dataJenisSK = [];
        try {
            const stored = localStorage.getItem('db_jenis_sk_bps'); 
            if (stored) dataJenisSK = JSON.parse(stored);
        } catch (e) { dataJenisSK = []; }

        const tableBody = document.getElementById('table-body');

        function renderTable() {
            if (!Array.isArray(dataJenisSK) || dataJenisSK.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5" class="py-10 text-center text-gray-400 italic font-normal">Belum ada data. Silakan klik Tambah.</td></tr>`;
                return;
            }
            
            let barisHTML = '';
            dataJenisSK.forEach((item, index) => {
                barisHTML += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-[#4a9bc8] border-r border-gray-100">${index + 1}</td>
                        <td class="py-4 px-6 text-[#4a9bc8] border-r border-gray-100">${item.kelompok}</td>
                        <td class="py-4 px-6 text-[#4a9bc8] border-r border-gray-100">${item.jenis}</td>
                        <td class="py-4 px-6 text-[#4a9bc8] border-r border-gray-100">${item.periode}</td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex justify-center gap-3">
                                <button type="button" onclick="editData(${index})" class="text-[#2a93c9] hover:opacity-70 transition"><i class="fa-solid fa-pen"></i></button>
                                <button type="button" onclick="deleteData(${index})" class="text-red-500 hover:opacity-70 transition"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = barisHTML;
        }

        window.deleteData = function(index) {
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                dataJenisSK.splice(index, 1);
                localStorage.setItem('db_jenis_sk_bps', JSON.stringify(dataJenisSK));
                renderTable(); 
            }
        }

        window.editData = function(index) {
            localStorage.setItem('edit_index_sk', index); 
            // PINDAH KE HALAMAN EDIT YANG BARU
            window.location.href = '/edit-jenis-sk'; 
        }

        renderTable();
    </script>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const submenuDataMaster = document.getElementById('submenuDataMaster');
        const dataMasterBtn = document.getElementById('dataMasterBtn');

        hamburgerBtn.addEventListener('click', () => {
            const isMinimized = sidebar.classList.contains('w-[80px]');
            if (isMinimized) {
                sidebar.classList.replace('w-[80px]', 'w-[260px]');
                textsToHide.forEach(text => text.classList.remove('hidden'));
                submenuDataMaster.classList.remove('hidden');
            } else {
                sidebar.classList.replace('w-[260px]', 'w-[80px]');
                textsToHide.forEach(text => text.classList.add('hidden'));
                submenuDataMaster.classList.add('hidden');
            }
        });

        dataMasterBtn.addEventListener('click', () => {
            if (!sidebar.classList.contains('w-[80px]')) {
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
            }
        });
    </script>
</body>
</html>