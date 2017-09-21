@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-10 col-lg-offset-1">


    <h1></i>Customers
    <a style="float: right;margin-left: 6px;" href="{{ route('customer.create') }}" class="btn btn-success">Add Customer</a>
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
                    <th>Status</th>
                    <th style="width: 25%;">Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                @if($user->hasRole('User'))
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>
                    @if($user->status=="1") 
                    <a href="{{route('user_deactive',['id'=> $user->id] )}}" class="label label-sm label-success" title="Click to deactivate">Active</a>
                    @elseif($user->status=="0")
                    <a href="{{ route('user_active',['id'=> $user->id] ) }}" class="label label-sm label-danger" title="Click to deactivate">Inactive</a>
                    @endif
                    </td>
                    {{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>

                     <a href="{{ route('customer.show', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>

                    <a href="{{ route('customer.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $user->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
    </div>

   

</div>

@endsection