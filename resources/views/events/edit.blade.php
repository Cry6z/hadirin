<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <title>Edit Event</title>
  <style>
    .form-input:focus {
      box-shadow: 0 0 0 2px #f59e42;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-orange-50 to-yellow-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-lg mx-auto">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-orange-200">
      <div class="bg-gradient-to-r from-orange-400 to-yellow-400 px-8 py-6 flex items-center gap-3">
        <a href="{{ route('events.index') }}" class="text-white hover:text-orange-900 transition-colors">
          <i class="fas fa-arrow-left"></i>
        </a>
        <span class="text-xl font-extrabold text-white tracking-wide">Edit Event</span>
      </div>
      <div class="px-8 py-8">

        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-400 rounded">
            <div class="flex items-center gap-2">
              <i class="fas fa-exclamation-triangle text-red-500"></i>
              <span class="font-semibold text-red-700">Please fix the following:</span>
            </div>
            <ul class="mt-2 text-red-700 text-sm list-disc pl-6">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-5">
          @csrf
          @method('PUT')

          <div>
            <label for="title" class="block text-sm font-semibold text-orange-700 mb-1">
              Title <span class="text-red-500">*</span>
            </label>
            <input 
              type="text" 
              name="title" 
              id="title" 
              value="{{ old('title', $event->title) }}"
              class="form-input w-full px-4 py-2 border border-orange-200 rounded-lg focus:ring-orange-400 focus:border-orange-400"
              placeholder="Event title"
              required
            >
          </div>

          <div>
            <label for="description" class="block text-sm font-semibold text-orange-700 mb-1">
              Description <span class="text-red-500">*</span>
            </label>
            <textarea 
              name="description" 
              id="description" 
              rows="3"
              class="form-input w-full px-4 py-2 border border-orange-200 rounded-lg focus:ring-orange-400 focus:border-orange-400"
              placeholder="Event description"
              required
            >{{ old('description', $event->description) }}</textarea>
          </div>

          <div>
            <label for="date" class="block text-sm font-semibold text-orange-700 mb-1">
              Date <span class="text-red-500">*</span>
            </label>
            <input 
              type="date" 
              name="date" 
              id="date" 
              value="{{ old('date', $event->date->format('Y-m-d')) }}"
              class="form-input w-full px-4 py-2 border border-orange-200 rounded-lg focus:ring-orange-400 focus:border-orange-400"
              required
            >
          </div>

          <div class="flex justify-between items-center pt-4 border-t border-orange-100">
            <a 
              href="{{ route('events.index') }}" 
              class="inline-flex items-center px-4 py-2 border border-orange-300 text-orange-700 bg-orange-50 rounded-lg hover:bg-orange-100 transition"
            >
              <i class="fas fa-times mr-2"></i> Cancel
            </a>
            <button 
              type="submit"
              class="inline-flex items-center px-5 py-2 bg-orange-500 text-white font-semibold rounded-lg shadow hover:bg-orange-600 transition"
            >
              <i class="fas fa-save mr-2"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
