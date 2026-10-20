<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Masyarakat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Buat Pengaduan -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-700">Riwayat Pengaduan Anda</h3>
                <a href="{{ route('complaints.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Buat Pengaduan Baru
                </a>
            </div>

            <!-- Tabel Riwayat Pengaduan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-3">Judul</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Tanggapan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $c)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 font-medium">{{ $c->title }}</td>
                                <td class="p-3">{{ $c->created_at->format('d M Y') }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs text-white rounded 
                                        {{ $c->status == 'Menunggu' ? 'bg-yellow-500' : ($c->status == 'Diproses' ? 'bg-blue-500' : 'bg-green-500') }}">
                                        {{ $c->status }}
                                    </span>
                                </td>
                                <td class="p-3 text-sm text-gray-600">
                                    {{ $c->response ?? 'Belum ada tanggapan' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">Anda belum pernah membuat pengaduan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>