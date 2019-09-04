<?php

final class Webview {
    private static $ffi;
    private $fullscreen;

    /**
     * new Webview([$args])
     *
     * @param $args - an array of arguments to the webview
     */
    public function __construct(array $args = []) {
        self::initFFI();

        $this->ptr = self::$ffi->php_webview_new(
            (string) ($args['title'] ?? 'Example'),
            (string) ($args['url'] ?? 'https://en.m.wikipedia.org/wiki/Main_Page'),
            (int) ($args['width'] ?? 800),
            (int) ($args['height'] ?? 600),
            (int) ($args['debug'] ?? 0),
            (int) ($args['resizable'] ?? 1)
        );

        self::$ffi->webview_init($this->ptr);

        if (array_key_exists('fullscreen', $args)) {
            $this->setFullscreen($args['fullscreen']);
        }
    }

    public function setFullscreen($on=1) {
        $this->fullscreen = (int) $on;
        self::$ffi->webview_set_fullscreen($this->ptr, $on);
    }

    public function loop($blocking = 0): bool {
        $blocking = (int) $blocking;
        return (self::$ffi->webview_loop($this->ptr, $blocking) == 0) ? true : false;
    }

    public function eval(string $js) {
        self::$ffi->webview_eval($this->ptr, $js);
    }

    public function inject_css(string $css) {
        self::$ffi->webview_inject_css($this->ptr, $css);
    }

    public function set_title(string $title) {
        self::$ffi->webview_set_title($this->ptr, $title);
    }

    public function exit() {
        self::$ffi->webview_exit($this->ptr);
    }

    public function terminate() {
        self::$ffi->webview_terminate($this->ptr);
    }

    public function __destruct() {
        self::$ffi->php_webview_free($this->ptr);
    }

    private static function initFFI() {
        if (!static::$ffi) {
            static::$ffi = FFI::scope("WEBVIEW");
        }
    }
}
