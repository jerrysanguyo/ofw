<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\User_role;
use App\Http\Middleware\Admin_role;
use App\Http\Middleware\Super_admin_role;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CivilStatusController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\IdController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SubJobController;
use App\Http\Controllers\OwwaController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PreviousController;
use App\Http\Controllers\NeedController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TypeNeedController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', User_role::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');
        Route::resource('/household', HouseholdController::class);
        Route::resource('/personal', PersonalController::class);
        Route::resource('/previous', PreviousController::class);
        Route::resource('/needs', NeedController::class);
    });
});

Route::post('/get-countries-by-continent', [HomeController::class, 'getCountriesByContinent']);
// Route::get('/locations', [HomeController::class, 'fetchLocations'])->name('locations.fetch');
Route::get('/get-countries/{continentId}', [PreviousController::class, 'getCountries'])->name('getCountries');
Route::get('/getJobType', [PreviousController::class, 'getJobType'])->name('getJobType');

Route::get('/get-sub-jobs/{jobId}', [PreviousController::class, 'getSubJobs'])
        ->name('getSubJobs');
Route::get('/report/export', [ReportController::class, 'ageExcel'])
        ->name('age.export');
        
Route::get('/get-continents', function() {
    $continents = Continent::all();
    return response()->json($continents);
});

Route::middleware(['auth', Admin_role::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        // home
        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');
        Route::post('/home/applicantCount', [HomeController::class, 'getApplicantCount'])
            ->name('home.applicantCount');
        Route::post('/ofw-count', [HomeController::class, 'getOFWCount'])
            ->name('home.getOFWCount');
        Route::get('/geochart', [HomeController::class, 'showGeoChart']);
        // resource
        Route::resource('/barangay', BarangayController::class);
        Route::resource('/city', CityController::class);
        Route::resource('/civil', CivilStatusController::class);
        Route::resource('/continent', ContinentController::class);
        Route::resource('/country', CountryController::class);
        Route::resource('/contract', ContractController::class);
        Route::resource('/education', EducationController::class);
        Route::resource('/gender', GenderController::class);
        Route::resource('/identification', IdController::class);
        Route::resource('/job', JobController::class);
        Route::resource('/subjob', SubJobController::class);
        Route::resource('/owwa', OwwaController::class);
        Route::resource('/relation', RelationController::class);
        Route::resource('/religion', ReligionController::class);
        Route::resource('/residence', ResidenceController::class);
        Route::resource('/household', HouseholdController::class);
        Route::resource('/personal', PersonalController::class);
        Route::resource('/previous', PreviousController::class);
        Route::resource('/needs', NeedController::class);
        Route::resource('/need', TypeNeedController::class);
        Route::resource('/applicant', ApplicantController::class);
        Route::PUT('/applicant/{household}/household/update', [ApplicantController::class, 'houseUpdate'])
            ->name('applicant.houseUpdate');
        Route::PUT('/applicant/{need}/need/update', [ApplicantController::class, 'needUpdate'])
            ->name('applicant.needUpdate');
        // report
        Route::resource('/report', ReportController::class);
        Route::post('/report/ageCount', [ReportController::class, 'getAgeCount'])
            ->name('home.ageCount');
        // Route::post('/home/countryCount', [ReportController::class, 'getCountryCount'])
        //     ->name('home.countryCount');
        Route::get('/country-count', [ReportController::class, 'getCountryCount'])
            ->name('country.count');
    });
});

Route::middleware(['auth', Super_admin_role::class])->group(function() {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');
    });
});