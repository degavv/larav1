<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'task'], function () {
    Route::get('/', function () {
        $tasks = Task::all();
        return view('task.index', [
            'tasks' => $tasks,
        ]);
    })->name('task.index');

    Route::get('/create', function () {
        return view('task.create');
    })->name('task.create');

    Route::post('/', function (Request $request) {
        list($newTask, $validator) = TaskService::validate($request);

        if ($validator) {
            return redirect()
                ->route('task.create')
                ->withInput()
                ->withErrors($validator);
        }

        return redirect()->route('task.index');
    })->name('task.store');

    Route::get('/edit/{task}', function (Task $task) {
        return view('task.edit', [
            'task_id' => $task->id,
            'task_name' => $task->name,
        ]);
    })->name('task.edit');

    Route::patch('/{task}', function (Task $task, Request $request) {
        list($savedTask, $validator) = TaskService::validate($request, $task);

        if ($validator) {
            return redirect()
                ->route('task.edit', $task->id)
                ->withInput()
                ->withErrors($validator);
        }

        return redirect()->route('task.index');
    })->name('task.update');

    Route::delete('/{task}', function (Task $task) {
        $task->delete();
        return redirect()->route('task.index');
    })->name('task.destroy');
});

