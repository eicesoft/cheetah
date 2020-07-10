<?php
namespace Cheetah\Util;


if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     */
    function value($value)
    {
        return $value instanceof \Closure ? $value() : $value;
    }
}

if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param null|array|int|string $key
     * @param null|mixed $default
     * @param mixed $target
     */
    function data_get($target, $key, $default = null)
    {
        if ($target == null) {
            return $default;
        }

        if ($key == null) {
            return $target;
        }

        $keys = explode('.', $key);
        $ret = $target;
        while (! is_null($segment = array_shift($keys))) {
            if (isset($ret[$segment])) {
                $ret = $ret[$segment];
            } else {
                $ret = $default;
            }
        }

        return $ret;
    }
}