<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>

        .bg{
            background: #286650;
        }
        .gradient-background {
            background: #FEFFF6;
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header with Hero Section -->
    <div class="gradient-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navigation -->
            <nav class="py-4">
                <div class="flex justify-between items-center">
                    <div class="text-2xl font-bold text-black ">Perpustakaan Digital</div>
                    <div class="flex gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" 
                               class="px-4 py-2 rounded-lg gradient-background text-black">
                                Dashboard Admin
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('member.dashboard')); ?>" 
                               class="px-4 py-2 rounded-lg gradient-background text-black">
                                Dashboard Member
                            </a>
                        <?php endif; ?>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                    class="px-4 py-2 rounded-lg bg text-white"> 
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" 
                           class="px-4 py-2 rounded-lg bg-white/20 text-black  hover:bg-white/30 transition-colors duration-300">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" 
                           class="px-4 py-2 rounded-lg bg text-white">
                            Register
                        </a>
                    <?php endif; ?>
                </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="py-16 text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-black  mb-6">
                    Jelajahi Dunia Pengetahuan
                </h1>
                <p class="text-lg md:text-xl text-black /80 mb-8">
                    Temukan ribuan buku digital untuk meningkatkan wawasan Anda
                </p>
                <div class="relative max-w-3xl mx-auto">
                    <form action="<?php echo e(route('home')); ?>" method="GET" class="flex gap-4">
                    </form>
                    <!-- Floating Decorative Elements -->
                    <div class="absolute -top-20 -left-20 w-40 h-40 bg-purple-400/30 rounded-full filter blur-3xl floating"></div>
                    <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-blue-400/30 rounded-full filter blur-3xl floating" style="animation-delay: -2s"></div>
                </div>
            </div>
        </div>
    </div>
                <div class="ml-8 gradient-background">
                <form action="<?php echo e(route('home')); ?>" method="GET">
                    <label for="kategori" class="mr-2 text-gray-600">Filter kategori:</label>
                    <select name="kategori" id="kategori" onchange="this.form.submit()"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua</option>
                        <option value="Fiksi" <?php echo e(request('kategori') === 'Fiksi' ? 'selected' : ''); ?>>Fiksi</option>
                        <option value="Non-Fiksi" <?php echo e(request('kategori') === 'Non-Fiksi' ? 'selected' : ''); ?>>Non-Fiksi</option>
                        <option value="Pendidikan" <?php echo e(request('kategori') === 'Pendidikan' ? 'selected' : ''); ?>>Pendidikan</option>
                        <option value="Sejarah" <?php echo e(request('kategori') === 'Sejarah' ? 'selected' : ''); ?>>Sejarah</option>
                        <option value="Teknologi" <?php echo e(request('kategori') === 'Teknologi' ? 'selected' : ''); ?>>Teknologi</option>
                    </select>
                </form>
                </div>

    <!-- Books Grid Section -->
    <div class="gradient-background max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <?php if($books->isEmpty()): ?>
            <div class="text-center py-12">
                <img src="https://illustrations.popsy.co/white/resistance-band.svg" 
                     alt="No results" class="w-48 h-48 mx-auto mb-6">
                <p class="text-gray-500 text-lg">Tidak ada buku yang ditemukan.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover cursor-pointer"
                         onclick="window.dispatchEvent(new CustomEvent('book-selected', { detail: <?php echo e($book->id); ?> }))">
                        <div class="aspect-w-3 aspect-h-4 relative overflow-hidden">
                            <?php if($book->thumbnail_path): ?>
                                <img src="<?php echo e(asset('storage/' . $book->thumbnail_path)); ?>" 
                                     alt="Cover <?php echo e($book->judul); ?>"
                                     class="w-full h-64 object-cover transform transition-transform duration-300 hover:scale-105">
                            <?php else: ?>
                                <div class="w-full h-64 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                                <div class="p-4 w-full text-center">
                                    <p class="text-white text-sm font-medium">Klik untuk detail</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2"><?php echo e($book->judul); ?></h3>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    <?php echo e($book->kategori === 'Fiksi' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                    <?php echo e($book->kategori === 'Non-Fiksi' ? 'bg-green-100 text-green-800' : ''); ?>

                                    <?php echo e($book->kategori === 'Pendidikan' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                    <?php echo e($book->kategori === 'Sejarah' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                    <?php echo e($book->kategori === 'Teknologi' ? 'bg-indigo-100 text-indigo-800' : ''); ?>

                                    <?php echo e($book->kategori === 'Lainnya' ? 'bg-gray-100 text-gray-800' : ''); ?>">
                                    <?php echo e($book->kategori); ?>

                                </span>
                                <p class="text-sm text-gray-600">Tahun: <?php echo e($book->tahun_terbit); ?></p>
                            </div>
                            <div class="mb-4">
                                    <p class="ml-2 text-sm text-gray-500 line-clamp-3">Penulis: <?php echo e($book->penulis); ?></p>
                                    <p class="ml-2 text-sm text-gray-500 line-clamp-3">Penerbit: <?php echo e($book->penerbit); ?></p>                                                                    
                            </div>
                            <div>
                            <p class="ml-2 text-sm text-gray-500 line-clamp-3">Deskripsi: <?php echo e($book->deskripsi); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Book Modal Component -->
    <?php echo $__env->make('partials.book-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH C:\Users\ASUS\Documents\Perpustakaan\resources\views/home.blade.php ENDPATH**/ ?>