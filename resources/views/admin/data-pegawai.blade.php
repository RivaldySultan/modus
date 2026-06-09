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
        .sidebar-text { transition: all 0.2s ease; }
        
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

    @include('components.sidebar', ['active' => 'data-pegawai'])

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

        <div class="px-8 pt-2 pb-10 fade-in">
            
            <div id="viewTabel">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Pegawai dan Mitra Statistik</h1>
                    <button onclick="tampilkanTambah()" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-blue-50 transition-all duration-300 tracking-wide bg-white shadow-sm">
                        TAMBAH
                    </button>
                </div>

                <div class="bg-white rounded border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                    <table class="w-full text-center border-collapse">
                        <thead>
                            <tr class="bg-[#2a93c9] text-white">
                                <th class="py-3 px-6 font-medium text-[13px] w-16 border-r border-[#3a9ed0]">No</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Nama</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Status</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">NIP/NIK</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Alamat</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">No Telepon</th>
                                <th class="py-3 px-6 font-medium text-[13px] w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTabelPegawai">
                            </tbody>
                    </table>
                </div>
            </div>

            <div id="viewTambah" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Data Pegawai/Mitra</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-white rounded border border-[#e2e8f0] shadow-sm w-full max-w-[500px] p-10">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="add-nama" class="form-input-custom">
                            </div>
                            <div class="relative">
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Status</label>
                                <select id="add-status" class="form-input-custom appearance-none text-gray-700">
                                    <option value="" disabled selected>Pilih Status...</option>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK">PPPK</option>
                                    <option value="Mitra Statistik Sobat">Mitra Statistik Sobat</option>
                                    <option value="Mitra Lainnya">Mitra Lainnya</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                    <i class="fa-solid fa-chevron-down text-[12px]"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP / NIK</label>
                                <input type="text" id="add-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Alamat</label>
                                <input type="text" id="add-alamat" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">No Telepon</label>
                                <input type="text" id="add-telepon" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <button onclick="kembali()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="prosesTambah()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    TAMBAH
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="viewEdit" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data Pegawai/Mitra</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-white rounded border border-[#e2e8f0] shadow-sm w-full max-w-[500px] p-10">
                        <input type="hidden" id="edit-index">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="edit-nama" class="form-input-custom">
                            </div>
                            <div class="relative">
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Status</label>
                                <select id="edit-status" class="form-input-custom appearance-none text-gray-700">
                                    <option value="" disabled>Pilih Status...</option>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK">PPPK</option>
                                    <option value="Mitra Statistik Sobat">Mitra Statistik Sobat</option>
                                    <option value="Mitra Lainnya">Mitra Lainnya</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                    <i class="fa-solid fa-chevron-down text-[12px]"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP / NIK</label>
                                <input type="text" id="edit-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Alamat</label>
                                <input type="text" id="edit-alamat" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">No Telepon</label>
                                <input type="text" id="edit-telepon" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <button onclick="kembali()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="prosesUpdate()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    SIMPAN
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // --- LOGIKA DATA PEGAWAI (LocalStorage) ---
        let storageKey = 'dataPegawai_v1';

        function render() {
            let items = JSON.parse(localStorage.getItem(storageKey)) || [];
            const body = document.getElementById('bodyTabelPegawai');
            body.innerHTML = '';
            
            if(items.length === 0) {
                body.innerHTML = '<tr><td colspan="7" class="py-10 text-center text-gray-400 italic font-normal">Data belum tersedia. Silakan klik Tambah.</td></tr>';
                return;
            }

            items.forEach((it, i) => {
                body.innerHTML += `
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6 text-[13px] text-[#4a9bc8] border-r border-gray-100">${i+1}</td>
                    <td class="py-4 px-6 text-[13px] text-gray-700 font-medium border-r border-gray-100 text-left">${it.nama}</td>
                    <td class="py-4 px-6 text-[13px] text-gray-600 border-r border-gray-100">${it.status}</td>
                    <td class="py-4 px-6 text-[13px] text-[#4a9bc8] border-r border-gray-100 font-mono">${it.nip}</td>
                    <td class="py-4 px-6 text-[13px] text-gray-600 border-r border-gray-100 text-left">${it.alamat}</td>
                    <td class="py-4 px-6 text-[13px] text-gray-600 border-r border-gray-100">${it.telepon}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        <div class="flex justify-center gap-3 text-lg">
                            <button onclick="tampilkanEdit(${i})" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="hapus(${i})" class="text-red-500 hover:opacity-70 transition" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
            });
        }

        // --- NAVIGATION ---
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

        // --- CRUD ACTIONS ---
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
</body>
</html>