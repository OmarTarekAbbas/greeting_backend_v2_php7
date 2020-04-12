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
                <br/>
                <a class="btn btn-success" href="{{ route('export') }}"  style="margin-bottom: 10px;float: right">Export Snap Images</a>

                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>                            
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "processing": true,
            "serverSide": true,
            stateSave: true,
            ajax: "{!! url('admin/gsnap/allData') !!}",
            
            columns: [
                {data: 'id'},
                {data: 'image',name:'path', searchable: false},                
                {data: 'title'},
                {data: 'occasionsTitle'},
                {data: 'categoriesTitle'},
                {data: 'RDate'},
                {data: 'EXDate'},
                {data: 'operators'},
                {data: 'featured'},
                {data: 'action', searchable: false}
            ] , "pageLength": {{get_pageLength()}}
        });
    });
</script>
@stop
<!-- {{get_pageLength()}} -->