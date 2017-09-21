@extends('layouts.app')

@section('title', '| Edit User')

@section('content')


<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> View</h1>
    <hr>
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', $user->name, array('class' => 'form-control','readonly' => 'true')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', $user->email, array('class' => 'form-control','readonly' => 'true')) }}
    </div>

     <div class="form-group">
        <?php $type= str_replace(array('[',']','"'),'', $user->roles->pluck('name')); ?>
        {{ Form::label('role', 'Role') }}
        {{ Form::email('role',$type, array('class' => 'form-control','readonly' => 'true')) }}
    </div>

</div>
     <h3 style="margin-top: 326px; margin-left: 18px;"> User Logs </h3>
        <div class="box-body">
        @if($dashboard!="")

              <table id="example2" class="table table-bordered table-hover">

                <thead>

                <tr>
                  <th>User name</th>
                    <th>IP</th>
                    <th>Login</th>
                    <th>Online Status</th>
                    <th>Logout</th>
                </tr>
                </thead>
                <tbody>

              @foreach ($dashboard as $dashboard)
                <tr>
                    <td>{{$user->name}}</td> 
                    <td>{{ $dashboard->ip }}</td> 
                    <td>{{ $dashboard->login }}</td> 
                    <td>{{($dashboard->current_login_status == "1") ? 'Online':'Offline'}}</td> 
                    <td>{{ $dashboard->logout }}</td> 
                 
                </tr>
                 @endforeach
                </tbody>
              </table>
              @endif
            </div>


@endsection