<?php

namespace Tests\Feature\Helpers {
	
	use DatabaseFactory\Helpers;
	use Tests\TestCase;
	
	class StrTest extends TestCase
	{
		public function testTransformStringToPluralForm(): void
		{
			$this->original = 'Car';
			$this->modified = Helpers\Str::plural($this->original);
			$this->expected = 'Cars';
			
			$this->assertEquals($this->modified, $this->expected);
		}
		
		public function testTransformStringToSingularForm(): void
		{
			$this->original = 'Cars';
			$this->modified = Helpers\Str::singular($this->original);
			$this->expected = 'Car';
			
			$this->assertEquals($this->modified, $this->expected);
		}
	}
}