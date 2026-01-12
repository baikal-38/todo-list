<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    //     Route::apiResource('tasks', TaskController::class);

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::match(['put', 'patch'], '/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});





