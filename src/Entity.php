<?php

namespace DatabaseFactory {

    use ReflectionClass;
    use ReflectionProperty;
    use DatabaseFactory\ORM;
    use DatabaseFactory\Facades;

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
        use ORM\HasConfig;
        use ORM\HasTable;
        use ORM\HasWhere;
        use ORM\HasFirst;
        use ORM\HasJoin;
        use ORM\HasFind;
        use ORM\HasLast;
        use ORM\HasLike;
        use ORM\HasAll;
        use ORM\HasNot;

        /**
         * ID of a record for updating
         *
         * @var int|null $id
         */
        private ?int $id;

        /**
         * Constructor
         *
         * @param int $id Pass an ID to update a record
         */
        public function __construct(int $id = null)
        {
            $this->id = $id;
        }

        /**
         * Save a record
         *
         * @return bool|int
         */
        public function save(): bool|int
        {
            // SET props
            $propsToImplode = [];

            // default ID
            $this->id ??= 0;

            // generate SET props
            foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                $propertyName = trim($property->getName(), $property->getModifiers());
                $propsToImplode[] = '`' . $propertyName . '` = "' . $this->{$propertyName} . '"';
            }

            // generate the SET clause by gluing all key value
            // pairs together
            $setClause = implode(',', $propsToImplode);

            // are we updating an existing record, or creating a new one?
            if ($this->id > 0) {
                $sqlQuery = 'UPDATE `' . static::table() . '` SET ' . $setClause . ' WHERE id = ' . $this->id;
            } else {
                $sqlQuery = 'INSERT ' . 'INTO ' . static::table() . ' SET ' . $setClause . ', id = ' . $this->id;
            }

            // finally, let's execute the query
            return Facades\DB::connection()->exec($sqlQuery);
        }
    }
}
