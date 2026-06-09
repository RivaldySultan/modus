<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f4f8; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }

        .nav-active-indicator { position: relative; }
        .nav-active-indicator::before {
            content: "";
            position: absolute;
            left: -48px; 
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 22px;
            background-color: #2a93c9;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-text { transition: all 0.2s ease; }
        .fade-in { animation: fadeIn 0.2s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                        <a href="/data-teknis" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors">
                            <span>&middot;</span> Data Teknis dan Administrasi
                        </a>
                        <a href="/data-kpa" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors">
                            <span>&middot;</span> Data KPA & DIPA
                        </a>
                        <a href="/data-pegawai" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors">
                            <span>&middot;</span> Data Pegawai dan Mitra Statistik
                        </a>
                        <a href="/data-jenis-sk" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors">
                            <span>&middot;</span> Data Jenis SK
                        </a>
                        <a href="/data-jabatan" class="sidebar-text text-[13px] text-gray-500 hover:text-[#2491c9] flex items-center gap-2 whitespace-nowrap transition-colors">
                            <span>&middot;</span> Data Jabatan Peserta
                        </a>
                    </div>
                </div>

                <a href="/arsip" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Arsip / Monitoring SK</span>
                </a>
                <a href="/manajemen-user" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-users nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Manajemen User</span>
                </a>
                <a href="/pengaturan" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium hover:text-[#2a93c9] hover:bg-gray-50 transition-all duration-300">
                    <i class="fa-solid fa-gear nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Pengaturan</span>
                </a>
            </nav>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-white">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium hover:text-red-500 transition-all duration-300">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-200 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div id="index-content" class="px-8 pt-2 pb-10 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[24px] font-bold text-black tracking-tight">Jenis SK</h1>
                <button id="btn-tambah" class="px-8 py-2 border border-[#2a93c9] text-[#2a93c9] text-[12px] font-bold rounded hover:bg-[#2a93c9] hover:text-white transition-all duration-300 tracking-wider">
                    TAMBAH
                </button>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-6 font-medium text-[14px] w-16">No</th>
                            <th class="py-3 px-6 font-medium text-[14px]">Nama Jenis</th>
                            <th class="py-3 px-6 font-medium text-[14px]">Kode Jenis</th>
                            <th class="py-3 px-6 font-medium text-[14px]">Status</th>
                            <th class="py-3 px-6 font-medium text-[14px] w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="text-gray-600">
                        </tbody>
                </table>
            </div>
        </div>

        <div id="form-content" class="px-8 pt-2 pb-10 hidden fade-in">
            <div class="mb-6">
                <h1 id="form-title" class="text-[24px] font-bold text-black tracking-tight">Tambah Jenis SK</h1>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-10 flex justify-center items-center min-h-[500px]">
                <div class="w-full max-w-lg">
                    <form id="form-sk" class="space-y-6">
                        <input type="hidden" id="edit-index">
                        <div>
                            <label class="block text-[#2a93c9] text-sm font-medium mb-2">Nama Jenis</label>
                            <input type="text" id="input-nama" required class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                        </div>
                        <div>
                            <label class="block text-[#2a93c9] text-sm font-medium mb-2">Kode Jenis</label>
                            <input type="text" id="input-kode" required class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                        </div>
                        <div>
                            <label class="block text-[#2a93c9] text-sm font-medium mb-2">Status</label>
                            <div class="relative">
                                <select id="input-status" required class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-100 appearance-none bg-white transition-all cursor-pointer">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-chevron-down text-[#2a93c9] text-xs"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-4 pt-4">
                            <button type="button" id="btn-kembali" class="flex-1 py-3 border border-[#2a93c9] text-[#2a93c9] font-bold rounded-lg hover:bg-gray-50 transition-all uppercase text-[13px]">KEMBALI</button>
                            <button type="submit" id="btn-submit-form" class="flex-1 py-3 bg-[#eef7ff] text-[#2a93c9] font-bold rounded-lg hover:bg-[#2a93c9] hover:text-white transition-all uppercase text-[13px]">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // 1. Persiapan Data
        let dataJenisSK = [];
        try {
            const stored = localStorage.getItem('dataJenisSK_v2'); // Ganti key agar memori lama yang rusak ter-reset
            if (stored) {
                dataJenisSK = JSON.parse(stored);
            }
        } catch (e) {
            dataJenisSK = [];
        }

        if (!Array.isArray(dataJenisSK)) {
            dataJenisSK = [];
        }

        let isEditMode = false;

        // Elemen DOM
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const submenuDataMaster = document.getElementById('submenuDataMaster');
        const dataMasterBtn = document.getElementById('dataMasterBtn');

        const indexContent = document.getElementById('index-content');
        const formContent = document.getElementById('form-content');
        const tableBody = document.getElementById('table-body');
        const formSK = document.getElementById('form-sk');
        const formTitle = document.getElementById('form-title');
        const btnSubmitForm = document.getElementById('btn-submit-form');

        // Sidebar logic 
        hamburgerBtn.addEventListener('click', () => {
            const isMinimized = sidebar.classList.contains('w-[80px]');
            if (isMinimized) {
                sidebar.classList.replace('w-[80px]', 'w-[260px]');
                textsToHide.forEach(text => text.classList.remove('hidden'));
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
            } else {
                sidebar.classList.replace('w-[260px]', 'w-[80px]');
                textsToHide.forEach(text => text.classList.add('hidden'));
                submenuDataMaster.classList.add('hidden');
                submenuDataMaster.classList.remove('flex');
            }
        });

        dataMasterBtn.addEventListener('click', () => {
            if(sidebar.classList.contains('w-[80px]')) {
                hamburgerBtn.click();
            } else {
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
            }
        });

        // Buka Form Tambah
        document.getElementById('btn-tambah').addEventListener('click', () => {
            isEditMode = false;
            formTitle.innerText = "Tambah Jenis SK";
            btnSubmitForm.innerText = "Tambah";
            formSK.reset(); 
            indexContent.classList.add('hidden');
            formContent.classList.remove('hidden');
        });

        // Tutup Form
        document.getElementById('btn-kembali').addEventListener('click', () => {
            formContent.classList.add('hidden');
            indexContent.classList.remove('hidden');
        });

        // Render Table
        function renderTable() {
            if (dataJenisSK.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5" class="py-20 text-center text-gray-400 text-sm italic border-b border-gray-200">Data belum tersedia. Silakan klik Tambah.</td></tr>`;
                return;
            }
            
            let barisHTML = '';
            dataJenisSK.forEach((item, index) => {
                const statusColor = item.status === 'Aktif' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
                
                barisHTML += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-sm">${index + 1}</td>
                        <td class="py-4 px-6 text-sm font-medium text-gray-800">${item.nama}</td>
                        <td class="py-4 px-6 text-sm font-mono text-gray-500">${item.kode}</td>
                        <td class="py-4 px-6 text-sm"><span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase ${statusColor}">${item.status}</span></td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex justify-center gap-2">
                                <button type="button" onclick="editData(${index})" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded transition"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="button" onclick="deleteData(${index})" class="p-1.5 text-red-500 hover:bg-red-50 rounded transition"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = barisHTML;
        }

        // Simpan ke Browser
        function saveData() {
            localStorage.setItem('dataJenisSK_v2', JSON.stringify(dataJenisSK));
            renderTable();
        }

        // Edit Data
        window.editData = function(index) {
            isEditMode = true;
            const item = dataJenisSK[index];
            formTitle.innerText = "Edit Jenis SK";
            btnSubmitForm.innerText = "Simpan";
            document.getElementById('edit-index').value = index;
            document.getElementById('input-nama').value = item.nama;
            document.getElementById('input-kode').value = item.kode;
            document.getElementById('input-status').value = item.status;
            
            indexContent.classList.add('hidden');
            formContent.classList.remove('hidden');
        }

        // Hapus Data
        window.deleteData = function(index) {
            if(confirm("Hapus data ini secara permanen?")) {
                dataJenisSK.splice(index, 1);
                saveData();
            }
        }

        // PROSES SUBMIT FORM (PENYEBAB UTAMA EROR SEBELUMNYA, SEKARANG SUDAH AMAN)
        formSK.addEventListener('submit', function(e) {
            e.preventDefault(); // Wajib ada untuk menahan loading halaman
            
            const nama = document.getElementById('input-nama').value.trim();
            const kode = document.getElementById('input-kode').value.trim();
            const status = document.getElementById('input-status').value.trim();

            if (isEditMode) {
                const index = document.getElementById('edit-index').value;
                dataJenisSK[index] = { nama, kode, status };
            } else {
                dataJenisSK.push({ nama, kode, status });
            }
            
            saveData(); // Simpan dan langsung render ke tabel
            
            formContent.classList.add('hidden'); // Sembunyikan form
            indexContent.classList.remove('hidden'); // Munculkan tabel
            formSK.reset(); // Kosongkan form untuk pengisian selanjutnya
        });

        // Munculkan tabel saat web pertama kali dibuka
        renderTable();
    </script>

    <script>
    (function(){
      const sidebar = document.getElementById('sidebar');
      const submenu = document.getElementById('submenuDataMaster');
      const btn = document.getElementById('dataMasterBtn');
      const hamburger = document.getElementById('hamburgerToggle');
      const arrow = document.getElementById('arrow');
      if(!sidebar || !submenu || !btn){ return; }

      const KEY = 'data_master_open';
      const isMin = () => sidebar.classList.contains('w-[80px]');

      const render = () => {
        const open = localStorage.getItem(KEY) === '1';
        if(open && !isMin()) {
          submenu.classList.remove('hidden');
          submenu.classList.add('flex');
          if (arrow) arrow.classList.add('rotate-180');
        } else {
          submenu.classList.add('hidden');
          submenu.classList.remove('flex');
          if (arrow) arrow.classList.remove('rotate-180');
        }
      };

      render();

      btn.addEventListener('click', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        const open = localStorage.getItem(KEY) === '1';
        localStorage.setItem(KEY, open ? '0' : '1');
        if(isMin() && !open && hamburger){
          hamburger.click();
          setTimeout(render, 0);
          return;
        }
        render();
      }, true);

      if (hamburger) {
        hamburger.addEventListener('click', function(){
          setTimeout(render, 0);
        }, true);
      }
    })();
    </script>
</body>
</html>