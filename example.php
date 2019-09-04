<?php

$v = new Webview([
    'url' => 'https://www.php.net/manual/en/ffi.examples-complete.php',
    'title' => 'Example Webview',
    'width' => 640,
    'height' => 480,
    // 'debug' => 0,
    // 'resizable' => 1,
    // 'fullscreen' => 0,
]);

$i = 0;

$frameSleep = .01;
$nextFrame = microtime(true) + $frameSleep;
$countDown = 20;

$callback = function($i) use (&$v, &$countDown) {
    if ($i == 200) {
        $v->eval("alert('Callback from php')");
    }

    if ($i == 400) {
        $v->inject_css('#layout-content {background-color: white; }');
    }

    if ($countDown <= 0) {
        $v->terminate();
    }

    if (($i % 100) == 0) {
        $countDown--;
        $v->set_title(sprintf(
            "Example Webview: Closing in %s",
            $countDown
        ));
    }
};

while ($v->loop(0)) {
    if (microtime(true) >= $nextFrame) {
        $i++;
        $callback($i);
        $nextFrame = $nextFrame + $frameSleep;
    }
}

echo "Complete!\n";

$v->exit();
