@extends('admin.master')

@section('page_title')
    @lang('messages.create_static_value')
@stop

@section('PageContent')
    @include('admin.errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.add_static_keyword')</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                     @if(isset($static_translation))
                        {!! Form::model($static_translation, ['route' => ['admin.static_translation.update', $static_translation->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}

                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'admin.static_translation.store', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}


                    @endif
                        @include('admin.static_translation._form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#static').addClass('active');
        $('#static-create').addClass('active');
    </script>
@stop
