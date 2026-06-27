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
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'manajemen-user'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px]">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border bg-white p-[2px]">
                <img src="https://i.pravatar.cc/150?img=11" class="rounded-full">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-[24px] font-semibold text-black tracking-tight">Manajemen User</h1>
                <a href="{{ url('/tambah-user') }}" class="inline-block px-8 py-2 border border-[#2a93c9] text-[#2a93c9] text-[13px] font-semibold rounded bg-white shadow-sm hover:bg-blue-50 transition-colors">
                    TAMBAH
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

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
                    <tbody id="tabelBodyUser">
                        @forelse($users as $index => $user)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors text-[13px]">
                                <td class="py-4 px-4 text-[#2a93c9] font-medium border-r border-gray-100">{{ $index + 1 }}</td>
                                <td class="py-4 px-4 text-gray-700 font-medium border-r border-gray-100">{{ $user->nama }}</td>
                                <td class="py-4 px-4 text-gray-600 border-r border-gray-100">{{ $user->username }}</td>
                                <td class="py-4 px-4 text-gray-400 italic border-r border-gray-100">(Tersembunyi)</td>
                                <td class="py-4 px-4 text-gray-600 border-r border-gray-100">{{ $user->email }}</td>
                                
                                <td class="py-4 px-4 border-r border-gray-100">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase {{ $user->role == 'Admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-4 border-r border-gray-100">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase {{ $user->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $user->status }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-4">
                                    <div class="flex justify-center gap-3 text-lg">
                                        <a href="{{ url('/edit-user/' . $user->id) }}" class="text-[#2a93c9] hover:opacity-70 transition" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        
                                        <form action="{{ url('/hapus-user/' . $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini secara permanen?');" class="inline m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:opacity-70 transition" title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-gray-400 italic font-normal">
                                    Belum ada data user di database. Silakan klik Tambah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>