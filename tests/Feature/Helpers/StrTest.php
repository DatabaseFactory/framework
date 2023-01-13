<?php

namespace Tests\Feature\Helpers {

    use DatabaseFactory\Helpers\Str;
    use Tests\TestCase;

    class StrTest extends TestCase
    {
        public function testTransformStringToPluralForm(): void
        {
            $this->original = 'Car';
            $this->modified = Str::plural($this->original);
            $this->expected = 'Cars';

            $this->assertEquals($this->modified, $this->expected);
        }

        public function testTransformStringToSingularForm(): void
        {
            $this->original = 'Cars';
            $this->modified = Str::singular($this->original);
            $this->expected = 'Car';

            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testConvertStringToLowercase(): void
        {
            $this->original = 'Cars';
            $this->modified = Str::lower($this->original);
            $this->expected = 'cars';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testConvertStringToUppercase(): void
        {
            $this->original = 'Cars';
            $this->modified = Str::upper($this->original);
            $this->expected = 'CARS';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testStripDoubleQuotesFromString(): void
        {
            $this->original = '"Cars"';
            $this->modified = Str::stripQuotes($this->original);
            $this->expected = 'Cars';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testStripSingleQuotesFromString(): void
        {
            $this->original = '\'Cars\'';
            $this->modified = Str::stripQuotes($this->original);
            $this->expected = 'Cars';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testConvertStringToSlug(): void
        {
            $this->original = 'Some cars are very fast';
            $this->modified = Str::slug($this->original);
            $this->expected = 'some-cars-are-very-fast';
            $this->assertEquals($this->modified, $this->expected);
        }
    }
}
