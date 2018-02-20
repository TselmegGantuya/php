@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body" id="list-list">
                    @foreach ($lists as $list)
                    <p class='list-name' id='name{{$list->id}}'>{{$list->name}}</p>
                    <span class='delete' id="delete{{$list->id}}">delete</span>
                    <ul class='list-item' id='{{$list->id}}'>
                        <?php $tasks = explode("/|/",$list->tasks);?>
                        @foreach ($tasks as $task)
                            <?php $task = explode("|||", $task)?>
                            <li id='task{{$task[0]}}'><p class='item-name'> {{$task[1]}}</p>
                                <span class='del' id="del{{$task[0]}}">delete</span></li>
                        @endforeach
                        <li><p class='item-item'>+add task</p></li>
                    </ul>
                    @endforeach
                   <p class="add-list" id="list-add">+ add list</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 