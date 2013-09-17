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
		if (isset($_ENV[$var])) {
			$$var = $_ENV[$var];
		} else {
			$$var = $default;
		}
	}

	$query = substr(urldecode($_SERVER['REQUEST_URI']),1);
	$url = empty($query) ? $FALLBACK_URL
	                     : (isset($serviceURLs[$SERVICE]) ? $serviceURLs[$SERVICE]
	                                                      : $serviceURLs[$defaults['SERVICE']])
	                     . urlencode($query.' site:'.$SEARCH_DOMAIN);

	file_put_contents("php://stdout", sprintf(
		"%s => %s\n",
		empty($query) ? '(empty query)' : $query,
		$url
	));

	header('Location: '.$url, true, 303);
	exit();

?>