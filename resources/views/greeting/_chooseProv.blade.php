@foreach($providers as $provider)
    <option value="{{$provider->id}}">{{$provider->name}}</option>
@endforeach

