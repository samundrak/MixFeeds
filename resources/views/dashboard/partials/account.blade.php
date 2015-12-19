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
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="samundra.kc6@gmail.com">
<input type="hidden" name="lc" value="BM">
<input type="hidden" name="item_name" value="subscription">
<label>Enter amount you want </label>
<input type="text" name="amount" required value="10.00" placeholder="Enter amount you want" class="form-control">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="hidden"  name="return" value="http://52.33.26.178/">
<input type="hidden"  name="cancel_return" value="http://52.33.26.178/">
<input type="hidden"  name="notify" value="http://localhost/payment/done">
<br/>
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
 <input type="hidden" name="notify_url" value="http://">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</li>
</ul>
</ui-view>

</div>