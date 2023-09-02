<?php

namespace DatabaseFactory\ORM {

	use DatabaseFactory\Facades;
	use ReflectionProperty;
	use ReflectionClass;

	trait HasSave
	{
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