<?php
if (!function_exists('realredis')) {
    /**
     * Return an instance of the RealRedis Library.
     *
     * @return TFHInc\RealRedis\RealRedis
     */
    function realredis(): TFHInc\RealRedis\RealRedis
    {
        $CI =& get_instance();

        if (!isset($CI->realredis)) {
            $CI->realredis = new TFHInc\RealRedis\RealRedis();
        } elseif (!$CI->realredis instanceof TFHInc\RealRedis\RealRedis) {
            $CI->realredis = new TFHInc\RealRedis\RealRedis();
        }

        return $CI->realredis;
    }
}