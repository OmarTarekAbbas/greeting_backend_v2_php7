@extends('admin.master')
@section('title')
    {{ $Operator->name }}
@endsection
@section('PageTitle')
    {{ $Operator->name }}
@endsection
@section('PageDesc')
    Details about {{ $Operator->name }}
@endsection
@section('breadcrumb')
    <li><a href="{{ url('admin/operator') }}"> Operators </a></li>
    <li class="active">{{ $Operator->name }}</li>
@endsection
@section('PageContent')
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ url('admin/operatorImg/'.$Operator->id.'/images') }}">

            <div class="panel panel-tile bg-blue-grey-500">
                <div class="panel-body padding-15-20">
                    <div class="clearfix margin-top-10 margin-bottom-10">
                        <div class="pull-left">
                            <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->greetingimgs()->img()->count() }}</div>
                            <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i> Greeting Images</div>
                        </div>
                        <div class="absolute bottom right margin-right-20 margin-bottom-5">
                            <i class="font-size-70 color-blue-grey-300 ion-images"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel -->
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ url('admin/operatorImg/'.$Operator->id.'/snap') }}">

            <div class="panel panel-tile bg-grey-800">
                <div class="panel-body padding-15-20">
                    <div class="clearfix margin-top-10 margin-bottom-10">
                        <div class="pull-left">
                            <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->greetingimgs()->snap()->count() }}</div>
                            <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i> Greeting Snap</div>
                        </div>
                        <div class="absolute bottom right margin-right-20 margin-bottom-5">
                            <i class="font-size-70 color-blue-grey-300 ion-images"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel -->
        </a>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ url('admin/operatorAudio/'.$Operator->id.'/audios') }}">
            <div class="panel panel-tile bg-green-600">
                <div class="panel-body padding-15-20">
                    <div class="clearfix margin-top-10 margin-bottom-10">
                        <div class="pull-left">
                            <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->greetingaudios()->audio()->count() }}</div>
                            <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i> Greeting Audios</div>
                        </div>
                        <div class="absolute bottom right margin-right-20 margin-bottom-5">
                            <i class="font-size-70 color-green-300 ion-ios-musical-notes"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel -->
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ url('admin/operatorAudio/'.$Operator->id.'/rbts') }}">
            <div class="panel panel-tile bg-blue-500">
                <div class="panel-body padding-15-20">
                    <div class="clearfix margin-top-10 margin-bottom-10">
                        <div class="pull-left">
                            <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->greetingaudios()->rbt()->count() }}</div>
                            <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i> Greeting Rbt</div>
                        </div>
                        <div class="absolute bottom right margin-right-20 margin-bottom-5">
                            <i class="font-size-70 color-blue-300 ion-ios-musical-notes"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel -->
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a href="{{ url('admin/operatorAudio/'.$Operator->id.'/notifications') }}">
            <div class="panel panel-tile bg-teal-500">
                <div class="panel-body padding-15-20">
                    <div class="clearfix margin-top-10 margin-bottom-10">
                        <div class="pull-left">
                            <div class="color-white font-size-36 font-roboto font-weight-600">{{ $Operator->greetingaudios()->notification()->count() }}</div>
                            <div class="display-block color-white font-weight-600"><i class="ion-plus-round"></i> Greeting Notification</div>
                        </div>
                        <div class="absolute bottom right margin-right-20 margin-bottom-5">
                            <i class="font-size-70 color-teal-300 ion-ios-musical-notes"></i>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel -->
        </a>
    </div>
@endsection