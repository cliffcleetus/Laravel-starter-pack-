 @extends('layouts.app')

@section('title', '| View Site Settings')

@section('content')


        <div class="box-body">
          <h3 >View - {{$settings->name}} </h3>
              <table id="example2" border="1" class="table table-bordered table-hover">
                <tbody>
                <tr><td width="25%">Name</td><td>{{$settings->name}}</td></tr>
                 <tr><td>Value</td><td>{{$settings->value}}</td></tr>
                 <tr><td>Description</td><td>{{$settings->description}}</td></tr>
                 <tr><td>Created at</td><td>{{$settings->created_at->format('F d, Y h:ia')}}</td></tr>
                 <tr><td>Modified at</td><td>{{ $settings->updated_at->format('F d, Y h:ia')}}</td></tr>
               </tbody>
              </table>
            </div>

            @endsection

           