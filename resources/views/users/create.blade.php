<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Add New User</title>
  <style>
    .input-style {
      transition: box-shadow 0.2s;
    }
    .input-style:focus {
      box-shadow: 0 0 0 2px #2563eb44;
    }
    .select-style {
      appearance: none;
      background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") no-repeat right 0.75rem center/1.25em 1.25em;
    }
  </style>
</head>
<body class="bg-blue-50 min-h-screen">

  <!-- Navigation Bar -->
  <nav class="bg-blue-700 shadow">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('users.index') }}" class="text-white hover:text-blue-200 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Users
      </a>
      <span class="text-lg font-semibold text-white">Add User</span>
    </div>
  </nav>

  <!-- Main Section -->
  <section class="max-w-2xl mx-auto mt-8 p-6">
    <div class="bg-white rounded-xl shadow-lg">
      <div class="px-6 py-4 border-b bg-blue-600 rounded-t-xl">
        <h2 class="text-xl font-bold text-white flex items-center">
          <i class="fas fa-user-plus mr-2"></i> New User Details
        </h2>
      </div>
      <div class="p-6">

        <!-- Validation Errors -->
        @if ($errors->any())
          <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold"><i class="fas fa-exclamation-triangle"></i> Please fix the following:</strong>
            <ul class="mt-2 ml-4 list-disc text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <!-- User Form -->
        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
          @csrf

          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
              Name <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-user text-blue-400"></i>
              </span>
              <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                class="input-style w-full pl-10 pr-3 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="Full name"
                required
              >
            </div>
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
              Email <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-envelope text-blue-400"></i>
              </span>
              <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                class="input-style w-full pl-10 pr-3 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400"
                placeholder="user@email.com"
                required
              >
            </div>
          </div>

          <!-- Gender -->
          <div>
            <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">
              Gender
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-venus-mars text-blue-400"></i>
              </span>
              <select
                name="gender"
                id="gender"
                class="select-style w-full pl-10 pr-3 py-2 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-400"
              >
                <option value="">Select gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
          </div>

          <!-- Actions -->
          <div class="flex justify-between items-center pt-4 border-t border-blue-100">
            <a
              href="{{ route('users.index') }}"
              class="inline-flex items-center px-4 py-2 border border-blue-200 text-blue-700 bg-white rounded-lg hover:bg-blue-50 transition"
            >
              <i class="fas fa-times mr-2"></i> Cancel
            </a>
            <button
              type="submit"
              class="inline-flex items-center px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
            >
              <i class="fas fa-plus mr-2"></i> Add User
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
