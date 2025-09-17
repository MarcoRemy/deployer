<?php

namespace Deployer;

set('reset_opcache_nonce', bin2hex(random_bytes(8)));
set('reset_opcache_document_root', '{{current_path}}');

desc('Resets PHP OPcache');
task('deploy:reset_opcache', function () {
    // place script in server's web root
    $targetFilepath = '{{reset_opcache_document_root}}/reset_opcache-{{reset_opcache_nonce}}.php';
    upload(dirname(__DIR__) . '/files/reset_opcache.php', $targetFilepath);

    // fetch script from server
    // TODO: configurable server url
    $result = fetch("https://{{hostname}}/opcache-reset-{{reset_opcache_nonce}}.php");
    if ($result !== 'success') {
        throw error('Reset PHP OPcache failed');
    }
});
