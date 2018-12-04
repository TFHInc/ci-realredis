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
     * Get the cache key. If it does not exist, execute the callable and set the cache key.
     *
     * @param   string      $key
     * @param   int         $ttl
     * @param   callable    $callable
     * @return  mixed
     */
    public function getElseSet(string $key, int $ttl, callable $callable)
    {
        if ($this->exists($key)) {
            return $this->get($key);
        }

        try {
            $callable_data = call_user_func($callable);
        } catch( Exception $e ) {
            // throw exception
        }

        $this->set($key, $callable_data);
        $this->expireAt($key, time() + $ttl);

        return $this->get($key);
    }

    /**
     * Execute the callable and set the cache key.
     *
     * @param   string      $key
     * @param   int         $ttl
     * @param   callable    $callable
     * @return  mixed
     */
    public function getAndSet(string $key, int $ttl, callable $callable)
    {
        try {
            $callable_data = call_user_func($callable);
        } catch( Exception $e ) {
            // throw exception
        }

        $this->set($key, $callable_data);
        $this->expireAt($key, time() + $ttl);

        return $this->get($key);
    }
}