<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ExpertProfileController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\QueryReplyController;
use App\Http\Controllers\QueryController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('landingpage');
});

// Route::get('/home', function () {
//     return view('homepage');
// })->middleware(['auth'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    // Route::get('/expert/dashboard', function () {
    //     return view('expert.dashboard');
    // })->name('expert.dashboard');

    // Route::get('/expert/dashboard', [CropController::class, 'index'])->name('expert.dashboard');

    Route::get('/expert/dashboard', [DiseaseController::class, 'index'])
    ->name('expert.dashboard');

    // Route::get('/farmer/dashboard', function () {
    //     return view('farmer.dashboard');
    // })->name('farmer.dashboard');


Route::get('/farmer/dashboard', [FarmerController::class, 'dashboard'])
    ->middleware('auth')
    ->name('farmer.dashboard');

});

Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::patch('/admin/experts/{id}/approve', [AdminController::class, 'approveExpert'])->name('admin.experts.approve');
Route::patch('/admin/experts/{id}/reject', [AdminController::class, 'rejectExpert'])->name('admin.experts.reject');
Route::delete('/admin/users/{id}', [AdminController::class, 'Userdestroy'])->name('admin.users.destroy');

// Route::prefix('admin')->group(function () {
//     Route::resource('crops', AdminController::class);
// });

// Route::middleware(['auth'])->group(function () {
//     Route::resource('diseases', DiseaseController::class);
// });

Route::prefix('expert')->middleware(['auth'])->group(function () {
    Route::resource('crops', CropController::class);
    Route::resource('diseases', DiseaseController::class);
});

Route::get('/common-diseases', [DiseaseController::class, 'commonDiseases'])->name('common.diseases');
// Route::get('/diseases/{id}', [DiseaseController::class, 'show'])->name('diseases.show');
Route::get('/disease-identification', [DiseaseController::class, 'identify'])
     ->name('disease.identification');

// Route::post('/disease-identification', [DiseaseController::class, 'process'])
//      ->name('disease.identification.process');


// Route::post('/expert/diagnose/{id}', [DiseaseController::class, 'diagnose'])
//     ->name('expert.diagnose');


Route::post('/disease-identification', [DiseaseController::class, 'process'])
    ->middleware('auth')
    ->name('disease.identification.process');

Route::post('/expert/diagnose/{plantImageId}', [DiseaseController::class, 'diagnose'])
    ->middleware('auth')
    ->name('expert.diagnose');

Route::get('/prediction/{plantImageId}', [DiseaseController::class, 'showPrediction'])
    ->middleware('auth')
    ->name('prediction.show');

Route::get('/weather/today', [HomeController::class, 'today'])->name('weather.today');


Route::get('/set-location', [HomeController::class, 'setLocation']);

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search');

use App\Http\Controllers\SuccessStoryController;
Route::prefix('farmer')->group(function () {
    Route::get('/stories/create', [SuccessStoryController::class, 'create'])->name('farmer.stories.create');
    Route::post('/stories', [SuccessStoryController::class, 'store'])->name('farmer.stories.store');
    Route::post('/stories/{id}/like', [SuccessStoryController::class, 'like'])
     ->middleware('auth')
     ->name('stories.like');
    Route::post('/stories/{id}/unlike', [SuccessStoryController::class, 'unlike'])
      ->middleware('auth')
      ->name('stories.unlike');

});


use App\Http\Controllers\ExpertController;
Route::patch('/expert/stories/{story}/approve', [ExpertController::class, 'approve'])
    ->name('expert.stories.approve');

Route::patch('/expert/stories/{story}/reject', [ExpertController::class, 'reject'])
    ->name('expert.stories.reject');

Route::post('/farmer/logout', [AuthenticatedSessionController::class, 'farmerLogout'])
    ->middleware('auth')
    ->name('farmer.logout');

Route::get('/resources', [ResourceController::class, 'index'])
    // ->middleware('auth')
    ->name('resources.index');

Route::resource('resources', ResourceController::class);

Route::post('/crop/recommend', [CropController::class, 'recommend'])->name('crop.recommend');

Route::middleware(['auth'])->group(function () {
    Route::post('/consult/pay', [PaymentController::class, 'initiate'])->name('consult.pay');
    Route::get('/consult/success', [PaymentController::class, 'success'])->name('consult.success');
});

Route::put('/farmer/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('farmer.profile.update');

Route::get('/set-location', [ProfileController::class, 'setLocation']);

Route::middleware(['auth'])->group(function () {
    Route::put('/expert/profile/update', [ExpertProfileController::class, 'update'])
        ->name('expert.profile.update');
});

Route::get('/experts', [ExpertProfileController::class, 'index'])->name('experts.index');
Route::get('/experts/{id}', [ExpertProfileController::class, 'show'])->name('expert.show');

Route::get('/consultation/book/{expert}', [ConsultationController::class, 'create'])
    ->name('consultation.book');
Route::post('/consultation/book/{expert}', [ConsultationController::class, 'store'])
    ->name('consultation.store');

Route::delete('/consultations/{id}/cancel', [ConsultationController::class, 'cancel'])
    ->name('consultation.cancel');

Route::post('/payment/initiate/{expert}', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

use App\Http\Controllers\RefundController;

Route::post('/consultations/{id}/refund', [RefundController::class, 'requestRefund'])
     ->name('refund.request');

// Farmer submits a query
Route::post('/queries', [QueryController::class, 'store'])->name('queries.store');

// Expert replies to a query
Route::post('/queries/{query}/reply', [QueryReplyController::class, 'store'])->name('queries.reply');

Route::get('/expert/queries', [ExpertController::class, 'queries'])
     ->name('expert.queries')
     ->middleware('auth');

Route::get('/farmer/queries', [FarmerController::class, 'queries'])
     ->name('farmer.queries')
     ->middleware('auth');
