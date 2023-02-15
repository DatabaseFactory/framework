<?php

namespace DatabaseFactory\Config {

    use DatabaseFactory\Helpers;
    use DatabaseFactory\Contracts;

    /**
     * SQL BaseBuilder
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class BaseBuilder implements Contracts\BaseBuilderInterface
    {
        // @todo - reimplement as non-constants (props as an array, perhaps?)
        protected const COUNT = 'COUNT';
        protected const WHERE = ' WHERE ';
        protected const LIKE = ' LIKE ';
        protected const ORDER_BY = ' ORDER BY ';
        protected const GROUP_BY = ' GROUP BY ';
        protected const SELECT = 'SELECT';
        protected const INSERT = 'INSERT ';
        protected const UPDATE = 'UPDATE ';
        protected const DELETE = 'DELETE ';
        protected const JOIN = 'JOIN ';
        protected const OFFSET = ' OFFSET';
        protected const LIMIT = ' LIMIT';
        protected const OR_NOT = ' OR NOT ';
        protected const FROM = ' FROM ';
        protected const NOT = ' <>';
        protected const AND = ' AND ';
        protected const SEPARATOR = ', ';
        protected const BKTK = '`';
        protected const EQUALS = ' = ';
        protected const COMMA = ',';
        protected const SPC = ' ';
        protected const EMPTY = '';
        protected const SGLQT = "'";
        protected const DBLQT = '"';
        protected const PRD = '.';
        protected const ON = ' ON ';
        protected const OR = ' OR ';
        protected const TRUE = 'TRUE';
        protected const FALSE = 'FALSE';
        protected const ZERO = 0;
        protected const ONE = 1;
        protected const ASC = 'ASC';
        protected const DESC = 'DESC';
        protected const OPPAR = '(';
        protected const CLPAR = ')';
        protected const VALUE = '`?`';
        protected const ALL = '*';
        protected const PERC = '%';

        // joins
        protected const LEFT = ' LEFT';
        protected const RIGHT = ' RIGHT';
        protected const OUTER = ' OUTER';
        protected const INNER = ' INNER';


        /**
         * Strip a string of quotes
         *
         * @param string $string
         *
         * @return string
         */
        protected static function strip(string $string): string
        {
            return Helpers\Str::stripQuotes($string, true);
        }

        /**
         * Add double quotes to a string
         *
         * @param string $string
         *
         * @return string
         */
        protected static function doubleQuote(string $string): string
        {
            return self::DBLQT . self::strip($string) . self::DBLQT;
        }

        /**
         * Add single quotes to a string
         *
         * @param string $string
         *
         * @return string
         */
        protected static function singleQuote(string $string): string
        {
            return self::SGLQT . self::strip($string) . self::SGLQT;
        }

        /**
         * Increment a value
         *
         * @param int $value
         *
         * @return int
         */
        protected static function increment(int $value = 0): int
        {
            return $value + self::ONE;
        }

        /**
         * Decrement a value
         *
         * @param int $value
         *
         * @return int
         */
        protected static function decrement(int $value = 0): int
        {
            return $value - self::ONE;
        }

        /**
         * Implement FIND_IN_SET(...)
         *
         * @param string $field
         * @param mixed  $value
         *
         * @return string
         */
        public static function contains(string $field, $value): string
        {
            return self::WHERE . 'find_in_set' . self::OPPAR . self::SGLQT . $value . self::SGLQT . self::SEPARATOR . $field . self::CLPAR > 0;
        }

        /**
         * Implement WHERE
         *
         * @param string $columns
         *
         * @return string
         */
        public static function where(string $columns): string
        {
            return static::WHERE . $columns;
        }

        /**
         * Implement LIKE
         *
         * @param string $pattern
         * @param bool   $not 
         *
         * @return string
         */
        public static function like(string $pattern, bool $not = false): string
        {
            $notStr = $not ? self::NOT : self::EMPTY;
            return $notStr . self::LIKE . static::SGLQT . self::PERC . $pattern . self::PERC . static::SGLQT;
        }

        /**
         * Implement SELECT
         *
         * @param string $columns
         * @param bool   $space 
         *
         * @return string
         */
        public static function select(string $columns, bool $space = false): string
        {
            $select = $space ? self::SPC : self::EMPTY;
            return self::SELECT . self::SPC . $columns . $select;
        }

        /**
         * Implement LIMIT
         *
         * @param int $rows
         *
         * @return string
         */
        public static function limit(int $rows): string
        {
            return self::LIMIT . self::SPC . $rows;
        }

        /**
         * Implement OFFSET
         *
         * @param int $rows
         *
         * @return string
         */
        public static function offset(int $rows): string
        {
            return self::OFFSET . self::SPC . $rows;
        }

        /**
         * Implement COUNT
         *
         * @param string $values
         *
         * @return string
         */
        public static function count(string $values = self::ALL): string
        {
            return self::COUNT . self::OPPAR . $values . self::CLPAR;
        }

        /**
         * Determine values for a query
         *
         * @param array $values
         *
         * @return string
         */
        public static function values(array $values): string
        {
            $string = self::OPPAR;
            foreach ($values as $value) {
                $string .= self::VALUE . self::SEPARATOR;
            }
            $string .= self::CLPAR;
            return str_replace($string, '?`, )', '?`)');
        }

        /**
         * Determine columns of a query
         *
         * @param array $columns
         *
         * @return string
         */
        public static function columns(array $columns): string
        {
            return rtrim($columns[0], self::SEPARATOR);
        }

        /**
         * Implement FROM
         *
         * @param string $table
         *
         * @return string
         */
        public static function from(string $table = null): string
        {
            return self::FROM . $table ? : '';
        }

        /**
         * Implement JOIN
         *
         * @param string $params
         * @param array  $on
         *
         * @return string
         */
        public static function join(string $params, array $on): string
        {
            return static::SPC . static::JOIN . $params . self::ON . rtrim(implode(self::EQUALS, $on), self::EQUALS);
        }
    }
}
