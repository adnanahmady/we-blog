<?php

if (!function_exists('pregTrim')) {
    /**
     * Trims given string from specified patterns.
     *
     * @param string $string      context
     * @param string ...$patterns Patterns, default is '.*\\\\'.
     */
    function pregTrim(
        string $string,
        string ...$patterns
    ): string {
        if (!count($patterns)) {
            $patterns = ['.*\\\\'];
        }

        foreach ($patterns as $pattern) {
            $string = preg_replace(
                "/$pattern/",
                '',
                $string
            );
        }

        return $string;
    }
}
