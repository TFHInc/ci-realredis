<?php

namespace TFHInc\RealRedis;

/**
 * RealRedis
 *
 * A wrapper library for phpredis.
 *
 * @package RealRedis
 * @author Colin Rafuse <colin.rafuse@gmail.com>
 */
class RealRedis
{
    use \TFHInc\RealRedis\Traits\SupportRedis;

    /**
     * @var object
     */
    protected $CI;

    /**
     * Default config
     *
     * @static
     * @var    array
     */
    protected static $_default_config = array(
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'timeout' => 0,
        'database' => 0
    );

    /**
     * Redis connection
     *
     * @var    Redis
     */
    protected $_redis;

    /**
     * Class constructor
     *
     * Setup Redis
     *
     * Loads Redis config file if present. Will halt execution
     * if a Redis connection can't be established.
     *
     * @return    void
     */
    public function __construct()
    {
        $this->CI =& get_instance();

        if ( ! $this->is_supported())
        {
            log_message('error', 'Cache: Failed to create Redis object; extension not loaded?');
            return;
        }

        if ($this->CI->config->load('redis', TRUE, TRUE))
        {
            $config = array_merge(self::$_default_config, $this->CI->config->item('redis'));
        }
        else
        {
            $config = self::$_default_config;
        }

        $this->_redis = new \Redis();

        try
        {
            if ( ! $this->_redis->connect($config['host'], ($config['host'][0] === '/' ? 0 : $config['port']), $config['timeout']))
            {
                log_message('error', 'Cache: Redis connection failed. Check your configuration.');
            }

            if (isset($config['password']) && ! $this->_redis->auth($config['password']))
            {
                log_message('error', 'Cache: Redis authentication failed.');
            }

            if (isset($config['database']) && $config['database'] > 0 && ! $this->_redis->select($config['database']))
            {
                log_message('error', 'Cache: Redis select database failed.');
            }
        }
        catch (RedisException $e)
        {
            log_message('error', 'Cache: Redis connection refused ('.$e->getMessage().')');
        }
    }

    /**
     * Magic method to catch and call phpredis methods.
     *
     * @param   string        $method
     * @param   array         $arguments
     * @return  mixed
     */
    public function __call(string $method, array $arguments)
    {
        return $this->_redis->$method(...array_values($arguments));
    }

    /**
     * Check if Redis driver is supported
     *
     * @return    bool
     */
    public function is_supported()
    {
        return extension_loaded('redis');
    }

    /**
     * Class destructor
     *
     * Closes the connection to Redis if present.
     *
     * @return    void
     */
    public function __destruct()
    {
        if ($this->_redis)
        {
            $this->_redis->close();
        }
    }
}
