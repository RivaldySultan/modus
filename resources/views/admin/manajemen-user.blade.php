<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - MODUS BPS Kota Sukabumi</title>
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

    @include('components.sidebar', ['active' => 'manajemen-user'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px]"><div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div><div class="w-[18px] h-[2px] bg-white"></div></button>
            <div class="w-10 h-10 rounded-full border bg-white p-[2px]"><img src="https://i.pravatar.cc/150?img=11" class="rounded-full"></div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[24px] font-semibold text-black tracking-tight">Manajemen User</h1>
                <a href="/tambah-user" class="inline-block px-8 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    TAMBAH
                </a>
            </div>

            <div class="bg-white rounded border border-gray-200 shadow-sm overflow-hidden min-h-[500px]">
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr class="bg-[#2a93c9] text-white">
                            <th class="py-3 px-4 font-medium text-[13px] w-12 border-r border-[#3a9ed0]">No</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Nama</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Username</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Password</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Email</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Role</th>
                            <th class="py-3 px-4 font-medium text-[13px] border-r border-[#3a9ed0]">Status</th>
                            <th class="py-3 px-4 font-medium text-[13px] w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tabelBodyUser"></tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function muatData() {
            const data = JSON.parse(localStorage.getItem('dataUser_v2')) || []; 
            const tbody = document.getElementById('tabelBodyUser');
            
            if(data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="py-10 text-gray-400 italic">Data user belum tersedia. Silakan klik Tambah.</td></tr>';
                return;
            }
            
            tbody.innerHTML = '';
            data.forEach((item, i) => {
                const badgeStatus = (item.status === 'Aktif') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
                const badgeRole = (item.role === 'Admin') ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600';

                tbody.innerHTML += `
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]">
                        <td class="py-4 text-[#4a9bc8] border-r border-gray-100">${i+1}</td>
                        <td class="py-4 text-gray-700 font-medium border-r border-gray-100">${item.nama || '-'}</td>
                        <td class="py-4 text-[#4a9bc8] font-medium border-r border-gray-100">${item.username || '-'}</td>
                        <td class="py-4 text-gray-500 border-r border-gray-100">${item.password || '-'}</td>
                        <td class="py-4 text-gray-600 border-r border-gray-100">${item.email || '-'}</td>
                        <td class="py-4 border-r border-gray-100"><span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase ${badgeRole}">${item.role || '-'}</span></td>
                        <td class="py-4 border-r border-gray-100"><span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase ${badgeStatus}">${item.status || 'Aktif'}</span></td>
                        <td class="py-4">
                            <div class="flex justify-center gap-3 text-lg">
                                <button onclick="editUser(${i})" class="text-[#2a93c9] hover:opacity-70 transition"><i class="fa-solid fa-pen"></i></button>
                                <button onclick="hapusUser(${i})" class="text-red-500 hover:opacity-70 transition"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        function hapusUser(i) { 
            if(confirm('Apakah Anda yakin ingin menghapus user ini?')) { 
                let d = JSON.parse(localStorage.getItem('dataUser_v2')); 
                d.splice(i, 1); 
                localStorage.setItem('dataUser_v2', JSON.stringify(d)); 
                muatData(); 
            } 
        }

        function editUser(i) {
            localStorage.setItem('edit_index_user', i);
            window.location.href = '/edit-user'; 
        }

        document.addEventListener('DOMContentLoaded', muatData);
    </script>
</body>
</html>