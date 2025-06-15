<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Pemeriksaan Pasien') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk mencatat hasil pemeriksaan pasien dan memilih obat yang diberikan.') }}
                            </p>

                        </header>

                        <form class="mt-6" id="formPeriksa" action="{{route('dokter.memeriksa.update', $janjiPeriksa->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                            <div class="mb-3 form-group">
                                <label for="namaInput">Nama</label>
                                <input type="text" class="rounded form-control" id="editNamaInput" value="{{$janjiPeriksa->pasien->nama}}" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="tgl_periksa">Tanggal Periksa</label>
                                <input type="datetime-local" class="rounded form-control" id="edit_tgl_periksa" name="tgl_periksa" value="{{$janjiPeriksa->periksa->tgl_periksa}}" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="catatan">Catatan</label>
                                <textarea type="text" class="rounded form-control" id="edit_catatan" name="catatan" rows="3" placeholder="Catatan pemeriksaan">{{$janjiPeriksa->periksa->catatan}}</textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="edit_obat">Pilih Obat</label>
                                <select class="rounded form-control" id="edit_obat" name="obats[]" multiple onchange="hitungBiayaPeriksa()">
                                    @foreach ($obats as $obat)
                                        <option value="{{$obat->id}}" data-harga="{{$obat->harga}}" {{in_array($obat->id,$janjiPeriksa->periksa->detailPeriksas->pluck('id_obat')->toArray()) ? 'selected' : ''}} onchange="hitungBiayaPeriksa()">{{$obat->nama_obat}} - {{$obat->kemasan}} (Rp {{number_format($obat->harga, 0, ',', '.')}})</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk memilih lebih dari satu.</small>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="edit_biaya_periksa">Biaya Periksa (Rp)</label>
                                <input type="text" class="rounded form-control" id="edit_biaya_periksa" name="biaya_periksa" value="{{$janjiPeriksa->periksa->biaya_periksa}}" readonly>
                            </div>

                            <a type="button" href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="Update" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                        <script>
                            function hitungBiayaPeriksa() {
                                
                                const baseBiayaPeriksa = 150000;
                                let totalBiaya = baseBiayaPeriksa;
                                const select = document.getElementById('edit_obat');
                                const selectedOptions = Array.from(select.selectedOptions);

                                selectedOptions.forEach(option => {
                                    const harga = parseInt(option.getAttribute('data-harga'));
                                    totalBiaya += harga;
                                })

                                document.getElementById('edit_biaya_periksa').value = totalBiaya;
                            }
                        </script>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
