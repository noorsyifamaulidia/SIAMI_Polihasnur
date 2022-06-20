<?php

use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Audit\UnitIndex;
use App\Http\Livewire\Audit\AuditIndex;
use App\Http\Livewire\User\EditProfile;
use App\Http\Controllers\UnitController;
use App\Http\Livewire\Audit\JadwalIndex;
use App\Http\Livewire\Audit\AuditorIndex;
use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Audit\IndikatorIndex;
use App\Http\Controllers\AuditNoteController;
use App\Http\Controllers\AuditPlanController;
use App\Http\Controllers\AuditRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndicatorController;
use App\Http\Livewire\Audit\ResponsibleIndex;
use App\Http\Controllers\AuditTemuanController;
use App\Http\Controllers\AuditWorkStepController;
use App\Http\Controllers\EvaluasiAuditeeController;
use App\Http\Controllers\AuditRingkasanTemuanController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// middleware guest
Route::middleware('guest')->group(function() {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // logout
    Route::post('logout', LogoutController::class)->name('logout');

    Route::get('edit-profile', EditProfile::class)->name('edit.profile');

    // Audit Room
    Route::prefix('audit')->group(function() {
        Route::get('room/{id}', [AuditRoomController::class, 'index'])->name('audit.room.index');

        // Jadwal Visitasi
        Route::get('jadwal-visitasi/{id}', [AuditRoomController::class, 'jadwal_visitasi'])->name('audit.room.jadwal_visitasi');
        Route::post('jadwal-visitasi/{id}', [AuditRoomController::class, 'save_jadwal_visitasi']);

        // Evaluasi Auditee
        Route::prefix('auditee')->group(function() {
            Route::resource('audit.evaluasi', EvaluasiAuditeeController::class, [
                'as' => 'auditee'
            ])->only(['index', 'create', 'store']);
        });

        // Rencana Audit
        Route::resource('audit.plan', AuditPlanController::class, [
            'as' => 'auditor'
        ])->only(['index', 'create', 'store']);

        // Program Kerja Audit
        Route::resource('audit.workstep', AuditWorkStepController::class, [
            'as' => 'auditor'
        ])->only(['index', 'create', 'store']);

        // Catatan Audit
        Route::resource('audit.note', AuditNoteController::class, [
            'as' => 'auditor'
        ])->only(['index', 'create', 'store']);

        // Ringkasan Temuan Audit
        Route::resource('audit.ringkasan', AuditRingkasanTemuanController::class, [
            'as' => 'auditor'
        ])->only(['index', 'create', 'store']);

        // Temuan Audit
        Route::resource('audit.temuan', AuditTemuanController::class, [
            'as' => 'auditor'
        ])->only(['index', 'create', 'store']);

        // Evaluasi Auditee for auditor, upm
        Route::get('evaluasi-diri/{id}', [AuditRoomController::class, 'evaluasi'])->name('audit.room.evaluasi');
        Route::get('evaluasi-diri/{id}/detail/{unit_id}', [AuditRoomController::class, 'evaluasi_detail'])->name('audit.room.evaluasi.detail');
        
        // Temuan Audit
        Route::get('temuan-audit/{id}', [AuditRoomController::class, 'temuan'])->name('audit.room.temuan');

        // Approval (Persetujuan)
        Route::post('approval-form-audit', [AuditRoomController::class, 'approval'])->name('audit.room.approval.form');

        // Report PDF
        Route::get('report-evaluasi/{id}/{unit_id}', [ReportController::class, 'evaluasi'])->name('audit.report.evaluasi');
        Route::get('report-rencana-audit/{audit}', [ReportController::class, 'rencana_audit'])->name('audit.report.rencana-audit');
        Route::get('report-program-kerja/{audit}', [ReportController::class, 'program_kerja'])->name('audit.report.program-kerja');
        Route::get('report-catatan-audit/{audit}', [ReportController::class, 'catatan_audit'])->name('audit.report.catatan-audit');
        Route::get('report-ringkasan-temuan/{audit}', [ReportController::class, 'ringkasan_temuan'])->name('audit.report.ringkasan-temuan');
        Route::get('report-temuan-audit/{audit}', [ReportController::class, 'temuan_audit'])->name('audit.report.temuan-audit');
    });
});

Route::group(['middleware' => ['role:kepala upm']], function () {
    Route::resource('unit', UnitController::class);
    Route::resource('indicator', IndicatorController::class);

    // Route::resource('user', UserController::class);
    Route::get('pengguna', UserIndex::class)->name('user.index');

    // CRUD Audit
    Route::prefix('upm')->group(function() {
        Route::get('audit', AuditIndex::class)->name('audit.index');
        Route::get('audit/pengelolaan/{id}/auditee', UnitIndex::class)->name('audit.unit');
        Route::get('audit/pengelolaan/{id}/standar', IndikatorIndex::class)->name('audit.standar');
        Route::get('audit/pengelolaan/{id}/jadwal', JadwalIndex::class)->name('audit.jadwal');
        Route::get('audit/pengelolaan/{id}/auditor', AuditorIndex::class)->name('audit.auditor');
        Route::get('audit/pengelolaan/{id}/responsible', ResponsibleIndex::class)->name('audit.responsible');
    });
});