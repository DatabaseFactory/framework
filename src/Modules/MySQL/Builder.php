<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Modules;
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
    class Builder extends Modules\BaseBuilder implements Contracts\BaseBuilderInterface
    {
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

        public static function join(string $params, array $on, string $type = 'INNER'): string
        {
            return static::SPC . $type . static::JOIN . $params . self::ON . rtrim(implode(self::EQUALS, $on), self::EQUALS);
        }
    }
}
