@extends('admin.master')
@section('title')
    Categories
@endsection
@section('PageTitle')
    Categories
@endsection
@section('PageDesc')
    You can add and delete Categories
@endsection
@section('breadcrumb')
    <li class="active">Categories</li>
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
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($Categories as $Category)
                            <tr>
                                <td>{{ $Category->id }}</td>
                                <td>{{ $Category->title }}</td>
                                <td>
                                    @if(get_settings('enable_parent'))
                                    {!! Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('CategoriesController@destroy', $Category->id))) !!}
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete {{ $Category->title }}')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    @endif
                                    {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('CategoriesController@edit', $Category->id))) !!}
                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    {!! Form::close() !!}
                                    <a href="{{ url('admin/occasions/create?category_id='.$Category->id) }}"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Occasion"><i class="ion-ios-bookmarks"></i> </button> </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {!! $Categories->setPath('categories') !!}
    <div class="row">
        <span class="divider"></span>
    </div>
    <hr class="fc-agenda-divider-inner">
    <div class="page-head margin-bottom-20">
        <h1 class="page-title">Add new Category</h1>
    </div>
    <div class="row">

        <div class="col-xs-9">
            <div class="box">
                {!! Form::open(['url'=>'admin/categories']) !!}
                    @include('admin.categories.form')
                    <div class="form-group">
                        <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection
