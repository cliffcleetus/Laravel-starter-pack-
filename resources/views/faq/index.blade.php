@extends('layouts.app')

@section('title', '| FAQ')

@section('content')


        <div class="box-body col-lg-10 col-lg-offset-1">
              <h1>FAQs</h1>
              </br>
              <table id="example2" class="table table-bordered table-striped">

               <a href="{{ route('faq.create' ) }}" style="margin-bottom: 6px;" class="btn btn-primary pull-right">New FAQ</a>

                <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Question</th>
                  <th>Created at</th>
                  <th>Modified at</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $i=1; ?>
                @foreach ($faq as $pages)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$pages->question}}</td> 
                    <td>{{$pages->created_at->format('F d, Y h:ia')}}</td> 
                    <td>{{$pages->updated_at->format('F d, Y h:ia')}}</td> 
                    <td>
                    @if($pages->status=="1") 
                    <a href="{{route('faq_deactive',['id'=> $pages->id] )}}" class="label label-sm label-success" title="Click to deactivate">Active</a>
                    @elseif($pages->status=="0")
                    <a href="{{ route('faq_active',['id'=> $pages->id] ) }}" class="label label-sm label-danger" title="Click to deactivate">Inactive</a>
                    @endif
                    </td> 
                    <td>
                    <a href="{{ route('faq.edit',$pages->id) }}" class="btn btn-primary">Edit</a>

                     <a href="{{ route('faq.show', $pages->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">View</a>

                     {!! Form::open(['method' => 'DELETE', 'route' => ['faq.destroy', $pages->id] ,'style'=>'    margin-left: 111px;margin-top: -34px;' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}




                    </td>
                <?php  $i++; ?>
                </tr>
               @endforeach
                </tbody>
              </table>
            </div>


@endsection