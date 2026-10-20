<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto">
        <a href="{{ route('complaints.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Buat Pengaduan</a>
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr><th class="p-4">Judul</th><th class="p-4">Status</th><th class="p-4">Tanggapan Admin</th></tr>
                </thead>
                <tbody>
                    @foreach($complaints as $c)
                    <tr class="border-b">
                        <td class="p-4">{{ $c->title }}</td>
                        <td class="p-4">{{ $c->status }}</td>
                        <td class="p-4">{{ $c->response ?? 'Belum ditanggapi' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>