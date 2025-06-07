<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Presensi Error</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-red-50 min-h-screen flex flex-col">

  <nav class="bg-red-600 shadow-md sticky top-0 z-20">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <a href="{{ route('scan.show') }}" class="text-white hover:text-red-200" title="Kembali ke Scanner">
          <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <span class="text-white font-semibold text-lg">Presensi Tidak Berhasil</span>
      </div>
      <a href="{{ url('/') }}" class="text-white hover:text-red-200" title="Beranda">
        <i class="fas fa-home"></i>
      </a>
    </div>
  </nav>

  <main class="flex-grow flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
      <div class="mb-5">
        <i class="fas fa-times-circle text-red-500 text-5xl mb-4"></i>
        <h2 class="text-2xl font-bold text-red-700 mb-2">Terjadi Kesalahan</h2>
        <p class="text-gray-700">{{ $message }}</p>
      </div>
      <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6">
        <a href="{{ route('scan.show') }}" class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
          <i class="fas fa-qrcode mr-2"></i> Scan Ulang
        </a>
        <a href="{{ url('/') }}" class="flex-1 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
          <i class="fas fa-home mr-2"></i> Ke Beranda
        </a>
      </div>
    </div>
  </main>
</body>
</html>
