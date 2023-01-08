<?php

namespace Tests {
	
	use PHPUnit\Framework\TestCase as PHPUnitTestCase;
	
	class TestCase extends PHPUNitTestCase
	{
		protected mixed $original;
		protected mixed $modified;
		protected mixed $expected;
	}
}