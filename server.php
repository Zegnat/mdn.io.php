<?php

	$serviceURLs = array(
		'google' => 'http://google.com/search?btnI&q=',
		'bing' => 'http://www.bing.com/search?q=',
		'ddg' => 'https://duckduckgo.com/?q=%21+'
	);

	$defaults = array(
		'SERVICE' => 'google',
		'SEARCH_DOMAIN' => 'developer.mozilla.org',
		'FALLBACK_URL' => 'https://developer.mozilla.org/en-US/docs/JavaScript'
	);

	foreach ($defaults as $var => $default) {
		$$var = $default;
		if (isset($_ENV[$var])) {
			$$var = $_ENV[$var];
		} elseif (isset($_SERVER[$var])) {
			$$var = $_SERVER[$var];
		} else {
			$__ENV = array_change_key_case($_ENV, CASE_UPPER);
			if (isset($__ENV[$var])) {
				$$var = $__ENV[$var];
			} else {
				$__SERVER = array_change_key_case($_SERVER, CASE_UPPER);
				if (isset($__SERVER[$var])) {
					$$var = $__SERVER[$var];
				}
			}
		}
	}

	$query = substr(urldecode($_SERVER['REQUEST_URI']),1);
	$url = empty($query) ? $FALLBACK_URL
	                     : (isset($serviceURLs[$SERVICE]) ? $serviceURLs[$SERVICE]
	                                                      : $serviceURLs[$defaults['SERVICE']])
	                     . urlencode($query.' site:'.$SEARCH_DOMAIN);

	if (php_sapi_name() === 'cli-server') file_put_contents('php://stdout', sprintf(
		"%s => %s\n",
		empty($query) ? '(empty query)' : $query,
		$url
	));

	header('Location: '.$url, true, 303);
	exit();

?>