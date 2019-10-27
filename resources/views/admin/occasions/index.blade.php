@extends('admin.master')
@section('title')
    Occasions
@endsection
@section('PageTitle')
    @if(isset($occasion) && $occasion) {{$occasion->title}} @else Occasions @endif
@endsection
@section('PageDesc')
    You can add and delete Occasions
@endsection
@section('breadcrumb')
    <li class="active">Occasions</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="right">
            <a href="{{ url('admin/occasions/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Occasion Name</th>
                            <th>Category</th>
                            <th>Slider</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Occasions as $Occasion)
                            <tr>
                                <td>{{ $Occasion->id }}</td>
                                <td>{{ $Occasion->title }}</td>
                                <td>{{ $Occasion->category->title }}</td>
                                <td>@if($Occasion->slider) YES @else NO @endif</td>
                                <td>
                                    @if(Auth::user()->admin == true)
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('OccasionsController@edit', $Occasion->id))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('OccasionsController@destroy', $Occasion->id))) !!}
                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $Occasion->title }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                    <a href="{{ url('admin/occasions/'.$Occasion->id.'/gimage') }}"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Images"><i class="ion-images"></i> </button> </a>
                                    <a href="{{ url('admin/occasions/create?parent_id='.$Occasion->id.'&title='.$Occasion->title) }}"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Sub Occasion"><i class="ion-plus"></i> </button> </a>
                                    @if(count($Occasion->sub_occasions) > 0)
                                      <a href="{{ url('admin/occasions/'.$Occasion->id) }}"><button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show Sub Occasion"><i class="fa fa-arrow-right"></i> </button> </a>
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

    {!! $Occasions->render() !!}
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
