@extends('admin.master')
@section('title')
    Users
@endsection
@section('PageTitle')
    Users
@endsection
@section('PageDesc')
    You can add and delete Users
@endsection
@section('breadcrumb')
    <li class="active">Users</li>
@endsection

@section('PageContent')

    <div class="right">
        <a href="{{ url('admin/user/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">

                <h3>Users</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Admin</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($Users as $User)
                        <tr>
                            <td>{{ $User->name }}</td>

                            <td>
                                @if($User->admin == 0)
                                    No
                                @else
                                    Yes
                                @endif
                            </td>
                            <td>{{ $User->email }}</td>
                            <td>
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('UsersController@destroy', $User->id))) !!}
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete this ?')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                {!! Form::close() !!}
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('UsersController@edit', $User->id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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


    {!! $Users->setPath('user') !!}


@endsection
