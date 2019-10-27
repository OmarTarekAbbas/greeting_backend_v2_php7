@extends('admin.master')
@section('title')
Greeting {{$type}} of {{ $Operator->name }}
@endsection
@section('PageTitle')
Greeting {{$type}} of {{ $Operator->name }}
@endsection
@section('PageDesc')
Greeting {{$type}} of {{ $Operator->name }} edit and delete 
@endsection
@section('breadcrumb')
<li><a href="{{ url('admin/operator') }}"> Operators</a></li>
<li><a href="{{ url('admin/operator/'.$Operator->id) }}"> {{ $Operator->name }}</a></li>
<li class="active">{{$type}}</li>
@endsection
@section('PageContent')
<div class="col-xs-12">
    <div class="box">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Occasion</th>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($images as $GreetingImg)
                    <tr>
                        <td>{{ $GreetingImg->id }}</td>
                        <td><img src="{{ url($GreetingImg->path) }}" height="90px"></td>
                        <td>{{ $GreetingImg->title }}</td>
                        <td>{{ $GreetingImg->occasion->title }}</td>
                        <td>{{ $GreetingImg->occasion->category->title }}</td>
                        <td>{{ $GreetingImg->RDate }}</td>
                        <td>{{ $GreetingImg->EXDate }}</td>
                        <td>
                            {!! Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'url' => url('admin/operator/'.$Operator->id.'/images/'.$GreetingImg->id) )) !!}
                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $GreetingImg->title }} from {{ $Operator->name }} ?')">
                                <i class="fa fa-trash-o "></i>
                            </button>
                            {!! Form::close() !!}

                            {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GreetingimgsController@edit', $GreetingImg->id))) !!}
                            <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                <i class="fa fa-edit  "></i>
                            </button>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection