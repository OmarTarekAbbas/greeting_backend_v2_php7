@foreach ($Rdata as $key=>$snap)
            <div class="col-4 p-0">
                <div class="first_list_img">
                    <a href="{{url('rotanav2/inner/'.$snap->id.'/'.UID())}}">
                        <img class="w-100" src="{{url('/'.$snap->path)}}"
                            alt="{{$snap->getTranslation('title',getCode())}}">

                        <a class="first_list_img_heart" href="#0">
                            <i class="fas fa-heart heart_heart"></i>
                        </a>

                        <a class="first_list_img_share" href="#0" data-toggle="modal"
                            data-target="#modalForShare{{$key}}">
                            <i class="fas fa-share-square"></i>
                        </a>
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal_share modal fade" id="modalForShare{{$key}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="rounded-social-buttons w-100 text-center">
                                <a class="social-button facebook_link"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{url('rotanav2/inner/'.$snap->id.'/'.UID())}}"
                                    target="_blank" title="Facebook">
                                    <i class="fab fa-facebook-f facebook_icon"></i>
                                </a>

                                <a class="social-button whatsapp_link"
                                    href="whatsapp://send?abid=+20111682831&text={{url('rotanav2/inner/'.$snap->id.'/'.UID())}}" title="Whatsapp">
                                    <i class="fab fa-whatsapp whatsapp_icon"></i>
                                </a>

                                <a class="social-button twitter_link"
                                    href="http://twitter.com/share?url={{url('rotanav2/inner/'.$snap->id.'/'.UID())}}" target="_blank"
                                    title="Twitter">
                                    <i class="fab fa-twitter twitter_icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
