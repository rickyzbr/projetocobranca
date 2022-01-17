<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContactsClientController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ReleasesController;
use App\Http\Controllers\ReleasesGraphicsController;
use App\Http\Controllers\ReleasesClientController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReleasesAgreementsController;
use App\Http\Controllers\ReleasesUsersController;
use App\Http\Controllers\ReleasesManagerController;
use App\Http\Controllers\ShedulleChargesController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\NegotiationsController;

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

Route::get('/', [HomeController::class, 'index'] )->middleware('auth');

//Rotas Para Home Dashboard

Route::get('/dashboard', [HomeController::class, 'index'] )->middleware('auth');

//Rotas Para Gerenciamento dos Clientes
Route::get('clientes', [ClientsController::class, 'index'] )->name('clients.index')->middleware('auth');
Route::get('clientes/create', [ClientsController::class, 'create'] )->name('client.create')->middleware('auth');
Route::post('clientes', [ClientsController::class, 'store'] )->name('client.store')->middleware('auth');
Route::get('clientes/edit/{id}', [ClientsController::class, 'edit'] )->name('client.edit')->middleware('auth');
Route::put('clientes/{id}', [ClientsController::class, 'update'] )->name('client.update')->middleware('auth');
Route::delete('clientes/{id}', [ClientsController::class, 'destroy'] )->name('client.destroy')->middleware('auth');
Route::get('clientes/view/{id}',[ClientsController::class, 'show'] )->name('client.show')->middleware('auth');
Route::any('clientes/search', [ClientsController::class, 'searchClient'] )->name('client.search')->middleware('auth');


//Links para Vincular contatos ao cliente
Route::get('clientes/{id}/contatos', [ContactsClientController::class, 'index'] )->name('client.contacts')->middleware('auth');
Route::post('clientes/contatos/{id}', [ContactsClientController::class, 'store'] )->name('clientcontact.store')->middleware('auth');
Route::put('clientes/contatos/{id}/edit', [ContactsClientController::class, 'edit'])->name('clientcontact.edit')->middleware('auth');
Route::post('clientes/{id}/update',[ContactsClientController::class, 'update'])->name('clientcontact.update')->middleware('auth');
Route::post('clientes/contatos', [ContactsClientController::class, 'store'])->name('clientcontact.store')->middleware('auth');
Route::get('clientes/contatos/{id}/delete', [ContactsClientController::class, 'destroy'])->name('clientcontact.delete')->middleware('auth');

//Links para Vincular Sócios ao cliente
Route::get('clientes/{id}/socios', [PartnersController::class, 'index'] )->name('client.partners')->middleware('auth');
Route::post('clientes/socios/{id}', [PartnersController::class, 'store'] )->name('partners.store')->middleware('auth');
Route::put('clientes/socios/{id}/edit', [PartnersController::class, 'edit'])->name('partners.edit')->middleware('auth');
Route::post('clientes/{id}/update',[PartnersController::class, 'update'])->name('partners.update')->middleware('auth');
Route::post('clientes/socios', [PartnersController::class, 'store'])->name('partners.store')->middleware('auth');
Route::get('clientes/socios/{id}/delete', [PartnersController::class, 'destroy'])->name('partners.delete')->middleware('auth');
Route::get('socios', [PartnersController::class, 'list'])->name('partners.list')->middleware('auth');

//Links para Vincular Sócios ao cliente
Route::get('clientes/{id}/lancamentos', [ReleasesClientController::class, 'index'] )->name('client.releases')->middleware('auth');

//Kinks para cadastrar Cargo 
Route::post('clientes/cargos/', [CargoController::class, 'store'] )->name('cargo.store')->middleware('auth');

//Links para Vincular Anexos ao cliente
Route::get('clientes/{id}/anexos', [AttachmentsClientsController::class, 'index'] )->name('client.attachments');
Route::post('clientes/{id}/file_upload', [AttachmentsClientsController::class, 'uploadFiles'])->name('client.uploadFiles');

//Rotas Para Gerenciamento dos Lançamentos
Route::get('cobranca/lancamentos', [ReleasesController::class, 'index'] )->name('releases.index')->middleware('auth');
Route::get('cobranca/lancamentos/create', [ReleasesController::class, 'create'] )->name('release.create')->middleware('auth');
Route::post('cobranca/lancamentos', [ReleasesController::class, 'store'] )->name('release.store')->middleware('auth');
Route::get('cobranca/lancamentos/edit/{id}', [ReleasesController::class, 'edit'] )->name('release.edit')->middleware('auth');
Route::put('cobranca/lancamentos/{id}', [ReleasesController::class, 'update'] )->name('release.update')->middleware('auth');
Route::delete('cobranca/lancamentos/{id}', [ReleasesController::class, 'destroy'] )->name('release.destroy')->middleware('auth');
Route::get('cobranca/lancamentos/view/{id}',[ReleasesController::class, 'show'] )->name('release.show')->middleware('auth');
Route::any('cobranca/lancamentos/search', [ReleasesController::class, 'searchClient'] )->name('releases.search')->middleware('auth');
Route::post('cobranca/update-status/', [ReleasesController::class, 'update_status'] )->name('release.status')->middleware('auth');

