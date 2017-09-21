@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-10 col-lg-offset-1">


    <h1>Admin Users
    <a style="float: right;margin-left: 6px;" href="{{ route('users.create') }}" class="btn btn-success">Add Admin User</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time Added</th>
                    <th>User Role</th>
                    <th style="width: 25%;">Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                @if(!$user->hasRole('User'))
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                       {{ str_replace(array('[',']','"'),'', $user->roles->pluck('name')) }}
                    </td>
                {{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>

                     <a href="{{ route('users.show', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
          {{$users->links()}}
    </div>

   

</div>

@endsection