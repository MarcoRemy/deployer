<?php

/*
 * Fetch this file from the web server once the path has been switched to the new release.
 * It must be executed by the web server because its opcache is stored in a separate memory space.
 */
if (function_exists("clearstatcache")) {
    // Clear realpath cache
    clearstatcache(true);
}
if (function_exists("opcache_reset")) {
    // Clear opcache
    opcache_reset();
}
@unlink(__FILE__);
echo "success";
