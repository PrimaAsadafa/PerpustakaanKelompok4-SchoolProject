<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    </style>
</head>
<body class="min-h-screen gradient-background flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold bg-gradient-to-r text-black">
                    Register Member
                </h1>
                <p class="text-gray-700 mt-2">Bergabung dengan Perpustakaan Digital</p>
            </div>

            <form method="POST" action="<?php echo e(url('/register')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200"
                           required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200"
                           required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-200"
                           required>
                </div>

                <button type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r bg text-white rounded-xl transition-all duration-200 font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Register
                </button>

                <div class="text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="<?php echo e(route('login')); ?>" class="font-medium text-black">
                        Login disini
                    </a>

                    <div class="mt-2 text-center">
                        <a href="<?php echo e(route('home')); ?>" 
                        class="text-sm text-gray-600 hover:text-black transition-colors duration-300">
                        Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\ASUS\Documents\Perpustakaan\resources\views/auth/register.blade.php ENDPATH**/ ?>