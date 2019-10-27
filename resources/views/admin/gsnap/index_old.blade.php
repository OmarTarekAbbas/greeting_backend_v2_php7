@extends('admin.master')
@section('title')
Snap Images
@endsection
@section('PageTitle')
Snap Images
@endsection
@section('PageDesc')
You can add and delete Snap Images
@endsection
@section('breadcrumb')
<li class="active">Snap Images</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="right">
        <a href="{{ url('admin/gsnap/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Occasion</th>
                            <th>Category</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>In Operators</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($GreetingImgs as $GreetingImg)
                        <tr>
                            <td><img src="{{ url($GreetingImg->path) }}" height="90px"></td>
                            <td>{{ $GreetingImg->id }}</td>
                            <td>{{ $GreetingImg->title }}</td>
                            <td>{{ $GreetingImg->occasion->title }}</td>
                            <td>{{ $GreetingImg->occasion->category->title }}</td>
                            <td>{{ $GreetingImg->RDate }}</td>
                            <td>{{ $GreetingImg->EXDate }}</td>
                            <td>{{ $GreetingImg->operators->count() }}</td>
                            <td>
                                @if($GreetingImg->featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif

                            </td>
                            <td>
                                @if(Auth::user()->admin == true)
                                {!! Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('GreetingSnapController@destroy', $GreetingImg->id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $GreetingImg->title }}')">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                {!! Form::close() !!}
                                @endif
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GreetingSnapController@edit', $GreetingImg->id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                {!! Form::close() !!}
                                @if($GreetingImg->rbt_id)
                                <a class="btn btn-success btn-sm" style="margin: 0 10%;" href="{{url('admin/grbts?snap='.$GreetingImg->id)}}" data-toggle="tooltip" data-placement="bottom" title="List RBT">
                                    <i class="fa fa-list"></i>
                                </a>
                                @else
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GreetingRbtController@create'))) !!}
                                <input type="hidden"name="snapID" value="{{$GreetingImg->id}}">
                                 <button class="btn btn-success btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Add RBT">
                                    <i class="fa fa-plus  "></i>
                                </button>
                                {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $GreetingImgs->setPath('gsnap') !!}


@endsection