<div class="col-md-3">
<ul class="list-group">
<li class="list-group-item">
<a ui-sref="settings.changePassword">Change Password</a>
</li>
<li class="list-group-item">
<a ui-sref="settings.changeEmail">Change Email Address</a>
</li>
{{-- <li class="list-group-item"> --}}
{{-- <a ui-sref="settings.deleteAccount">Delete Account</a> --}}
{{-- </li> --}}
</ul>
</div>
<div class="col-md-9">

<ui-view>
<ul class="list-group">
<li class="list-group-item active">
Account Details</li>
<li class="list-group-item">
	Your total Balance is: <b> {{ Auth::user()->balance }}$</b>
</li>

<li class="list-group-item">
	<a href="/payment"><img src="/public/img/pp.gif" class="img-responsive"/></a>
</li>
</ul>
</ui-view>

</div>