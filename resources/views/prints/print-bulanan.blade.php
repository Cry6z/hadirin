<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kehadiran Guru Bulanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @media print {
      body { margin: 0; font-size: 11pt; background: #fff; }
      .no-print { display: none !important; }
      .print-header { display: block !important; }
      .web-header { display: none; }
      table { width: 100%; border-collapse: collapse; }
      th, td { border: 1px solid #cbd5e1; padding: 6px 10px; }
      .print-header { margin-bottom: 18px; }
    }
    @page { size: A4; margin: 12mm; }
    .btn-action {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 7px 14px;
      border-radius: 5px;
      font-weight: 500;
      background: #2563eb;
      color: #fff;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-action:hover { background: #1d4ed8; }
    @media (max-width: 600px) {
      .btn-action span { display: none; }
      .btn-action { padding: 7px 10px; }
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen">

  <!-- Web Header -->
  <div class="web-header bg-white shadow no-print">
    <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <a href="{{ url('/') }}" class="text-gray-500 hover:text-gray-800" title="Kembali">
          <i class="fas fa-arrow-left"></i>
        </a>
        <span class="text-lg font-bold text-gray-800">Laporan Bulanan Kehadiran Guru</span>
      </div>
      <button onclick="window.print()" class="btn-action">
        <i class="fas fa-print"></i>
        <span>Cetak</span>
      </button>
    </div>
  </div>

  <!-- Print Header -->
  <div class="print-header hidden text-center">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 mx-auto mb-2">
    <div class="font-bold text-lg">SMK NEGERI 1 KOTA BENGKULU</div>
    <div class="text-xs">Jl. Jati No 41, Padang Jati, Ratu Samban, Bengkulu 38222</div>
    <div class="mt-3 text-base font-semibold">LAPORAN KEHADIRAN GURU BULANAN</div>
    <div class="text-blue-700 font-medium">{{ $month }}</div>
  </div>

  <main class="max-w-5xl mx-auto p-4">
    <div class="bg-white rounded shadow">
      <div class="p-4 border-b border-gray-200 no-print">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
          <div>
            <div class="text-lg font-semibold text-gray-800">Rekapitulasi Bulanan</div>
            <div class="text-gray-600 text-sm">SMKN 1 Kota Bengkulu</div>
            <div class="text-blue-700 font-medium text-sm">{{ $month }}</div>
          </div>
        </div>
      </div>
      <div class="p-4">
        <div class="overflow-x-auto">
          <table class="min-w-full bg-white">
            <thead class="bg-blue-50">
              <tr>
                <th class="text-xs font-bold text-gray-700 uppercase">No</th>
                <th class="text-xs font-bold text-gray-700 uppercase">Nama</th>
                <th class="text-xs font-bold text-gray-700 uppercase">Tanggal</th>
                <th class="text-xs font-bold text-gray-700 uppercase">Jam</th>
                <th class="text-xs font-bold text-gray-700 uppercase">Status</th>
                <th class="text-xs font-bold text-gray-700 uppercase">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @forelse($attendances as $i => $row)
              <tr class="even:bg-gray-50">
                <td class="text-center text-sm">{{ $i + 1 }}</td>
                <td class="text-sm">{{ $row->user->name }}</td>
                <td class="text-sm">{{ $row->scan_time->format('d/m/Y') }}</td>
                <td class="text-sm">{{ $row->scan_time->format('H:i') }}</td>
                <td class="text-sm">
                  @php
                    $color = match($row->status) {
                      'hadir' => 'bg-green-100 text-green-700',
                      'izin' => 'bg-blue-100 text-blue-700',
                      'sakit' => 'bg-yellow-100 text-yellow-700',
                      'tidak hadir' => 'bg-red-100 text-red-700',
                      default => 'bg-gray-100 text-gray-700'
                    };
                  @endphp
                  <span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">
                    {{ ucfirst($row->status) }}
                  </span>
                </td>
                <td class="text-sm">{{ $row->keterangan ?? '-' }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data kehadiran bulan ini.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        @if($attendances->count())
        <div class="mt-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-gray-50 p-3 rounded">
          <div class="text-sm text-gray-700">
            Total Data: <span class="font-bold">{{ $attendances->count() }}</span>
          </div>
          <div class="text-xs text-gray-500">
            Dicetak: {{ now()->format('d/m/Y H:i') }}
          </div>
        </div>
        @endif
      </div>
    </div>
  </main>

  <script>
    function beforePrint() {
      document.querySelector('.print-header').classList.remove('hidden');
    }
    function afterPrint() {
      document.querySelector('.print-header').classList.add('hidden');
    }
    if (window.matchMedia) {
      window.matchMedia('print').addEventListener('change', e => {
        if (e.matches) beforePrint(); else afterPrint();
      });
    }
    window.addEventListener('beforeprint', beforePrint);
    window.addEventListener('afterprint', afterPrint);
  </script>
</body>
</html>
