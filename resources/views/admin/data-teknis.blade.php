<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Teknis dan Administrasi - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        
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

    @include('components.sidebar', ['active' => 'data-teknis'])

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
                    <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Teknis dan Administrasi</h1>
                    <button onclick="tampilkanFormTambah()" class="px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-[#2a93c9] hover:text-white transition-all duration-300 tracking-wide bg-white shadow-sm">
                        TAMBAH
                    </button>
                </div>

                <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#2a93c9] text-white">
                                <th class="py-3 px-6 font-medium text-[13px] w-16 text-center border-r border-[#3a9ed0]">No</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Kelompok Bagian</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Nama Teknis/Administrasi</th>
                                <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Kode Teknis/Administrasi</th>
                                <th class="py-3 px-6 font-medium text-[13px] text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelDummy" class="text-gray-700">
                            </tbody>
                    </table>
                </div>
            </div>

            <div id="view-edit" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Data Teknis dan Administrasi</h1>
                <div class="flex justify-center mt-10">
                    <div class="bg-white rounded border border-gray-200 shadow-sm w-full max-w-[480px] p-8">
                        <input type="hidden" id="edit-index">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Kelompok Bagian</label>
                                <input type="text" id="edit-kelompok" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama Teknis/Administrasi</label>
                                <input type="text" id="edit-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Kode Teknis/Administrasi</label>
                                <input type="text" id="edit-kode" class="form-input-custom">
                            </div>
                            <div class="flex gap-4 pt-6">
                                <button onclick="batalEdit()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-blue-50 transition bg-white uppercase">KEMBALI</button>
                                <button onclick="simpanEdit()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#3982a9] transition uppercase">EDIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="view-tambah" class="hidden">
                <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Tambah Data Teknis</h1>
                <div class="flex justify-center mt-10">
                    <div class="bg-white rounded border border-gray-200 shadow-sm w-full max-w-[480px] p-8">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Kelompok Bagian</label>
                                <input type="text" id="add-kelompok" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Nama Teknis/Administrasi</label>
                                <input type="text" id="add-nama" class="form-input-custom">
                            </div>
                            <div>
                                <label class="block text-[#4a9bc8] text-[13px] font-medium mb-1.5">Kode Teknis/Administrasi</label>
                                <input type="text" id="add-kode" class="form-input-custom">
                            </div>
                            <div class="flex gap-4 pt-6">
                                <button onclick="batalEdit()" class="flex-1 border border-[#4a9bc8] text-[#4a9bc8] py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-blue-50 transition bg-white uppercase">KEMBALI</button>
                                <button onclick="prosesTambah()" class="flex-1 bg-[#4a9bc8] text-white py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#3982a9] transition uppercase">TAMBAH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        // LOGIKA DATA TABEL
        function muatTabel() {
            const data = JSON.parse(localStorage.getItem('dummyTeknis')) || [{ kelompok: 'Teknis', nama: 'Contoh Administrasi', kode: 'TKN-001' }];
            const tbody = document.getElementById('tabelDummy');
            tbody.innerHTML = '';

            data.forEach((item, index) => {
                tbody.innerHTML += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-[13px] text-center text-[#2a93c9] font-medium">${index + 1}</td>
                        <td class="py-4 px-6 text-[13px] text-gray-700">${item.kelompok}</td>
                        <td class="py-4 px-6 text-[13px] text-gray-700">${item.nama}</td>
                        <td class="py-4 px-6 text-[13px] text-gray-700">${item.kode}</td>
                        <td class="py-4 px-6 text-center whitespace-nowrap">
                            <button onclick="keHalamanEdit(${index})" class="text-gray-700 hover:text-[#2a93c9] mr-3 transition" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button onclick="hapusData(${index})" class="text-gray-700 hover:text-red-600 transition" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });
            localStorage.setItem('dummyTeknis', JSON.stringify(data));
        }

        // NAVIGASI
        function tampilkanFormTambah() {
            document.getElementById('view-tabel').classList.add('hidden');
            document.getElementById('view-tambah').classList.remove('hidden');
        }

        function batalEdit() {
            document.getElementById('view-edit').classList.add('hidden');
            document.getElementById('view-tambah').classList.add('hidden');
            document.getElementById('view-tabel').classList.remove('hidden');
        }

        function keHalamanEdit(index) {
            const data = JSON.parse(localStorage.getItem('dummyTeknis'));
            const item = data[index];
            document.getElementById('edit-index').value = index;
            document.getElementById('edit-kelompok').value = item.kelompok;
            document.getElementById('edit-nama').value = item.nama;
            document.getElementById('edit-kode').value = item.kode;
            document.getElementById('view-tabel').classList.add('hidden');
            document.getElementById('view-edit').classList.remove('hidden');
        }

        // CRUD
        function prosesTambah() {
            const kelompok = document.getElementById('add-kelompok').value;
            const nama = document.getElementById('add-nama').value;
            const kode = document.getElementById('add-kode').value;
            if(!kelompok || !nama) return alert('Lengkapi data!');
            let data = JSON.parse(localStorage.getItem('dummyTeknis')) || [];
            data.push({ kelompok, nama, kode });
            localStorage.setItem('dummyTeknis', JSON.stringify(data));
            batalEdit();
            muatTabel();
        }

        function simpanEdit() {
            const index = document.getElementById('edit-index').value;
            let data = JSON.parse(localStorage.getItem('dummyTeknis'));
            data[index] = {
                kelompok: document.getElementById('edit-kelompok').value,
                nama: document.getElementById('edit-nama').value,
                kode: document.getElementById('edit-kode').value
            };
            localStorage.setItem('dummyTeknis', JSON.stringify(data));
            batalEdit();
            muatTabel();
        }

        function hapusData(index) {
            if(confirm('Hapus data ini?')) {
                let data = JSON.parse(localStorage.getItem('dummyTeknis'));
                data.splice(index, 1);
                localStorage.setItem('dummyTeknis', JSON.stringify(data));
                muatTabel();
            }
        }

        document.addEventListener('DOMContentLoaded', muatTabel);
    </script>
</body>
</html>