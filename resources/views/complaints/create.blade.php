<x-app-layout>
    <div class="py-12 max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Buat Pengaduan</h2>
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block font-bold">Judul</label>
                    <input type="text" name="title" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Isi Laporan</label>
                    <textarea name="content" class="w-full border p-2 rounded" rows="4" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-bold">Foto Bukti</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim</button>
            </form>
        </div>
    </div>
</x-app-layout>