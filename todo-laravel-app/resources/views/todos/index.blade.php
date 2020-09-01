@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="/todos" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="body" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>

        
        <!-- Current Tasks -->
        @if (count($todos) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Current todos
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Task</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($todos as $todo)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $todo->body }}</div>
                                    </td>

                                    <td class="table-text">
                                        @if ($todo->state)
                                            <div>完了</div>
                                        @else
                                            <div>未完</div>
                                        @endif
                                    </td>

                                    <!-- confirm Button -->
                                    <td>
                                        <form action="/todos/{{ $todo->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}

                                            <button>Done Task</button>
                                        </form>
                                    </td>

                                    <!-- Delete Button -->
                                    <td>
                                        <form action="/todos/{{ $todo->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button>Delete Task</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
