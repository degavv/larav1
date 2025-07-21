@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <a href="{{ route('task.create') }}" class="btn btn-success">New task</a>
        <!-- TODO: Текущие задачи -->
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Tasks
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Заголовок таблицы -->
                <thead>
                    <th>Id</th>
                    <th>Task</th>
                    <th>Action</th>
                </thead>

                <!-- Тело таблицы -->
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text">
                                <div>{{ $task->id }}</div>
                            </td>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <td>
                                <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection