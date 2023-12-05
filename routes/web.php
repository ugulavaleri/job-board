<?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\JobApplicationController;
    use App\Http\Controllers\JobController;
    use App\Http\Controllers\MyJobApplicationController;
    use App\Models\JobApplication;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => to_route('jobs.index'));

Route::resource('jobs', JobController::class)
    ->only(['index','show']);

// ეს იმიტორო რამე შეცდომა რო იყოს ლოგინის დროს, ლარაველი დეფაულტად
// არედაირექტებს login როუტზე.
Route::get('login', fn() => to_route('auth.create'));
Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

Route::get('logout', fn() => to_route('auth.destroy'));
Route::delete('auth',[AuthController::class,'destroy'])
    ->name('auth.destroy');

Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create','store']);
    Route::resource('my_job_applications', MyJobApplicationController::class)
        ->only(['index','destroy']);
});
