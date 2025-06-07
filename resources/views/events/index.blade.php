<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <title>Events Dashboard</title>
  <style>
    .card-hover:hover {
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      transform: translateY(-3px) scale(1.01);
    }
    .btn-fab {
      box-shadow: 0 2px 8px rgba(59,130,246,0.15);
      transition: background 0.2s, transform 0.2s;
    }
    .btn-fab:hover {
      background: #2563eb;
      transform: scale(1.08);
    }
    .fade-in {
      animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
      from { opacity: 0;}
      to { opacity: 1;}
    }
    @media (max-width: 768px) {
      .desktop-table { display: none; }
    }
    @media (min-width: 769px) {
      .mobile-list { display: none; }
    }
  </style>
</head>
<body class="bg-slate-100 min-h-screen">

  <!-- Navbar -->
  <nav class="bg-blue-700 py-4 shadow-md">
    <div class="max-w-5xl mx-auto flex items-center justify-between px-4">
      <a href="{{ url('/') }}" class="text-white flex items-center gap-2 font-semibold text-lg">
        <i class="fa fa-home"></i>
        Home
      </a>
      <span class="text-white text-xl font-bold tracking-wide">Events Dashboard</span>
    </div>
  </nav>

  <main class="max-w-5xl mx-auto px-4 py-6">

    <!-- Search & Success Message -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">
      <form method="GET" action="{{ route('events.index') }}" class="w-full sm:w-1/2">
        <div class="relative">
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Find event by title or date..."
            class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-base"
          />
          <span class="absolute left-3 top-2.5 text-gray-400">
            <i class="fa fa-search"></i>
          </span>
        </div>
      </form>
      @if (session('success'))
        <div class="fade-in bg-green-50 text-green-700 px-4 py-2 rounded-md flex items-center gap-2">
          <i class="fa fa-check-circle"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif
    </div>

    <!-- Desktop Table -->
    <div class="desktop-table bg-white rounded-lg shadow overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-slate-100">
          <tr>
            <th class="py-3 px-4 text-left font-semibold text-slate-600">#</th>
            <th class="py-3 px-4 text-left font-semibold text-slate-600">Event</th>
            <th class="py-3 px-4 text-left font-semibold text-slate-600">Details</th>
            <th class="py-3 px-4 text-left font-semibold text-slate-600">Date</th>
            <th class="py-3 px-4 text-right font-semibold text-slate-600">Actions</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($events as $event)
          <tr class="border-b hover:bg-slate-50 transition">
            <td class="py-3 px-4 text-slate-400">{{ $loop->iteration }}</td>
            <td class="py-3 px-4 font-semibold text-slate-800">{{ $event->title }}</td>
            <td class="py-3 px-4 text-slate-600">{{ Str::limit($event->description, 60) }}</td>
            <td class="py-3 px-4 text-slate-500">
              <i class="fa fa-calendar-alt mr-1"></i>
              {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
            </td>
            <td class="py-3 px-4 text-right">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="inline-flex items-center gap-1 px-3 py-1.5 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 transition"
                 title="Edit">
                <i class="fa fa-edit"></i>
                <span class="hidden sm:inline">Edit</span>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded bg-red-100 text-red-700 hover:bg-red-200 transition ml-1"
                        title="Delete">
                  <i class="fa fa-trash"></i>
                  <span class="hidden sm:inline">Delete</span>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="py-8 text-center text-slate-400">
              <i class="fa fa-calendar-times text-3xl mb-2"></i>
              <div>No events available. Click the + button to add one.</div>
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <!-- Mobile Card List -->
    <div class="mobile-list space-y-4">
      @forelse ($events as $event)
        <div class="card-hover bg-white rounded-lg shadow p-4 fade-in">
          <div class="flex justify-between items-start">
            <div>
              <div class="font-bold text-slate-800 text-lg">{{ $event->title }}</div>
              <div class="text-slate-500 text-xs mt-1 flex items-center gap-1">
                <i class="fa fa-calendar-alt"></i>
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
              </div>
            </div>
            <div class="flex gap-2">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200"
                 title="Edit">
                <i class="fa fa-edit"></i>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200"
                        title="Delete">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </div>
          </div>
          @if($event->description)
            <div class="text-slate-600 text-sm mt-2">{{ Str::limit($event->description, 80) }}</div>
          @endif
        </div>
      @empty
        <div class="bg-slate-50 border border-dashed border-slate-200 rounded-lg py-8 text-center text-slate-400">
          <i class="fa fa-calendar-times text-3xl mb-2"></i>
          <div>No events found.</div>
        </div>
      @endforelse
    </div>
  </main>

  <!-- Floating Add Button -->
  <a href="{{ route('events.create') }}"
     class="btn-fab fixed bottom-6 right-6 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700"
     title="Add Event">
    <i class="fa fa-plus text-xl"></i>
    <span class="sr-only">Add Event</span>
  </a>

</body>
</html>
