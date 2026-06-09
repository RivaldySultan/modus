<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Jenis SK - MODUS BPS</title>
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
        .sidebar-text { transition: all 0.2s ease; }
        .form-input-custom {
            width: 100%; border: 1px solid #4a9bc8; border-radius: 6px;
            height: 40px; padding: 0 12px; color: #4a5568; font-size: 13px;
            outline: none; background-color: white; transition: border-color 0.2s;
        }
        .form-input-custom:focus { border-color: #2a93c9; box-shadow: 0 0 0 1px #2a93c9; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">
    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">BPS <br> KOTA SUKABUMI</div>
            </div>
            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="/data-jenis-sk" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md font-medium text-[#2a93c9] bg-blue-50 transition-all duration-300">
                    <i class="fa-solid fa-arrow-left nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Kembali ke Tabel</span>
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Jenis SK</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                    <form id="formTambahJenisSk">
                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Kelompok SK</label>
                            <select id="input-kelompok" class="form-input-custom appearance-none text-[#4a9bc8]" required>
                                <option value="" disabled selected>Pilih Kelompok...</option>
                                <option value="Umum">Umum</option>
                                <option value="Teknis">Teknis</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                <i class="fa-solid fa-chevron-down text-[12px]"></i>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Jenis SK</label>
                            <input type="text" id="input-jenis" class="form-input-custom" placeholder="Masukkan Jenis SK..." required>
                        </div>

                        <div class="mb-10">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Periode</label>
                            <input type="text" id="input-periode" class="form-input-custom" placeholder="Contoh: 2026" required>
                        </div>

                        <div class="flex justify-between gap-4">
                            <a href="/data-jenis-sk" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] text-center flex-1 hover:bg-blue-50 transition-colors bg-white">KEMBALI</a>
                            <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] flex-1 hover:bg-blue-50 transition-colors bg-white">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('formTambahJenisSk').addEventListener('submit', function(e) {
            e.preventDefault(); 
            const kelompok = document.getElementById('input-kelompok').value.trim();
            const jenis = document.getElementById('input-jenis').value.trim();
            const periode = document.getElementById('input-periode').value.trim();

            let databaseSK = JSON.parse(localStorage.getItem('db_jenis_sk_bps')) || [];
            
            // Logika Murni Tambah
            databaseSK.push({ kelompok, jenis, periode });
            
            localStorage.setItem('db_jenis_sk_bps', JSON.stringify(databaseSK));
            window.location.href = '/data-jenis-sk';
        });

        // Script Sidebar
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        hamburgerBtn.addEventListener('click', () => {
            const isMinimized = sidebar.classList.contains('w-[80px]');
            if (isMinimized) {
                sidebar.classList.replace('w-[80px]', 'w-[260px]');
                textsToHide.forEach(text => text.classList.remove('hidden'));
            } else {
                sidebar.classList.replace('w-[260px]', 'w-[80px]');
                textsToHide.forEach(text => text.classList.add('hidden'));
            }
        });
    </script>
</body>
</html>