<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai dan Mitra Statistik - MODUS BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #d9dce5;
        }

        .nav-icon {
            min-width: 24px;
            text-align: center;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }

        .sidebar-text {
            transition: all 0.2s ease;
        }

        .active-indicator {
            position: relative;
        }

        .active-indicator::before {
            content: "";
            position: absolute;
            left: -18px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 32px;
            border-radius: 0 4px 4px 0;
            background: #2696d1;
        }

        .form-input-custom {
            width: 100%;
            height: 36px;
            border: 1px solid #56a9dd;
            border-radius: 8px;
            padding: 0 12px;
            color: #2b2b2b;
            font-size: 13px;
            outline: none;
            background-color: #ffffff;
        }

        .form-input-custom:focus {
            border-color: #2696d1;
            box-shadow: 0 0 0 2px rgba(38, 150, 209, 0.12);
        }

        .form-label {
            display: block;
            color: #2996ce;
            font-size: 14px;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-card {
            width: 310px;
            border: 1px solid #cfd3da;
            background: #dfe2e8;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden text-gray-800">
    <aside id="sidebar" class="w-[260px] bg-[#e3e5eb] h-screen flex flex-col justify-between border-r border-[#cfd4dc] flex-shrink-0 transition-all duration-300">
        <div class="flex-1 overflow-y-auto sidebar-scroll pb-4">
            <div id="logo-container" class="h-[86px] flex items-center px-5 gap-3 sticky top-0 bg-[#e3e5eb] z-10">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" alt="Logo BPS" class="w-[42px] flex-shrink-0">
                <div class="sidebar-text text-[31px] font-bold leading-tight uppercase text-[#101010] whitespace-nowrap">
                    BPS <br>KOTA SUKABUMI
                </div>
            </div>

            <nav class="mt-7 flex flex-col gap-4 px-5 text-[30px]">
                <a href="#" class="flex items-center gap-3 text-[#1d1d1d] hover:text-[#2696d1] transition-colors">
                    <i class="fa-solid fa-print nav-icon"></i>
                </a>

                <a href="#" class="flex items-center gap-3 text-[#1d1d1d] hover:text-[#2696d1] transition-colors">
                    <i class="fa-solid fa-hard-drive nav-icon"></i>
                </a>

                <div class="active-indicator h-8"></div>

                <a href="/arsip" class="flex items-center gap-3 text-[#1d1d1d] hover:text-[#2696d1] transition-colors">
                    <i class="fa-solid fa-folder-open nav-icon"></i>
                </a>

                <a href="/manajemen-user" class="flex items-center gap-3 text-[#1d1d1d] hover:text-[#2696d1] transition-colors">
                    <i class="fa-solid fa-users nav-icon"></i>
                    <span class="sidebar-text text-[30px]">Manajemen User</span>
                </a>

                <a href="/pengaturan" class="flex items-center gap-3 text-[#1d1d1d] hover:text-[#2696d1] transition-colors">
                    <i class="fa-solid fa-gear nav-icon"></i>
                    <span class="sidebar-text text-[30px]">Pengaturan</span>
                </a>
            </nav>
        </div>

        <div class="p-5 bg-[#e3e5eb]">
            <a href="/" class="flex items-center gap-3 text-[#1d1d1d] hover:text-red-500 transition-colors text-[30px]">
                <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                <span class="sidebar-text">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        <header class="h-[76px] flex items-center justify-between px-5 bg-white sticky top-0 z-10 border-b border-[#d9dce3]">
            <button id="hamburgerToggle" class="w-[35px] h-[35px] bg-[#2a93c9] rounded-md flex items-center justify-center hover:bg-[#1d7aa9] transition">
                <i class="fa-solid fa-bars text-white text-[18px]"></i>
            </button>
            <div class="w-10 h-10 rounded-full border border-[#2696d1] p-[2px] bg-white">
                <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar" class="w-full h-full rounded-full object-cover">
            </div>
        </header>

        <div class="px-5 pt-4 pb-8">
            <h1 class="text-[45px] font-bold text-[#101010] tracking-tight mb-5">Data Pegawai dan Mitra Statistik</h1>

            <div class="flex justify-center">
                <div class="form-card p-5">
                    <form id="formTambahPegawai" class="space-y-4">
                        <div>
                            <label class="form-label" for="input-nama">Nama</label>
                            <input type="text" id="input-nama" class="form-input-custom" required>
                        </div>

                        <div class="relative">
                            <label class="form-label" for="input-status">Status</label>
                            <select id="input-status" class="form-input-custom appearance-none pr-8" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="PNS">PNS</option>
                                <option value="PPPK">PPPK</option>
                                <option value="Mitra Statistik Sobat">Mitra Statistik Sobat</option>
                                <option value="Mitra Lainnya">Mitra Lainnya</option>
                            </select>
                            <div class="pointer-events-none absolute right-3 top-[39px] text-[#2996ce]">
                                <i class="fa-solid fa-chevron-down text-[11px]"></i>
                            </div>
                        </div>

                        <div>
                            <label class="form-label" for="input-nip">NIP/NIK</label>
                            <input type="text" id="input-nip" class="form-input-custom" required>
                        </div>

                        <div>
                            <label class="form-label" for="input-alamat">Alamat</label>
                            <input type="text" id="input-alamat" class="form-input-custom" required>
                        </div>

                        <div>
                            <label class="form-label" for="input-telepon">Nomor Telepon</label>
                            <input type="text" id="input-telepon" class="form-input-custom" required>
                        </div>

                        <div class="flex justify-between gap-3 pt-1">
                            <a href="/data-pegawai" class="flex-1 text-center border border-[#71b8e6] text-[#208cc2] py-1.5 rounded-lg font-semibold text-[13px] hover:bg-white transition-colors">KEMBALI</a>
                            <button type="submit" class="flex-1 border border-[#71b8e6] text-[#208cc2] py-1.5 rounded-lg font-semibold text-[13px] hover:bg-white transition-colors">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('hamburgerToggle').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const minimized = sidebar.classList.contains('w-[82px]');

            if (minimized) {
                sidebar.classList.replace('w-[82px]', 'w-[260px]');
                document.querySelectorAll('.sidebar-text').forEach((t) => t.classList.remove('hidden'));
            } else {
                sidebar.classList.replace('w-[260px]', 'w-[82px]');
                document.querySelectorAll('.sidebar-text').forEach((t) => t.classList.add('hidden'));
            }
        });

        document.getElementById('formTambahPegawai').addEventListener('submit', function(e) {
            e.preventDefault();

            const data = {
                nama: document.getElementById('input-nama').value,
                status: document.getElementById('input-status').value,
                nip: document.getElementById('input-nip').value,
                alamat: document.getElementById('input-alamat').value,
                telepon: document.getElementById('input-telepon').value
            };

            let list = JSON.parse(localStorage.getItem('dataPegawai_v1')) || [];
            list.push(data);
            localStorage.setItem('dataPegawai_v1', JSON.stringify(list));

            window.location.href = '/data-pegawai';
        });
    </script>
</body>
</html>
