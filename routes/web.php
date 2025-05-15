<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CourseRegistrationController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\TeacherDashboardController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryMediaController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\Course;
use App\Models\User;
use App\Notifications\NewCourseNotification;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses/{categorySlug}', [CourseController::class, 'byCategory'])->name('courses.byCategory');
Route::get('/courses/{categorySlug}/{levelSlug}', [CourseController::class, 'byCategoryAndLevel'])->name('courses.byCategoryAndLevel');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/evenements', [EventController::class, 'index'])->name('events');
Route::get('/evenements/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/inscription', [InscriptionController::class, 'index'])->name('inscription');
Route::get('/gallery', [GalleryMediaController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogPostController::class, 'show'])->name('blog.show');
Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.message');
Route::post('/inscription/message', [MessageController::class, 'store'])->name('inscription.message');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('/chat/create-session', [ChatController::class, 'createSession'])->name('chat.createSession');
Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/legal-notice', fn() => Inertia::render('LegalNotice'));
Route::get('/privacy-policy', fn() => Inertia::render('PrivacyPolicy'));
Route::get('/terms-of-use', fn() => Inertia::render('TermsOfUse'));
Route::get('/cookie-policy', fn() => Inertia::render('CookiePolicy'));
// 🔑 Google OAuth login
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');


Route::middleware(['auth'])->group(function () {
    Route::post('/courses/{course}/register', [CourseRegistrationController::class, 'store'])
        ->name('courses.register');

    Route::delete('/courses/{course}/register', [CourseRegistrationController::class, 'destroy'])
        ->name('courses.unregister');
    Route::post('/blog/{post}/comment', [BlogCommentController::class, 'store'])->name('blog.comment');
    Route::post('/like/toggle', [LikeController::class, 'toggle'])->name('like.toggle');
});

// 🔁 Редирект после логина по ролям
Route::middleware(['auth'])->get('/redirect', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    }

    if ($user->role === 'teacher') {
        return redirect()->route('dashboard.teacher');
    }

    return redirect()->route('dashboard.user');
});


// 🛡 Панель администратора
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->group(function () {

        // Главная страница админки
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

        // Пользователи (CRUD)
        Route::controller(AdminDashboardController::class)->prefix('/users')->group(function () {
            Route::post('/', 'store')->name('admin.users.store');
            Route::put('/{user}', 'update')->name('admin.users.update');
            Route::delete('/{user}', 'destroy')->name('admin.users.destroy');
        });

        // Курсы (CRUD)
        Route::resource('/courses', AdminCourseController::class)
            ->only(['store', 'update', 'destroy'])
            ->names('admin.courses');

        // События (CRUD)
        Route::resource('/events', EventController::class)
            ->except(['show', 'create', 'edit'])
            ->names('admin.events');

        // Галерея
        Route::get('/gallery', [GalleryMediaController::class, 'index'])->name('admin.gallery');
        Route::post('/gallery', [GalleryMediaController::class, 'store'])->name('admin.gallery.store');
        Route::delete('/gallery/{media}', [GalleryMediaController::class, 'destroy'])->name('admin.gallery.destroy');

        // Блог (CRUD)
        Route::post('/blog', [BlogPostController::class, 'store'])->name('admin.blog.store');
        Route::put('/blog/{post}', [BlogPostController::class, 'update'])->name('admin.blog.update');
        Route::delete('/blog/{post}', [BlogPostController::class, 'destroy'])->name('admin.blog.destroy');

        Route::delete('/chats/{chatSession}', [ChatController::class, 'destroy'])->name('admin.chats.destroy');
    });


// 🧑‍🏫 Панель преподавателя
// Route::middleware(['auth', RoleMiddleware::class . ':teacher'])
//     ->get('/dashboard/teacher', [TeacherDashboardController::class, 'index'])
//     ->name('dashboard.teacher');

// Route::middleware(['auth', RoleMiddleware::class . ':teacher'])
//     ->prefix('teacher')
//     ->group(function () {
//         Route::post('/courses', [TeacherDashboardController::class, 'store'])->name('teacher.courses.store');
//         Route::put('/courses/{course}', [TeacherDashboardController::class, 'update'])->name('teacher.courses.update');
//         Route::delete('/courses/{course}', [TeacherDashboardController::class, 'destroy'])->name('teacher.courses.destroy');
//     });
Route::middleware(['auth', RoleMiddleware::class . ':teacher'])
    ->prefix('teacher')
    ->group(function () {

        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])
            ->name('dashboard.teacher');

        Route::post('/courses', [TeacherDashboardController::class, 'storeCourse'])
            ->name('teacher.courses.store');
        Route::put('/courses/{course}', [TeacherDashboardController::class, 'updateCourse'])
            ->name('teacher.courses.update');
        Route::delete('/courses/{course}', [TeacherDashboardController::class, 'destroyCourse'])
            ->name('teacher.courses.destroy');

        Route::post('/events', [TeacherDashboardController::class, 'storeEvent'])->name('teacher.events.store');
        Route::put('/events/{event}', [TeacherDashboardController::class, 'updateEvent'])->name('teacher.events.update');
        Route::delete('/events/{event}', [TeacherDashboardController::class, 'destroyEvent'])->name('teacher.events.destroy');
    });
// 👤 Панель пользователя
Route::middleware(['auth', RoleMiddleware::class . ':user,teacher'])
    ->group(function () {
        Route::get('/dashboard/user', [UserDashboardController::class, 'index'])->name('dashboard.user');
        Route::put('/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/dashboard/user/chats/{chatSession}', [UserDashboardController::class, 'destroy'])
            ->name('user.chats.destroy');
    });
