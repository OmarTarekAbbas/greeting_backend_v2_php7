@if(Auth::user()->admin == true)
{!! Form::open(array("class" => "col-xs-1","method" => "DELETE", "action" => array("GreetingSnapController@destroy", $GreetingImg->id))) !!}
<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm("Are you sure you want to delete {{ $GreetingImg->title }}")">
        <i class="fa fa-trash-o "></i>
</button>
{!! Form::close() !!}
@endif
{!! Form::open(array("class" => "form-inline col-lg-1","method" => "GET", "action" => array("GreetingSnapController@edit", $GreetingImg->id))) !!}
<button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
    <i class="fa fa-edit  "></i>
</button>
{!! Form::close() !!}
@if($GreetingImg->rbt_id)
<a class="btn btn-success btn-sm" style="margin: 0 10%;" href="{{url("admin/grbts?snap=".$GreetingImg->id)}}" data-toggle="tooltip" data-placement="bottom" title="List RBT">
    <i class="fa fa-list"></i>
</a>
@else
{!! Form::open(array("class" => "form-inline col-lg-1","method" => "GET", "action" => array("GreetingRbtController@create"))) !!}
<input type="hidden"name="snapID" value="{{$GreetingImg->id}}">
<button class="btn btn-success btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Add RBT">
    <i class="fa fa-plus  "></i>
</button>
{!! Form::close() !!}
@endif
