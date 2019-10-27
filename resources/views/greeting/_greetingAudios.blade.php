<table>
    <tr>
        <th>اختر</th>
        <th>تشغيل</th>
        <th>الاسم</th>
    </tr>
    @foreach($greetingAudiosForOccProv as $audio)
    <tr>
        <td class="audio-radio">
            <input id="track_id" class="center" type="radio" name="audio" value="{{$audio->id}}" />
            <label for="track_id" class="center"><span class="center"></span></label>
        </td>
        <td class="np-play" data-src='{{asset("$audio->path")}}'></td>
        <td>{{$audio->title}}</td>
    </tr>
    @endforeach
</table>

<script>
    $('input:radio').on('click', function (e) {
        $("#audio_next").click();
    });

</script>