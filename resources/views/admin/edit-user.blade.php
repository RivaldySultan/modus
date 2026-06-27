<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .fade-in { animation: fadeIn 0.2s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        
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

    @include('components.sidebar', ['active' => 'manajemen-user'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[80px] flex items-center justify-between px-8 bg-[#f4f6f9] sticky top-0 z-10">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded flex flex-col items-center justify-center gap-[5px]">
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
                <div class="w-[18px] h-[2px] bg-white"></div>
            </button>
            <div class="w-10 h-10 rounded-full border p-[2px] bg-white">
                <img src="https://i.pravatar.cc/150?img=11" class="rounded-full w-full h-full object-cover">
            </div>
        </header>

        <div class="px-8 pt-2 pb-10">
            <h1 class="text-[24px] font-semibold text-black tracking-tight mb-8">Edit User</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                    
                    <form action="{{ url('/edit-user/' . $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5 text-[12px]">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>- {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Pegawai</label>
                            <input type="text" name="nama" value="{{ $user->nama }}" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Username</label>
                            <input type="text" name="username" value="{{ $user->username }}" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Password <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" class="form-input-custom">
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-input-custom" required>
                        </div>

                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Role</label>
                            <select name="role" class="form-input-custom appearance-none text-gray-700" required>
                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User (Pegawai)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                <i class="fa-solid fa-chevron-down text-[12px]"></i>
                            </div>
                        </div>

                        <div class="mb-10 relative">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Status</label>
                            <select name="status" class="form-input-custom appearance-none text-gray-700" required>
                                <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-Aktif" {{ $user->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 top-7 text-[#4a9bc8]">
                                <i class="fa-solid fa-chevron-down text-[12px]"></i>
                            </div>
                        </div>

                        <div class="flex justify-between gap-4">
                            <a href="{{ url('/manajemen-user') }}" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] text-center flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                BATAL
                            </a>
                            <button type="submit" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-blue-50 transition-colors uppercase bg-white">
                                SIMPAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>