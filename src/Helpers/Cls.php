<?php

namespace DatabaseFactory\Helpers {

    use ReflectionClass;
    use Throwable;

    /**
     * Helper for working with classes and objects
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Cls
    {
        /**
         * Wrapper for is_subclass_of()
         *
         * @param string $class
         * @param string $parent
         *
         * @return bool
         *
         * @see \is_subclass_of
         *
         */
        public static function extends(string $class, string $parent): bool
        {
            return is_subclass_of($class, $parent);
        }

        /**
         * Returns only a classes namespace name
         *
         * @param string $classname
         *
         * @return string
         *
         * @throws \ReflectionException
         */
        public static function getNamespace(string $classname): string
        {
            return rtrim((new ReflectionClass($classname))->getNamespaceName(), self::stripNamespace($classname));
        }

        /**
         * Strip the namespace from a FQCN
         *
         * @param string $classname
         *
         * @return string
         *
         * @throws \ReflectionException
         */
        public static function stripNamespace(string $classname): string
        {
            return (new ReflectionClass($classname))->getShortName();
        }

        /**
         * Check to see if a class implements the \Throwable interface
         *
         * @param string $exception
         *
         * @return bool
         *
         * @throws \ReflectionException
         */
        public static function throwable(string $exception): bool
        {
            return self::implements($exception, Throwable::class);
        }

        /**
         * Does a class implement an interface?
         *
         * @param string $class
         * @param string $interface
         *
         * @return bool
         *
         * @throws \ReflectionException
         */
        public static function implements(string $class, string $interface): bool
        {
            return (new ReflectionClass($class))->implementsInterface($interface);
        }

        /**
         * Are two classes the same as one another?
         *
         * @param string $classOne
         * @param string $classTwo
         *
         * @return bool
         */
        public static function equals(string $classOne, string $classTwo): bool
        {
            return $classOne === $classTwo;
        }

        /**
         * Wrapper for class_exists()
         *
         * @param string $class
         *
         * @return bool
         * @see \class_exists
         *
         */
        public static function exists(string $class): bool
        {
            return class_exists($class);
        }
    }
}
