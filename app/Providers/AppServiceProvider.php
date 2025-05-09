<?php

namespace App\Providers;

use App\Http\Responses\CustomLoginResponse;
use App\Http\Responses\CustomLogoutResponse;
use App\Models\CourseCategory;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(LogoutResponse::class, CustomLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'flash' => function () {
                return [
                    'success' => session('success'),
                    'error' => session('error'),
                ];
            },
        ]);

        Inertia::share('menuCourses', function () {
            return CourseCategory::with('courses.level')->get()->map(function ($category) {
                $levels = $category->courses
                    ->whereNotNull('level')
                    ->groupBy('course_level_id')
                    ->map(function ($courses) use ($category) {
                        $level = $courses->first()->level;
                        return [
                            'id' => $level->id,
                            'name' => $level->name,
                            'slug' => Str::slug($category->name) . '/' . Str::slug($level->name),
                        ];
                    })->values();

                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'children' => $levels,
                ];
            });
        });
    }
}
