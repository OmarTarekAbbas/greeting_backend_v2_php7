@extends('admin.master')
@section('title')
    Operator Snap
@endsection
@section('PageTitle')
    Operator Snap
@endsection
@section('PageDesc')

@endsection
@section('breadcrumb')
    <li class="active">Operator Snap</li>
@endsection
@section('PageContent')
    <style>
        .table.table-bordered > thead > tr > th {
            text-align: center;
        }

        /*.dataTables_wrapper .dataTables_paginate{*/
        /*    display: none;*/
        /*}*/
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <br/>
                    <div class="table-responsive">
                        <table id="example"
                               class="table table-bordered table-striped table-hover js-basic-example dataTable display responsive nowrap" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Count</th>
                                <th>operator Name</th>
                                <th class='notexport'>Image</th>
                                {{--  <th>Image</th>  --}}
                                <th>Title</th>
                                <th>Occasion</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @if(count($GreetingImgs) > 0)
                                @foreach($GreetingImgs as $GreetingImg)

                                    <tr>
                                        <td>{{$GreetingImg->id}}</td>
                                        <td>{{$GreetingImg->count}}</td>
                                        <td>{{$GreetingImg->op_name}} / {{$GreetingImg->co_name}}</td>
                                        <td><img src="{{url($GreetingImg->path)}}" style="width: 100px;height: 100px" alt=""></td>
                                        {{--  <td><img src="{{url($GreetingImg->path)}}" style="width: 100px;height: 100px" alt=""></td>  --}}
                                        <td>{{$GreetingImg->title}}</td>
                                        <td>{{$GreetingImg->occasionsTitle}}</td>
                                        <td>{{$GreetingImg->categoriesTitle}}</td>
                                        <td>{{$GreetingImg->RDate}}</td>
                                        <td>{{$GreetingImg->EXDate}}</td>
                                    </tr>

                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    }]

            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
@stop