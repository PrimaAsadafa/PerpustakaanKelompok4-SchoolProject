<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        .book-button {
            background: #286650;
        }

        .gradient-background {
            background: #FEFFF6;
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-background border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-black">Admin Panel</h1>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.books.index')); ?>" 
                           class="border-black text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Kelola Buku
                        </a>
                        <a href="<?php echo e(route('admin.members.index')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Kelola Member
                        </a>
                        <a href="<?php echo e(route('home')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Lihat Website
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?php echo e(route('admin.books.create')); ?>" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white 
                            bg-gradient-to-r book-button
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Buku
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="rounded-lg bg-green-50 p-4 mb-6 animate-fadeIn">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            <?php echo e(session('success')); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Books Grid -->
        <div class="gradient-background rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Buku
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tahun Terbit
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-24 w-16 rounded-lg overflow-hidden bg-gray-100">
                                            <?php if($book->thumbnail_path): ?>
                                                <img class="h-24 w-16 object-cover" 
                                                     src="<?php echo e(asset('storage/' . $book->thumbnail_path)); ?>" 
                                                     alt="Thumbnail <?php echo e($book->judul); ?>">
                                            <?php else: ?>
                                                <div class="h-24 w-16 flex items-center justify-center">
                                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo e($book->judul); ?></div>
                                            <div class="text-sm text-gray-500 mt-1">
                                                <?php if($book->abstrak_text): ?>
                                                    <?php echo e(Str::limit($book->abstrak_text, 100)); ?>

                                                <?php elseif($book->abstrak_image_path): ?>
                                                    <span class="text-indigo-600">[Abstrak dalam bentuk gambar]</span>
                                                <?php else: ?>
                                                    <?php echo e(Str::limit($book->deskripsi, 100)); ?>

                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        <?php echo e($book->kategori === 'Fiksi' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                        <?php echo e($book->kategori === 'Non-Fiksi' ? 'bg-green-100 text-green-800' : ''); ?>

                                        <?php echo e($book->kategori === 'Pendidikan' ? 'bg-purple-100 text-purple-800' : ''); ?>

                                        <?php echo e($book->kategori === 'Sejarah' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                        <?php echo e($book->kategori === 'Teknologi' ? 'bg-indigo-100 text-indigo-800' : ''); ?>

                                        <?php echo e($book->kategori === 'Lainnya' ? 'bg-gray-100 text-gray-800' : ''); ?>">
                                        <?php echo e($book->kategori); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e($book->tahun_terbit); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="<?php echo e(route('admin.books.edit', $book)); ?>" 
                                           class="text-black-600 hover:text-black-900 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <form action="<?php echo e(route('admin.books.destroy', $book)); ?>" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada buku yang ditambahkan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\ASUS\Documents\Perpustakaan\resources\views/admin/books/index.blade.php ENDPATH**/ ?>