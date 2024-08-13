<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\{
    User_role,
    Admin_role,
    Super_admin_role
};
use App\Http\Controllers\{
    BarangayController,
    CityController,
    CivilStatusController,
    ContinentController,
    CountryController,
    EducationController,
    GenderController,
    IdController,
    ContractController,
    JobController,
    SubJobController,
    OwwaController,
    RelationController,
    ReligionController,
    ResidenceController,
    HouseholdController,
    PersonalController,
    PreviousController,
    NeedController,
    ApplicantController,
    HomeController,
    ReportController,
    TypeNeedController,
    ImportController
};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/get-countries-by-continent', [HomeController::class, 'getCountriesByContinent']);
Route::get('/get-countries/{continentId}', [PreviousController::class, 'getCountries'])->name('getCountries');
Route::get('/getJobType', [PreviousController::class, 'getJobType'])->name('getJobType');
Route::get('/get-sub-jobs/{jobId}', [PreviousController::class, 'getSubJobs'])->name('getSubJobs');

Route::get('/get-continents', function() {
    $continents = \App\Models\Continent::all();
    return response()->json($continents);
});


Route::middleware(['auth', User_role::class])->group(function() {
    Route::prefix('user')->name('user.')->group(function () {
        //home
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        //resource
        Route::resources([
            '/household' => HouseholdController::class,
            '/personal' => PersonalController::class,
            '/previous' => PreviousController::class,
            '/needs'=> NeedController::class,
        ]);
        
    });
});

Route::middleware(['auth', Admin_role::class])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        //home-dashboard
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('/home/applicantCount', [HomeController::class, 'getApplicantCount'])->name('home.applicantCount');
        Route::post('/ofw-count', [HomeController::class, 'getOFWCount'])->name('home.getOFWCount');
        Route::get('/geochart', [HomeController::class, 'showGeoChart']);

        //report-export
        Route::get('/report/export/country', [ReportController::class, 'countryExport'])->name('country.export');
        Route::get('/report/export/age', [ReportController::class, 'ageExcel'])->name('age.export');
        //report-count
        Route::post('/report/ageCount', [ReportController::class, 'getAgeCount'])->name('home.ageCount');
        Route::get('/country-count', [ReportController::class, 'getCountryCount'])->name('country.count');
        
        // resource
        Route::resources([
            '/barangay' => BarangayController::class,
            '/city' => CityController::class,
            '/civil' => CivilStatusController::class,
            '/continent' => ContinentController::class,
            '/country' => CountryController::class,
            '/contract' => ContractController::class,
            '/education' => EducationController::class,
            '/gender' => GenderController::class,
            '/identification' => IdController::class,
            '/job' => JobController::class,
            '/subjob' => SubJobController::class,
            '/owwa' => OwwaController::class,
            '/relation' => RelationController::class,
            '/religion' => ReligionController::class,
            '/residence' => ResidenceController::class,
            '/household' => HouseholdController::class,
            '/personal' => PersonalController::class,
            '/previous' => PreviousController::class,
            '/needs' => NeedController::class,
            '/need' => TypeNeedController::class,
            '/applicant' => ApplicantController::class,
            '/report' => ReportController::class,
            '/import' => ImportController::class,
        ]);

        //form-update
        Route::put('/applicant/{household}/household/update', [ApplicantController::class, 'houseUpdate'])
            ->name('applicant.houseUpdate');
        Route::put('/applicant/{need}/need/update', [ApplicantController::class, 'needUpdate'])
            ->name('applicant.needUpdate');

        //import
        Route::post('/import', [ImportController::class, 'userImport'])->name('archive.import');
    });
});

Route::middleware(['auth', Super_admin_role::class])->group(function() {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
});