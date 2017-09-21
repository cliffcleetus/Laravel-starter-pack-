@extends('layouts.app')

@section('title', '| Site Settings')

@section('content')

   


        <div class="box-body col-lg-10 col-lg-offset-1">
             <h1>Site Settings</h1>
             <br/>
              <table id="example2" class="table table-bordered table-striped">

                <thead>

                <tr>
                  <th>Sl No</th>
                    <th>Name</th>
                    <th>Value</th>
                     <th>Description</th>
                      <th>Created at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $i=1; ?>
                @foreach ($settings as $pages)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$pages->name}}</td> 
                    <td>{{$pages->value}}</td> 
                    <td>{{ str_limit($pages->description,75) }}</td>
                    <td>{{ $pages->created_at->format('F d, Y h:ia')}}</td> 
                    <td>
                    <a style="" href="{{ route('settings.edit',$pages->id) }}" class="btn btn-primary">Edit</a>

                     <a href="{{ route('settings.show', $pages->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>


                    </td>
                <?php  $i++; ?>
                </tr>
               @endforeach
                </tbody>
              </table>
                {{$settings->links()}}
            </div>


@endsection