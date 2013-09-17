mdn.io.php
==========

A port of [Davis]’ ([@lazd]) [mdn.io] to PHP. An “I’m feeling lucky” URL shortener.

Currently `server.php` is made to run as a _Router Script_ for PHP’s built-in web server. Execute with the following command:

```
php -S localhost:1337 server.php
```

For available settings, please see [the original README](https://github.com/lazd/mdn.io/blob/master/README.md). Environment variables can be set as follows:

```
SERVICE=ddg php -d variables_order=ES -S localhost:1337 server.php
```


[Davis]: http://lazd.net/
[@lazd]: https://github.com/lazd
[mdn.io]: https://github.com/lazd/mdn.io/