<?php

namespace DatabaseFactory\Factory {

    use DatabaseFactory\Helpers;

    class Generator
    {
        /**
         * Returns a random email address
         *
         * @return string
         */
        public function email($separator = '_'): string
        {
            return Helpers\Str::replace($this->fullName(), $separator) . '@' . $this->word() . '.' . Helpers\Arr::random($this->parse('domains'));
        }

        /**
         * Returns a random first name
         *
         * @return string
         */
        public function firstName(): string
        {
            return Helpers\Arr::random($this->parse('firstNames'));
        }

        /**
         * Returns a random full name
         *
         * @return string
         */
        public function fullName(): string
        {
            return $this->firstName() . ' ' . $this->lastName();
        }

        /**
         * Returns a random last name
         *
         * @return string
         */
        public function lastName(): string
        {
            return Helpers\Arr::random($this->parse('lastNames'));
        }

        /**
         * Returns a random word
         *
         * @return string
         */
        public function word(): string
        {
            return Helpers\Arr::random($this->parse('words'));
        }

        /**
         * Takes the contents of a JSON file, converts them into
         * a PHP array, and returns that array
         *
         * @param string $filename
         *
         * @return array
         * @throws \JsonException
         */
        private function parse(string $filename): array
        {
            $data = file_get_contents(__DIR__ . '/Data/' . $filename . '.json');
            return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        }
    }
}
