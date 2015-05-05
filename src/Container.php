<?php
/**
 * Created by PhpStorm.
 * User: Tom Gribbins
 * Date: 27/04/2015
 * Time: 10:29
 */

namespace shanecullinane\Discogs;

/**
 * Class Container
 * An attempt at managing dependency injection. Based on this tutorial: http://code.tutsplus.com/tutorials/dependency-injection-huh--net-26903
 *
 * Register classes in the Register class
 *
 * @package shanecullinane\Discogs
 */
class Container {

    public static $classes = array();

    /**
     * Classes and their dependancies are listed in the Register class.  Setup instantiates the register and makes them
     * available in the Container.
     */
    public static function setup(){
        new Register() ;
    }

    /**
     * Register a class name and the function/closure which will generate the class and it's dependencies.
     *
     * @param string $name
     * @param $function
     */
     public static function register($name, $function) {
        self::$classes[$name] = $function;
     }

    /**
     * Returns an instance of the class with dependencies already injected
     *
     * @param string $name name of class
     * @return mixed Class
     * @throws \Exception
     */
     public static function get ($name) {

        if (self::registered($name) ) {
            $function = static::$classes[$name];
            return $function();

        }
         throw new \Exception("Cannot find the class '$name' in the Discogs register");
     }

    /**
     * Checks if a class of the given name is registered in the container
     *
     * @param string $name name of class
     * @return bool
     */
    public static function registered($name)
    {
        return array_key_exists($name, self::$classes);
    }

}