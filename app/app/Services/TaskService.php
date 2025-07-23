<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskService
{
    /**
     * validates and saves the task
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task|null $task
     * @param int $maxLength
     * @return array<mixed|Task|null>
     */
    public static function validate(Request $request, Task $task = null, int $maxLength = 5): array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:' . $maxLength,
        ]);

        if($validator->fails()){
            return [null, $validator];
        }

        if(!$task){
            $task = new Task();
        }

        $task->name = $request->name;
        $task->save();

        return [$task, null];
    }

}