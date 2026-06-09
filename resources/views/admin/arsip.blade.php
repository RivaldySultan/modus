<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip/Monitoring SK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-bg: #ffffff;
            --main-bg: #eef1f6;
            --primary-color: #2b8cb3;
            --table-header-bg: #298ebd;
            --text-blue: #3fa1c6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--main-bg); }

        .nav-icon { min-width: 24px; text-align: center; }
        #arrow { transition: transform 0.3s ease; }
        .nav-active-main { position: relative; }
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
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }

        .main-layout { flex-grow: 1; display: flex; flex-direction: column; min-width: 0; }
        .top-navbar { height: 60px; background-color: #f8fafd; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; border-bottom: 1px solid #e0e6ed; }
        .hamburger { background-color: var(--primary-color); width: 38px; height: 35px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; border: 0; border-radius: 4px; cursor: pointer; }
        .hamburger span { width: 20px; height: 3px; background-color: #fff; border-radius: 999px; display: block; }
        .profile-pic { width: 35px; height: 35px; border-radius: 50%; border: 1px solid var(--primary-color); overflow: hidden; }
        .profile-pic img { width: 100%; height: 100%; object-fit: cover; }
        .content-area { padding: 30px; flex-grow: 1; overflow-y: auto; }
        
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .page-header h2 { color: #222; font-size: 22px; font-weight: 600; }
        
        /* Style Tombol Filter yang diperbarui */
        .btn-filter { border: 1px solid var(--primary-color); color: var(--primary-color); background-color: transparent; padding: 8px 25px; border-radius: 4px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-filter:hover { background-color: var(--primary-color); color: #fff; }

        .table-card { background-color: #fff; border-radius: 4px; border: 1px solid #e0e6ed; overflow: hidden; min-height: 450px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: var(--table-header-bg); color: #fff; text-align: left; padding: 12px 20px; font-weight: 400; font-size: 14px; }
        td { padding: 12px 20px; border-bottom: 1px solid #eee; color: #555; font-size: 14px; }
        
        .data-row td { color: var(--text-blue); padding: 15px 20px; }
        .action-icons { display: flex; gap: 15px; color: #222 !important; font-size: 18px; }
        .action-icons i { cursor: pointer; }
        .action-icons i:hover { color: var(--primary-color) !important; }
        .empty-body { height: 400px; background-color: #fbfdff; border-bottom: none !important;}
        
        /* Tombol Delete Custom */
        .btn-delete-all { font-size: 12px; color: #dc3545; cursor: pointer; border: 1px solid #dc3545; padding: 5px 10px; border-radius: 4px; background: white; margin-left: 10px;}
        .btn-delete-all:hover { background: #dc3545; color: white;}
    </style>
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
                <a href="/dashboard" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden">
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
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2491c9] hover:bg-gray-50 overflow-hidden cursor-pointer" type="button">
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

                <a href="/arsip" class="nav-link nav-active-main flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2491c9] font-medium transition-all duration-300 hover:bg-gray-50 overflow-hidden">
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

    <div class="main-layout">
        <div class="top-navbar">
            <button id="hamburgerToggle" class="hamburger" type="button" aria-label="Toggle sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="profile-pic"><img src="https://i.pravatar.cc/100?img=11" alt="Profile"></div>
        </div>

        <div class="content-area">
            <div class="page-header">
                <div style="display: flex; align-items: center;">
                    <h2>Arsip/Monitoring SK</h2>
                    <button onclick="resetData()" class="btn-delete-all" id="btnReset" style="display: none;">Reset Tabel</button>
                </div>
                
                <button type="button" class="btn-filter">
                    <i class="fa-solid fa-filter"></i> FILTER
                </button>
            </div>

            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor SK</th>
                            <th>Jenis SK</th>
                            <th>Tanggal</th>
                            <th>Tahun</th>
                            <th>Pembuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableBody = document.getElementById('tableBody');
            const btnReset = document.getElementById('btnReset');
            
            // Ambil data dari LocalStorage
            const dataArsip = JSON.parse(localStorage.getItem('databaseArsipSK')) || [];

            // Jika tidak ada data, tampilkan tabel kosong
            if (dataArsip.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7" class="empty-body"></td></tr>`;
            } 
            // Jika ada data, buatkan barisnya
            else {
                btnReset.style.display = 'inline-block'; // Munculkan tombol reset
                let isiTabel = '';
                
                dataArsip.forEach((item, index) => {
                    isiTabel += `
                        <tr class="data-row">
                            <td>${index + 1}</td>
                            <td>${item.nomor}</td>
                            <td>${item.jenis}</td>
                            <td>${item.tanggalLengkap}</td>
                            <td>${item.tahun}</td>
                            <td>${item.pembuat}</td>
                            <td class="action-icons">
                                <i class="fa-solid fa-eye" title="Lihat"></i>
                                <i class="fa-solid fa-download" title="Unduh"></i>
                            </td>
                        </tr>
                    `;
                });
                
                // Tambahkan ruang kosong di bawah agar desain tidak rusak
                isiTabel += `<tr><td colspan="7" style="height: 350px; background-color: #fbfdff; border-bottom: none;"></td></tr>`;
                
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
