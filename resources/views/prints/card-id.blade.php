<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kartu Identitas Anggota</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
    body { font-family: 'Montserrat', sans-serif; background: #f1f5f9; }
    @media print {
      body { background: #fff; }
      .no-print, .print-hide { display: none !important; }
      .card-id { box-shadow: none !important; border: 1px solid #d1d5db !important; }
      @page { margin: 8mm; }
    }
    .card-id {
      background: linear-gradient(120deg, #e0f2fe 0%, #f0fdf4 100%);
      border-radius: 1rem;
      border: 1px solid #d1d5db;
      box-shadow: 0 4px 16px rgba(0,0,0,0.07);
      transition: box-shadow 0.2s;
      margin-bottom: 1.5rem;
    }
    .card-id:hover { box-shadow: 0 8px 32px rgba(16,185,129,0.13); }
    .card-header {
      background: linear-gradient(90deg, #0ea5e9 0%, #22d3ee 100%);
      height: 10px;
      border-radius: 1rem 1rem 0 0;
    }
    .qr-box {
      background: #fff;
      border-radius: 0.5rem;
      border: 1px solid #d1d5db;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 0.5rem;
    }
    .user-info p { margin: 0; }
    .select-checkbox { accent-color: #0ea5e9; }
    .footer-note { font-size: 11px; color: #64748b; }
    @media (max-width: 600px) {
      .card-id { max-width: 95vw; margin-left: auto; margin-right: auto; }
    }
  </style>
</head>
<body>
  <!-- Navigation/Header -->
  <nav class="bg-white shadow print-hide">
    <div class="max-w-4xl mx-auto flex items-center justify-between px-4 py-3">
      <a href="{{ url('/') }}" class="text-sky-600 hover:text-sky-800 flex items-center gap-2">
        <i class="fas fa-arrow-left"></i>
        <span class="font-semibold">Beranda</span>
      </a>
      <h2 class="text-lg font-bold text-gray-700">Cetak Kartu Identitas</h2>
    </div>
  </nav>

  <main class="max-w-4xl mx-auto px-4 py-6">
    <!-- Top Controls -->
    <section class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col sm:flex-row justify-between items-center gap-3 print-hide">
      <div>
        <div class="text-xl font-bold text-gray-800 mb-1">Daftar Kartu Anggota</div>
        <div class="text-gray-500 text-sm">Tanggal cetak: <span id="print-date">{{ date('d-m-Y H:i') }}</span></div>
        <div class="text-xs text-gray-400 mt-1">Jumlah anggota: <span id="user-count">{{ count($users) }}</span></div>
      </div>
      <div class="flex gap-2 flex-wrap">
        <button onclick="window.print()" class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded transition flex items-center gap-2">
          <i class="fas fa-print"></i> Cetak Semua
        </button>
        <button onclick="printCheckedCards()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded transition flex items-center gap-2">
          <i class="fas fa-print"></i> Cetak Pilihan
        </button>
        <button onclick="toggleAllCheckboxes()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded transition flex items-center gap-2" id="toggle-all-btn">
          <i class="fas fa-check-square"></i> Pilih Semua
        </button>
      </div>
    </section>

    <!-- Cards List -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
      @forelse($users as $user)
      <div class="card-id print:break-inside-avoid">
        <div class="card-header"></div>
        <div class="p-5 flex flex-col gap-3">
          <div class="flex items-center gap-3 mb-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 rounded-full shadow">
            <div>
              <div class="font-bold text-gray-800 text-base">{{ $user->name }}</div>
              <div class="text-xs text-gray-500">SMKN 1 Kota Bengkulu</div>
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-4 items-center">
            <div class="qr-box" id="qr-{{ $user->id }}"></div>
            <div class="user-info text-sm text-gray-700 flex-1">
              <p><span class="font-semibold">ID:</span> <span class="font-mono">{{ $user->user_id }}</span></p>
              @if($user->gender)
                <p><span class="font-semibold">Gender:</span> {{ $user->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
              @endif
              @if($user->class)
                <p><span class="font-semibold">Kelas:</span> {{ $user->class }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between px-5 py-2 border-t border-gray-200 bg-gray-50">
          <div class="flex items-center gap-2 print-hide">
            <input type="checkbox" class="select-checkbox h-4 w-4" data-id="{{ $user->id }}">
            <span class="text-xs text-gray-500">Pilih</span>
          </div>
          <div class="footer-note">#{{ $user->id }} | {{ date('Y') }}</div>
        </div>
      </div>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          new QRCode(document.getElementById("qr-{{ $user->id }}"), {
            text: "{{ $user->user_id }}",
            width: 90,
            height: 90,
            colorDark: "#0f172a",
            colorLight: "#fff",
            correctLevel: QRCode.CorrectLevel.M
          });
        });
      </script>
      @empty
      <div class="col-span-full text-center py-10 text-gray-400">
        <i class="fas fa-users-slash fa-3x mb-3"></i>
        <div class="text-lg font-semibold">Tidak ada anggota ditemukan</div>
        <div class="text-sm">Belum ada data anggota untuk dicetak.</div>
      </div>
      @endforelse
    </section>
  </main>

  <script>
    // Update print date
    function updatePrintDate() {
      const now = new Date();
      const opts = { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' };
      document.getElementById('print-date').textContent = now.toLocaleDateString('id-ID', opts);
    }
    document.addEventListener('DOMContentLoaded', function() {
      updatePrintDate();
      setInterval(updatePrintDate, 60000);
    });

    // Toggle all checkboxes
    function toggleAllCheckboxes() {
      const checkboxes = document.querySelectorAll('.select-checkbox');
      const allChecked = Array.from(checkboxes).every(cb => cb.checked);
      checkboxes.forEach(cb => cb.checked = !allChecked);
      const btn = document.getElementById('toggle-all-btn');
      btn.querySelector('i').className = allChecked ? 'fas fa-check-square' : 'fas fa-times-circle';
      btn.childNodes[1].textContent = allChecked ? ' Pilih Semua' : ' Batal Pilih';
    }

    // Print only checked cards
    function printCheckedCards() {
      const checked = Array.from(document.querySelectorAll('.select-checkbox:checked'));
      if (checked.length === 0) {
        alert('Pilih minimal satu kartu untuk dicetak.');
        return;
      }
      const cards = document.querySelectorAll('.card-id');
      const original = Array.from(cards).map(card => card.style.display);
      cards.forEach(card => card.style.display = 'none');
      checked.forEach(cb => {
        const card = cb.closest('.card-id');
        if (card) card.style.display = 'block';
      });
      setTimeout(() => {
        window.print();
        setTimeout(() => {
          cards.forEach((card, i) => card.style.display = original[i]);
        }, 400);
      }, 150);
    }
  </script>
</body>
</html>
