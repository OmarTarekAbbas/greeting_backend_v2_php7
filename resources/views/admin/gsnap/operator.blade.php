@foreach ($GreetingImg->operators as $op)
<p class="btn btn-info btn-sm" style="margin-bottom:2px" type="submit" data-toggle="tooltip" data-placement="bottom" title="{{$op->name}}-{{$op->country->name}}">{{$op->name}}-{{$op->country->name}}</p>
@endforeach
