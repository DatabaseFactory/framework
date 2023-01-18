<?php

namespace DatabaseFactory\Collections {

    readonly class ToJSON implements \JsonSerializable
    {
        public function __construct(private array $collection = [])
        {
            // ...
        }

        public function jsonSerialize(): array
        {
            return $this->collection;
        }
    }
}
