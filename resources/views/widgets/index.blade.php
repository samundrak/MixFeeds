@include('global.headers')
<body>
<style type="text/css">
	#widgetHere ul .icons:hover{
		background-color:gray;
	}
</style>
<script type="text/javascript" src="{{ URL::asset('/public/javascript/src/jquery.tools.min.js')}}"></script>

<div class="widget-00vfe-main">
<div class="widget-00vfe">
	<div class="widget-00vfe-left">
		<div class="widget-00vfe-left-top" ><a href="#" id="prev" class="prev"><img class="img-ac" src="../../../public/widget/images/top-arrow.png"></a></div>
		<div class="widget-00vfe-container" id="container">

			<div class="items">

			   @foreach($data->pages as $page)


				  	<a class="item" id="li_{{fbpp($page)}}" onClick="viewWidgets('{{fbpp($page)}}')" style="cursor:pointer" href="#">
				  		<img class="ext-img" id="img_{{fbpp($page)}}" src="http://graph.facebook.com/v2.5/{{fbpp($page,true)}}/picture?width=200&height=200"/>
				  	</a>


				@endforeach

			</div>
		</div>

		<div class="widget-00vfe-left-bottom"><a href="#" id="next" class="next"><img class="img-ac" src="../../../public/widget/images/bottom-arrow.png"></a></div>
	</div>
	<div class="widget-00vfe-right tab-content">
		<div class="widgetHere" id="img_{{fbpp($page)}}"></div>

	</div>
	@if($data->subscription->plan != 4)
	<p class="powered-link" style="text-align:right; font-size:11px;">Powered by: <a style="text-decoration:underline; color:#40b622" href="#">www.MultiEmbed.com</a></p>
	@endif
</div>

</div>

<script type="text/javascript">
function viewWidgets(item){
		widgetsIds.forEach(function (post) {
			$("#"+post).slideUp(100);

					$("#li_"+post).css("opacity","0.5");


		});

			$("#li_"+item).css("opacity","1");

		$("#"+item).slideDown(200);
		$("#title").html(item.toUpperCase());
	}



				var widgets = {};
				var widgetsIds = [];
 @forelse($data->pages as $page)
 widgetsIds.push('{{fbpp($page)}}');
widgets['{{fbpp($page)}}'] ='<div style="display:none;" id="{{fbpp($page)}}"><div  class="fb-page" data-href=" {{ $page }}" data-width="{{ getWidthHeight($data->settings->size,'width') }}" data-height="{{ getWidthHeight($data->settings->size,'height') }}" data-small-header="{{$data->settings->show_small_header == '1' ? 'true' : 'false'}}" data-adapt-container-width="true" data-hide-cover="{{$data->settings->hide_cover_photo == '1' ? 'true' : 'false'}}" data-show-facepile="{{ $data->settings->show_friends_face == '1' ? 'true' : 'false'}}" data-show-posts="true" ><div class="fb-xfbml-parse-ignore"> <blockquote cite="{{$page}}"> <a href="{{$page}}">Facebook</a> </blockquote> </div> </div> </div>';
@empty
    widgets = undefined;
@endforelse

(function(){
		if(widgetsIds.length){
			for(var key in widgets){
			$(".widgetHere").append(widgets[key]);
					$("#li_"+key).css("opacity","0.5");
			if(widgetsIds[0] === key)
				{
					console.log(widgetsIds[0])
					console.log(key)
					$("#"+key).css("display","block");

					$("#li_"+key).css("opacity","1");
				}
			}
		}
})();
</script>
<div id="fb-root"></div>
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=972492646144125";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

if(window.location.hostname != '{{ $data->domain}}'){
	$("body").html('<p>Unauthorized Request from unknown Domain</p>');
	// document.getElementsByTagName('body').innerHTML = '<p>Unauthorized Request from unknown Domain</p>';
}
 </script>

	<script>$('#container').scrollable({'vertical' : 'true'});</script>
</body>
</html>