@extends('admin.master')
@section('title')
    Occasions
@endsection
@section('PageTitle')
    Occasions
@endsection
@section('PageDesc')
    You can add and delete Occasions
@endsection
@section('breadcrumb')
    <li class="active">Occasions</li>
@endsection
@section('PageContent')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
    <div class="row">
        <div class="right">
            <a href="{{ url('admin/occasions/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped" id="example">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Occasion Name</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  
    <div class="row">
        <span class="divider"></span>
    </div>


@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"/></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "paging": true,
        "ajax": "{{url('admin/ajax')}}",
//        "deferLoading": 7
    } );
} );
</script>
@stop