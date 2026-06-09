<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Template - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        
        /* Custom scrollbar untuk sidebar agar rapi */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <aside id="sidebar" class="w-[260px] bg-white h-screen flex flex-col justify-between shadow-[2px_0_10px_rgba(0,0,0,0.03)] flex-shrink-0 z-20 transition-all duration-300 relative">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[90px] flex items-center px-6 gap-3 border-b border-transparent transition-all duration-300 overflow-hidden sticky top-0 bg-white z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[45px] flex-shrink-0">
                <div class="sidebar-text text-[13px] font-bold leading-tight uppercase tracking-tight text-black whitespace-nowrap transition-opacity duration-200">
                    BPS <br> KOTA SUKABUMI
                </div>
            </div>

            <nav class="mt-6 flex flex-col gap-2 px-4">
                <a href="/dashboard" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-house nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Dashboard</span>
                </a>
                
                <a href="#" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-users nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Manajemen User</span>
                </a>

                <a href="/daftar-template" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-[#2a93c9] font-medium transition-all duration-300 overflow-hidden">
                    <i class="fa-solid fa-print nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Daftar Template SK</span>
                </a>

                <div class="flex flex-col">
                    <button id="dataMasterBtn" class="nav-link w-full flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden cursor-pointer">
                        <i class="fa-solid fa-hard-drive nav-icon text-lg"></i>
                        <span class="sidebar-text text-[14px] whitespace-nowrap">Data Master</span>
                        <i class="fa-solid fa-chevron-down ml-auto text-[10px] sidebar-text" id="arrow"></i>
                    </button>
                    
                    <div id="submenuDataMaster" class="hidden flex-col pl-12 pr-3 py-2 space-y-4">
                        <a href="/data-teknis" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9] transition-colors flex items-center gap-2 whitespace-nowrap">
                            <span>&middot;</span> Data Teknis dan Administrasi
                        </a>
                        <a href="/data-kpa" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9] transition-colors flex items-center gap-2 whitespace-nowrap">
                            <span>&middot;</span> Data KPA & DIPA
                        </a>
                        <a href="/data-pegawai" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9] transition-colors flex items-center gap-2 whitespace-nowrap">
                            <span>&middot;</span> Data Pegawai dan Mitra Statistik
                        </a>
                        <a href="/data-jenis-sk" class="sidebar-text text-[13px] text-gray-700 hover:text-[#2a93c9] transition-colors flex items-center gap-2 whitespace-nowrap">
                            <span>&middot;</span> Data Jenis SK
                        </a>
                    </div>
                </div>

                <a href="#" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
                    <i class="fa-solid fa-folder-open nav-icon text-lg"></i>
                    <span class="sidebar-text text-[14px] whitespace-nowrap">Arsip / Monitoring SK</span>
                </a>

                <a href="#" class="nav-link flex items-center justify-start gap-4 px-3 py-2.5 rounded-md text-gray-700 font-medium transition-all duration-300 hover:text-[#2a93c9] hover:bg-gray-50 overflow-hidden">
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
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#3ba8db] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#2a93c9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            
            <div class="w-10 h-10 rounded-full border border-gray-300 p-[2px] cursor-pointer hover:shadow-md transition bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 flex flex-col">
            
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">
                Upload Template
            </h1>
            
            <div class="flex justify-center w-full">
                <div class="bg-white border border-gray-200 shadow-sm p-8 rounded-sm w-[450px]">
                    
                    <form id="formUploadTemplate">
                        
                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Kelompok SK</label>
                            
                            <div id="customSelectKelompok" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                <span id="selectTextKelompok" class="text-gray-700 text-[14px]"></span> 
                                <i id="selectArrowKelompok" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                            </div>

                            <div id="dropdownOptionsKelompok" class="hidden absolute top-8 left-[calc(100%+15px)] w-full bg-white border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30">
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40" data-value="Umum">
                                    Umum
                                </div>
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50" data-value="Teknis">
                                    Teknis
                                </div>
                            </div>
                            
                            <input type="hidden" name="kelompok_sk" id="kelompokSkInput" required>
                        </div>
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Jenis SK</label>
                            
                            <div class="relative">
                                <div id="customSelectJenis" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                    <span id="selectTextJenis" class="text-[#4a9bc8] text-[14px]"></span> 
                                    <i id="selectArrowJenis" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                                </div>

                                <div id="dropdownOptionsJenis" class="hidden absolute top-0 left-[calc(100%+12px)] w-[260px] bg-[#f8fafc] border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30">
                                </div>
                                
                                <input type="hidden" name="jenis_sk" id="jenisSkInput" required>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Upload Dokumen</label>
                            <div class="w-full border border-[#4a9bc8] rounded h-[120px] bg-white cursor-pointer hover:bg-blue-50/30 transition relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center p-4 z-0 pointer-events-none">
                                    <span id="nama_file_tampil" class="text-[13px] text-[#4a9bc8] font-medium text-center truncate w-full hidden"></span>
                                </div>
                                
                                <input type="file" id="file_dokumen" accept=".doc,.docx" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>
                            <p class="text-[#4a9bc8] text-[11px] mt-1">Accepted File Types : doc and docx only</p>
                        </div>
                        
                        <div class="flex justify-between mt-8 gap-4">
                            <a href="/daftar-template" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 text-center flex-1 flex items-center justify-center">
                                KEMBALI
                            </a>
                            <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 flex-1">
                                UPLOAD
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
        </div>
    </main>

    <script>
        // --- SCRIPT HAMBURGER SIDEBAR ---
        const hamburgerBtn = document.getElementById('hamburgerToggle');
        const sidebar = document.getElementById('sidebar');
        const logoContainer = document.getElementById('logo-container');
        const textsToHide = document.querySelectorAll('.sidebar-text');
        const navLinks = document.querySelectorAll('.nav-link');
        const submenuDataMaster = document.getElementById('submenuDataMaster');

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
            if (sidebar.classList.contains('w-[80px]')) {
                submenuDataMaster.classList.add('hidden');
                submenuDataMaster.classList.remove('flex');
            }
        });

        // --- SCRIPT DROPDOWN DATA MASTER ---
        const dataMasterBtn = document.getElementById('dataMasterBtn');
        dataMasterBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('w-[260px]')) {
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
                submenuDataMaster.classList.add('flex');
            } else {
                hamburgerBtn.click();
                submenuDataMaster.classList.remove('hidden');
                submenuDataMaster.classList.add('flex');
            }
        });

        // --- DATA DINAMIS UNTUK JENIS SK ---
        const dataJenisSK = {
            "Umum": ["SK Pengelola Anggaran", "SK B", "SK C"],
            "Teknis": ["SK Lapangan", "SK B", "SK C"]
        };

        const customSelectJenis = document.getElementById('customSelectJenis');
        const selectTextJenis = document.getElementById('selectTextJenis');
        const dropdownOptionsJenis = document.getElementById('dropdownOptionsJenis');
        const hiddenInputJenis = document.getElementById('jenisSkInput');

        // Fungsi untuk merender opsi Jenis SK berdasarkan Kelompok SK
        function renderJenisSK(kelompok) {
            dropdownOptionsJenis.innerHTML = ''; // Bersihkan opsi sebelumnya
            
            if (dataJenisSK[kelompok]) {
                const opsiList = dataJenisSK[kelompok];
                opsiList.forEach((jenis, index) => {
                    const optionDiv = document.createElement('div');
                    
                    // Hilangkan border bawah pada item terakhir agar rapi
                    const borderClass = index === opsiList.length - 1 ? '' : 'border-b border-[#4a9bc8] border-opacity-40';
                    optionDiv.className = `custom-option-jenis px-4 py-2.5 text-[#4a9bc8] text-[13px] cursor-pointer hover:bg-blue-50 ${borderClass}`;
                    optionDiv.textContent = jenis;
                    optionDiv.setAttribute('data-value', jenis);
                    
                    // Event listener saat opsi diklik
                    optionDiv.addEventListener('click', function(e) {
                        e.stopPropagation();
                        selectTextJenis.textContent = jenis;
                        hiddenInputJenis.value = jenis;
                        dropdownOptionsJenis.classList.add('hidden');
                    });
                    
                    dropdownOptionsJenis.appendChild(optionDiv);
                });
            } else {
                 const emptyDiv = document.createElement('div');
                 emptyDiv.className = 'px-4 py-2.5 text-gray-500 text-[12px] italic bg-gray-50';
                 emptyDiv.textContent = 'Pilih Kelompok SK terlebih dahulu';
                 dropdownOptionsJenis.appendChild(emptyDiv);
            }
        }

        // --- SCRIPT CUSTOM DROPDOWN KELOMPOK SK ---
        const customSelectKelompok = document.getElementById('customSelectKelompok');
        const selectTextKelompok = document.getElementById('selectTextKelompok');
        const dropdownOptionsKelompok = document.getElementById('dropdownOptionsKelompok');
        const optionsKelompok = document.querySelectorAll('.custom-option-kelompok');
        const hiddenInputKelompok = document.getElementById('kelompokSkInput');

        customSelectKelompok.addEventListener('click', (e) => {
            e.stopPropagation(); 
            dropdownOptionsKelompok.classList.toggle('hidden');
            dropdownOptionsJenis.classList.add('hidden'); // Tutup dropdown bawah jika terbuka
        });

        optionsKelompok.forEach(option => {
            option.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                selectTextKelompok.textContent = value; 
                selectTextKelompok.classList.remove('text-gray-400');
                hiddenInputKelompok.value = value; 
                dropdownOptionsKelompok.classList.add('hidden');
                
                // Reset pilihan Jenis SK setiap kali Kelompok SK berubah
                selectTextJenis.textContent = "";
                hiddenInputJenis.value = "";
                
                // Perbarui daftar dropdown Jenis SK secara dinamis
                renderJenisSK(value);
            });
        });

        // --- EVENT LISTENER DROPDOWN JENIS SK ---
        customSelectJenis.addEventListener('click', (e) => {
            e.stopPropagation(); 
            
            // Render jika belum ada pilihan atau saat dropdown dibuka
            if(!hiddenInputKelompok.value) {
                renderJenisSK(""); 
            }
            
            dropdownOptionsJenis.classList.toggle('hidden');
            dropdownOptionsKelompok.classList.add('hidden'); // Tutup menu Kelompok SK jika terbuka
        });

        // Tutup semua dropdown jika klik di area kosong
        document.addEventListener('click', (e) => {
            if (!customSelectKelompok.contains(e.target)) {
                dropdownOptionsKelompok.classList.add('hidden');
            }
            if (!customSelectJenis.contains(e.target)) {
                dropdownOptionsJenis.classList.add('hidden');
            }
        });

        // --- SCRIPT TAMPILKAN NAMA FILE SAAT DI-KLIK ---
        const fileInput = document.getElementById('file_dokumen');
        const namaFileTampil = document.getElementById('nama_file_tampil');

        fileInput.addEventListener('change', function() {
            if(this.files && this.files.length > 0) {
                namaFileTampil.textContent = this.files[0].name;
                namaFileTampil.classList.remove('hidden');
            } else {
                namaFileTampil.textContent = "";
                namaFileTampil.classList.add('hidden');
            }
        });

        // --- SCRIPT SIMPAN DATA DUMMY ---
        document.getElementById('formUploadTemplate').addEventListener('submit', function(e) {
            e.preventDefault(); 

            const kelompokSk = document.getElementById('kelompokSkInput').value;
            const jenisSk = document.getElementById('jenisSkInput').value;
            
            if(!kelompokSk) {
                alert('Silakan pilih Kelompok SK terlebih dahulu!');
                return;
            }

            if(!jenisSk) {
                alert('Silakan pilih Jenis SK terlebih dahulu!');
                return;
            }

            let namaFile = "Template.docx";
            if(fileInput.files.length > 0) {
                namaFile = fileInput.files[0].name;
            }

            const templateBaru = {
                nama: kelompokSk, 
                jenis: jenisSk,
                file: namaFile,
                tanggal: new Date().toLocaleDateString('id-ID') 
            };

            let daftarTemplate = JSON.parse(localStorage.getItem('dummyTemplate')) || [];
            daftarTemplate.push(templateBaru);
            localStorage.setItem('dummyTemplate', JSON.stringify(daftarTemplate));

            window.location.href = '/daftar-template';
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
