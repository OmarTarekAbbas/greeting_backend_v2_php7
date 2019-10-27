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
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
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
                            <td><a href="{{ url('admin/operator/'.$URL->operator->id) }}"> {{ $URL->operator->name }} - {{ $URL->operator->country->name }}</a></td>
                            <td>{{ $URL->occasion->title }}</td>
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
                                <br/>
                                <span class="text text-info">link 2 : </span>  <input class="" value='{{url("cuurentSnap/$URL->UID")}}'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <br/>

                            <span class="text text-info">link 3 : </span>  <input class="" value='{{url("cuurentSnap_v2/$URL->UID")}}'/>

                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                               
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
                                @if($URL->video == true)
                                @if($URL->operator->greetingaudios()->publishedocc($URL->occasion->id)->count() == 0)
                                <p class="text-danger">Expired Audio Contents</p>

                                @elseif($URL->operator->greetingimgs()->publishedocc($URL->occasion->id)->count() == 0)
                                <p class="text-danger">Expired Images Contents</p>
                                @endif


                    @elseif($URL->img == true)
                                                @if($URL->operator->greetingimgs()->publisheSnapdocc($URL->occasion->id)->count() == 0)
                                                    <p class="text-danger">Expired Images Contents</p>
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
{!! $URLs->setPath('generateurls') !!}
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
        })
    })
</script>
    @stop
