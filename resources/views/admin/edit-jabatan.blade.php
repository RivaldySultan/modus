<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Jabatan Peserta - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .form-input-custom {
            width: 100%; border: 1px solid #4a9bc8; border-radius: 6px;
            height: 40px; padding: 0 12px; color: #4a5568; font-size: 13px;
            outline: none; background-color: white; transition: border-color 0.2s;
        }
        .form-input-custom:focus { border-color: #2a93c9; box-shadow: 0 0 0 1px #2a93c9; }    
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    @include('components.sidebar', ['active' => 'data-jabatan'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="px-8 pt-10 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Jabatan Peserta</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[450px]">
                    <form action="{{ url('/edit-jabatan/' . $jabatan->id) }}" method="POST">
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

                        <div class="mb-8">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Jabatan Peserta</label>
                            <input type="text" name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}" class="form-input-custom" required>
                        </div>

                        <div class="flex justify-between gap-4">
                            <a href="{{ url('/data-jabatan') }}" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] text-center flex-1 hover:bg-blue-50 transition-colors bg-white">BATAL</a>
                            <button type="submit" class="border border-[#4a9bc8] text-white bg-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] flex-1 hover:bg-[#3982a9] transition-colors">SIMPAN CHANGER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>