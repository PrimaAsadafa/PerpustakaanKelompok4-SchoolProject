<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        .logout-button {
            background: #286650;
        }

        .gradient-background {
            background: #FEFFF6;
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        .gradient-text {
            background: linear-gradient(to right, #4F46E5, #7C3AED);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-gradient {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>


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
                           class="border-transparent text-gray-500 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.books.index')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Kelola Buku
                        </a>
                        <a href="<?php echo e(route('admin.members.index')); ?>"
                           class="border-black text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Kelola Member
                        </a>
                        <a href="<?php echo e(route('home')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Lihat Website
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white logout-button">
                            Logout
                            <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


<div class=".gradient-background container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Daftar Member</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">No</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Tanggal Register</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                        <td class="px-4 py-2"><?php echo e($member->email); ?></td>
                        <td class="px-4 py-2"><?php echo e($member->created_at->format('d/m/Y H:i')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($members->isEmpty()): ?>
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center">Belum ada member terdaftar</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->startSection('content'); ?>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\ASUS\Documents\Perpustakaan\resources\views/admin/members/index.blade.php ENDPATH**/ ?>