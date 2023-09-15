<?php

namespace DatabaseFactory\ORM {

    trait HasUpsert
    {
        /**
         * Acts as an INSERT or and UPDATE query
         *
         * @param array         $data
         * @param int|null      $id
         * @param callable|null $callback
         *
         * @return bool
         */
        public static function upsert(array $data, int $id = null, callable $callback = null): bool
        {
            $class = static::class;
            $entity = new $class($id);

            foreach ($data as $key => $value) {
                $entity->$key = $value;
            }

            if ($entity->save()) {
                if (! is_null($callback)) {
                    $callback($entity);
                }
                return true;
            }
            return false;
        }
    }
}
