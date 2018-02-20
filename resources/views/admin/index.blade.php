@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body" >
                    <table>
                        <thead>
                            <th>Users</th>
                            <th>Id</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <td><a href='admin/{{$user->id}}/view'>{{$user->name}}</a></td>
                                <td>{{$user->id}}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 