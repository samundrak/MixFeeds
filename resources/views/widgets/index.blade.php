@include('global.headers')
<body>
<div class="row widget-00vfe-main widget-00vfe">
<div class="col-md-2">
	{{-- <div class="widget-00vfe-left"> --}}
		<div class="widget-00vfe-left-top" ><a href="#" id="prev"><img class="img-ac" src="{{ URL::asset('/public/img/top-arrow.png')}}"></a></div>
		<div class="widget-00vfe-container">
			<div class="slideshow" id="widget-tab"
			data-cycle-fx=carousel
			data-cycle-timeout=0
			data-cycle-next="#next"
			data-cycle-prev="#prev"
			data-cycle-carousel-visible=8
			data-cycle-carousel-vertical=true
			data-allow-wrap=true
			data-cycle-auto-height=false
			data-cycle-random=false
			>
			{{$index = 0}}
				@foreach($data->pages as $page)
				  {{-- <a href="#ex1" data-toggle="tab"> --}}
				  <img id="img_{{fbpp($page)}}" onClick="viewWidgets('{{fbpp($page)}}')" class="ex-img" src="http://graph.facebook.com/v2.5/{{fbpp($page)}}/picture"/>
				  {{-- </a> --}}

				@endforeach
			    {{-- <a href="#ex10" data-toggle="tab"><img  src="/widget/images/pic/user10-128x128.jpg"></a> --}}
			</div>
		</div>
		<div class="widget-00vfe-left-bottom" ><a href="#" id="next"><img class="img-ac" src="{{ URL::asset('/public/img/bottom-arrow.png')}}"></a></div>
	{{-- </div> --}}
</div>
<div class="col-md-10">
	<div class="widget-00vfe-right tab-content">
		<div class="tab-pane in active" id="ex1"><h3 class="h3-temp">{{$data->widget_name}}</h3></div>
	</div>
{{-- <div id="fb-root"></div> --}}


	@forelse($data->pages as $page)
<div   id="{{fbpp($page)}}">
<div
	style="display:none;"
	class="fb-page"
	data-href=" {{ $page }}"
	data-width="{{ getWidthHeight($data->settings->size,'width') }}"
	data-height="{{ getWidthHeight($data->settings->size,'height') }}"
	data-small-header="{{$data->settings->show_small_header == '1' ? 'true' : 'false'}}"
	data-adapt-container-width="true"
	data-hide-cover="{{$data->settings->hide_cover_photo == '1' ? 'true' : 'false'}}"
	data-show-facepile="{{ $data->settings->show_friends_face == '1' ? 'true' : 'false'}}"
	data-show-posts="true"

	><div class="fb-xfbml-parse-ignore">
	<blockquote cite="{{$page}}">
	<a href="{{$page}}">Facebook</a>
	</blockquote>
	</div>
	</div>
	</div>
@empty
    <p>No Facebook Page found</p>
@endforelse
</div>
</div>

</div>

<div class="widget-00vfe-main">
<div class="widget-00vfe">

@if($data->subscription->plan != 4)
<p style="text-align:right; padding-top:10px; font-size:11px;">Powered by: <a style="text-decoration:underline; color:#40b622" href="#">www.MultiEmbed.com</a></p>
@endif
</div>


<script type="text/javascript" src="{{ URL::asset('/public/javascript/lib/widget_cycle.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/public/javascript/lib/widget_cycle.carousel.js')}}"></script>

<script>$.fn.cycle.defaults.autoSelector = '.slideshow';</script>
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=972492646144125";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>