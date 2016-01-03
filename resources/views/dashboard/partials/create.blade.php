<ul class="list-group">
	<li class="list-group-item">
		<div class="main-wrapper">
			<h2 class="fb-widget-h2">Multi Facebook Pages Embedder Widget Maker</h2>
			<div class="content-wrapper">
				<form  class="form-widget" method="post" ng-submit="createWidget()">
					<div class="row-group">
						<label>Widget Name:</label>
						<input ng-disabled="ifOnEdit"   class="fdin" type="text" ng-model="widget.widget_name" />
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
							<input  class="section-input-domain" type="url" ng-disabled="ifOnEdit" ng-model="widget.settings.domain">
						</div>
					</div>
					<div class="row-group margin-top-30">
						<label>.</label>
						<div class="fb-page-box-1">
							<input  class="getcode" type="submit" value="Save">
							<input style="margin-left:5px"  class="getcode" type="button" value="Preview" ng-click="getCode(null,true)">
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
<div style="color:black;" class="modal fade" id="codeView" tabindex="-1" role="dialog" aria-labelledby="codeViewLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div ng-if="!preview">
				<h4 class="modal-title" id="codeViewLabel">Widget Code</h4>
				<label> Copy paste the code into your website,where you want to display widget</label>
				<textarea ng-model="code" width="auto" rows="5" class="form-control"></textarea>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<div ng-if="preview">
				<display-widget id="me" code="code"></display-widget>
			</div>
		</div>
	</div>
</div>