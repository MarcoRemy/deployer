<?php

namespace Deployer;

set('opcache_reset_nonce', bin2hex(random_bytes(8)));
set('opcache_public_dir', 'htdocs');

desc('PHP - Place opcache reset script');
task('deploy:reset_opcache:create', function () {
    $targetFilepath = sprintf(
        '%s/%s/reset_opcache-%s.php',
        get('release_path'),
        get('opcache_public_dir'),
        get('opcache_reset_nonce'),
    );
    upload(dirname(__DIR__) . '/files/reset_opcache.php', $targetFilepath);
});

desc('PHP - Execute opcache reset');
task('deploy:reset_opcache:execute', function () {
    // TODO: configurable server url
    $result = fetch("https://{{hostname}}/opcache-reset-{{opcache_reset_nonce}}.php");
    if ($result !== 'success') {
        throw error('Reset PHP opcache failed');
    }
});
