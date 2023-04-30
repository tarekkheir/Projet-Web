<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\PlanningController;
use App\Models\Planning;

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

Route::get('/', function () { return view('modele.main'); });
Route::view('/home','home')->middleware('auth')->name('home');

// ADMIN ROUTES
Route::get('/admin', [UserController::class, 'home'])->middleware('auth')->middleware('is_admin')->name('admin.home');
Route::get('/admin/listeFormation', [FormationController::class, 'liste'])->middleware('auth')->middleware('is_admin')->name('admin.listeFormation');
Route::get('/admin/createFormation', [FormationController::class, 'addForm'])->middleware('auth')->middleware('is_admin')->name('admin.addFormation');
Route::post('/admin/createFormation', [FormationController::class, 'store']);
Route::get('/admin/demandes', [UserController::class, 'demandes'])->middleware('auth')->middleware('is_admin')->name('admin.demandes');
Route::post('/admin/accepter', [UserController::class, 'updateType'])->name('admin.updateType');
Route::post('/admin/refuser/{id}', [UserController::class, 'delete'])->name('admin.deleteUser');
Route::get('/admin/listeCours', [CoursController::class, 'liste'])->middleware('auth')->middleware('is_admin')->name('admin.listeCours');
Route::get('/admin/createCours', [CoursController::class, 'addCours'])->middleware('auth')->middleware('is_admin')->name('admin.addCours');
Route::post('/admin/createCours', [CoursController::class, 'store']);
Route::post('/admin/supprimerCours/{id}', [CoursController::class, 'supprimer'])->middleware('auth')->middleware('is_admin')->name('admin.supprimerCours');
Route::get('/admin/modifier/{id}',[CoursController::class, 'edit'])->middleware('auth')->middleware('is_admin')->name('admin.edit');
Route::put('/admin/modifier/{id}', [CoursController::class, 'modifier'])->middleware('auth')->middleware('is_admin')->name('admin.modifier');
Route::post('/admin/supprimerFormation/{id}', [FormationController::class, 'supprimer'])->middleware('auth')->middleware('is_admin')->name('admin.supprimerFormation');
Route::get('/admin/modifierFormation/{id}',[FormationController::class, 'edit'])->middleware('auth')->middleware('is_admin')->name('admin.editFormation');
Route::put('/admin/modifierFormation/{id}', [FormationController::class, 'modifier'])->middleware('auth')->middleware('is_admin')->name('admin.modifierFormation');


// ENSEIGNANT ROUTE
Route::get('/enseignant', [UserController::class, 'home'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.home');
Route::get('/enseignant/listeCoursEnseignant/{id}', [CoursController::class, 'listeCoursEnseignant'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.listeCoursEnseignant');
Route::get('/enseignant/planning', [PlanningController::class, 'planning'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.planning');
Route::get('/enseignant/planning/ajouterUneSeance', [PlanningController::class, 'formAjouterUneSeance'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.ajouterUneSeance');
Route::post('/enseignant/planning/ajouterUneSeance', [PlanningController::class, 'ajouterUneSeance']);
Route::get('/enseignant/planningIntegral', [PlanningController::class, 'planningIntegralEnseignant'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.planningIntegral');
Route::get('/enseignant/planningCoursListe', [PlanningController::class, 'planningCoursListeEnseignant'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.planningCoursListe');
Route::get('/enseignant/planningCours/{id}', [PlanningController::class, 'planningCoursEnseignant'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.planningCours');
Route::get('/enseignant/planningSemaine', [PlanningController::class, 'planningSemaineEnseignant'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.planningSemaine');
Route::post('enseignant/supprimerCours/{id}', [PlanningController::class, 'supprimer'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.supprimer');
Route::get('/enseignant/modifier/{id}',[PlanningController::class, 'edit'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.edit');
Route::put('/enseignant/modifier/{id}', [PlanningController::class, 'modifier'])->middleware('auth')->middleware('is_enseignant')->name('enseignant.modifier');

// ETUDIANT ROUTE
Route::get('/etudiant', [UserController::class, 'home'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.home');
Route::get('/etudiant/listeCoursEtudiant/{id}', [CoursController::class, 'listeCoursEtudiant'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.listeCoursEtudiant');
Route::get('/etudiant/listeCoursFormation', [CoursController::class, 'listeCoursFormation'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.listeCoursFormation');
Route::get('/etudiant/inscription', [CoursController::class, 'formulaireInscription'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.inscription');
Route::post('/etudiant/inscription', [CoursController::class, 'inscription']);
Route::post('/etudiant/desinscription', [CoursController::class, 'desinscription'])->name('etudiant.desinscription');
Route::get('/etudiant/planningIntegral', [PlanningController::class, 'planningIntegral'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.planningIntegral');
Route::get('/etudiant/planningCoursListe', [PlanningController::class, 'planningCoursListe'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.planningCoursListe');
Route::get('/etudiant/planningCours/{id}', [PlanningController::class, 'planningCours'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.planningCours');
Route::get('/etudiant/planningSemaine', [PlanningController::class, 'planningSemaine'])->middleware('auth')->middleware('is_etudiant')->name('etudiant.planningSemaine');


// USER ROUTES
Route::get('/user', [UserController::class, 'home'])->middleware('auth')->middleware('is_user')->name('user.home');
Route::get('/user/updateName', [UserController::class, 'editName'])->middleware('auth')->name('user.updateName');
Route::put('/user/updateName', [UserController::class, 'updateName']);
Route::get('/user/updatePassword', [UserController::class, 'editPassword'])->middleware('auth')->name('user.updatePassword');
Route::put('/user/updatePassword', [UserController::class, 'updatePassword']);

// LOGIN ROUTES
Route::get('/login', [AuthenticatedSessionController::class,'showForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])->name('logout')->middleware('auth');


// REGISTER ROUTES
Route::get('/register', [RegisterUserController::class,'showForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterUserController::class,'store']);