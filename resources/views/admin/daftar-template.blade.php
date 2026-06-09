<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Template SK - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent transition-all duration-300 overflow-hidden sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">
                    BPS <br> KOTA SUKABUMI
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="/dashboard" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard</span>
                </a>
                
                <a href="/manajemen-user" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-users nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Manajemen User</span>
                </a>

                <a href="/daftar-template" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2a93c9] font-medium transition-all duration-300 overflow-hidden bg-blue-50/50">
                    <i class="fa-solid fa-print nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Daftar Template SK</span>
                </a>

                <div class="flex flex-col">
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden cursor-pointer">
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

                <a href="/arsip" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Arsip / Monitoring SK</span>
                </a>

                <a href="/pengaturan" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-gear nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Pengaturan</span>
                </a>
            </nav>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-white sticky bottom-0">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium transition-all duration-300 hover:text-red-500 overflow-hidden">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#3ba8db] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#2a93c9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[22px] font-semibold text-black tracking-tight">Daftar Template SK</h1>
                <a href="/upload-template" class="inline-block bg-white border border-[#2a93c9] text-[#2a93c9] px-8 py-2 rounded font-medium text-[13px] tracking-wide hover:bg-[#2a93c9] hover:text-white transition-colors duration-200">
                    UPLOAD
                </a>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-6 font-medium text-[13px] w-16">No</th>
                            <th class="py-3 px-6 font-medium text-[13px]">Kelompok SK</th>
                            <th class="py-3 px-6 font-medium text-[13px]">Jenis SK</th>
                            <th class="py-3 px-6 font-medium text-[13px]">Tanggal Upload</th>
                            <th class="py-3 px-6 font-medium text-[13px] w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // SCRIPT SIDEBAR
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const submenuDataMaster = document.getElementById('submenuDataMaster');
        const dataMasterBtn = document.getElementById('dataMasterBtn');
        const arrow = document.getElementById('arrow');

        hamburgerBtn.addEventListener('click', () => {
            const isMinimized = sidebar.classList.contains('w-[80px]');
            sidebar.classList.toggle('w-[260px]');
            sidebar.classList.toggle('w-[80px]');
            textsToHide.forEach(text => text.classList.toggle('hidden'));
            
            if (!isMinimized) {
                submenuDataMaster.classList.add('hidden');
                submenuDataMaster.classList.remove('flex');
                arrow.classList.remove('rotate-180');
            }
        });

        dataMasterBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('w-[80px]')) {
                hamburgerBtn.click();
            }
            const isHidden = submenuDataMaster.classList.contains('hidden');
            if (isHidden) {
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
                arrow.classList.add('rotate-180');
            } else {
                submenuDataMaster.classList.add('hidden');
                submenuDataMaster.classList.remove('flex');
                arrow.classList.remove('rotate-180');
            }
        });

        // SCRIPT LOAD DATA TABEL
        function loadDummyData() {
            const tableBody = document.getElementById('tableBody');
            const templates = JSON.parse(localStorage.getItem('dummyTemplate')) || [];
            
            tableBody.innerHTML = ''; 

            templates.forEach((data, index) => {
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-100 hover:bg-blue-50/30 transition-colors';
                row.innerHTML = `
                    <td class="py-3 px-6 text-[13px] text-gray-600 text-center">${index + 1}</td>
                    <td class="py-3 px-6 text-[13px] text-gray-800 font-medium text-center">${data.nama}</td>
                    <td class="py-3 px-6 text-[13px] text-gray-600 text-center">${data.jenis}</td>
                    <td class="py-3 px-6 text-[13px] text-gray-600 text-center">${data.tanggal}</td>
                    <td class="py-3 px-6 text-[13px] whitespace-nowrap text-center">
                        <button onclick="window.location.href='/edit-template?index=${index}'" class="text-[#2a93c9] hover:text-[#1d7aa9] mr-3" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button onclick="alert('Membuka file: ${data.file}')" class="text-green-500 hover:text-green-700 mr-3" title="Lihat">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button onclick="deleteData(${index})" class="text-red-500 hover:text-red-700" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function deleteData(index) {
            if(confirm('Yakin ingin menghapus template ini?')) {
                let templates = JSON.parse(localStorage.getItem('dummyTemplate')) || [];
                templates.splice(index, 1);
                localStorage.setItem('dummyTemplate', JSON.stringify(templates));
                loadDummyData(); 
            }
        }

        document.addEventListener('DOMContentLoaded', loadDummyData);
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
