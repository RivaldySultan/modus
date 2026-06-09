<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai dan Mitra Statistik - MODUS BPS Kota Sukabumi</title>
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
            content: "";
            position: absolute;
            left: -34px;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 22px;
            background-color: #2a93c9;
            border-radius: 0 4px 4px 0;
        }
        .submenu-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            white-space: normal;
            line-height: 1.25;
        }
        .submenu-dot {
            margin-top: 2px;
            flex-shrink: 0;
        }

        .form-input-custom {
            width: 100%;
            border: 1px solid #b8e1f4;
            border-radius: 6px;
            padding: 10px 16px;
            color: #4a5568;
            font-size: 13px;
            outline: none;
            background-color: white;
            transition: all 0.2s;
        }
        .form-input-custom:focus { border-color: #2a93c9; }
        .sidebar-text { transition: all 0.2s ease; }    </style>
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
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            
            <div id="viewTabel">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Pegawai dan Mitra Statistik</h1>
                    <button onclick="tampilkanTambah()" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-[#2a93c9] hover:text-white transition-all duration-300 tracking-wide bg-white shadow-sm">
                        TAMBAH
                    </button>
                </div>

                <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr class="bg-[#2a93c9] text-white">
                                <th class="py-3 px-6 font-medium text-[13px] w-16">No</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Nama</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Status</th>
                                <th class="py-3 px-6 font-medium text-[13px]">NIP/NIK</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Alamat</th>
                                <th class="py-3 px-6 font-medium text-[13px]">No Telepon</th>
                                <th class="py-3 px-6 font-medium text-[13px] w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTabelPegawai" class="text-gray-700">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="viewTambah" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Data Pegawai dan Mitra Statistik</h1>
                <div class="flex justify-center mt-4">
                    <div class="bg-[#f8fafc] rounded border border-gray-200 shadow-sm w-full max-w-[550px] p-8">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama Lengkap</label>
                                <input type="text" id="add-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Status</label>
                                <select id="add-status" class="form-input-custom appearance-none">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK">PPPK</option>
                                    <option value="Mitra Statistik Sobat">Mitra Statistik Sobat</option>
                                    <option value="Mitra Lainnya">Mitra Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">NIP / NIK</label>
                                <input type="text" id="add-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Alamat</label>
                                <input type="text" id="add-alamat" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">No Telepon</label>
                                <input type="text" id="add-telepon" class="form-input-custom">
                            </div>

                            <div class="flex gap-4 pt-6">
                                <button onclick="kembali()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] hover:bg-blue-50 transition bg-white">KEMBALI</button>
                                <button onclick="prosesTambah()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] hover:bg-[#3982a9] transition">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="viewEdit" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data Pegawai/Mitra</h1>
                <div class="flex justify-center mt-4">
                    <div class="bg-[#f8fafc] rounded border border-gray-200 shadow-sm w-full max-w-[550px] p-8">
                        <input type="hidden" id="edit-index">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama Lengkap</label>
                                <input type="text" id="edit-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Status</label>
                                <select id="edit-status" class="form-input-custom appearance-none">
                                    <option value="Pegawai">Pegawai</option>
                                    <option value="Mitra Statistik">Mitra Statistik</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">NIP / NIK</label>
                                <input type="text" id="edit-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Alamat</label>
                                <input type="text" id="edit-alamat" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">No Telepon</label>
                                <input type="text" id="edit-telepon" class="form-input-custom">
                            </div>

                            <div class="flex gap-4 pt-6">
                                <button onclick="kembali()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] hover:bg-blue-50 transition bg-white">KEMBALI</button>
                                <button onclick="prosesUpdate()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] hover:bg-[#3982a9] transition">EDIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // --- LOGIKA SIDEBAR ---
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
            if(!sidebar.classList.contains('w-[80px]')) {
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
            }
        });

        // --- LOGIKA DATA PEGAWAI (LocalStorage) ---
        let storageKey = 'dataPegawai_v1';

        function render() {
            let items = JSON.parse(localStorage.getItem(storageKey)) || [];
            const body = document.getElementById('bodyTabelPegawai');
            body.innerHTML = '';
            
            if(items.length === 0) {
                body.innerHTML = '<tr><td colspan="7" class="py-20 text-center text-gray-400 italic">Data belum tersedia. Silakan klik tambah.</td></tr>';
                return;
            }

            items.forEach((it, i) => {
                body.innerHTML += `
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-4 px-6 text-[13px] text-[#2a93c9]">${i+1}</td>
                    <td class="py-4 px-6 text-[13px] font-medium">${it.nama}</td>
                    <td class="py-4 px-6 text-[13px]">${it.status}</td>
                    <td class="py-4 px-6 text-[13px]">${it.nip}</td>
                    <td class="py-4 px-6 text-[13px]">${it.alamat}</td>
                    <td class="py-4 px-6 text-[13px]">${it.telepon}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        <button onclick="tampilkanEdit(${i})" class="text-gray-700 hover:text-[#2a93c9] mr-3 transition" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button onclick="hapus(${i})" class="text-gray-700 hover:text-red-500 transition" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>`;
            });
        }

        function tampilkanTambah() {
            // Kosongkan form
            document.getElementById('add-nama').value = '';
            document.getElementById('add-status').value = '';
            document.getElementById('add-nip').value = '';
            document.getElementById('add-alamat').value = '';
            document.getElementById('add-telepon').value = '';

            document.getElementById('viewTabel').classList.add('hidden');
            document.getElementById('viewEdit').classList.add('hidden');
            document.getElementById('viewTambah').classList.remove('hidden');
        }

        function tampilkanEdit(i) {
            let items = JSON.parse(localStorage.getItem(storageKey)) || [];
            document.getElementById('edit-index').value = i;
            document.getElementById('edit-nama').value = items[i].nama;
            document.getElementById('edit-status').value = items[i].status;
            document.getElementById('edit-nip').value = items[i].nip;
            document.getElementById('edit-alamat').value = items[i].alamat;
            document.getElementById('edit-telepon').value = items[i].telepon;
            
            document.getElementById('viewTabel').classList.add('hidden');
            document.getElementById('viewTambah').classList.add('hidden');
            document.getElementById('viewEdit').classList.remove('hidden');
        }

        function kembali() {
            document.getElementById('viewTambah').classList.add('hidden');
            document.getElementById('viewEdit').classList.add('hidden');
            document.getElementById('viewTabel').classList.remove('hidden');
        }

        function prosesTambah() {
            const nama = document.getElementById('add-nama').value;
            const status = document.getElementById('add-status').value;
            const nip = document.getElementById('add-nip').value;
            const alamat = document.getElementById('add-alamat').value;
            const telepon = document.getElementById('add-telepon').value;

            if(!nama || !status || !nip) return alert('Nama, Status, dan NIP/NIK wajib diisi!');
            
            let items = JSON.parse(localStorage.getItem(storageKey)) || [];
            items.push({ nama, status, nip, alamat, telepon });
            localStorage.setItem(storageKey, JSON.stringify(items));
            
            kembali();
            render();
        }

        function prosesUpdate() {
            const i = document.getElementById('edit-index').value;
            let items = JSON.parse(localStorage.getItem(storageKey)) || [];
            
            items[i] = { 
                nama: document.getElementById('edit-nama').value, 
                status: document.getElementById('edit-status').value,
                nip: document.getElementById('edit-nip').value,
                alamat: document.getElementById('edit-alamat').value,
                telepon: document.getElementById('edit-telepon').value
            };
            
            localStorage.setItem(storageKey, JSON.stringify(items));
            kembali();
            render();
        }

        function hapus(i) {
            if(confirm('Hapus data pegawai/mitra ini?')) {
                let items = JSON.parse(localStorage.getItem(storageKey)) || [];
                items.splice(i, 1);
                localStorage.setItem(storageKey, JSON.stringify(items));
                render();
            }
        }

        document.addEventListener('DOMContentLoaded', render);
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
