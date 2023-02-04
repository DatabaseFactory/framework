<?php

namespace DatabaseFactory\Config {

    use DatabaseFactory\Helpers;
    use DatabaseFactory\Contracts;

    /**
     * SQL Module DB
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
            return self::DBLQT . Helpers\Str::stripQuotes($string) . self::DBLQT;
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
            return self::SGLQT . Helpers\Str::stripQuotes($string) . self::SGLQT;
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
        public static function contains(string $field, $value): string
        {
            return self::WHERE . 'find_in_set' . self::OPPAR . self::SGLQT . $value . self::SGLQT . self::SEPARATOR . $field . self::CLPAR > 0;
        }

        public static function where(string $columns): string
        {
            return static::WHERE . $columns;
        }

        public static function like(string $pattern, bool $not = false): string
        {
            $notStr = $not ? self::NOT : self::EMPTY;
            return $notStr . self::LIKE . static::SGLQT . self::PERC . $pattern . self::PERC . static::SGLQT;
        }

        public static function select(string $columns, bool $space = false): string
        {
            $select = $space ? self::SPC : self::EMPTY;
            return self::SELECT . self::SPC . $columns . $select;
        }

        public static function limit(int $rows): string
        {
            return self::LIMIT . self::SPC . $rows;
        }

        public static function offset(int $count): string
        {
            return self::OFFSET . self::SPC . $count;
        }

        public static function count($values = self::ALL): string
        {
            return self::COUNT . self::OPPAR . $values . self::CLPAR;
        }

        public static function values(array $values): string
        {
            $string = self::OPPAR;
            foreach ($values as $value) {
                $string .= self::VALUE . self::SEPARATOR;
            }
            $string .= self::CLPAR;
            return str_replace($string, '?`, )', '?`)');
        }

        public static function columns(array $columns): string
        {
            return rtrim($columns[0], self::SEPARATOR);
        }

        public static function from(string $table = null): string
        {
            return self::FROM . $table ? : '';
        }

        public static function join(string $params, array $on): string
        {
            return static::SPC . static::JOIN . $params . self::ON . rtrim(implode(self::EQUALS, $on), self::EQUALS);
        }
    }
}
