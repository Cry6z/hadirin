<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <title>Buat Event Baru</title>
  <style>
    .input-custom:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 2px #3b82f6;
    }
    .select-arrow {
      background: url("data:image/svg+xml,%3csvg fill='none' stroke='%236b7280' stroke-width='2' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3e%3c/path%3e%3c/svg%3e") no-repeat right 0.75rem center/1.25em 1.25em;
      appearance: none;
    }
  </style>
</head>
<body class="bg-blue-50 min-h-screen">

  <!-- Navigation Bar -->
  <nav class="bg-blue-700 py-3 shadow">
    <div class="max-w-4xl mx-auto flex items-center justify-between px-4">
      <a href="{{ route('events.index') }}" class="text-white hover:text-blue-200 flex items-center">
        <i class="fa fa-arrow-left mr-2"></i>
        <span>Kembali</span>
      </a>
      <span class="text-lg font-bold text-white tracking-wide">Manajemen Event</span>
    </div>
  </nav>

  <!-- Main Section -->
  <section class="max-w-4xl mx-auto mt-8 px-4">
    <div class="mb-8">
      <h2 class="text-3xl font-extrabold text-blue-800 mb-1">Buat Event Baru</h2>
      <p class="text-gray-600">Isi detail event yang ingin ditambahkan ke sistem.</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="bg-blue-600 px-6 py-3">
        <h3 class="text-white text-lg font-semibold flex items-center">
          <i class="fa fa-calendar-plus mr-2"></i> Formulir Event
        </h3>
      </div>
      <div class="p-6">
        @if ($errors->any())
          <div class="mb-5 bg-red-100 border-l-4 border-red-600 p-4 rounded">
            <div class="flex items-center">
              <i class="fa fa-exclamation-triangle text-red-600 mr-2"></i>
              <span class="font-semibold text-red-700">Ada {{ $errors->count() }} kesalahan:</span>
            </div>
            <ul class="mt-2 ml-6 list-disc text-red-700 text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST" class="space-y-5">
          @csrf

          <!-- Judul Event -->
          <div>
            <label for="title" class="block text-gray-700 font-medium mb-1">
              Nama Event <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fa fa-pen"></i>
              </span>
              <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                class="input-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Contoh: Seminar Teknologi"
                required
              >
            </div>
          </div>

          <!-- Deskripsi Event -->
          <div>
            <label for="description" class="block text-gray-700 font-medium mb-1">
              Keterangan <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <span class="absolute left-3 top-3 text-gray-400">
                <i class="fa fa-align-left"></i>
              </span>
              <textarea
                id="description"
                name="description"
                rows="3"
                class="input-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Tuliskan deskripsi singkat event"
                required
              >{{ old('description') }}</textarea>
            </div>
          </div>

          <!-- Tanggal Event -->
          <div>
            <label for="date" class="block text-gray-700 font-medium mb-1">
              Waktu Pelaksanaan <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fa fa-calendar-day"></i>
              </span>
              <input
                type="date"
                id="date"
                name="date"
                value="{{ old('date') }}"
                class="input-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                required
              >
            </div>
          </div>

          <!-- Tombol Aksi -->
          <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
              <i class="fa fa-times mr-2"></i> Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
              <i class="fa fa-save mr-2"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
