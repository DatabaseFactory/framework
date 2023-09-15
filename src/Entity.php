<?php

namespace DatabaseFactory {

    /**
     * The base entity class
     *
     *
     * @package DatabaseFactory
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Entity
    {
        // ORM Plugins
        use ORM\HasQuery;
        use ORM\HasTable;
        use ORM\HasSave;

        /**
         * Constructor
         *
         * @param int|null $id Pass an ID to update a record
         */
        public function __construct(private ?int $id = null)
        {
        }
    }
}
