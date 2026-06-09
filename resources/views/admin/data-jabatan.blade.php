<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jabatan Peserta - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .nav-icon { min-width: 24px; text-align: center; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .sidebar-text { transition: all 0.2s ease; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-jabatan'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 sticky top-0 bg-[#f4f6f9] z-10">
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[22px] font-semibold text-black tracking-tight">Data Jabatan Peserta</h1>
                
                <a href="/tambah-jabatan" class="inline-block px-6 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-medium rounded hover:bg-[#2a93c9] hover:text-white transition-all duration-300 tracking-wide bg-white shadow-sm">
                    TAMBAH
                </a>
            </div>

            <div class="bg-white rounded border border-[#e2e8f0] shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-6 font-medium text-[13px] w-20 text-center border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-6 font-medium text-[13px] border-r border-[#3a9ed0]">Jabatan Peserta</th>
                            <th class="py-3 px-6 font-medium text-[13px] text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelBodyJabatan">
                        </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        let dataJabatan = [];
        try {
            const stored = localStorage.getItem('db_jabatan_bps'); 
            if (stored) {
                dataJabatan = JSON.parse(stored);
            } else {
                // Memberikan data default jika kosong (seperti di HTML aslimu)
                dataJabatan = [
                    { jabatan: "PML/Pemeriksa Lapangan" },
                    { jabatan: "PCL/Pencacah Lapangan" }
                ];
                localStorage.setItem('db_jabatan_bps', JSON.stringify(dataJabatan));
            }
        } catch (e) { 
            dataJabatan = []; 
        }

        const tableBody = document.getElementById('tabelBodyJabatan');

        function renderTable() {
            if (!Array.isArray(dataJabatan) || dataJabatan.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="3" class="py-10 text-center text-gray-400 italic font-normal">Belum ada data jabatan. Silakan klik Tambah.</td></tr>`;
                return;
            }
            
            let barisHTML = '';
            dataJabatan.forEach((item, index) => {
                barisHTML += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6 text-[13px] text-[#4a9bc8] text-center border-r border-gray-100">${index + 1}</td>
                        <td class="py-4 px-6 text-[13px] font-medium text-gray-700 border-r border-gray-100">${item.jabatan}</td>
                        <td class="py-4 px-6 text-[13px] text-center">
                            <div class="flex justify-center gap-3 text-lg">
                                <button type="button" onclick="editData(${index})" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit"><i class="fa-solid fa-pen"></i></button>
                                <button type="button" onclick="deleteData(${index})" class="text-red-500 hover:opacity-70 transition" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tableBody.innerHTML = barisHTML;
        }

        window.deleteData = function(index) {
            if(confirm("Apakah Anda yakin ingin menghapus data jabatan ini?")) {
                dataJabatan.splice(index, 1);
                localStorage.setItem('db_jabatan_bps', JSON.stringify(dataJabatan));
                renderTable(); 
            }
        }

        window.editData = function(index) {
            localStorage.setItem('edit_index_jabatan', index); 
            window.location.href = '/edit-jabatan'; 
        }

        // Panggil render pertama kali halaman dibuka
        renderTable();
    </script>
</body>
</html>