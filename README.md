# PHP-Webview-FFI

This is a test of using <https://github.com/zserge/webview> via FFI that
is introduced in PHP 7.4.

# Requirements

The docker method is recommended as this involves building PHP from source.

    docker build -t php-webview-ffi .
    docker run --rm -it -v $(pwd):/app -e DISPLAY=host.docker.internal:0 php-webview-ffi bash

If you want to build it without docker, the Dockerfile is pretty readable and
should give you a clue as to what is required. Also note that opcache and FFI
need to be enabled and preloading `preload.php` in order for the extension to be
registered. See the `opcache` and `ffi` sections in `config/php.ini` for the
settings I'm using. More info on FFI can be found here:
<https://www.php.net/manual/en/ffi.examples-complete.php>
