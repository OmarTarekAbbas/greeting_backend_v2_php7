@extends('greeting.master')
@section('style')
    <style>
        fieldset {
            margin-top: 20px;
        }



    </style>
@stop
@section('form')
    {!! Form::open(['id'=>'greetingForm']) !!}

    <fieldset id="enterName">
        <div>

            <div class="exception">
                @if (count($errors) > 0)

                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach

                @endif
            </div>


        </div>

    </fieldset>

    {!! Form::close()!!}
@stop
