<?php

namespace TFHInc\RealRedis\Traits;

/**
 * SupportRedis
 *
 * Support the RealRedis class with additional methods not found in the phpredis class.
 *
 * @package RealRedis
 * @author Colin Rafuse <colin.rafuse@gmail.com>
 */
trait SupportRedis {
    /**
     * Get cache key else execute the callable and set it
     *
     * @param   string    $key    Cache ID
     * @return  mixed
     */
    public function getElseSet(string $key, int $ttl, callable $else_callable)
    {
        if ($this->exists($key)) {
            error_log('return from cache');
            return $this->get($key);
        }

        error_log('run callable');
        try {
            $else_data = call_user_func($else_callable);
        } catch( Exception $e ) {
            // throw exception
        }

        error_log('set from callable');
        $this->set($key, $else_data);
        $this->expireAt($key, time() + $ttl);

        error_log('return from cache');
        return $this->get($key);
    }
}