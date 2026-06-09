<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard MODUS - BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #eef3f7; }
        .card-title-container { position: relative; display: inline-block; padding-bottom: 12px; margin-bottom: 20px; }
        .card-title-container::after { content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 1.5px; background-color: #2491c9; }
        .nav-icon { min-width: 24px; text-align: center; }
        
        #arrow { transition: transform 0.3s ease; }
        
        .nav-active-main { position: relative; }
        .nav-active-main::before {
            content: ""; position: absolute; left: -16px; top: 50%;
            transform: translateY(-50%); width: 5px; height: 22px;
            background-color: #2491c9; border-radius: 0 4px 4px 0;
        }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent transition-all duration-300 overflow-hidden sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">
                    BPS <br> Kota Sukabumi
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-1 px-4">
                <a href="/dashboard" class="nav-link nav-active-main flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2491c9] font-medium transition-all duration-300 hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard</span>
                </a>

                <a href="/manajemen-user" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-users nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Manajemen User</span>
                </a>

                <a href="/daftar-template" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-print nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Daftar Template SK</span>
                </a>

                <div class="flex flex-col">
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden cursor-pointer">
                        <i class="fa-solid fa-database nav-icon text-lg"></i>
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

                <a href="/arsip" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Arsip / Monitoring SK</span>
                </a>
                
                <a href="/pengaturan" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
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

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#eef3f7] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[38px] h-[35px] bg-[#2491c9] rounded flex flex-col items-center justify-center gap-[4px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-[#2491c9] p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <h1 class="text-[26px] font-bold text-black mb-8">
                Dashboard <span class="text-[15px] font-semibold text-gray-800 ml-1">admin</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#2491c9] font-bold text-[16px] uppercase tracking-wide px-2">JUMLAH TEMPLATE SK</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2491c9] leading-none mt-2">10</span>
                </div>
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#2491c9] font-bold text-[16px] uppercase tracking-wide px-2">TOTAL SK YANG DIBUAT</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2491c9] leading-none mt-2">50</span>
                </div>
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#2491c9] font-bold text-[16px] uppercase tracking-wide px-2">SK BULAN INI</h2>
                    </div>
                    <span class="text-[65px] font-[900] text-[#2491c9] leading-none mt-2">5</span>
                </div>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm mt-8 overflow-hidden w-full max-w-[65%]">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="text-[#2491c9] text-[13px] font-semibold">Aktivitas Terakhir</h3>
                </div>
                <div class="h-11 border-b border-gray-100 bg-[#fbfbfb]"></div>
                <div class="h-11 border-b border-gray-100 bg-white"></div>
                <div class="h-11 border-b border-gray-100 bg-[#fbfbfb]"></div>
                <div class="h-11 border-b border-gray-100 bg-white"></div>
                <div class="px-4 py-2 text-right bg-white">
                    <a href="#" class="text-[#2491c9] text-[10px] font-semibold hover:underline">Lihat Semua ></a>
                </div>
            </div>
        </div>
    </main>

    <script>
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const logoContainer = document.getElementById('logo-container');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const navLinks = document.querySelectorAll('.nav-link');
        const dataMasterBtn = document.getElementById('dataMasterBtn');
        const submenuDataMaster = document.getElementById('submenuDataMaster');
        const arrow = document.getElementById('arrow');

        hamburgerBtn.addEventListener('click', () => {
            const isMinimized = sidebar.classList.contains('w-[80px]');
            
            sidebar.classList.toggle('w-[260px]');
            sidebar.classList.toggle('w-[80px]');
            textsToHide.forEach(text => text.classList.toggle('hidden'));
            logoContainer.classList.toggle('px-6');
            logoContainer.classList.toggle('justify-center');
            
            navLinks.forEach(link => {
                link.classList.toggle('justify-start');
                link.classList.toggle('justify-center');
                link.classList.toggle('px-3');
            });

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
