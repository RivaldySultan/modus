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

    @include('components.sidebar', ['active' => 'data-kpa'])

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
            
            <div id="view-tabel">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Data KPA dan DIPA</h1>
                    <button onclick="tampilkanFormTambah()" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-blue-50 transition-all duration-300 tracking-wide bg-white shadow-sm">
                        TAMBAH
                    </button>
                </div>

                <div class="bg-white rounded border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2a93c9] text-white">
                                <th class="py-3 px-6 font-medium text-[13px] w-16 text-center border-r border-[#3a9ed0]">No</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Tahun Anggaran</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Nama KPA</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">NIP</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Nomor DIPA</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Tanggal DIPA</th>
                                <th class="py-3 px-6 font-medium text-[13px] w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelBodyKpa">
                            </tbody>
                    </table>
                </div>
            </div>

            <div id="view-edit" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data KPA dan DIPA</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                        <input type="hidden" id="edit-index-hidden">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tahun Anggaran</label>
                                <input type="number" id="edit-tahun" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama KPA</label>
                                <input type="text" id="edit-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP</label>
                                <input type="text" id="edit-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nomor DIPA</label>
                                <input type="text" id="edit-nomor" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tanggal DIPA</label>
                                <input type="date" id="edit-tanggal" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <button onclick="kembaliKeTabel()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="simpanHasilEdit()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    SIMPAN
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="view-tambah" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Data KPA dan DIPA</h1>
                
                <div class="flex justify-center mt-4">
                    <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tahun Anggaran</label>
                                <input type="number" id="input-tahun" placeholder="Misal: 2026" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nama KPA</label>
                                <input type="text" id="input-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">NIP</label>
                                <input type="text" id="input-nip" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Nomor DIPA</label>
                                <input type="text" id="input-nomor" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-2">Tanggal DIPA</label>
                                <input type="date" id="input-tanggal" class="form-input-custom">
                            </div>

                            <div class="flex justify-between gap-4 pt-4">
                                <button onclick="kembaliKeTabel()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                    KEMBALI
                                </button>
                                <button onclick="simpanKpaBaru()" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
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
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-[13px] text-center text-[#4a9bc8] border-r border-gray-100">${index + 1}</td>
                        <td class="py-4 px-6 text-[13px] text-[#4a9bc8] border-r border-gray-100">${item.tahun}</td>
                        <td class="py-4 px-6 text-[13px] text-gray-700 font-medium border-r border-gray-100">${item.nama}</td>
                        <td class="py-4 px-6 text-[13px] text-[#4a9bc8] border-r border-gray-100">${item.nip}</td>
                        <td class="py-4 px-6 text-[13px] text-[#4a9bc8] border-r border-gray-100 font-mono">${item.nomor}</td>
                        <td class="py-4 px-6 text-[13px] text-[#2ebd59] font-medium border-r border-gray-100">${formatTanggal(item.tanggal)}</td>
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <div class="flex justify-center gap-3 text-lg">
                                <button onclick="bukaEdit(${index})" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button onclick="hapusKpa(${index})" class="text-red-500 hover:opacity-70 transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
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

        // Muat tabel saat halaman di-load
        document.addEventListener('DOMContentLoaded', muatDataKpa);
    </script>
</body>
</html>