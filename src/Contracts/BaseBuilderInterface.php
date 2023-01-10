<?php

namespace DatabaseFactory\Contracts {

    /**
     * Contract for the query builder
     *
     * @package DatabaseFactory\Contracts
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    interface BaseBuilderInterface
    {
        /**
         * SELECT
         *
         * @param string $columns
         *
         * @return string
         */
        public static function select(string $columns): string;

        /**
         * LIMIT
         *
         * @param int $rows
         *
         * @return string
         */
        public static function limit(int $rows): string;

        /**
         * OFFSET
         *
         * @param int $count
         *
         * @return string
         */
        public static function offset(int $count): string;

        /**
         * COUNT
         *
         * @param string $values
         *
         * @return string
         */
        public static function count(string $values): string;

        /**
         * VALUES
         *
         * @param array $values
         *
         * @return string
         */
        public static function values(array $values): string;

        /**
         * COLUMNS
         *
         * @param array $columns
         *
         * @return string
         */
        public static function columns(array $columns): string;

        /**
         * FROM
         *
         * @param string $table
         *
         * @return string
         */
        public static function from(string $table): string;
    }
}
