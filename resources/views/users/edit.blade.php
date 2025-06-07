<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perbarui User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .input-custom {
      transition: border 0.2s;
    }
    .input-custom:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 2px #93c5fd;
    }
    .select-custom {
      appearance: none;
      background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 0.75rem center/1.25em 1.25em;
    }
  </style>
</head>
<body class="bg-blue-50 min-h-screen">

  <!-- Navigation -->
  <nav class="bg-blue-700">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('users.index') }}" class="text-white hover:text-blue-200 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
      </a>
      <span class="text-white font-semibold">Edit User</span>
    </div>
  </nav>

  <main class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-xl shadow-lg p-8">
      <div class="mb-6 flex items-center justify-between border-b pb-4">
        <h2 class="text-xl font-bold text-blue-700 flex items-center">
          <i class="fas fa-user-cog mr-2"></i> Ubah Data User
        </h2>
        <span class="text-xs text-gray-400">User ID: {{ $user->id }}</span>
      </div>

      @if ($errors->any())
        <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
          <strong class="font-bold">Oops!</strong>
          <span class="block">Ada {{ $errors->count() }} error:</span>
          <ul class="mt-2 ml-5 list-disc text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if(session('success'))
        <div class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
          <i class="fas fa-check-circle mr-2"></i>
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
          <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
            Nama <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-user"></i></span>
            <input
              type="text"
              name="name"
              id="name"
              value="{{ old('name', $user->name) }}"
              class="input-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:outline-none"
              placeholder="Nama lengkap"
              required
            >
          </div>
        </div>

        <div>
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
            Email <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-envelope"></i></span>
            <input
              type="email"
              name="email"
              id="email"
              value="{{ old('email', $user->email) }}"
              class="input-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:outline-none"
              placeholder="email@domain.com"
              required
            >
          </div>
        </div>

        <div>
          <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">
            Jenis Kelamin
          </label>
          <div class="relative">
            <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-venus-mars"></i></span>
            <select
              name="gender"
              id="gender"
              class="select-custom pl-10 pr-3 py-2 w-full border border-gray-300 rounded-lg focus:outline-none"
            >
              <option value="">Pilih Jenis Kelamin</option>
              <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
              <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>
        </div>

        <div class="flex justify-between pt-6 border-t">
          <a
            href="{{ route('users.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-100"
          >
            <i class="fas fa-arrow-circle-left mr-2"></i> Batal
          </a>
          <button
            type="submit"
            class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold"
          >
            <i class="fas fa-save mr-2"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
