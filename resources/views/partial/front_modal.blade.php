
		@if(Session::has('success'))
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">
							<p>  <a href="{{Session::get('login_link')}}"  >  {{Session::get('success')}} </a>  </p>


						</div>
					</div>
				</div>
			</div>


		@elseif(Session::has('failed'))
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">
							<p>{{Session::get('failed')}}</p>
						</div>
					</div>
				</div>
			</div>



			@elseif(Session::has('success_url_resend_again') )
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">

								<p style="direction: rtl !important;">
									<span>لديك اشتراك مفعل فى خدمة يلا وفر من IVAS بقيمة 2 جنيها يوميا للوصول الى الخدمة قم بزيارة</span>
									<span>  <a href="{{Session::get('link')}}"  > الرابط </a> </span>
									<span>تكلفة الخدمة 2 جنيها يوميا</span>
									<span>لإلغاء الاشتراك ارسل stop waffar الى</span>
									<span>{{Session::get('shortCode')}}</span>
									<span>مجانا</span>

								</p>
								@if(Session::has('msisdn_subscribe_before'))



									<p><a href="{{url('sendUrlToActiveUser')."/".Session::get('msisdn_subscribe_before')}}" style="font-weight: bold"> إعادة إرسال رابط الخدمة</a></p>
								@endif

							</div>
						</div>
					</div>
				</div>




		@elseif(Session::has('success_new_user') )
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">

							<p style="direction: rtl !important;">
								<span>شكراَ لإشتراكك فى خدمة يلا وفر من IVAS بقيمة 2 جنيها يوميا للوصول الى الخدمة قم بزيارة</span>
								<span>  <a href="{{Session::get('link')}}"  > الرابط </a> </span>
								<span>تكلفة الخدمة 2 جنيها يوميا</span>
								<span>لإلغاء الاشتراك ارسل stop waffar الى</span>
								<span>{{Session::get('shortCode')}}</span>
								<span>مجانا</span>

							</p>
							@if(Session::has('msisdn_subscribe_before'))



								<p><a href="{{url('sendUrlToActiveUser')."/".Session::get('msisdn_subscribe_before')}}" style="font-weight: bold"> إعادة إرسال رابط الخدمة</a></p>
							@endif

						</div>
					</div>
				</div>
			</div>
                        <iframe src="http://arabyads.go2cloud.org/aff_l?offer_id=3753" scrolling="no" frameborder="0" width="1" height="1"></iframe>


		@elseif(Session::has('success_pincode'))
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"></h4>
						</div>
						<div class="modal-body">

							<p  style="color: #f00;">{{Session::get('success_pincode')}}</p>

							<form class="form-group" action="{{url('tpay_subscribe_verify')}}" method="post">
								<input type="number"   onKeyPress="if(this.value.length==6) return false;"  required  style="text-align:right"   name="pinCode" placeholder="كود التفعيل" class="form-control" >
								<div class="single-input" style="margin: 14px">
									<button type="submit" class="cr-btn cr-btn--sm cr-btn--theme cr-round cr-round--lg"><span style="text-align: center;">أشتراك</span></button>
									<p class="app-desc" style="text-align:right !important;"> سعر الخدمة 2 جنيها يوميا</p>
									@if(Session::has('contract_id'))
										<p class="app-desc" style="margin: 13px !important;"> &nbsp; &nbsp;  <a class="primary-text" href="{{url('sub_pincode_resend')}}">  اعادة ارسال الكود</a></p>

									@endif
								</div>
							</form>




							<div class="dis">
								<ul>
									<li>تكلفة الاشتراك لعملاء اورنج 2 جنية يوميا   و لعملاء فودافون 2 جنيه يوميا</li>
									<li>لإلغاء الإشتراك بإرسال رسالة نصية، لمشتركى اورنج: إرسال كلمة "stop waffar" إلى الرقم المجانى 5030   ، لمشتركى شبكة فودافون: ارسال "stop waffar" إلى الرقم المجانى 6699</li>

									<p>او عن طريق هذا <a href="{{url('unsub')}}"   > الرابط  </a>   </p>
									<li>برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@yallawaffar.com</li>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</div>


		@endif