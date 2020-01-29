
    @foreach($greetingAudiosForOccProv as $audio)
    <div class="item" id="person1">
            <div class="row">
                <div class="col-6">
                    <span>النص</span>
                    <p>{{$audio->title}}</p>
                </div>
                <div class="col-3">
                    <span>تشغيل</span>
                    <div class="np-play">
                        <div class="fa fa-play" data-src="{{asset("$audio->path")}}" id="play"></div>
                    </div>
                </div>
                <div class="col-3">
                    <span>اختر</span>
                    <input type="radio" name="audio" value="{{$audio->id}}" class="chooseRadio" required="">
                </div>
            </div>
        </div>  
   
    @endforeach


<script>
    $('input:radio').on('click', function (e) {
        $("#audio_next").click();
    });

</script>