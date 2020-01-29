@extends('admin.master')
@section('title')
    Countries
@endsection
@section('PageTitle')
    Countries
@endsection
@section('PageDesc')
    You can add and delete countries
@endsection
@section('breadcrumb')
    <li class="active">Countries</li>
@endsection
@section('PageContent')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Country Name</th>
                            <th>Opertators count</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Countries as $Country)
                            <tr>
                                <td>{{ $Country->id }}</td>
                                <td><a href="{{ url('admin/country/'.$Country->id) }}">{{ $Country->name }}</a></td>
                                <td><a href="{{ url('admin/country/'.$Country->id) }}">{{ $Country->operators->count() }}</a></td>
                                <td>
                                    {!! Form::open(array('class' => 'col-xs-4','method' => 'DELETE', 'action' => array('CountriesController@destroy', $Country->id))) !!}
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $Country->Name }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    <a href="{{ url('admin/country/'.$Country->id.'/operator') }}"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Operator"><i class="ion-android-phone-portrait"></i> </button> </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! $Countries->setPath('country') !!}
    <div class="row">
        <span class="divider"></span>
    </div>
    <div class="row">
        <div class="col-xs-9">
            <div class="box">
                @include('admin.countries.form')

            </div>
        </div>

    </div>

@endsection