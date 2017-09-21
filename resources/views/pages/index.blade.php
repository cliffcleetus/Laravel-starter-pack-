@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

   


        <div class="box-body col-lg-10 col-lg-offset-1">
             <h1>Pages</h1>
             <br/>
              <table id="example2" class="table table-bordered table-striped">

                <thead>

                <tr>
                  <th>Sl No</th>
                  <!--   <th>Heading</th> -->
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                

                @foreach ($pages as $pages)
                <tr>
                    <td>{{$pages->title}}</td> 
                   <!--  <td>{{ str_limit($pages->body,75) }}</td> -->
                    <td>{{ $pages->created_at->format('F d, Y h:ia')}}</td> 
                    <td>
                    <a href="{{ route('pages.edit',$pages->id) }}" class="btn btn-primary">Edit</a>

                     <a href="{{ route('pages.show', $pages->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>


                    </td>
                 
                </tr>
               @endforeach
                </tbody>
              </table>
            </div>


@endsection