<?php

namespace Helpers {
    
    use Tests\TestCase;
    use DatabaseFactory\Helpers\Cls;
    use Tests\Examples\ExampleClass;
    use Tests\Examples\ExampleClassTwo;
    use Tests\Examples\ExampleException;
    
    class ClsTest extends TestCase
    {
        public function testClassIsThrowable(): void
        {
            $this->original = ExampleException::class;
            $this->expected = Cls::throwable($this->original);
            $this->assertTrue($this->expected);
        }
        
        public function testClassExtendsClass(): void
        {
            $this->original = ExampleClassTwo::class;
            $this->expected = Cls::extends($this->original, ExampleClass::class);
            $this->assertTrue($this->expected);
        }
        
        public function testClassImplementsInterface(): void
        {
            $this->original = ExampleClass::class;
            $this->expected = Cls::implements($this->original, \Countable::class);
            $this->assertTrue($this->expected);
        }
        
        public function testTwoClassesAreNotEqual(): void
        {
            $this->original = ExampleClass::class;
            $this->expected = Cls::equals($this->original, ExampleClassTwo::class);
            $this->assertFalse($this->expected);
        }
        
        public function testVerifyIfClassExists(): void
        {
            $this->original = ExampleClass::class;
            $this->expected = Cls::exists($this->original);
            $this->assertTrue($this->expected);
        }
    
        public function testStripNamespaceFromClass(): void
        {
            $this->original = ExampleClass::class;
            $this->modified = Cls::stripNamespace($this->original);
            $this->expected = 'ExampleClass';
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testGetNamespaceFromClass(): void
        {
            $this->original = ExampleClass::class;
            $this->modified = Cls::getNamespace($this->original);
            $this->expected = 'Tests\\';
            $this->assertEquals($this->modified, $this->expected);
        }
    }
}
