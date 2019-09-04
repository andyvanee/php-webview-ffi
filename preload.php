<?php

/**
 * Preloader for webview
 */

// We must change directory so that webview-ext.h can use a relative
// path to FFI_LIB.
$cwd = getcwd();
chdir(__DIR__ . "/src");
FFI::load("webview-ext.h");
opcache_compile_file("webview-ext.php");
chdir($cwd);