//Rotas para gerenciar os lançamentos
Route::get('cobranca/lancamentos/gerenciar', [ReleasesManagerController::class, 'index'] )->name('releases.manager.index')->middleware('auth');
Route::get('cobranca/lancamentos/{id}/gerenciar', [ReleasesManagerController::class, 'manager'] )->name('releases.manager.list')->middleware('auth');
Route::get('cobranca/socio/{id}/lancamentos', [ReleasesManagerController::class, 'listOfParners'] )->name('releases.manager.list_partner')->middleware('auth');
Route::get('cobranca/lancamentos/{id}/vizualizar', [ReleasesManagerController::class, 'show'] )->name('releases.manager.view')->middleware('auth');
Route::post('cobranca/lancamentos/update-assigned/', [ReleasesManagerController::class, 'update_assigned'] )->name('release.assigned')->middleware('auth');
Route::post('cobranca/lancamentos/update-partner/', [ReleasesManagerController::class, 'update_partner'] )->name('release.partner')->middleware('auth');

//Rotas para Gerenciamento das Cobraças dos usuários
Route::get('minhascobrancas', [ReleasesUsersController::class, 'index'] )->name('releasesuser.index')->middleware('auth');
Route::get('minhascobrancas/{id}/listar', [ReleasesUsersController::class, 'list'] )->name('releasesuser.list')->middleware('auth');
Route::post('minhascobrancas/{id}/listar', [ReleasesUsersController::class, 'charge_store'] )->name('charge.store')->middleware('auth');
Route::post('minhascobrancas/{id}/agendar', [ReleasesUsersController::class, 'charge_schedule'] )->name('charge.schedule')->middleware('auth');
Route::get('minhascobrancas/{id}/cobranças', [ReleasesUsersController::class, 'charges'] )->name('releasesuser.charges')->middleware('auth');
Route::get('minhascobrancas/{id}/historico', [ReleasesUsersController::class, 'historic'] )->name('releasesuser.historic')->middleware('auth');
Route::get('minhascobrancas/{id}/gerenciar', [ReleasesUsersController::class, 'manage'] )->name('releasesuser.manage')->middleware('auth');
Route::post('minhascobrancas/{id}/simular', [ReleasesUsersController::class, 'simulation'] )->name('releasesuser.simulation')->middleware('auth');
Route::post('minhascobrancas/update-status/', [ReleasesUsersController::class, 'update_status'] )->name('releasesuser.status')->middleware('auth');

//Rotas para Agendamento de Cobranças
Route::get('minhascobrancas/agendamentos', [ShedulleChargesController::class, 'index'] )->name('schedules.index')->middleware('auth');

//Rotas para Negociações de Cobranças
Route::get('minhascobrancas/negociacoes', [NegotiationsController::class, 'index'] )->name('negotiations.index')->middleware('auth');


//Rotas Para gerenciamento de negociação de Contratos
Route::get('cobranca/contratos/', [ReleasesAgreementsController::class, 'index'] )->name('agreements.index')->middleware('auth');
Route::get('cobranca/contratos/{id}/create', [ReleasesAgreementsController::class, 'create'] )->name('agreement.create')->middleware('auth');
Route::get('cobranca/contratos/{id}/view', [ReleasesAgreementsController::class, 'view'] )->name('agreement.view')->middleware('auth');
Route::post('cobranca/contratos/review', [ReleasesAgreementsController::class, 'simulation'] )->name('agreement.postsimulation')->middleware('auth');
Route::get('cobranca/contratos/teste', [ReleasesAgreementsController::class, 'simulation'] )->name('agreement.simulation')->middleware('auth');
Route::post('cobranca/contratos/{id}/post', [ReleasesAgreementsController::class, 'store'] )->name('agreement.store')->middleware('auth');


Route::get('cobranca/graphics', [ReleasesGraphicsController::class, 'index'] )->name('release.graphics')->middleware('auth');

//Rotas Para Gerenciamento dos Catagorias dos Produtos
Route::get('categorias', [CategoriesController::class, 'index'] )->name('categories.index')->middleware('auth');
Route::get('categorias/create', [CategoriesController::class, 'create'] )->name('category.create')->middleware('auth');
Route::post('categorias', [CategoriesController::class, 'store'] )->name('category.store')->middleware('auth');
Route::get('categorias/edit/{id}', [CategoriesController::class, 'edit'] )->name('category.edit')->middleware('auth');
Route::put('categorias/{id}', [CategoriesController::class, 'update'] )->name('category.update')->middleware('auth');
Route::delete('categorias/{id}', [CategoriesController::class, 'destroy'] )->name('category.destroy')->middleware('auth');
Route::get('categorias/view/{id}',[CategoriesController::class, 'show'] )->name('category.show')->middleware('auth');
Route::any('categorias/search', [CategoriesController::class, 'searchCategories'] )->name('category.search')->middleware('auth');
Route::delete('categorias/delete-categories/', [CategoriesController::class, 'destroy'] )->name('categories.multipledelete')->middleware('auth');
Route::post('categorias/update-status/', [CategoriesController::class, 'update_status'] )->name('categories.status')->middleware('auth');
Route::post('categorias/categories-delete/', [CategoriesController::class, 'delete'] )->name('staff.categories.delete')->middleware('auth');

//Route::get('/show-event-calendar', [CalenderController::class, 'index']);
//Route::post('/full-calender/action', [CalenderController::class, 'manageEvents']);

Route::get('fullcalender', [CalenderController::class, 'index']);
Route::post('fullcalenderAjax', [CalenderController::class, 'ajax']);

require __DIR__.'/auth.php';
