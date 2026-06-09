<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - MODUS BPS</title>
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
        
        .form-input-custom {
            width: 100%;
            border: 1px solid #93c5fd; 
            border-radius: 6px;
            height: 40px;
            padding: 0 12px;
            color: #4a5568;
            font-size: 13px;
            outline: none;
            background-color: white;
            transition: border-color 0.2s;
        }
        .form-input-custom:focus {
            border-color: #3b82f6; 
            box-shadow: 0 0 0 1px #3b82f6;
        }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" class="w-[45px]">
                <div class="sidebar-text text-[13px] font-bold uppercase text-black">BPS <br> KOTA SUKABUMI</div>
            </div>

            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="/dashboard" class="nav-link flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50"><i class="fa-solid fa-house nav-icon"></i><span class="sidebar-text text-[14px]">Dashboard</span></a>
                
                <a href="/manajemen-user" class="nav-link flex items-center gap-4 px-3 py-2.5 rounded-md font-medium text-[#2a93c9] bg-blue-50/50 nav-active-indicator"><i class="fa-solid fa-users nav-icon"></i><span class="sidebar-text text-[14px]">Manajemen User</span></a>

                <a href="/daftar-template" class="nav-link flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50"><i class="fa-solid fa-print nav-icon"></i><span class="sidebar-text text-[14px]">Daftar Template SK</span></a>

                <div class="flex flex-col">
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50"><i class="fa-solid fa-hard-drive nav-icon"></i><span class="sidebar-text text-[14px]">Data Master</span>
                        <i class="fa-solid fa-chevron-down ml-auto text-[10px] sidebar-text" id="arrow"></i></button>
                    <div id="submenuDataMaster" class="hidden flex-col pl-12 pr-3 py-2 space-y-4">
                        <a href="/data-teknis" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9]"><span>&middot;</span> Data Teknis dan Administrasi</a>
                        <a href="/data-kpa" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9]"><span>&middot;</span> Data KPA & DIPA</a>
                        <a href="/data-pegawai" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9]"><span>&middot;</span> Data Pegawai dan Mitra Statistik</a>
                        <a href="/data-jenis-sk" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9]"><span>&middot;</span> Data Jenis SK</a>
                        <a href="/data-jabatan" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9]"><span>&middot;</span> Data Jabatan Peserta</a>
                    </div>
                </div>

                <a href="/arsip" class="nav-link flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50"><i class="fa-solid fa-folder-open nav-icon"></i><span class="sidebar-text text-[14px]">Arsip / Monitoring SK</span></a>
                <a href="/pengaturan" class="nav-link flex items-center gap-4 px-3 py-2.5 rounded-md text-gray-700 hover:text-[#2a93c9] hover:bg-gray-50"><i class="fa-solid fa-gear nav-icon"></i><span class="sidebar-text text-[14px]">Pengaturan</span></a>
            </nav>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-white sticky bottom-0">
            <a href="/" class="nav-link flex items-center justify-start gap-4 text-gray-800 font-medium hover:text-red-500 transition-all duration-300">
                <i class="fa-solid fa-right-from-bracket nav-icon text-xl"></i>
                <span class="sidebar-text text-[14px] whitespace-nowrap">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px]"><div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div></button>
            <div class="w-10 h-10 rounded-full border p-[2px] bg-white"><img src="https://i.pravatar.cc/150?img=11" class="rounded-full"></div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <h1 class="text-[24px] font-semibold text-black tracking-tight mb-8">Edit User</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                    <form id="formEditUser">
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Pegawai</label>
                            <input type="text" id="input-nama" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Username</label>
                            <input type="text" id="input-username" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Password</label>
                            <input type="text" id="input-password" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Email</label>
                            <input type="email" id="input-email" class="form-input-custom" required>
                        </div>

                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Role</label>
                            <select id="input-role" class="form-input-custom appearance-none text-gray-700" required>
                                <option value="" disabled>Pilih Role...</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User (Pegawai)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                <i class="fa-solid fa-chevron-down text-[12px]"></i>
                            </div>
                        </div>

                        <div class="mb-10 relative">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Status</label>
                            <select id="input-status" class="form-input-custom appearance-none text-gray-700" required>
                                <option value="" disabled>Pilih Status...</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                <i class="fa-solid fa-chevron-down text-[12px]"></i>
                            </div>
                        </div>

                        <div class="flex justify-between gap-4">
                            <a href="/manajemen-user" onclick="localStorage.removeItem('edit_index_user');" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                BATAL
                            </a>
                            <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                SIMPAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // 1. Cek index yang dititipkan dari halaman tabel
        const editIndex = localStorage.getItem('edit_index_user');
        let databaseUser = JSON.parse(localStorage.getItem('dataUser_v2')) || [];

        // Proteksi: Tendang kembali ke tabel jika tidak ada data yang dipilih
        if (editIndex === null || !databaseUser[editIndex]) {
            alert('Tidak ada data yang dipilih untuk diedit!');
            window.location.href = '/manajemen-user';
        } else {
            // Isi form dengan data lama yang ditarik dari memori
            document.getElementById('input-nama').value = databaseUser[editIndex].nama;
            document.getElementById('input-username').value = databaseUser[editIndex].username;
            document.getElementById('input-password').value = databaseUser[editIndex].password;
            document.getElementById('input-email').value = databaseUser[editIndex].email;
            document.getElementById('input-role').value = databaseUser[editIndex].role;
            document.getElementById('input-status').value = databaseUser[editIndex].status;
        }

        // 2. Event saat form disubmit (Simpan Perubahan)
        document.getElementById('formEditUser').addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            // Timpa data lama dengan data baru yang ada di form
            databaseUser[editIndex] = {
                nama: document.getElementById('input-nama').value.trim(),
                username: document.getElementById('input-username').value.trim(),
                password: document.getElementById('input-password').value.trim(),
                email: document.getElementById('input-email').value.trim(),
                role: document.getElementById('input-role').value,
                status: document.getElementById('input-status').value
            };
            
            // Simpan kembali ke memori lokal browser
            localStorage.setItem('dataUser_v2', JSON.stringify(databaseUser));
            
            // Hapus sisa ingatan index yang diedit
            localStorage.removeItem('edit_index_user');
            
            // Alihkan kembali ke halaman tabel utama manajemen user
            window.location.href = '/manajemen-user';
        });
    </script>

    <script>
        const btn = document.getElementById('hamburgerToggle'), sidebar = document.getElementById('sidebar'), masterBtn = document.getElementById('dataMasterBtn'), sub = document.getElementById('submenuDataMaster');
        btn.addEventListener('click', () => { sidebar.classList.toggle('w-[260px]'); sidebar.classList.toggle('w-[80px]'); document.querySelectorAll('.sidebar-text').forEach(t => t.classList.toggle('hidden')); if(sidebar.classList.contains('w-[80px]')) sub.classList.add('hidden'); });
        masterBtn.addEventListener('click', () => { if(sidebar.classList.contains('w-[80px]')) btn.click(); sub.classList.remove('hidden'); sub.classList.add('flex'); });

        (function(){
          const arrow = document.getElementById('arrow');
          const KEY = 'data_master_open';
          const isMin = () => sidebar.classList.contains('w-[80px]');

          const render = () => {
            const open = localStorage.getItem(KEY) === '1';
            if(open && !isMin()) {
              sub.classList.remove('hidden');
              sub.classList.add('flex');
              if (arrow) arrow.classList.add('rotate-180');
            } else {
              sub.classList.add('hidden');
              sub.classList.remove('flex');
              if (arrow) arrow.classList.remove('rotate-180');
            }
          };

          render();

          masterBtn.addEventListener('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            const open = localStorage.getItem(KEY) === '1';
            localStorage.setItem(KEY, open ? '0' : '1');
            if(isMin() && !open && btn){
              btn.click();
              setTimeout(render, 0);
              return;
            }
            render();
          }, true);

          if (btn) {
            btn.addEventListener('click', function(){
              setTimeout(render, 0);
            }, true);
          }
        })();
    </script>
</body>
</html>