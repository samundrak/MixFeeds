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
{{-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="samundra.kc6@gmail.com">
<input type="hidden" name="item_name" value="hat">
<input type="hidden" name="item_number" value="123">
<input type="hidden" name="amount" value="15.00">
<input type="hidden" name="first_name" value="John">
<input type="hidden" name="last_name" value="Doe">
<input type="hidden" name="address1" value="9 Elm Street">
<input type="hidden" name="address2" value="Apt 5">
<input type="hidden" name="city" value="Berwyn">
<input type="hidden" name="state" value="PA">
<input type="hidden" name="zip" value="19312">
<input type="hidden" name="night_phone_a" value="610">
<input type="hidden" name="night_phone_b" value="555">
<input type="hidden" name="night_phone_c" value="1234">
<input type="hidden" name="email" value="samundra.kc6@gmail.com">
<input type="image" name="submit" border="0"
src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">
</form> --}}

	 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="samundra.kc6@gmail.com">
<input type="hidden" name="lc" value="BM">
<input type="hidden" name="item_name" value="subscription">
<input type="hidden" name="amount" value="10.00">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
 <input type="hidden" name="notify_url" value="http://">

<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</li>
</ul>
</ui-view>

</div>