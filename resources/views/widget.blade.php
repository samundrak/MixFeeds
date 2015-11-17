@include('global.headers')

<div class="row">
<div class="col-md-1">
@foreach($data->pages as $page)

<img src="http://graph.facebook.com/v2.5/{{fbpp($page)}}/picture"/>
@endforeach
</div>
<div class="col-md-10">
@forelse($data->pages as $page)
<div   id="{{fbpp($page)}}">
<div
	class="fb-page"
	data-href=" {{ $page }}"
	data-width=" {{ $data->settings->size->width }}"
	data-height="{{ $data->settings->size->height }}"
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
</body>
<div id="fb-root"></div>
<div id="fb-root"></div>
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=972492646144125";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</html>