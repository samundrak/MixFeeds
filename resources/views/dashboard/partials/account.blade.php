<div class="col-md-3">
<ul class="list-group">
<li class="list-group-item">
<a ui-sref="dashboard({page:'account'})">Balance</a>
</li>
<li class="list-group-item">
<a ui-sref="account.subscriptions">Subscriptions</a>
</li>
<li class="list-group-item">
<a ui-sref="account.transaction">Transaction</a>
</li>
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
<form action='/expresscheckout' METHOD='POST'>
<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
</form>
	{{-- <a href="/payment"><img src="/public/img/pp.gif" class="img-responsive"/></a> --}}
</li>
</ul>
</ui-view>

</div>