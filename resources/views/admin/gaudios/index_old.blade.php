@extends('admin.master')
@section('title')
Greeting Audios
@endsection
@section('PageTitle')
Greeting Audios
@endsection
@section('PageDesc')
You can add and delete Greeting Audios
@endsection
@section('breadcrumb')
<li class="active">Greeting Audios</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="right">
        <a href="{{ url('admin/gaudios/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Occasion</th>
                            <th>Category</th>
                            <th>Content Provider</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>In Operators</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($GreetingAudios as $GreetingAudio)
                        <tr>
                            <td>{{ $GreetingAudio->id }}</td>
                            <td>{{ $GreetingAudio->title }}</td>
                            <td>{{ $GreetingAudio->occasion->title }}</td>
                            <td>{{ $GreetingAudio->occasion->category->title }}</td>
                            <td>{{ $GreetingAudio->cprovider->name }}</td>
                            <td>{{ $GreetingAudio->RDate }}</td>
                            <td>{{ $GreetingAudio->EXDate }}</td>
                            <?php
                            $Ops = '';
                            foreach ($GreetingAudio->operators as $Op) {
                                $Ops.= $Op->name . '-' . $Op->country->name . ', ';
                            }
                            ?>
                            <td><a href="#" data-toggle="tooltip" data-placement="right" title="{{ $Ops }}"> {{ $GreetingAudio->operators->count() }}</a></td>
                            <td>
                                @if($GreetingAudio->featured == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif

                            </td>
                            <td>
                                @if(Auth::user()->admin == true)
                                {!! Form::open(array('class' => 'form-inline col-xs-1','method' => 'DELETE', 'action' => array('GreetingaudiosController@destroy', $GreetingAudio->id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $GreetingAudio->title }}')">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                {!! Form::close() !!}
                                @endif
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GreetingaudiosController@edit', $GreetingAudio->id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                {!! Form::close() !!}
                                <audio src="{{ url($GreetingAudio->path) }}" controls></audio>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{!! $GreetingAudios->setPath('gaudios') !!}


@endsection