<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Template - MODUS BPS Kota Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
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
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-[13px] font-bold text-gray-800">{{ auth()->user()->nama ?? 'Guest' }}</p>
                    <p class="text-[11px] text-gray-500 font-medium uppercase">{{ auth()->user()->role ?? '' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full border border-gray-200 p-[2px] bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'U') }}&background=2a93c9&color=fff" class="rounded-full w-full h-full object-cover">
                </div>
            </div>
        </header>

        <div class="px-8 pt-2 pb-10 flex flex-col">
            <h1 class="text-[22px] font-semibold text-black tracking-tight mb-8">Edit Template SK</h1>
            
            <div class="flex justify-center w-full">
                <div class="bg-white border border-gray-200 shadow-sm p-8 rounded-sm w-[450px]">
                    
                    <form id="formEditTemplate" action="{{ url('/edit-template/' . $template->id) }}" method="POST" enctype="multipart/form-data">
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
                        
                        <div class="mb-5 relative">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Kelompok SK</label>
                            <div id="customSelectKelompok" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                <span id="selectTextKelompok" class="text-[#4a9bc8] text-[14px]">{{ $template->keterangan }}</span> 
                                <i id="selectArrowKelompok" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                            </div>
                            <div id="dropdownOptionsKelompok" class="hidden absolute top-8 left-[calc(100%+15px)] w-full bg-white border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30">
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40" data-value="Umum">Umum</div>
                                <div class="custom-option-kelompok px-4 py-2.5 text-[#4a9bc8] text-[14px] cursor-pointer hover:bg-blue-50" data-value="Teknis">Teknis</div>
                            </div>
                            <input type="hidden" name="keterangan" id="kelompokSkInput" value="{{ $template->keterangan }}" required>
                        </div>
                        
                        <div class="mb-5">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Jenis SK</label>
                            <div class="relative">
                                <div id="customSelectJenis" class="w-full border border-[#4a9bc8] rounded h-[40px] px-3 flex items-center justify-between bg-white cursor-pointer select-none">
                                    <span id="selectTextJenis" class="text-[#4a9bc8] text-[14px]">{{ $template->nama_template }}</span> 
                                    <i id="selectArrowJenis" class="fa-solid fa-chevron-right text-[#4a9bc8] text-sm transition-transform duration-200"></i>
                                </div>
                                <div id="dropdownOptionsJenis" class="hidden absolute top-0 left-[calc(100%+12px)] w-[260px] bg-[#f8fafc] border border-[#4a9bc8] rounded shadow-md overflow-hidden z-30"></div>
                                <input type="hidden" name="nama_template" id="jenisSkInput" value="{{ $template->nama_template }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label class="block text-[#4a9bc8] text-[14px] mb-2 font-medium">Upload Dokumen Baru (Opsional)</label>
                            <div class="w-full border border-[#4a9bc8] rounded h-[120px] bg-white cursor-pointer hover:bg-blue-50/30 transition relative overflow-hidden">
                                <div class="absolute inset-0 flex flex-col items-center justify-center p-4 z-0 pointer-events-none">
                                    <span id="nama_file_tampil" class="text-[13px] text-green-600 font-medium text-center truncate w-full mb-1">
                                        File saat ini: {{ basename($template->file_template) }}
                                    </span>
                                    <span class="text-[11px] text-gray-400">Klik untuk mengganti file</span>
                                </div>
                                <input type="file" name="file_template" id="file_dokumen" accept=".doc,.docx,.pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>
                            <p class="text-[#4a9bc8] text-[11px] mt-1">Kosongkan jika tidak ingin mengganti dokumen.</p>
                        </div>
                        
                        <div class="flex justify-between mt-8 gap-4">
                            <a href="{{ url('/daftar-template') }}" class="border border-[#4a9bc8] text-[#4a9bc8] bg-white px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#4a9bc8] hover:text-white transition-colors duration-200 text-center flex-1 flex items-center justify-center">BATAL</a>
                            <button type="submit" class="border border-[#4a9bc8] text-white bg-[#4a9bc8] px-8 py-2.5 rounded font-medium text-[13px] tracking-wide hover:bg-[#398ab7] transition-colors duration-200 flex-1">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        const dataJenisSK = { "Umum": ["SK Pengelola Anggaran", "SK B", "SK C"], "Teknis": ["SK Lapangan", "SK B", "SK C"] };
        const customSelectJenis = document.getElementById('customSelectJenis');
        const selectTextJenis = document.getElementById('selectTextJenis');
        const dropdownOptionsJenis = document.getElementById('dropdownOptionsJenis');
        const hiddenInputJenis = document.getElementById('jenisSkInput');

        function renderJenisSK(kelompok) {
            dropdownOptionsJenis.innerHTML = ''; 
            if (dataJenisSK[kelompok]) {
                dataJenisSK[kelompok].forEach(jenis => {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = 'px-4 py-2.5 text-[#4a9bc8] text-[13px] cursor-pointer hover:bg-blue-50 border-b border-[#4a9bc8] border-opacity-40';
                    optionDiv.textContent = jenis;
                    optionDiv.onclick = () => { selectTextJenis.textContent = jenis; hiddenInputJenis.value = jenis; dropdownOptionsJenis.classList.add('hidden'); };
                    dropdownOptionsJenis.appendChild(optionDiv);
                });
            }
        }

        // Render otomatis list Jenis SK saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            renderJenisSK("{{ $template->keterangan }}");
        });

        document.getElementById('customSelectKelompok').onclick = (e) => { e.stopPropagation(); document.getElementById('dropdownOptionsKelompok').classList.toggle('hidden'); dropdownOptionsJenis.classList.add('hidden'); };
        document.querySelectorAll('.custom-option-kelompok').forEach(opt => {
            opt.onclick = () => {
                const val = opt.getAttribute('data-value');
                document.getElementById('selectTextKelompok').textContent = val;
                document.getElementById('kelompokSkInput').value = val;
                document.getElementById('dropdownOptionsKelompok').classList.add('hidden');
                
                // Reset Jenis SK kalau Kelompok diganti
                selectTextJenis.textContent = "";
                hiddenInputJenis.value = "";
                renderJenisSK(val);
            };
        });

        customSelectJenis.onclick = (e) => { e.stopPropagation(); dropdownOptionsJenis.classList.toggle('hidden'); document.getElementById('dropdownOptionsKelompok').classList.add('hidden'); };
        
        document.getElementById('file_dokumen').onchange = function() {
            if(this.files.length > 0) {
                document.getElementById('nama_file_tampil').textContent = "File baru: " + this.files[0].name;
                document.getElementById('nama_file_tampil').classList.remove('text-green-600');
                document.getElementById('nama_file_tampil').classList.add('text-[#4a9bc8]');
            }
        };

        document.addEventListener('click', (e) => {
            if (!document.getElementById('customSelectKelompok').contains(e.target)) {
                document.getElementById('dropdownOptionsKelompok').classList.add('hidden');
            }
            if (!document.getElementById('customSelectJenis').contains(e.target)) {
                document.getElementById('dropdownOptionsJenis').classList.add('hidden');
            }
        });
        
        // SCRIPT LOCALSTORAGE SUDAH DIHAPUS. FORM AKAN OTOMATIS DISUBMIT KE LARAVEL!
    </script>
</body>
</html>