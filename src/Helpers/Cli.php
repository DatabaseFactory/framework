<?php

namespace DatabaseFactory\Helpers {

    /**
     * Helper for interacting with CLI requests
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Cli
    {
	    /**
	     * Is the current request a CLI request?
	     *
	     * @return bool
	     */
        public static function isCli(): bool
        {
            if (PHP_SAPI === 'cli') {
                return true;
            }
            if (defined('STDIN')) {
                return true;
            }
            if (stripos(PHP_SAPI, 'cgi') !== false && getenv('TERM')) {
                return true;
            }
            if (
                !isset($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']) && isset($_SERVER['argv']) && count(
                    $_SERVER['argv']
                ) > 0
            ) {
                return true;
            }
            return !isset($_SERVER['REQUEST_METHOD']);
        }
    }
}
