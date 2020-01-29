@extends('admin.master')
@section('title')
Generated URLs
@endsection
@section('PageTitle')
Generated URLs
@endsection
@section('PageDesc')
You can add and delete Generated URLs
@endsection
@section('breadcrumb')
<li class="active">Generated URLs</li>
@endsection
@section('PageContent')

<div class="row">
    <div class="right">
        <a href="{{ url('admin/generateurls/create') }}"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        @if(get_settings('enable_delete'))
        <a  id="delete_button" onclick="delete_selected('generatedurls')" class="btn btn-circle btn-danger show-tooltip" title="Delete All" href="#"><i class="fa fa-trash-o"></i></a>
        @endif
    </div>
    <br>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th style="width:18px"><input type="checkbox" onclick="select_all('generatedurls')"></th>
                            <th>Operator Name</th>
                            <th>Occasion</th>
                            <th>Images</th>
                            {{--<th>Audio</th>--}}
                            <th>Video</th>
                            <th>Snap</th>
                            <th>URL</th>
                            <th>Actions</th>
                            <th>Occasion Expire</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($URLs as $URL)
                        <?php $snap = $URL->operator->greetingimgs()->PublishedSnap()->count() ?>
                        <tr>
                                <td><input class="select_all_template" type="checkbox" name="selected_rows[]" value="{{$URL->id}}"
                                    class="roles" onclick="collect_selected(this)"></td>
                            <td><a href="{{ url('admin/operator/'.$URL->operator['id']) }}"> {{ $URL->operator['name'] }}-{{ $URL->operator->country['name'] }}</a></td>
                            <td>{{ $URL->occasion['title'] }}</td>
                            <td>
                                @if($URL->img == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif

                            </td>
                            {{--<td>
                                    @if($URL->audio == 1)
                                        <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                    @else
                                        <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                    @endif
                                </td>--}}
                            <td>
                                @if($URL->video == 1)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($snap >0)
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                @else
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($snap> 0)
                                <span class="text text-info">link 1 : </span><input class="" value='{{url("snap/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <div style="display:none">{{url("snap/$URL->UID")}}</div>
                                <br/>
                                <span class="text text-info">link 2 : </span>  <input class="" value='{{url("cuurentSnap/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <div style="display:none">{{url("cuurentSnap/$URL->UID")}}</div>
                                <br/>

                                <span class="text text-info">link 3 : </span>  <input class="" value='{{url("cuurentSnap_v2/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <div style="display:none">{{url("cuurentSnap_v2/$URL->UID")}}</div>
                                <br/>

                                <span class="text text-info">link 4 : </span>  <input class="" value='{{url("newdesignv4/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <div style="display:none">{{url("newdesignv4/$URL->UID")}}</div>
                                <br/>
                                <span class="text text-info">rotana: </span>  <input class="" value='{{url("rotana/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <div style="display:none">{{url("rotana/$URL->UID")}}</div>
                            @else
                                <a  target="_blank" href="{{url($URL->UID)}}">{{url($URL->UID)}}</a>
                            @endif
                            <td>
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GenerateurlController@edit', $URL->id))) !!}
                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                {!! Form::close() !!}
                                {!! Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('GenerateurlController@destroy', $URL->id))) !!}
                                <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete this item')">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                {!! Form::close() !!}
                            </td>
                            <td>
                                @if($URL->img == true)
                                @if($URL->occasion)
                                    @if($URL->operator->greetingimgs()->publisheSnapdocc($URL->occasion->id)->count() == 0)
                                        <p class="text-danger">Expired Images Contents</p>
                                    @endif
                                @endif
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
{{-- {!! $URLs->setPath('generateurls') !!} --}}
<div class="row">
    <span class="divider"></span>
</div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            $(".copy").click(function () {
                var copyText = $(this).prev('input');
                console.log(copyText.attr('class'));
                copyText.select();
                document.execCommand("copy");
                //alert("Copied the text: " + copyText.val());
            });
            $('.datatable').DataTable()
        })
    </script>
     <script>
            var check = false;

            function select_all(table_name, has_media)
            {
                if (!check)
                {
                    $('.select_all_template').prop("checked", !check);
                    $.get("{{url('admin/get_table_ids?table_name=')}}" + table_name, function (data, status) {
                        data.forEach(function (item) {
                            collect_selected(item.id);
                        });
                    });
                    check = true;
                }
                else
                {
                    $('.select_all_template').prop("checked", !check);
                    check = false;
                    clear_selected();
                }
            }

        </script>

        <script>

            var selected_list = [];
            var checker_list = [];
            function collect_selected(element) {
                var id;
                if (!element.value)
                {
                    id = element;
                }
                else {
                    id = element.value;
                }

                if (checker_list[id])
                {
                    var index = selected_list.indexOf(id);
                    selected_list.splice(index, 1);
                    checker_list[id] = false;
                }
                else {
                    if (!selected_list.includes(id))
                    {
                        selected_list.push(id);
                        checker_list[id] = true;
                    }
                }
            }

            function clear_selected()
            {
                selected_list = [];
                checker_list = [];
            }

        </script>

        <script>
            $(document).ready(function () {
                // $('#example').DataTable();
            });


            function delete_selected(table_name) {
                var confirmation = confirm('Are you sure you want to delete this ?');
                if (confirmation)
                {
                    var form = document.createElement("form");
                    var element = document.createElement("input");
                    var tb_name = document.createElement("input");
                    var csrf = document.createElement("input");
                    csrf.name = "_token";
                    csrf.value = "{{ csrf_token() }}";
                    csrf.type = "hidden";

                    form.method = "POST";
                    form.action = "{{url('admin/delete_multiselect')}}";

                    element.value = selected_list;
                    element.name = "selected_list";
                    element.type = "hidden";

                    tb_name.value = table_name;
                    tb_name.name = "table_name";
                    tb_name.type = "hidden";

                    form.appendChild(element);
                    form.appendChild(csrf);
                    form.appendChild(tb_name);

                    document.body.appendChild(form);

                    form.submit();
                }
            }

            var initChosenWidgets = function () {
                $(".chosen").chosen();
            };
        </script>
@stop
