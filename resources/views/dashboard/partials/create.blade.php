<ul class="list-group">
<li class="list-group-item">
<div class="main-wrapper">
	<h2 class="fb-widget-h2">Multi Facebook Pages Embedder Widget Maker</h2>
	<div class="content-wrapper">
		<form class="form-widget" action="#" method="post">
			<div class="row-group">
				<label>Widget Name:</label>
				<input class="fdin" type="text">
			</div>
			<div class="row-group">
				<label>Facebook Pages:</label>
				<div class="fb-page-box">
					<ul class="first-ul-int">
						<li>
						<input class="fb-url-int">
						<div class="logo-ico"><img src="http://www.w3schools.com/images/w3schools.png"></div>
						</li>
					</ul>
					<input class="add-another" type="button" value="Add">
				</div>
			</div>
			<div class="row-group margin-top-20">
				<label>Display Settings:</label>
				<div class="fb-page-box-1">
					<div class="row-group">
						<input type="checkbox"><span class="label-inspan">Random</span>
					</div>
					<div class="row-group">
						<input type="checkbox"><span class="label-inspan">Page with latest post</span>
					</div>
					<div class="row-group">
						<input type="checkbox"><span class="label-inspan">Auto Rotate every <input class="section-input" type="text"> second</span>
					</div>
				</div>
			</div>
			<div class="row-group margin-top-20">
				<label>Widget Size:</label>
				<div class="fb-page-box-1">
					<div class="row-group res-hide">
						Width: <input class="section-input" type="text">px
					</div>
					<div class="row-group res-hide">
						Height: <input class="section-input" type="text">px
					</div>
					<div class="row-group margin-top-20 clear-margin">
						<input id="responsive-checkbox" type="checkbox"><span class="label-inspan">Or Responsive?</span>
					</div>
				</div>
			</div>
			<div class="row-group margin-top-10">
				<label>Show Friends Face:</label>
				<div class="fb-page-box-1">
					<div class="row-group">
						<input type="checkbox">
					</div>
				</div>
			</div>
			<div class="row-group margin-top-10">
				<label>Use Small Header:</label>
				<div class="fb-page-box-1">
					<div class="row-group">
						<input type="checkbox">
					</div>
				</div>
			</div>
			<div class="row-group margin-top-10">
				<label>Hide Cover Photo:</label>
				<div class="fb-page-box-1">
					<div class="row-group">
						<input type="checkbox">
					</div>
				</div>
			</div>
			<div class="row-group margin-top-10">
				<label>Domain to be embedded at:</label>
				<div class="fb-page-box-1">
					<input class="section-input-domain" type="text">
				</div>
			</div>
			<div class="row-group margin-top-30">
				<label>.</label>
				<div class="fb-page-box-1">
					<input class="getcode" type="submit" value="Get Code">
				</div>
			</div>
		</form>
	</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#responsive-checkbox').removeAttr('checked');
 	$('.res-hide').css("display", "block");
	$('#responsive-checkbox').change(function () {
	 	if (this.checked) {
			$('.res-hide').css("display", "none");
			$('.clear-margin').css("margin", "0px !important");
		}

		else {
			$('.res-hide').css("display", "block");
		}
	});
	$(".add-another").click(function () {
  		$(".first-ul-int").append('<li><input class="fb-url-int"><div class="logo-ico"><img src="http://www.w3schools.com/images/w3schools.png"></div></li>');
	});


});
</script>
</li>
</ul>