@extends('admin.master')
@section('title')
    {{ $Country->name }}
@endsection
@section('PageTitle')
    {{ $Country->name }}
@endsection
@section('PageDesc')
    Details about {{ $Country->name }}
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/country') }}"> Countries</a></li>
    <li class="active">{{ $Country->name }}</li>
@endsection
@section('PageContent')
    @foreach($Country->operators as $Operator)
        <div class="col-lg-2 col-md-2 col-sm-6  col-xs-12">
            <a href="{{ url('admin/operator/'.$Operator->id) }}">
                <div class="panel panel-tile bg-blue-600">
                    <div class="panel-body padding-15-20">
                        <div class="clearfix margin-top-10 margin-bottom-10">
                            <div class="pull-left">
                                <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->name }}</div>
                                <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i>{{ $Operator->greetingimgs->count() + $Operator->greetingaudios->count()}} greetings </div>
                            </div>
                            <div class="absolute bottom right margin-right-20 margin-bottom-5">
                                <i class="font-size-70 color-blue-300 ion-android-phone-portrait"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- /.panel -->
            </a>
        </div>

    @endforeach
@endsection