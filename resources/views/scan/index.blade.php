<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Presensi QR Scanner</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://unpkg.com/html5-qrcode"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-blue-50 min-h-screen flex flex-col">

  <!-- Navigation Bar -->
  <nav class="bg-blue-700 shadow text-white sticky top-0 z-20">
    <div class="max-w-4xl mx-auto flex items-center justify-between px-5 py-3">
      <a href="{{ url('/') }}" class="flex items-center space-x-2 hover:text-blue-200">
        <i class="fas fa-arrow-left"></i>
        <span class="font-semibold">Beranda</span>
      </a>
      <span class="text-lg font-bold tracking-wide">Presensi QR Scanner</span>
      <i class="fas fa-qrcode text-2xl"></i>
    </div>
  </nav>

  <!-- Main Section -->
  <section class="flex-grow flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-lg">

      @if(session('error'))
        <div class="mb-5 p-3 bg-red-200 border border-red-400 text-red-800 rounded-lg flex items-center">
          <i class="fas fa-exclamation-triangle mr-2"></i>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <h2 class="text-2xl font-bold text-blue-800 mb-3">Pemindaian QR Presensi</h2>
      <p class="mb-6 text-gray-600">Silakan pilih kamera dan mulai scan QR Code untuk presensi.</p>

      <div class="mb-5 flex items-center space-x-3">
        <select id="cameraSelect" class="flex-1 p-2 border border-gray-300 rounded focus:ring-blue-500">
          <option value="">Pilih Kamera</option>
        </select>
        <button type="button" onclick="toggleScan()" id="scanBtn"
          class="px-4 py-2 bg-blue-700 text-white rounded hover:bg-blue-800 flex items-center">
          <i class="fas fa-play mr-2"></i> <span id="scanBtnText">Mulai</span>
        </button>
      </div>

      <div id="reader" class="border-2 border-blue-400 rounded-lg bg-gray-100 w-full aspect-square flex items-center justify-center mb-4">
        <span class="text-gray-400 text-lg"><i class="fas fa-camera text-3xl"></i><br>Kamera belum aktif</span>
      </div>

      <div id="result" class="mb-6 p-3 bg-blue-100 border border-blue-300 rounded text-blue-700 text-center">
        <i class="fas fa-info-circle mr-1"></i>
        <span id="resultText">Menunggu scan QR Code...</span>
      </div>

      <form id="presenceForm" method="POST" action="{{ route('scan.process') }}" class="hidden">
        @csrf
        <input type="hidden" name="user_id" id="user_id" />
        <div class="mb-3">
          <label for="statusSelect" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
          <select id="statusSelect" name="status" required class="w-full p-2 border border-gray-300 rounded">
            <option value="hadir" selected>Hadir</option>
            <option value="izin">Izin</option>
            <option value="sakit">Sakit</option>
            <option value="tidak hadir">Tidak Hadir</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
          <textarea id="keterangan" name="keterangan" rows="2" class="w-full p-2 border border-gray-300 rounded" placeholder="Opsional"></textarea>
        </div>
        <button type="submit" class="w-full py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center justify-center">
          <i class="fas fa-check mr-2"></i> Simpan Presensi
        </button>
      </form>

    </div>
  </section>

  <script>
    let html5QrCode = null;
    let scanning = false;

    // Populate camera list
    Html5Qrcode.getCameras().then(cameras => {
      const select = document.getElementById('cameraSelect');
      if (!cameras.length) {
        select.innerHTML = '<option>Tidak ada kamera</option>';
        select.disabled = true;
      } else {
        cameras.forEach((cam, idx) => {
          const opt = document.createElement('option');
          opt.value = cam.id;
          opt.text = cam.label || `Kamera ${idx + 1}`;
          select.appendChild(opt);
        });
      }
    }).catch(() => {
      document.getElementById('cameraSelect').innerHTML = '<option>Gagal akses kamera</option>';
    });

    function toggleScan() {
      if (scanning) {
        stopScan();
      } else {
        startScan();
      }
    }

    function startScan() {
      const camId = document.getElementById('cameraSelect').value;
      if (!camId) {
        alert('Pilih kamera terlebih dahulu!');
        return;
      }
      document.getElementById('reader').innerHTML = '';
      html5QrCode = new Html5Qrcode('reader');
      scanning = true;
      document.getElementById('scanBtnText').innerText = 'Berhenti';
      document.getElementById('resultText').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memindai...';
      document.getElementById('presenceForm').classList.add('hidden');

      html5QrCode.start(
        camId,
        { fps: 10, qrbox: { width: 250, height: 250 } },
        qrText => onScanSuccess(qrText),
        () => {}
      ).catch(() => {
        scanning = false;
        document.getElementById('scanBtnText').innerText = 'Mulai';
        document.getElementById('resultText').innerText = 'Gagal memulai kamera';
      });
    }

    function stopScan() {
      if (html5QrCode && scanning) {
        html5QrCode.stop().then(() => {
          scanning = false;
          document.getElementById('scanBtnText').innerText = 'Mulai';
          document.getElementById('reader').innerHTML =
            '<span class="text-gray-400 text-lg"><i class="fas fa-camera text-3xl"></i><br>Kamera belum aktif</span>';
        });
      }
    }

    function onScanSuccess(decoded) {
      document.getElementById('resultText').innerHTML =
        '<i class="fas fa-check-circle text-green-600"></i> QR Code terdeteksi';
      document.getElementById('user_id').value = decoded;
      document.getElementById('presenceForm').classList.remove('hidden');
      stopScan();
    }

    window.addEventListener('beforeunload', () => {
      if (html5QrCode && scanning) html5QrCode.stop();
    });
  </script>
</body>
</html>
