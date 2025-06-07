<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Aplikasi Kehadiran Digital SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
        extend: {
          colors: {
            main: {
              700: '#2563eb',
              800: '#1e40af',
              900: '#172554',
            },
            accent: {
              400: '#f59e42',
            }
          },
          boxShadow: {
            'panel': '0 6px 12px -2px rgba(0,0,0,0.12), 0 2px 4px -2px rgba(0,0,0,0.08)',
            'panel-hover': '0 14px 24px -4px rgba(0,0,0,0.13), 0 6px 12px -4px rgba(0,0,0,0.07)',
          },
          animation: {
            'fade-in-up': 'fadeInUp 0.4s cubic-bezier(.4,0,.2,1)',
          },
          keyframes: {
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            }
          }
        }
      }
    }
  </script>
  <script src="https://unpkg.com/feather-icons"></script>
  <title>Hadirin - Kehadiran Digital SMKN 1 Kota Bengkulu</title>
  <style>
    @media (max-width: 640px) {
      .hero-height { min-height: 15rem; }
      .square-card { aspect-ratio: 1/1; }
      .rect-card { aspect-ratio: 2/1; }
    }
  </style>
</head>
<body class="bg-slate-100 text-gray-900 font-sans min-h-screen antialiased">

  <!-- Hero Section -->
  <section class="w-full hero-height rounded-b-2xl bg-gradient-to-tr from-main-800 to-main-900 px-5 py-7 md:px-10 md:py-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-15 pointer-events-none">
      <div class="absolute top-8 left-16 w-28 h-28 rounded-full bg-white"></div>
      <div class="absolute bottom-8 right-16 w-20 h-20 rounded-full bg-accent-400"></div>
      <div class="absolute top-1/2 right-1/3 w-12 h-12 rounded-full bg-white"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto">
      <div class="flex justify-between items-center">
        <div class="text-white font-extrabold text-2xl tracking-wide">HADIRIN</div>
        <div class="flex gap-2">
          <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
          <span class="w-3 h-3 bg-red-400 rounded-full"></span>
        </div>
      </div>
      <div class="text-white text-center mt-7 md:mt-10">
        <div class="mx-auto w-16 h-16 md:w-20 md:h-20">
          <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Kota Bengkulu" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-2xl md:text-3xl font-bold mt-2">SMKN 1 Kota Bengkulu</h1>
        <p class="text-base md:text-lg text-blue-100">Aplikasi Kehadiran Digital</p>
      </div>
      <nav class="flex justify-center mt-7 md:mt-10 gap-2 md:gap-5">
        <button id="tabBtn1" onclick="showTab(1)" class="text-white font-semibold text-sm md:text-base px-4 py-2 rounded-md hover:bg-blue-800 transition flex items-center">
          <i data-feather="grid" class="mr-2 w-5 h-5"></i> Menu
        </button>
        <button id="tabBtn2" onclick="showTab(2)" class="text-white font-semibold text-sm md:text-base px-4 py-2 rounded-md hover:bg-blue-800 transition flex items-center">
          <i data-feather="printer" class="mr-2 w-5 h-5"></i> Cetak
        </button>
        <button id="tabBtn3" onclick="showTab(3)" class="text-white font-semibold text-sm md:text-base px-4 py-2 rounded-md hover:bg-blue-800 transition flex items-center">
          <i data-feather="help-circle" class="mr-2 w-5 h-5"></i> Tentang
        </button>
      </nav>
    </div>
  </section>

  <!-- Main Content -->
  <main class="px-4 py-7 md:px-10 md:py-12 max-w-5xl mx-auto transition-all duration-300">

    <!-- Menu Tab -->
    <div id="tab1" class="grid grid-cols-2 gap-4 transition-opacity duration-300">
      <a href="/users" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
        <div class="h-full p-5 flex flex-col">
          <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
            <img src="https://img.icons8.com/ios-filled/50/2563eb/add-user-group-man-man.png" class="w-7 h-7" alt="Anggota" />
          </div>
          <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Anggota</h3>
          <p class="text-xs text-gray-500 text-center mt-auto">Kelola data anggota</p>
        </div>
      </a>
      <a href="/events" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
        <div class="h-full p-5 flex flex-col">
          <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
            <img src="https://img.icons8.com/ios-filled/50/2563eb/edit-calendar.png" class="w-7 h-7" alt="Kegiatan" />
          </div>
          <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Kegiatan</h3>
          <p class="text-xs text-gray-500 text-center mt-auto">Atur jadwal kegiatan</p>
        </div>
      </a>
      <a href="{{ route('generate.id.show') }}" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
        <div class="h-full p-5 flex flex-col">
          <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
            <i data-feather="credit-card" class="w-7 h-7 text-blue-800"></i>
          </div>
          <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">ID Card</h3>
          <p class="text-xs text-gray-500 text-center mt-auto">Buat kartu identitas</p>
        </div>
      </a>
      <a href="{{ route('scan.show') }}" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
        <div class="h-full p-5 flex flex-col">
          <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
            <i data-feather="camera" class="w-7 h-7 text-blue-800"></i>
          </div>
          <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Scan QR</h3>
          <p class="text-xs text-gray-500 text-center mt-auto">Presensi QR code</p>
        </div>
      </a>
    </div>

    <!-- Cetak Tab -->
    <div id="tab2" class="hidden grid grid-cols-1 gap-4 transition-opacity duration-300">
      <a href="{{ route('print.harian') }}" class="rect-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up flex items-center">
        <div class="flex flex-col items-center w-full py-5">
          <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition">
            <i data-feather="calendar" class="w-7 h-7 text-blue-800"></i>
          </div>
          <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Cetak Harian</h3>
          <p class="text-xs text-gray-500 text-center">Laporan kehadiran harian</p>
        </div>
      </a>
      <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('print.bulanan') }}" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
          <div class="h-full p-5 flex flex-col">
            <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
              <i data-feather="calendar" class="w-7 h-7 text-blue-800"></i>
            </div>
            <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Cetak Bulanan</h3>
            <p class="text-xs text-gray-500 text-center mt-auto">Laporan bulanan</p>
          </div>
        </a>
        <a href="{{ route('print.card.id') }}" class="square-card bg-white rounded-lg shadow-panel hover:shadow-panel-hover hover:scale-105 transition group border border-gray-100 animate-fade-in-up">
          <div class="h-full p-5 flex flex-col">
            <div class="w-12 h-12 rounded-lg bg-blue-50 mb-4 flex items-center justify-center group-hover:bg-blue-100 transition mx-auto">
              <img src="https://img.icons8.com/ios-filled/50/2563eb/print.png" class="w-7 h-7" alt="Print ID" />
            </div>
            <h3 class="text-base font-semibold text-gray-900 mb-1 text-center">Cetak Semua ID</h3>
            <p class="text-xs text-gray-500 text-center mt-auto">Cetak kartu identitas</p>
          </div>
        </a>
      </div>
    </div>

    <!-- Tentang Tab -->
    <div id="tab3" class="hidden transition-opacity duration-300 animate-fade-in-up">
      <div class="bg-white rounded-lg shadow-panel p-7 md:p-10">
        <div class="flex items-center mb-5">
          <i data-feather="info" class="w-7 h-7 text-blue-800 mr-3"></i>
          <h2 class="text-xl md:text-2xl font-bold text-gray-900">Tentang Aplikasi</h2>
        </div>
        <ul class="space-y-3">
          <li class="flex items-start">
            <span class="w-2 h-2 rounded-full bg-blue-800 mt-2"></span>
            <span class="ml-4 text-gray-700 text-sm md:text-base">
              <b>Hadirin</b> adalah aplikasi pencatatan kehadiran digital untuk lingkungan SMKN 1 Kota Bengkulu.
            </span>
          </li>
          <li class="flex items-start">
            <span class="w-2 h-2 rounded-full bg-blue-800 mt-2"></span>
            <span class="ml-4 text-gray-700 text-sm md:text-base">
              Desain modern dan responsif, Hadirin memudahkan pengelolaan kehadiran di sekolah.
            </span>
          </li>
          <li class="flex items-start">
            <span class="w-2 h-2 rounded-full bg-blue-800 mt-2"></span>
            <span class="ml-4 text-gray-700 text-sm md:text-base">
              Dikembangkan secara mandiri oleh Guru PPLG SMKN 1 Kota Bengkulu sebagai kontribusi untuk sekolah.
            </span>
          </li>
        </ul>
      </div>
    </div>
  </main>

  <script>
    function showTab(idx) {
      for (let i = 1; i <= 3; i++) {
        document.getElementById('tab' + i).classList.add('hidden');
        document.getElementById('tabBtn' + i).classList.remove('bg-blue-800', 'shadow-lg');
      }
      document.getElementById('tab' + idx).classList.remove('hidden');
      document.getElementById('tabBtn' + idx).classList.add('bg-blue-800', 'shadow-lg');
      sessionStorage.setItem('tabIdx', idx);
    }
    feather.replace();
    document.addEventListener('DOMContentLoaded', () => {
      const idx = sessionStorage.getItem('tabIdx') || 1;
      showTab(idx);
      document.querySelectorAll('[id^="tab"] a').forEach((el, i) => {
        el.style.animationDelay = `${i * 60}ms`;
      });
    });
  </script>
</body>
</html>
