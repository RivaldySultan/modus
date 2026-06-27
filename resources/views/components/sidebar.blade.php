<aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
    <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
        <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent sticky top-0 bg-white z-10">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" class="w-[45px] flex-shrink-0">
            <div class="sidebar-text text-[13px] font-bold uppercase text-black whitespace-nowrap">BPS <br> KOTA SUKABUMI</div>
        </div>

        <nav class="mt-4 flex flex-col gap-1">
            <a href="{{ url('/dashboard') }}" class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] {{ ($active ?? '') == 'dashboard' ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-house nav-icon text-lg"></i><span class="sidebar-text text-[14px]">Dashboard</span>
            </a>
            
            <a href="{{ url('manajemen-user') }}" class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] {{ ($active ?? '') == 'manajemen-user' ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-users nav-icon text-lg"></i><span class="sidebar-text text-[14px]">Manajemen User</span>
            </a>

            <a href="{{ url('/daftar-template') }}" class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] {{ ($active ?? '') == 'daftar-template' ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-print nav-icon text-lg"></i><span class="sidebar-text text-[14px]">Daftar Template SK</span>
            </a>

            <div class="flex flex-col">
                <button id="dataMasterBtn" class="nav-link w-full flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 cursor-pointer border-l-[4px] {{ in_array(($active ?? ''), ['data-teknis', 'data-kpa', 'data-pegawai', 'data-jenis-sk', 'data-jabatan']) ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                    <i class="fa-solid fa-hard-drive nav-icon text-lg"></i><span class="sidebar-text text-[14px] whitespace-nowrap">Data Master</span>
                    <i class="fa-solid fa-chevron-down ml-auto text-[10px] sidebar-text" id="arrow"></i>
                </button>
                
                <div id="submenuDataMaster" class="hidden flex-col pl-14 pr-4 py-2 space-y-4 bg-gray-50/50 border-y border-gray-100">
                    <a href="{{ url('/data-teknis') }}" title="Data Teknis dan Administrasi" class="sidebar-text text-[13px] block whitespace-nowrap overflow-hidden text-ellipsis {{ ($active ?? '') == 'data-teknis' ? 'text-[#2a93c9] font-bold' : 'text-gray-600 hover:text-[#2a93c9]' }}"><span class="mr-1">&middot;</span> Data Teknis dan Administrasi</a>
                    
                    <a href="{{ url('/data-kpa') }}" title="Data KPA & DIPA" class="sidebar-text text-[13px] block whitespace-nowrap overflow-hidden text-ellipsis {{ ($active ?? '') == 'data-kpa' ? 'text-[#2a93c9] font-bold' : 'text-gray-600 hover:text-[#2a93c9]' }}"><span class="mr-1">&middot;</span> Data KPA & DIPA</a>
                    
                    <a href="{{ url('/data-pegawai') }}" title="Data Pegawai dan Mitra Statistik" class="sidebar-text text-[13px] block whitespace-nowrap overflow-hidden text-ellipsis {{ ($active ?? '') == 'data-pegawai' ? 'text-[#2a93c9] font-bold' : 'text-gray-600 hover:text-[#2a93c9]' }}"><span class="mr-1">&middot;</span> Data Pegawai dan Mitra Statistik</a>
                    
                    <a href="{{ url('/data-jenis-sk') }}" title="Data Jenis SK" class="sidebar-text text-[13px] block whitespace-nowrap overflow-hidden text-ellipsis {{ ($active ?? '') == 'data-jenis-sk' ? 'text-[#2a93c9] font-bold' : 'text-gray-600 hover:text-[#2a93c9]' }}"><span class="mr-1">&middot;</span> Data Jenis SK</a>
                    
                    <a href="{{ url('/data-jabatan') }}" title="Data Jabatan Peserta" class="sidebar-text text-[13px] block whitespace-nowrap overflow-hidden text-ellipsis {{ ($active ?? '') == 'data-jabatan' ? 'text-[#2a93c9] font-bold' : 'text-gray-600 hover:text-[#2a93c9]' }}"><span class="mr-1">&middot;</span> Data Jabatan Peserta</a>
                </div>
            </div>

            <a href="{{ url('/arsip') }}" class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] {{ ($active ?? '') == 'arsip' ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-folder-open nav-icon text-lg"></i><span class="sidebar-text text-[14px]">Arsip / Monitoring SK</span>
            </a>
            
        </nav>
    </div>
    
    <div class="border-t border-gray-100 bg-white sticky bottom-0">
        <form action="{{ url('/logout') }}" method="POST" class="m-0 p-0">
            @csrf
            <button type="submit" class="nav-link w-full flex items-center justify-start gap-4 pl-5 pr-4 py-5 text-gray-800 font-medium transition-all duration-300 border-l-[4px] border-transparent hover:border-red-500 hover:bg-red-50 hover:text-red-500 bg-transparent cursor-pointer text-left focus:outline-none">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const masterBtn = document.getElementById('dataMasterBtn');
        const sub = document.getElementById('submenuDataMaster');
        const arrow = document.getElementById('arrow');

        // Fungsi Toggle Sidebar
        if (btn && sidebar) {
            btn.addEventListener('click', () => { 
                sidebar.classList.toggle('w-[260px]'); 
                sidebar.classList.toggle('w-[80px]'); 
                document.querySelectorAll('.sidebar-text').forEach(t => t.classList.toggle('hidden')); 
                
                // Menutup submenu Data Master jika sidebar diciutkan
                if(sidebar.classList.contains('w-[80px]') && sub) {
                    sub.classList.add('hidden');
                    sub.classList.remove('flex');
                    if(arrow) arrow.classList.remove('rotate-180');
                }
            });
        }

        // Fungsi Toggle Submenu Data Master
        if (masterBtn && sub) {
            masterBtn.addEventListener('click', () => { 
                // Jika sidebar sedang diciutkan, mekarkan dulu
                if(sidebar.classList.contains('w-[80px]') && btn) {
                    btn.click(); 
                }
                sub.classList.toggle('hidden'); 
                sub.classList.toggle('flex'); 
                if(arrow) arrow.classList.toggle('rotate-180');
            });
        }

        // Fungsi otomatis membuka menu Data Master jika halamannya sedang aktif
        const activeMenu = "{{ $active ?? '' }}";
        const masterMenus = ['data-teknis', 'data-kpa', 'data-pegawai', 'data-jenis-sk', 'data-jabatan'];
        
        if (masterMenus.includes(activeMenu) && sub) {
            sub.classList.remove('hidden');
            sub.classList.add('flex');
            if(arrow) arrow.classList.add('rotate-180');
        }
    });
</script>