<?php

namespace Tests\Feature\Helpers {
    
    use DatabaseFactory\Helpers\Arr;
    use Tests\TestCase;
    
    class ArrTest extends TestCase
    {
        public function testArrayKeysAreTrimmed(): void
        {
            $this->original = [' my', 'cool ', ' array '];
            
            $this->modified = Arr::trim($this->original);
            $this->expected = ['my', 'cool', 'array'];
            $this->assertEquals($this->modified, $this->expected);
        }
    
        public function testArrayContainsKey(): void
        {
            $this->original = ['key' => 'value'];
            $this->expected = Arr::hasKey('key', $this->original);
            $this->assertTrue($this->expected);
        }
    }
}
