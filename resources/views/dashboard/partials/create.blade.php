<div ng-if="widget.alert.message">
	<response-messages messages="widget.alert.message" ></response-messages>
</div>
<ul class="list-group">
	<li class="list-group-item">
		<div class="main-wrapper">
			<h2 class="fb-widget-h2">Multi Facebook Pages Embedder Widget Maker</h2>
			<div class="content-wrapper">
				<form  class="form-widget" method="post" ng-submit="createWidget()">
					<div class="row-group">
						<label>Widget Name:</label>
						<input   class="fdin" type="text" ng-model="widget.widget_name" />
					</div>
					<div class="row-group">
						<label>Facebook Pages:</label>
						<div class="fb-page-box">
							<ul class="first-ul-int">
								<li ng-repeat="x in widget.pagesCounter track by $index">
									<input type="url" ng-value="'http://www.facebook.com/'"  ng-model="widget.pages[$index]" class="fb-url-int" />
									<div class="logo-ico">
										<span ng-click="removeFacebookPages($index)" class="btn btn-primary">Remove</span>
									{{-- <img src="http://www.w3schools.com/images/w3schools.png"></div> --}}
								</li>
							</ul>
							<input  class="add-another" ng-click="addFacebookPages()" type="button" value="Add" />
						</div>
					</div>
					<div class="row-group margin-top-20">
						<label>Display Settings:</label>
						<div class="fb-page-box-1">
							<div class="row-group">
								<input  ng-model="widget.settings.display.type"  value="random" name="display" type="radio" /><span class="label-inspan">Random</span>
							</div>
							<div class="row-group">
								<input  ng-model="widget.settings.display.type" value="latest" name="display" type="radio" /><span class="label-inspan">Page with latest post</span>
							</div>
							<div class="row-group">
								<input  ng-model="widget.settings.display.type" value="rotate" name="display" type="radio" /><span class="label-inspan">Auto Rotate every <input   class="section-input" type="text" ng-model="widget.settings.display.seconds" /> second</span>
							</div>
						</div>
					</div>
					<div class="row-group margin-top-20">
						<label>Widget Size:</label>
						<div class="fb-page-box-1">
							<div class="row-group res-hide">
								Width: <input ng-value="100" ng-model="widget.settings.size.width" class="section-input" type="text" />px
							</div>
							<div class="row-group res-hide">
								Height: <input  ng-value="100" ng-model="widget.settings.size.height" class="section-input" type="text" />px
							</div>
							<div class="row-group margin-top-20 clear-margin">
								<input    ng-model="widget.settings.size.responsive" id="responsive-checkbox" type="checkbox" /><span class="label-inspan">Or Responsive?</span>
							</div>
						</div>
					</div>
					<div class="row-group margin-top-10">
						<label>Show Friends Face:</label>
						<div class="fb-page-box-1">
							<div class="row-group">
								<input  type="checkbox" ng-model="widget.settings.show_friends_face"></input>
							</div>
						</div>
					</div>
					<div class="row-group margin-top-10">
						<label>Use Small Header:</label>
						<div class="fb-page-box-1">
							<div class="row-group">
								<input  type="checkbox" ng-model="widget.settings.show_small_header">
							</div>
						</div>
					</div>
					<div class="row-group margin-top-10">
						<label>Hide Cover Photo:</label>
						<div class="fb-page-box-1">
							<div class="row-group">
								<input  type="checkbox" ng-model="widget.settings.hide_cover_photo">
							</div>
						</div>
					</div>
					<div class="row-group margin-top-10">
						<label>Domain to be embedded at:</label>
						<div class="fb-page-box-1">
							<input  class="section-input-domain" type="url" ng-model="widget.settings.domain">
						</div>
					</div>
					<div class="row-group margin-top-30">
						<label>.</label>
						<div class="fb-page-box-1">
							<input  class="getcode" type="submit" value="Get Code">
						</div>
					</div>
				</form>
			</div>
		</div>
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
			// $(".add-another").click(function () {
						//  		$(".first-ul-int").append('<li><input  class="fb-url-int"><div class="logo-ico"><img src="http://www.w3schools.com/images/w3schools.png"></div><span class="close-span"><i class="fa fa-times"></i></span></li>');
			// });
		});
		</script>
	</li>
</ul>