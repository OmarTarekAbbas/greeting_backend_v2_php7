
@foreach ($Rdata as $key=>$snap)
<div class="col-4 p-0">
    <div class="first_list_img">
        <a href="{{url('rotanav2/inner/'.$snap->id.'/'.UID())}}">
            <img class="w-100" src="{{url('/'.$snap->path)}}" alt="{{$snap->getTranslation('title',getCode())}}">

            <a class="first_list_img_heart" href="#0">
                <i class="fas fa-heart heart_heart"></i>
            </a>

            <a id="{{$snap->id}}" class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
            </a>
        </a>
    </div>
</div>
@endforeach

