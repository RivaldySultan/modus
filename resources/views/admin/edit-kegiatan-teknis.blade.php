<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan Teknis - MODUS BPS</title>
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

    @include('components.sidebar', ['active' => 'kegiatan-teknis'])

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <div class="px-8 pt-10 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Kegiatan Teknis</h1>
            
            <div class="flex justify-center mt-4">
                <div class="bg-white border border-[#e2e8f0] shadow-sm p-10 rounded-sm w-[500px]">
                    <form action="{{ url('/edit-kegiatan-teknis/'.$kegiatan->id) }}" method="POST">
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
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Teknis</label>
                            <input type="text" name="nama_teknis" value="{{ old('nama_teknis', $kegiatan->nama_teknis) }}" class="form-input-custom" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Nama Survei / Kegiatan</label>
                            <input type="text" name="nama_survei" value="{{ old('nama_survei', $kegiatan->nama_survei) }}" class="form-input-custom" required>
                        </div>

                        <div class="mb-8">
                            <label class="block text-[#4a9bc8] text-[13px] mb-2 font-medium">Periode / Tahun</label>
                            <input type="text" name="periode" value="{{ old('periode', $kegiatan->periode) }}" class="form-input-custom" required>
                        </div>

                        <div class="flex justify-between gap-4">
                            <a href="{{ url('/kegiatan-teknis') }}" class="border border-[#4a9bc8] text-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] text-center flex-1 hover:bg-blue-50 transition-colors bg-white">KEMBALI</a>
                            <button type="submit" class="bg-[#4a9bc8] text-white px-8 py-2.5 rounded font-semibold text-[12px] flex-1 hover:bg-[#3982a9] transition-colors uppercase">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>