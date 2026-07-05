<aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
    <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
        <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent sticky top-0 bg-white z-10">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" class="w-[45px] flex-shrink-0">
            <div class="sidebar-text text-[13px] font-bold uppercase text-black whitespace-nowrap">BPS <br> KOTA SUKABUMI</div>
        </div>

        <nav class="mt-4 flex flex-col gap-1">
            <a href="{{ url('/user/dashboard') }}" 
            class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] 
            {{ request()->is('user/dashboard') ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-house nav-icon text-lg"></i>
                <span class="sidebar-text text-[14px]">Dashboard User</span>
            </a>
            
            <a href="{{ url('/user/buat-sk') }}" 
            class="nav-link flex items-center gap-4 pl-5 pr-4 py-3 font-medium transition-all duration-300 border-l-[4px] 
            {{ request()->is('user/buat-sk') ? 'border-[#2a93c9] text-[#2a93c9] bg-blue-50/50' : 'border-transparent text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50' }}">
                <i class="fa-solid fa-file-signature nav-icon text-lg"></i>
                <span class="sidebar-text text-[14px]">Buat SK</span>
            </a>
        </nav>
    </div>
    
    <div class="border-t border-gray-100 bg-white sticky bottom-0">
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full text-left nav-link flex items-center justify-start gap-4 pl-5 pr-4 py-5 text-gray-800 font-medium transition-all duration-300 border-l-[4px] border-transparent hover:border-red-500 hover:bg-red-50 hover:text-red-500 cursor-pointer">
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
        const textsToHide = document.querySelectorAll('.sidebar-text');

        if (btn && sidebar) {
            btn.addEventListener('click', () => { 
                sidebar.classList.toggle('w-[260px]'); 
                sidebar.classList.toggle('w-[80px]'); 
                textsToHide.forEach(t => t.classList.toggle('hidden')); 
            });
        }
    });
</script>