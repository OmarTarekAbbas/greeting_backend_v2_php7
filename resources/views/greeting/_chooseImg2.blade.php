
<script>
    $('#choosePicture').val('value').change();

</script>

<select id="choosePicture"    name="image"  class="image-picker ajax-select">
@foreach($greetingImgsForOcc as $greetingImg)
    <option  value="{{$greetingImg->id}}" data-img-src='{{asset("$greetingImg->path")}}'></option>
@endforeach
</select>


<script>
$('#choosePicture').on('change', function (e) {
// alert('ajax_load');
  $("#continue").click();

});
    </script>