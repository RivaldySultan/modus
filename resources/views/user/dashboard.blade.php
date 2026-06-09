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
        .nav-icon { min-width: 24px; text-align: center; }
        
        /* Indikator biru jika halaman aktif */
        .nav-active-main {
            position: relative;
        }
        .nav-active-main::before {
            content: "";
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 22px;
            background-color: #2491c9;
            border-radius: 0 4px 4px 0;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300">
        <div class="overflow-y-auto">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent transition-all duration-300 overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap">
                    BPS <br> Kota Sukabumi
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-1 px-4">
                
                <a href="{{ url('/user/dashboard') }}" class="nav-link nav-active-main flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2491c9] font-medium transition-all duration-300 hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard User</span>
                </a>

                <a href="{{ url('/user/buat-sk') }}" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-file-signature nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Buat SK</span>
                </a>

            </nav>
        </div>

        <div class="p-6 mb-2">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium transition-all duration-300 hover:text-red-500 overflow-hidden">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300">
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0">
            <button id="hamburgerToggle" class="w-[38px] h-[35px] bg-[#2491c9] rounded flex flex-col items-center justify-center gap-[4px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
                <div class="w-[20px] h-[3px] bg-white rounded-full"></div>
            </button>
            <div class="flex items-center gap-3">
                <span class="text-[14px] font-medium text-gray-600 hidden md:block">Halo, Nama Pegawai</span>
                <div class="w-10 h-10 rounded-full border border-[#2491c9] p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                    <img src="https://i.pravatar.cc/150?img=32" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            
            <div class="mb-8">
                <h1 class="text-[26px] font-bold text-black">
                    Selamat Datang!
                </h1>
                <p class="text-gray-500 text-[14px] mt-1">Pantau status Surat Keputusan (SK) yang telah Anda ajukan di sini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#2491c9] font-bold text-[15px] uppercase tracking-wide px-2">TOTAL PENGAJUAN SK</h2>
                    </div>
                    <span class="text-[55px] font-[900] text-[#2491c9] leading-none mt-2">12</span>
                </div>
                
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#f59e0b] font-bold text-[15px] uppercase tracking-wide px-2">SK SEDANG DIPROSES</h2>
                    </div>
                    <span class="text-[55px] font-[900] text-[#f59e0b] leading-none mt-2">2</span>
                </div>
                
                <div class="bg-white rounded border border-gray-200 shadow-sm flex flex-col items-center py-8">
                    <div class="card-title-container">
                        <h2 class="text-[#10b981] font-bold text-[15px] uppercase tracking-wide px-2">SK SELESAI / ARSIP</h2>
                    </div>
                    <span class="text-[55px] font-[900] text-[#10b981] leading-none mt-2">10</span>
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
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2491c9] text-white text-[13px] tracking-wide">
                                <th class="py-3 px-6 font-medium">No</th>
                                <th class="py-3 px-6 font-medium">Jenis SK</th>
                                <th class="py-3 px-6 font-medium">Tanggal Pengajuan</th>
                                <th class="py-3 px-6 font-medium">Status</th>
                                <th class="py-3 px-6 font-medium text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-[14px]">
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-3 px-6">1</td>
                                <td class="py-3 px-6">SK Kepanitiaan</td>
                                <td class="py-3 px-6">10 April 2026</td>
                                <td class="py-3 px-6"><span class="bg-yellow-100 text-yellow-700 py-1 px-3 rounded-full text-[12px] font-semibold">Diproses</span></td>
                                <td class="py-3 px-6 text-center">
                                    <button class="text-gray-400 hover:text-[#2491c9] transition" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="py-3 px-6">2</td>
                                <td class="py-3 px-6">SK Lapangan</td>
                                <td class="py-3 px-6">05 April 2026</td>
                                <td class="py-3 px-6"><span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-[12px] font-semibold">Selesai</span></td>
                                <td class="py-3 px-6 text-center">
                                    <button class="text-gray-400 hover:text-[#2491c9] mr-2 transition" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                    <button class="text-gray-400 hover:text-green-600 transition" title="Unduh SK"><i class="fa-solid fa-download"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="height: 150px;"></td>
                            </tr>
                        </tbody>
                    </table>
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

        hamburgerBtn.addEventListener('click', () => {
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
        });
    </script>
</body>
</html>