@extends('admin.master')
@section('title')
Greeting Rbts
@endsection
@section('PageTitle')
Greeting Rbts
@endsection
@section('PageDesc')
You can add and delete Greeting Rbts
@endsection
@section('breadcrumb')
<li class="active">Greeting Rbts</li>
@endsection
@section('PageContent')

<div class="row">
    @if($snap==0)
    <div class="right">
        <a href="{{ url('admin/grbts/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    @endif
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <br/>
                <table class="table table-hover table-striped datatable">
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
            ajax: '{!! url("admin/grbts/allData?snap=$snap") !!}',
            columns: [
                {data: 'id'},                                
                {data: 'title'},
                {data: 'occasionsTitle'},
                {data: 'categoriesTitle'},
                {data: 'cproviderName'},
                {data: 'RDate'},
                {data: 'EXDate'},
                {data: 'operators'},
                {data: 'featured'},
                {data: 'action', searchable: false}
            ]
             , "pageLength": {{get_pageLength()}}
        });      
    });
      
</script>
@stop