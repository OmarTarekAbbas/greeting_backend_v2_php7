<table>
    <tr>
        <td>choose</td>
        <td>play</td>
        <td>name</td>
    </tr>
    @foreach($greetingAudiosForOccProv as $audio)
    <tr>
        <td>
            <input id="track_id" type="radio" name="audio" value="{{$audio->id}}" />
            <label for="track_id"><span></span></label>
        </td>
        <td class="np-play" data-src='{{asset("$audio->path")}}'></td>
        <td>{{$audio->title}}</td>
    </tr>
    @endforeach
</table>