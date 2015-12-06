<?php

return array(
	'payment_method' => 'paypal',
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => 'AUFndcIFT14BZdqJtTyxRJTWebjbid2m_tDHXtAJ9FLNICU56Y1JXTkcm1SQmglrZXHvC253TLJnXPuC',
		'ClientSecret' => 'EOmAsIaNsklKz785JmEDn7UEsWjdiUGyD_hFb3i5n62VzhudoSaBXewWhlLG2qg74pjgz-9xAKIYtIIt',
	),

	# Connection Information
	'Http' => array(
		'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),

	# Logging Information
	'Log' => array(
		'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		'LogLevel' => 'FINE',
	),
);
