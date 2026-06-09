<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODUS - Login BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        /* Trik Master: Background Attachment Fixed menjamin gradient di body dan card sejajar 100% */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: linear-gradient(105deg, #ffffff 50%, #1e88bc 50%);
            background-attachment: fixed;
        }

        .main-card {
            background: linear-gradient(105deg, #ffffff 50%, #1e88bc 50%);
            background-attachment: fixed;
            width: 90%;
            max-width: 1050px;
            height: 580px;
            display: flex;
            border-radius: 8px; /* Sedikit dilunakkan sudutnya sesuai gambar asli */
            border: none; /* INI KUNCI MENGHILANGKAN GARIS ARTEFAK */
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.3); /* Shadow fokus di luar, tanpa mengenai border */
            position: relative;
            z-index: 10;
        }

        .panel-left-content,
        .panel-right-content {
            width: 50%;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 20;
        }

        .panel-left-content {
            justify-content: space-between;
            padding: 70px 60px;
        }

        .panel-right-content {
            justify-content: center;
            align-items: center;
            padding: 70px 60px;
        }

        /* Input Form di-set putih bersih sesuai gambar pertama */
        .form-input {
            background-color: #ffffff;
            border: none;
            border-radius: 2px;
            padding: 14px 16px;
            width: 100%;
            outline: none;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05); /* Sedikit kedalaman pada input */
        }

        .form-label {
            display: block;
            color: white;
            font-size: 11.5px;
            font-weight: 600;
            margin-bottom: 6px;
            margin-left: 1px;
        }

        .login-button {
            background-color: #7bb3ff;
            color: white;
            font-weight: 700;
            padding: 15px;
            border-radius: 2px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            width: 100%;
            transition: background-color 0.2s;
            text-align: center;
        }
        
        .login-button:hover {
            background-color: #5d9bff;
        }
    </style>
</head>
<body>

<div class="main-card">
    
    <div class="panel-left-content">
        <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Lambang_Badan_Pusat_Statistik_%28BPS%29_Indonesia.svg" 
                 alt="Logo BPS" class="w-20 mb-3">
            <div class="text-[11px] font-bold text-gray-800 uppercase leading-tight tracking-tighter">
                Badan Pusat Statistik <br> Kota Sukabumi
            </div>
        </div>

        <div class="mb-10">
            <h1 class="text-[40px] font-black text-gray-900 uppercase leading-[1.1] tracking-tighter mb-1.5">
                HALO, <br> SELAMAT DATANG DI
            </h1>
            <h1 class="text-[42px] font-black text-[#2292c9] uppercase leading-none tracking-tighter mb-1.5">
                MODUS
            </h1>
            <p class="text-[10px] font-bold text-gray-600 uppercase leading-normal tracking-[0.15em] w-full">
                APLIKASI MONITORING DOKUMENTASI SURAT KEPUTUSAN
            </p>
        </div>
    </div>

    <div class="panel-right-content">
        <form id="loginForm" class="w-full max-w-[340px]">
            
            <div id="error-msg" class="hidden bg-red-500/90 text-white text-[12px] font-bold px-3 py-2 rounded mb-4 text-center tracking-wide"></div>

            <div class="mb-5">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-input focus:ring-2 focus:ring-[#7bb3ff]">
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input focus:ring-2 focus:ring-[#7bb3ff]">
            </div>

            <div class="flex items-center mb-10">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded-sm border-none cursor-pointer">
                <label for="remember" class="ml-2 text-white text-[12px] font-medium cursor-pointer">Remember Me</label>
            </div>

            <button type="submit" class="w-full bg-[#82b4ff] hover:bg-blue-500 text-white font-semibold py-2 rounded transition-colors duration-300">
                LOGIN
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah halaman refresh

        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        const errorMsg = document.getElementById('error-msg');

        // 1. Validasi Input Kosong
        if (username === '' || password === '') {
            errorMsg.innerText = 'Username dan Password tidak boleh kosong!';
            errorMsg.classList.remove('hidden');
            return;
        }

        // 2. Logika Cek Akun (Dummy Data)
        if (username === 'admin' && password === 'admin123') {
            errorMsg.classList.add('hidden');
            window.location.href = '/dashboard'; 
        } 
        else if (username === 'user' && password === 'user123') {
            errorMsg.classList.add('hidden');
            window.location.href = '/user/dashboard'; 
        } 
        // 3. Jika akun salah
        else {
            errorMsg.innerText = 'Username atau Password salah!';
            errorMsg.classList.remove('hidden');
        }
    });
</script>

</body>
</html>