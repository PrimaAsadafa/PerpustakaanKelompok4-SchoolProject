        <?php

        use App\Http\Controllers\Auth\LoginRegisterController;
        use App\Http\Controllers\Admin\BookController as AdminBookController;
        use App\Http\Controllers\Admin\MemberController as AdminMemberController;
        use App\Http\Controllers\BookController;
        use App\Http\Controllers\HomeController;
        use App\Http\Controllers\MemberController;
        use Illuminate\Support\Facades\Route;

        // Public Routes
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');
        Route::get('/book/{id}/read', [BookController::class, 'read'])->name('books.read');
        Route::get('/book/{id}/pdf', [BookController::class, 'viewPdf'])->name('books.view-pdf');

        // Auth Routes (pakai LoginRegisterController)
        Route::middleware('guest')->group(function () {
            Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
            Route::post('/login', [LoginRegisterController::class, 'authenticate'])->name('login.attempt');
            
            // Register Routes
            Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
            Route::post('/register', [LoginRegisterController::class, 'store'])->name('register.attempt');
        });

        // Member Routes
        Route::middleware(['auth', 'role:member'])->group(function () {
            Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
        });

        // Logout pakai LoginRegisterController
        Route::post('/logout', [LoginRegisterController::class, 'logout'])
            ->name('logout')
            ->middleware('auth');

        // Admin Routes
        Route::middleware(['auth', 'role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(function () {
                Route::get('/', function () {
                    return redirect()->route('admin.dashboard');
                });

                Route::get('/dashboard', function () {
                    return view('admin.dashboard');
                })->name('dashboard');

                Route::resource('books', AdminBookController::class);
                Route::get('/members', [AdminMemberController::class, 'index'])->name('members.index');
            });
