<?php

namespace DatabaseFactory\Collections {

    class ToArray implements \ArrayAccess
    {
        public function __construct(private array $collection)
        {
            // ...
        }

        public function collection(): array
        {
            return $this->collection;
        }

        public function offsetSet($offset, $value): void
        {
            !is_null($offset)
                ? $this->collection[$offset] = $value
                : $this->collection[] = $value;
        }

        public function offsetExists($offset): bool
        {
            return isset($this->collection[$offset]);
        }

        public function offsetUnset($offset): void
        {
            unset($this->collection[$offset]);
        }

        public function offsetGet($offset): ?int
        {
            return $this->collection[$offset] ?? null;
        }
    }
}
