<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturesDossierController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DossiersController;
use App\Http\Controllers\anneedossierController;
use App\Http\Controllers\TransporteurController;
use App\Http\Controllers\TransitaireAlgController;
use App\Http\Controllers\TransitaireTangerController;
use App\Http\Controllers\NoteDebitDossierController;

// Him
Route::get('/', [
    App\Http\Controllers\DashboardController::class, 'index'
])->name('dashboard');

Route::resource('permissions', App\Http\Controllers\PermissionController::class);
Route::post('permissions/loadFromRouter', [App\Http\Controllers\PermissionController::class, 'LoadPermission'])->name('permissions.load-router');

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::get('profile', [App\Http\Controllers\UserController::class, 'showProfile'])->name('users.profile');
Route::patch('profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('users.updateProfile');
Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('attendances', App\Http\Controllers\AttendanceController::class);

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('generator_builder.index');
Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('generator_builder.field_template');
Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('generator_builder.relation_field_template');
Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('generator_builder.generate');
Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('generator_builder.rollback');
Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('generator_builder.from_file');

Route::resource('fileUploads', App\Http\Controllers\FileUploadController::class);

// Me
Route::resource('dossiers', DossiersController::class);
Route::get('/index-cloture', [DossiersController::class, 'indexCloture'])->name('index-cloture');
Route::get('/index-valide', [DossiersController::class, 'indexValide'])->name('index-valide');
Route::get('/show-valide/{id}', [DossiersController::class, 'showValide'])->name('show-valide');
Route::put('/dossiers/{id}/update-validation', [DossiersController::class, 'updateValidation'])->name('dossiers.update-validation');
Route::put('/dossiers/{id}/update-etat', [DossiersController::class, 'updateEtat'])->name('dossiers.update-etat');
Route::get('/export-dossiers', [DossiersController::class, 'export'])->name('export-dossiers');
Route::get('/export-dossiers-clotures', [DossiersController::class, 'exportCloture'])->name('export-dossiers-clotures');
Route::get('/imprimer-merged/{id}', [DossiersController::class, 'imprimerMerged'])->name('imprimer-merged');
Route::get('/dossiers/show-uploads/{id}', [DossiersController::class, 'showUploads'])->name('dossiers.show-uploads');
Route::post('/upload', [DossiersController::class, 'upload'])->name('upload');
Route::delete('/delete-file/{id}', [DossiersController::class, 'deleteFile'])->name('delete-file');
Route::post('/update-file-order', [DossiersController::class, 'updateFileOrder'])->name('update-file-order');

Route::resource('anneedossiers', anneedossierController::class);

Route::resource('clients', ClientsController::class);
Route::get('/getClientsBySociete/{societeId}', [ClientsController::class, 'getClientsBySociete'])->name('getClientsBySociete');

Route::resource('transporteurs', TransporteurController::class);
Route::resource('transitaireAlgs', TransitaireAlgController::class);
Route::resource('transitaireTangers', TransitaireTangerController::class);

Route::resource('facturesDossiers', FacturesDossierController::class);
Route::get('/index-non-facturer', [FacturesDossierController::class, 'indexNonFacturer'])->name('index-non-facturer');
Route::get('/facturesDossiers/create-facture/{id}', [FacturesDossierController::class, 'createFacture'])->name('facturesDossiers.create-facture');
Route::post('/store-facture/{id}', [FacturesDossierController::class, 'storeFacture'])->name('store-facture');
Route::put('/facturesDossiers/{id}/update-paiement', [FacturesDossierController::class, 'updatePaiement'])->name('facturesDossiers.update-paiement');
Route::put('/facturesDossiers/{id}/update-validation', [FacturesDossierController::class, 'updateValidation'])->name('facturesDossiers.update-validation');
Route::get('/imprimer-facture/{id}', [FacturesDossierController::class, 'imprimer'])->name('imprimer-facture');
Route::get('/download-facture/{id}', [FacturesDossierController::class, 'download'])->name('download-facture');
Route::get('/export-factures', [FacturesDossierController::class, 'export'])->name('export-factures');

Route::resource('noteDebitDossiers', NoteDebitDossierController::class);
Route::get('/index-non-debiter', [NoteDebitDossierController::class, 'indexNonDebiter'])->name('index-non-debiter');
Route::get('/noteDebitDossiers/create-debit/{id}', [NoteDebitDossierController::class, 'createDebit'])->name('noteDebitDossiers.create-debit');
Route::post('/store-debit/{id}', [NoteDebitDossierController::class, 'storeDebit'])->name('store-debit');
Route::put('/noteDebitDossiers/{id}/update-paiement', [NoteDebitDossierController::class, 'updatePaiement'])->name('noteDebitDossiers.update-paiement');
Route::put('/noteDebitDossiers/{id}/update-validation', [NoteDebitDossierController::class, 'updateValidation'])->name('noteDebitDossiers.update-validation');
Route::get('/imprimer-note-debit/{id}', [NoteDebitDossierController::class, 'imprimer'])->name('imprimer-note-debit');
Route::get('/download-note-debit/{id}', [NoteDebitDossierController::class, 'download'])->name('download-note-debit');
Route::get('/export-notes-debit', [NoteDebitDossierController::class, 'export'])->name('export-notes-debit');

Route::resource('historiques', App\Http\Controllers\HistoriqueController::class);
