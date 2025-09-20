<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - Perpustakaan Digital</title>
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
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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
    <nav class="gradient-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-black">Member Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-black">
                        Beranda
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="logout-button px-4 py-2 rounded-lg text-white">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Card -->
        <div class="bg-black rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-8 bg-white">
                <h2 class="text-3xl font-bold text-black mb-2">Selamat Datang,</h2>
                <p class="text-black">Jelajahi koleksi buku digital kami yang lengkap</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Books Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Total Buku</h3>
                        <div class="bg-indigo-500 text-white p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-4">{{ \App\Models\Book::count() }}</p>
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-black inline-flex items-center font-medium">
                        Lihat Semua Buku
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Profil Saya</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">Email</label>
                            <p class="text-gray-900 font-medium">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Member Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
