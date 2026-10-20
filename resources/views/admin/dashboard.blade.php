@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Form Filter -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengaduan Masuk</h1>
        <form action="{{ route('admin.dashboard') }}" method="GET" class="flex gap-2">
            <select name="status" class="border-gray-300 rounded-md text-sm shadow-sm" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </form>
    </div>

    <!-- Kartu Statistik (Pastikan variabel dari AdminController sudah dikirim) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center border border-gray-100">
            <div class="w-14 h-14 rounded-lg bg-blue-100 text-blue-500 flex items-center justify-center text-2xl mr-4">
                <i class="fas fa-file-alt"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Pengaduan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $total ?? 0 }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center border border-gray-100">
            <div class="w-14 h-14 rounded-lg bg-yellow-100 text-yellow-500 flex items-center justify-center text-2xl mr-4">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Menunggu</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $menunggu ?? 0 }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm flex items-center border border-gray-100">
            <div class="w-14 h-14 rounded-lg bg-green-100 text-green-500 flex items-center justify-center text-2xl mr-4">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Selesai</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $selesai ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 border-b">
                <tr>
                    <th class="p-4">Pelapor</th>
                    <th class="p-4">Judul Pengaduan</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi / Tanggapan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $c)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-medium">{{ $c->user->name }}</td>
                    <td class="p-4">{{ $c->title }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded text-xs text-white font-semibold
                            {{ $c->status == 'Menunggu' ? 'bg-yellow-500' : ($c->status == 'Diproses' ? 'bg-blue-500' : 'bg-green-500') }}">
                            {{ $c->status }}
                        </span>
                    </td>
                    <td class="p-4">
                        <form action="{{ route('admin.update', $c->id) }}" method="POST" class="flex flex-col gap-2">
                            @csrf @method('PUT')
                            <select name="status" class="border p-1 text-sm rounded">
                                <option value="Menunggu" {{ $c->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diproses" {{ $c->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $c->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <input type="text" name="response" value="{{ $c->response }}" placeholder="Tulis tanggapan..." class="border p-1 text-sm rounded w-full">
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 text-xs rounded hover:bg-blue-600">Simpan</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection