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
                           class="border-black text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.books.index')); ?>" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                <div class="flex items-center">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white logout-button  
                                       focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-300">
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

    <!-- Main Content -->
    <div class="gradient-background max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                <div class="bg-white p-8">
                    <h2 class="text-3xl font-bold text-black mb-2">Selamat Datang di Panel Admin</h2>
                    <p class="text-black">Kelola konten perpustakaan digital dengan mudah dan efisien</p>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Books Card -->
            <div class="bg-white overflow-hidden rounded-2xl shadow-xl card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg">
                            <svg enable-background="new 0 0 64 64" height="34px" id="Layer_1" version="1.1" viewBox="0 0 64 64" width="34px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M62.869,16.842h-0.057c-1.096,0.007-1.266-0.945-1.285-1.387V8.542c0-0.738-0.598-1.336-1.334-1.336H40.428  c-4.959,0-6.809,1.838-7.268,2.415l-0.126,0.175l-0.001,0.003l-0.391,0.536c-0.001,0-0.001,0-0.001,0  c-0.525,0.721-0.982,0.414-1.202,0.178l-0.748-0.933l-0.37-0.446c-0.622-0.653-2.243-1.928-5.456-1.928H3.808  c-0.738,0-1.336,0.598-1.336,1.336v6.825c0,1.195-0.649,1.435-1.047,1.475H1.129c-0.324,0.02-1.078,0.208-1.078,1.595v32.529  c0,0.798,0.647,1.444,1.445,1.444h19.218c6.131,0,8.803,2.312,9.604,3.199l0.457,0.566h0.001c0,0,1.226,1.387,2.518,0l0,0  l0.268-0.314v0.001l0.004-0.003l0.342-0.4c0.01-0.012,0.092-0.104,0.211-0.226c1.023-0.995,3.58-2.823,8.58-2.823h19.805  c0.799,0,1.445-0.646,1.445-1.444V18.122C63.949,16.946,63.098,16.848,62.869,16.842z M58.551,45.862  c0,0.641-0.535,1.158-1.201,1.158H41.055c-5.799,0-7.904,2.62-7.904,2.62l-0.267,0.358l-0.125,0.173c-0.001,0-0.001,0-0.001,0  c-0.553,0.751-1.366,0.006-1.37,0.002l-0.375-0.469c-0.278-0.334-2.408-2.685-7.563-2.685h-16.8c-0.663,0-1.199-0.518-1.199-1.158  V11.199c0-0.64,0.536-1.158,1.199-1.158h13.043c9.702,0,10.621,5.511,10.684,7.112v24.106c0,1.752,0.835,2.081,1.306,2.129h0.701  c0.48-0.048,1.243-0.333,1.243-1.7V16.842h-0.008c0.072-2.005,0.854-6.802,6.689-6.802H57.35c0.666,0,1.201,0.518,1.201,1.158  V45.862z" fill="#241F20"/></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Buku</dt>
                                <dd class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\Book::count()); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <a href="<?php echo e(route('admin.books.index')); ?>" 
                           class="font-medium text-black inline-flex items-center">
                            Lihat semua buku
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Members Card -->
            <div class="bg-white overflow-hidden rounded-2xl shadow-xl card-hover">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg">
                            <svg class="feather feather-user" fill="none" height="34" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="34" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Member</dt>
                                <dd class="text-3xl font-bold text-gray-900"><?php echo e(\App\Models\User::where('role', 'member')->count()); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <a href="<?php echo e(route('admin.members.index')); ?>" 
                           class="font-medium text-black inline-flex items-center">
                            Lihat semua member
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white overflow-hidden rounded-2xl shadow-xl card-hover mt-5 sm:mt-0">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    <a href="<?php echo e(route('admin.books.create')); ?>" 
                       class="inline-flex items-center w-full px-4 py-2 logout-button
                              text-white text-sm font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 
                              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                              transition-all duration-300">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Buku Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\ASUS\Documents\Perpustakaan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>