<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KPA dan DIPA - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }

        /* Indikator menu aktif */
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
        
        .form-input-custom {
            width: 100%;
            border: 1px solid #b8e1f4;
            border-radius: 6px;
            padding: 10px 16px;
            color: #4a5568;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-input-custom:focus {
            border-color: #2a93c9;
        }    </style>
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
            
            <div id="view-tabel">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Data KPA dan DIPA</h1>
                    <button onclick="tampilkanFormTambah()" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-[#2a93c9] hover:text-white transition-all duration-300 tracking-wide bg-white shadow-sm">
                        TAMBAH
                    </button>
                </div>

                <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2a93c9] text-white">
                                <th class="py-3 px-6 font-medium text-[13px] w-16 text-center">No</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Tahun Anggaran</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Nama KPA</th>
                                <th class="py-3 px-6 font-medium text-[13px]">NIP</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Nomor DIPA</th>
                                <th class="py-3 px-6 font-medium text-[13px]">Tanggal DIPA</th>
                                <th class="py-3 px-6 font-medium text-[13px] w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelBodyKpa" class="text-gray-700">
                            </tbody>
                    </table>
                </div>
            </div>

            <div id="view-edit" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data KPA dan DIPA</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-[#f8fafc] rounded shadow-sm border border-gray-200 w-full max-w-[500px] p-8">
                        <input type="hidden" id="edit-index-hidden">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Tahun Anggaran</label>
                                <input type="number" id="edit-tahun" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama KPA</label>
                                <input type="text" id="edit-nama" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">NIP</label>
                                <input type="text" id="edit-nip" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nomor DIPA</label>
                                <input type="text" id="edit-nomor" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Tanggal DIPA</label>
                                <input type="date" id="edit-tanggal" class="form-input-custom bg-white">
                            </div>

                            <div class="flex gap-4 pt-6">
                                <button onclick="kembaliKeTabel()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-blue-50 transition bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="simpanHasilEdit()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#3982a9] transition">
                                    EDIT
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="view-tambah" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Data KPA dan DIPA</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-[#f8fafc] rounded shadow-sm border border-gray-200 w-full max-w-[500px] p-8">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Tahun Anggaran</label>
                                <input type="number" id="input-tahun" placeholder="Misal: 2026" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama KPA</label>
                                <input type="text" id="input-nama" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">NIP</label>
                                <input type="text" id="input-nip" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nomor DIPA</label>
                                <input type="text" id="input-nomor" class="form-input-custom bg-white">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Tanggal DIPA</label>
                                <input type="date" id="input-tanggal" class="form-input-custom bg-white">
                            </div>

                            <div class="flex gap-4 pt-6">
                                <button onclick="kembaliKeTabel()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-blue-50 transition bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="simpanKpaBaru()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#3982a9] transition">
                                    TAMBAH
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // --- DATA LOGIC (LocalStorage) ---
        function muatDataKpa() {
            const data = JSON.parse(localStorage.getItem('dataKpaDipa')) || [
                { tahun: '2026', nama: 'Budi Santoso', nip: '198001012005011001', nomor: 'SP-DIPA-054.01.2.XXXXX', tanggal: '2025-12-01' }
            ];
            const tbody = document.getElementById('tabelBodyKpa');
            tbody.innerHTML = '';

            data.forEach((item, index) => {
                tbody.innerHTML += `
                    <tr class="border-b border-gray-100 hover:bg-blue-50/30 transition">
                        <td class="py-4 px-6 text-[13px] text-center text-[#2a93c9] font-medium">${index + 1}</td>
                        <td class="py-4 px-6 text-[13px]">${item.tahun}</td>
                        <td class="py-4 px-6 text-[13px]">${item.nama}</td>
                        <td class="py-4 px-6 text-[13px]">${item.nip}</td>
                        <td class="py-4 px-6 text-[13px]">${item.nomor}</td>
                        <td class="py-4 px-6 text-[13px] text-[#2ebd59] font-medium">${formatTanggal(item.tanggal)}</td>
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <button onclick="bukaEdit(${index})" class="text-gray-700 hover:text-[#2a93c9] mr-3 transition" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="hapusKpa(${index})" class="text-gray-700 hover:text-red-600 transition" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            localStorage.setItem('dataKpaDipa', JSON.stringify(data));
        }

        // Format tanggal yyyy-mm-dd jadi dd-mm-yyyy (opsional agar rapi)
        function formatTanggal(tglStr) {
            if(!tglStr) return '-';
            const parts = tglStr.split('-');
            if(parts.length === 3) return `${parts[2]}-${parts[1]}-${parts[0]}`;
            return tglStr;
        }

        // --- NAVIGATION ---
        function tampilkanFormTambah() {
            // Kosongkan form saat buka form tambah
            document.getElementById('input-tahun').value = '';
            document.getElementById('input-nama').value = '';
            document.getElementById('input-nip').value = '';
            document.getElementById('input-nomor').value = '';
            document.getElementById('input-tanggal').value = '';

            document.getElementById('view-tabel').classList.add('hidden');
            document.getElementById('view-edit').classList.add('hidden');
            document.getElementById('view-tambah').classList.remove('hidden');
        }

        function bukaEdit(index) {
            const data = JSON.parse(localStorage.getItem('dataKpaDipa'));
            const item = data[index];

            document.getElementById('edit-index-hidden').value = index;
            document.getElementById('edit-tahun').value = item.tahun;
            document.getElementById('edit-nama').value = item.nama;
            document.getElementById('edit-nip').value = item.nip;
            document.getElementById('edit-nomor').value = item.nomor;
            document.getElementById('edit-tanggal').value = item.tanggal;

            document.getElementById('view-tabel').classList.add('hidden');
            document.getElementById('view-tambah').classList.add('hidden');
            document.getElementById('view-edit').classList.remove('hidden');
        }

        function kembaliKeTabel() {
            document.getElementById('view-tambah').classList.add('hidden');
            document.getElementById('view-edit').classList.add('hidden');
            document.getElementById('view-tabel').classList.remove('hidden');
        }

        // --- CRUD ACTIONS ---
        function simpanKpaBaru() {
            const tahun = document.getElementById('input-tahun').value;
            const nama = document.getElementById('input-nama').value;
            const nip = document.getElementById('input-nip').value;
            const nomor = document.getElementById('input-nomor').value;
            const tanggal = document.getElementById('input-tanggal').value;

            if(!tahun || !nama || !nomor) {
                alert("Harap lengkapi data wajib (Tahun, Nama, Nomor DIPA)!");
                return;
            }

            let data = JSON.parse(localStorage.getItem('dataKpaDipa')) || [];
            data.push({ tahun, nama, nip, nomor, tanggal });
            localStorage.setItem('dataKpaDipa', JSON.stringify(data));
            
            kembaliKeTabel();
            muatDataKpa();
        }

        function simpanHasilEdit() {
            const index = document.getElementById('edit-index-hidden').value;
            let data = JSON.parse(localStorage.getItem('dataKpaDipa'));

            data[index] = {
                tahun: document.getElementById('edit-tahun').value,
                nama: document.getElementById('edit-nama').value,
                nip: document.getElementById('edit-nip').value,
                nomor: document.getElementById('edit-nomor').value,
                tanggal: document.getElementById('edit-tanggal').value
            };

            localStorage.setItem('dataKpaDipa', JSON.stringify(data));
            alert('Data berhasil diperbarui!');
            kembaliKeTabel();
            muatDataKpa();
        }

        function hapusKpa(index) {
            if(confirm('Hapus data KPA/DIPA ini?')) {
                let data = JSON.parse(localStorage.getItem('dataKpaDipa'));
                data.splice(index, 1);
                localStorage.setItem('dataKpaDipa', JSON.stringify(data));
                muatDataKpa();
            }
        }

        // --- SIDEBAR LOGIC ---
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

        // Muat tabel saat halaman di-load
        document.addEventListener('DOMContentLoaded', muatDataKpa);
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
