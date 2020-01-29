@foreach($greetingImgsForOcc as $greetingImg)
    <option value="{{$greetingImg->id}}" data-img-src='{{asset("$greetingImg->path")}}'></option>
@endforeach