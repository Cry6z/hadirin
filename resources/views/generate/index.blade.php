<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ID Anggota Generator</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
  <style>
    .btn-action {
      @apply px-3 py-1 rounded transition-colors;
    }
    .btn-action i {
      margin-right: 0.25rem;
    }
    .qr-thumb {
      width: 80px;
      height: 80px;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: auto;
    }
    .modal-bg {
      background: rgba(0,0,0,0.4);
      transition: opacity 0.2s;
    }
    .modal-bg.show {
      opacity: 1;
    }
    .modal-bg.hide {
      opacity: 0;
      pointer-events: none;
    }
    .modal-box {
      background: #fff;
      border-radius: 1rem;
      max-width: 22rem;
      margin: 2rem auto;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      transform: scale(0.95);
      opacity: 0;
      transition: all 0.2s;
    }
    .modal-bg.show .modal-box {
      transform: scale(1);
      opacity: 1;
    }
    @media (max-width: 640px) {
      .modal-box {
        padding: 1rem;
        max-width: 95vw;
      }
      .qr-thumb {
        width: 60px;
        height: 60px;
      }
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <nav class="bg-blue-700 py-4 shadow">
    <div class="max-w-5xl mx-auto flex items-center px-4">
      <a href="{{ url('/') }}" class="text-white hover:text-blue-200 mr-4">
        <i class="fas fa-arrow-left"></i>
      </a>
      <span class="text-white text-lg font-semibold">ID Anggota Generator</span>
    </div>
  </nav>

  <main class="max-w-5xl mx-auto mt-8 px-4">
    @if(session('success'))
      <div class="bg-green-200 text-green-900 px-4 py-2 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <section class="bg-white rounded shadow p-6 mb-8">
      <form action="{{ route('generate.id.process') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded font-semibold flex items-center gap-2">
          <i class="fas fa-plus-circle"></i>
          Buat ID Baru
        </button>
      </form>
    </section>

    <section class="bg-white rounded shadow overflow-hidden">
      <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 border-b gap-3">
        <h2 class="text-lg font-bold text-gray-800">Anggota Terdaftar</h2>
        <div class="relative w-full sm:w-64">
          <input type="text" id="searchInput" placeholder="Cari nama/email/ID..." class="w-full pl-9 pr-3 py-2 border rounded focus:ring-2 focus:ring-blue-400">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3">No</th>
              <th class="px-6 py-3">Nama</th>
              <th class="px-6 py-3 hidden md:table-cell">Email</th>
              <th class="px-6 py-3">ID</th>
              <th class="px-6 py-3">QR</th>
              <th class="px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr class="border-t hover:bg-gray-50">
              <td class="px-6 py-3">{{ $loop->iteration }}</td>
              <td class="px-6 py-3">
                <span class="font-medium">{{ $user->name }}</span>
                <div class="md:hidden text-xs text-gray-500">{{ $user->email }}</div>
              </td>
              <td class="px-6 py-3 hidden md:table-cell text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-3">
                @if($user->user_id)
                  <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">{{ $user->user_id }}</span>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>
              <td class="px-6 py-3">
                @if($user->user_id)
                  <div class="qr-thumb" id="qr-{{ $user->user_id }}">
                    {!! DNS2D::getBarcodeSVG($user->user_id, 'QRCODE', 3, 3) !!}
                  </div>
                @else
                  <span class="text-gray-300">-</span>
                @endif
              </td>
              <td class="px-6 py-3 text-right">
                @if($user->user_id)
                  <button class="btn-action bg-blue-50 text-blue-700 hover:bg-blue-100 mr-1"
                    onclick="openQRModal('{{ $user->user_id }}', '{{ $user->name }}')"
                    title="Lihat QR">
                    <i class="fas fa-qrcode"></i>Lihat
                  </button>
                  <button class="btn-action bg-green-50 text-green-700 hover:bg-green-100"
                    onclick="downloadQR('{{ $user->user_id }}', '{{ $user->name }}')"
                    title="Unduh QR">
                    <i class="fas fa-download"></i>Unduh
                  </button>
                @else
                  <span class="text-gray-300">-</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <!-- Modal -->
  <div id="qrModal" class="fixed inset-0 flex items-center justify-center z-50 modal-bg hide">
    <div class="modal-box relative">
      <button onclick="closeQRModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
      <h3 class="text-lg font-bold mb-2" id="modalName">Nama Anggota</h3>
      <div class="flex flex-col items-center">
        <canvas id="modalQRCanvas" width="180" height="180" class="mb-4"></canvas>
        <div class="bg-gray-100 rounded px-3 py-2 mb-3">
          <span class="text-xs text-gray-500">ID:</span>
          <span class="font-semibold text-blue-700" id="modalUserId">USRXXX</span>
        </div>
        <button id="modalDownloadBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded flex items-center gap-2">
          <i class="fas fa-download"></i>Unduh QR
        </button>
      </div>
    </div>
  </div>
  <canvas id="qrCanvas" style="display:none;"></canvas>

  <script>
    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
      const val = this.value.toLowerCase();
      document.querySelectorAll('tbody tr').forEach(row => {
        const tds = row.querySelectorAll('td');
        const name = tds[1].textContent.toLowerCase();
        const email = tds[2] ? tds[2].textContent.toLowerCase() : '';
        const id = tds[3].textContent.toLowerCase();
        row.style.display = (name.includes(val) || email.includes(val) || id.includes(val)) ? '' : 'none';
      });
    });

    // Modal logic
    function openQRModal(userId, name) {
      document.getElementById('modalName').textContent = name;
      document.getElementById('modalUserId').textContent = userId;
      const canvas = document.getElementById('modalQRCanvas');
      makeQR(canvas, userId, 180);
      document.getElementById('modalDownloadBtn').onclick = function() {
        downloadQR(userId, name);
      };
      const modal = document.getElementById('qrModal');
      modal.classList.remove('hide');
      setTimeout(() => modal.classList.add('show'), 10);
    }
    function closeQRModal() {
      const modal = document.getElementById('qrModal');
      modal.classList.remove('show');
      setTimeout(() => modal.classList.add('hide'), 200);
    }
    document.getElementById('qrModal').addEventListener('click', function(e) {
      if (e.target === this) closeQRModal();
    });
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeQRModal();
    });

    // QR code generator
    function makeQR(canvas, text, size) {
      const qr = qrcode(0, 'L');
      qr.addData(text);
      qr.make();
      const ctx = canvas.getContext('2d');
      canvas.width = canvas.height = size;
      ctx.fillStyle = '#fff';
      ctx.fillRect(0, 0, size, size);
      ctx.fillStyle = '#222';
      const cell = size / qr.getModuleCount();
      for (let r = 0; r < qr.getModuleCount(); r++) {
        for (let c = 0; c < qr.getModuleCount(); c++) {
          if (qr.isDark(r, c)) ctx.fillRect(c * cell, r * cell, cell, cell);
        }
      }
    }

    // Download QR
    function downloadQR(userId, name) {
      const canvas = document.getElementById('qrCanvas');
      makeQR(canvas, userId, 400);
      const url = canvas.toDataURL('image/png');
      const a = document.createElement('a');
      a.href = url;
      a.download = `${name.replace(/\s+/g, '_')}_${userId}_qr.png`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }
  </script>
</body>
</html>
