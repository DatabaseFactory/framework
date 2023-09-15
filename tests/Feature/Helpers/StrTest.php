<?php

namespace Tests\Feature\Helpers {
    use DatabaseFactory\Helpers;

    class StrTest extends \Tests\TestCase
    {
    
        public function testTransformStringToSingularForm(): void
        {
            $this->original = 'Cars';
            $this->modified = Helpers\Str::singular($this->original);
            $this->expected = 'Car';
        
            $this->assertEquals($this->modified, $this->expected);
        }
        
        public function testTransformStringToPluralForm(): void
        {
            $this->original = 'Car';
            $this->modified = Helpers\Str::plural($this->original);
            $this->expected = 'Cars';

            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testStripDoubleQuotesFromString(): void
        {
            $this->original = '"Cars"';
            $this->modified = Helpers\Str::stripQuotes($this->original);
            $this->expected = 'Cars';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testStripSingleQuotesFromString(): void
        {
            $this->original = '\'Cars\'';
            $this->modified = Helpers\Str::stripQuotes($this->original);
            $this->expected = 'Cars';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testConvertStringToLowercase(): void
        {
            $this->original = 'Cars';
            $this->modified = Helpers\Str::lower($this->original);
            $this->expected = 'cars';
            $this->assertEquals($this->modified, $this->expected);
        }

	    public function testConvertStringToSnakeCase(): void
	    {
		    $this->original = 'Some cars are very fast';
		    $this->modified = Helpers\Str::snakeCase($this->original);
		    $this->expected = 'some_cars_are_very_fast';
		    $this->assertEquals($this->modified, $this->expected);
	    }
    
        public function testConvertStringToUppercase(): void
        {
            $this->original = 'Cars';
            $this->modified = Helpers\Str::upper($this->original);
            $this->expected = 'CARS';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testConvertStringToSlug(): void
        {
            $this->original = 'Some cars are very fast';
            $this->modified = Helpers\Str::slug($this->original);
            $this->expected = 'some-cars-are-very-fast';
            $this->assertEquals($this->modified, $this->expected);
        }

        public function testConvertStringToDotNotation(): void
        {
            $this->original = 'Some cars are very fast';
            $this->modified = Helpers\Str::dot($this->original);
            $this->expected = 'some.cars.are.very.fast';
            $this->assertEquals($this->modified, $this->expected);
        }
    }
}
