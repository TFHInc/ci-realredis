<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * RealRedis
 *
 * A CI wrapper library to load RealRedis.
 *
 * @package RealRedis
 * @author Colin Rafuse <colin.rafuse@gmail.com>
 */
class RealRedis extends \TFHInc\RealRedis\RealRedis {
    /**
     * Class constructor
     *
     * @return    void
     */
    public function __construct() {
        parent::__construct();
    }
}
