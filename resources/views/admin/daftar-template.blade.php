<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Template SK - MODUS BPS Kota Sukabumi</title>
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
        .sidebar-text { transition: all 0.2s ease; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'daftar-template'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto transition-all duration-300 relative">
        
        <header class="h-[80px] flex items-center justify-between px-8 flex-shrink-0 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px] hover:bg-[#1d7aa9] transition cursor-pointer shadow-sm">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border border-gray-200 bg-white p-[2px] cursor-pointer hover:shadow-md transition">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[24px] font-semibold text-black tracking-tight">Daftar Template SK</h1>
                
                <a href="/upload-template" class="inline-block px-8 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    UPLOAD
                </a>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-4 font-medium text-[13px] w-16 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Kelompok SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Jenis SK</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Tanggal Upload</th>
                            <th class="py-3 px-4 font-medium text-[13px] w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function loadDummyData() {
            const tableBody = document.getElementById('tableBody');
            const templates = JSON.parse(localStorage.getItem('dummyTemplate')) || [];
            
            if(templates.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5" class="py-10 text-center text-gray-400 italic">Belum ada template SK yang diupload.</td></tr>';
                return;
            }

            tableBody.innerHTML = ''; 

            templates.forEach((data, index) => {
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]';
                row.innerHTML = `
                    <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${index + 1}</td>
                    <td class="py-4 px-4 text-gray-700 font-medium border-r border-gray-100">${data.nama}</td>
                    <td class="py-4 px-4 text-[#4a9bc8] border-r border-gray-100">${data.jenis}</td>
                    <td class="py-4 px-4 text-gray-600 border-r border-gray-100">${data.tanggal}</td>
                    <td class="py-4 px-4">
                        <div class="flex justify-center gap-3 text-lg">
                            <button onclick="window.location.href='/edit-template?index=${index}'" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="alert('Membuka file: ${data.file}')" class="text-green-500 hover:opacity-70 transition" title="Lihat">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button onclick="deleteData(${index})" class="text-red-500 hover:opacity-70 transition" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function deleteData(index) {
            if(confirm('Yakin ingin menghapus template ini?')) {
                let templates = JSON.parse(localStorage.getItem('dummyTemplate')) || [];
                templates.splice(index, 1);
                localStorage.setItem('dummyTemplate', JSON.stringify(templates));
                loadDummyData(); 
            }
        }

        document.addEventListener('DOMContentLoaded', loadDummyData);
    </script>
</body>
</html>