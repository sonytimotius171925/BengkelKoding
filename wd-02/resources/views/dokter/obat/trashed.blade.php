<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat Terhapus') }}
                        </h2>

                        <div class="flex gap-2">
                            <a href="{{ route('dokter.obat.index') }}" class="btn btn-primary">Kembali ke Daftar Obat</a>
                        </div>
                    </header>

                    @if ($obatsTerhapus->isEmpty())
                        <p class="text-gray-600">Tidak ada data obat yang terhapus.</p>
                    @else
                        <table class="table mt-6 overflow-hidden rounded table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Kemasan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Tanggal Dihapus</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obatsTerhapus as $obat)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">{{ $loop->iteration }}</th>
                                        <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                                        <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                                        <td class="align-middle text-start">Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                                        <td class="align-middle text-start">{{ $obat->deleted_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
