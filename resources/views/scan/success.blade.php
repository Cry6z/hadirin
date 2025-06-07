<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Presensi Sukses</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-green-50 min-h-screen flex flex-col">

  <nav class="bg-green-600 shadow-md sticky top-0 z-10">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('scan.show') }}" class="text-white hover:text-green-200 flex items-center space-x-2">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
      </a>
      <span class="text-white font-bold text-lg">Presensi Sukses</span>
    </div>
  </nav>

  <main class="flex-grow flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md text-center">
      <div class="mb-5">
        <i class="fas fa-check-circle text-green-500 text-6xl mb-4"></i>
        <h2 class="text-2xl font-bold text-green-700 mb-1">Berhasil!</h2>
        <p class="text-gray-700 mb-3">{{ $message }}</p>
      </div>
      <div class="bg-green-50 border border-green-200 rounded-lg p-5 mb-6 text-left">
        <ul class="space-y-2">
          <li><span class="font-semibold">Nama:</span> <span class="ml-2">{{ $data['nama'] }}</span></li>
          <li><span class="font-semibold">Status:</span> <span class="ml-2 capitalize">{{ $data['status'] }}</span></li>
          <li><span class="font-semibold">Waktu:</span> <span class="ml-2">{{ $data['waktu'] }}</span></li>
        </ul>
      </div>
      <a href="{{ url('/') }}" class="inline-flex items-center px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
        <i class="fas fa-home mr-2"></i> Kembali ke Beranda
      </a>
    </div>
  </main>
</body>
</html>
