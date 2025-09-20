<style>
    .bg{
        background: #286650;
    }
</style>

<div id="bookModal" class="hidden" role="dialog" aria-modal="true" aria-labelledby="bookTitle">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.querySelector('#bookModal');
            if (!modal) return;

            const thumbnail = document.querySelector('#bookThumbnail');
            const noThumbnail = document.querySelector('#noThumbnail');
            const titleEl = document.querySelector('#bookTitle');
            const kategoriEl = document.querySelector('#bookKategori');
            const yearEl = document.querySelector('#bookYear');
            const penerbitEl = document.querySelector('#bookPenerbit');
            const penulisEl = document.querySelector('#bookPenulis');
            const descriptionEl = document.querySelector('#bookDescription');
            const abstrakEl = document.querySelector('#abstrakText');
            const readBtn = document.querySelector('#readBookBtn');

            let currentBookId = null;

            window.addEventListener('book-selected', async function(event) {
                currentBookId = String(event.detail ?? '');
                if (!currentBookId) return;

                try {
                    const resp = await fetch('/book/' + encodeURIComponent(currentBookId));
                    if (!resp.ok) throw new Error('HTTP status ' + resp.status);
                    const data = await resp.json();

                    // show modal
                    modal.classList.remove('hidden');

                    // populate basic fields (safe assignment with nullish coalescing)
                    if (titleEl) titleEl.textContent = data.judul ?? '–';
                    if (kategoriEl) kategoriEl.textContent = data.kategori ?? 'Lainnya';
                    if (yearEl) yearEl.textContent = data.tahun_terbit ?? '–';
                    if (descriptionEl) descriptionEl.textContent = data.deskripsi ?? '–';
                    if (readBtn && data.read_url) readBtn.href = data.read_url;

                    // penerbit & penulis
                    if (penerbitEl) {
                        if (data.penerbit) {
                            penerbitEl.textContent = data.penerbit;
                            penerbitEl.classList.remove('hidden');
                        } else {
                            penerbitEl.textContent = '';
                            penerbitEl.classList.add('hidden');
                        }
                    }
                    if (penulisEl) {
                        if (data.penulis) {
                            penulisEl.textContent = data.penulis;
                            penulisEl.classList.remove('hidden');
                        } else {
                            penulisEl.textContent = '';
                            penulisEl.classList.add('hidden');
                        }
                    }

                    // Handle abstrak
                    if (abstrakEl) {
                        if (data.abstrak_text) {
                            abstrakEl.textContent = data.abstrak_text;
                            abstrakEl.classList.remove('hidden');
                        } else {
                            abstrakEl.textContent = '';
                            abstrakEl.classList.add('hidden');
                        }
                    }

                    // Update kategori class (badge)
                    if (kategoriEl) {
                        const base = 'px-2 py-1 text-xs font-medium rounded-full ';
                        const cls =
                            (data.kategori === 'Fiksi' ? 'bg-blue-100 text-blue-800' :
                            data.kategori === 'Non-Fiksi' ? 'bg-green-100 text-green-800' :
                            data.kategori === 'Pendidikan' ? 'bg-purple-100 text-purple-800' :
                            data.kategori === 'Sejarah' ? 'bg-yellow-100 text-yellow-800' :
                            data.kategori === 'Teknologi' ? 'bg-indigo-100 text-indigo-800' :
                            'bg-gray-100 text-gray-800');
                        kategoriEl.className = base + cls;
                    }

                    // Thumbnail / fallback
                    if (thumbnail && noThumbnail) {
                        if (data.thumbnail_path) {
                            // jika backend mengembalikan path relatif ke /storage, sesuaikan di server atau ubah di sini:
                            // thumbnail.src = '/storage/' + data.thumbnail_path;
                            thumbnail.src = data.thumbnail_path;
                            thumbnail.classList.remove('hidden');
                            noThumbnail.classList.add('hidden');
                        } else {
                            thumbnail.classList.add('hidden');
                            noThumbnail.classList.remove('hidden');
                        }
                    }
                } catch (err) {
                    console.error('Gagal memuat data buku:', err);
                    // opsi: tampilkan pesan error kecil di modal atau toast
                }
            });

            function closeModal() {
                modal.classList.add('hidden');
            }

            const closeBtn = document.querySelector('#closeModal');
            if (closeBtn) closeBtn.addEventListener('click', closeModal);

            const backdrop = document.querySelector('#modalBackdrop');
            if (backdrop) backdrop.addEventListener('click', closeModal);
        });
    </script>

    <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-black/75 backdrop-blur-sm" id="modalBackdrop"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl ease-out duration-300">
                <!-- Close Button -->
                <button id="closeModal"
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-10">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Content -->
                <div class="relative">
                    <div class="flex flex-col md:flex-row">
                        <!-- Thumbnail -->
                        <div class="md:w-1/2 relative">
                            <!-- tambahkan hidden awal supaya gambar kosong tidak terlihat -->
                            <img id="bookThumbnail" class="w-full h-full object-cover hidden" alt="Cover buku">
                            <div id="noThumbnail" class="hidden">
                                <div class="w-full h-[400px] bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="md:w-1/2 p-8">
                            <h3 id="bookTitle" class="text-2xl font-bold text-gray-900 mb-4"></h3>

                            <div class="flex items-center gap-3 mb-4">
                                <span id="bookKategori"></span>
                                <span class="text-gray-600">
                                    <span class="font-semibold">Tahun:</span>
                                    <span id="bookYear"></span>
                                </span>
                            </div>

                            <div class="mb-4">
                                <span class="text-gray-600 font-semibold">Penerbit:</span>
                                <span id="bookPenerbit"></span><br>
                                <span class="text-gray-600 font-semibold">Penulis:</span>
                                <span id="bookPenulis"></span>
                            </div>

                            <div class="prose max-w-none mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Sinopsis:</h4>
                                <p id="abstrakText" class="text-gray-600"></p>
                            </div>

                            <div class="prose max-w-none mb-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi:</h4>
                                <p id="bookDescription" class="text-gray-600"></p>
                            </div>

                            <div class="space-y-4">
                                <a id="readBookBtn" href="#"
                                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium 
                                          rounded-xl text-white bg transition-all duration-300 
                                          transform hover:scale-105 shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Baca Buku
                                </a>

                                <!-- (sisa tombol login/pinjam tidak diubah) -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
