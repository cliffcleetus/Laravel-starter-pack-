@extends('layouts.app')

@section('title', '| Email Contents')

@section('content')

   

 <a href="{{ route('helps.create') }}" style="    margin-right: 61px;
    margin-bottom: -56px;" class="btn btn-primary pull-right">New Help</a>

        <div class="box-body col-lg-10 col-lg-offset-1">
             <h1>Helps</h1>
             <br/>
                           <table id="example2" class="table table-bordered table-striped">

                <thead>

                <tr>
                    <th>Sl No</th>
                    <th>Heading</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $i=1; ?>
                @foreach ($helps as $email)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$email->heading}}</td> 
                    <td>{{$email->created_at}}</td> 
                    <td>{{$email->updated_at}}</td> 
                    <td>
                    @if($email->status=="1") 
                    <a href="{{route('deactive',['id'=> $email->id] )}}" class="label label-sm label-success" title="Click to deactivate">Active</a>
                    @elseif($email->status=="0")
                    <a href="{{ route('active',['id'=> $email->id] ) }}" class="label label-sm label-danger" title="Click to deactivate">Inactive</a>
                    @endif
                    </td>
                    
                    <td>
                    <a href="{{ route('helps.edit',$email->id) }}" class="btn btn-primary">Edit</a>

                    <a href="{{ route('helps.show', $email->id) }}" class="btn btn-info pull-left" style="margin-right:3px;">View</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['helps.destroy', $email->id] ,'style'=>'    margin-left: 111px;margin-top: -34px;' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}


                    </td>
                <?php  $i++; ?>
                </tr>
               @endforeach
                </tbody>
              </table>
                {{$helps->links()}}
            </div>


@endsection