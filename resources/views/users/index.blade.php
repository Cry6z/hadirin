<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <title>Users Directory</title>
  <style>
    /* Responsive action buttons */
    @media (max-width: 640px) {
      .user-actions {
        flex-direction: row;
        gap: 0.25rem;
      }
      .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
        display: flex;
      }
      .btn-label {
        display: none;
      }
    }
    @media (min-width: 641px) {
      .btn-action {
        padding: 0.3rem 0.7rem;
        border-radius: 0.375rem;
      }
      .btn-label {
        display: inline;
        margin-left: 0.3rem;
      }
    }
    .fab-btn {
      transition: box-shadow 0.2s, transform 0.2s;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .fab-btn:hover {
      transform: scale(1.07);
      box-shadow: 0 6px 18px rgba(0,0,0,0.18);
    }
  </style>
</head>
<body class="bg-blue-50 min-h-screen">

  <!-- Navigation Bar -->
  <nav class="bg-white shadow">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="{{ url('/') }}" class="text-blue-500 hover:text-blue-700">
          <i class="fas fa-arrow-left text-lg"></i>
        </a>
        <span class="font-semibold text-lg text-gray-700">Users Directory</span>
      </div>
    </div>
  </nav>

  <!-- Main Section -->
  <section class="max-w-2xl mx-auto mt-6 p-4">
    <!-- Search Input -->
    <div class="mb-5">
      <form method="GET" action="{{ route('users.index') }}">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Type to search users..."
            class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-base"
          />
          <span class="absolute left-3 top-2.5 text-gray-400">
            <i class="fas fa-magnifying-glass"></i>
          </span>
        </div>
      </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <!-- Table Headings -->
      <div class="grid grid-cols-12 bg-blue-100 px-4 py-2 text-gray-700 font-semibold text-xs uppercase">
        <div class="col-span-1">#</div>
        <div class="col-span-7 sm:col-span-8">Full Name</div>
        <div class="col-span-4 sm:col-span-3 text-right">Options</div>
      </div>
      <!-- Table Rows -->
      @forelse ($users as $user)
        <div class="grid grid-cols-12 px-4 py-3 border-b border-gray-100 items-center hover:bg-blue-50 transition">
          <div class="col-span-1 text-gray-400">{{ $loop->iteration }}</div>
          <div class="col-span-7 sm:col-span-8 text-gray-900 font-medium truncate">{{ $user->name }}</div>
          <div class="col-span-4 sm:col-span-3 flex justify-end">
            <div class="user-actions flex gap-2">
              <a href="{{ route('users.edit', $user->id) }}"
                 class="btn-action bg-green-50 text-green-600 hover:bg-green-100"
                 title="Edit User">
                <i class="fas fa-pen"></i>
                <span class="btn-label">Edit</span>
              </a>
              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn-action bg-red-50 text-red-600 hover:bg-red-100"
                        title="Remove User"
                        onclick="return confirm('Delete this user permanently?')">
                  <i class="fas fa-trash"></i>
                  <span class="btn-label">Delete</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="px-4 py-8 text-center text-gray-400">
          <i class="fas fa-user-slash text-3xl mb-2"></i>
          <div>No users available</div>
        </div>
      @endforelse
    </div>
  </section>

  <!-- Floating Add User Button -->
  <a href="{{ route('users.create') }}"
     class="fab-btn fixed bottom-6 right-6 bg-blue-600 text-white rounded-full p-4 hover:bg-blue-700"
     title="Add New User">
    <i class="fas fa-plus text-xl"></i>
    <span class="sr-only">Add User</span>
  </a>
</body>
</html>
