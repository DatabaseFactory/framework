<?php

namespace Helpers {
    
    use DatabaseFactory\Helpers\Env;
    use Tests\TestCase;
    
    class EnvTest extends TestCase
    {
        /** @var string $path Location of the env file(s) */
        private string $path = __DIR__ . '/../../Examples/';
        
        public function testLoadFromDefaultEnvFile(): void
        {
            Env::init($this->path);
            $this->expected = (bool)Env::get('TEST_KEY');
            $this->assertTrue($this->expected);
        }
        
        public function testLoadFromCustomEnvFile(): void
        {
            Env::init($this->path, '.env.example');
            $this->expected = (bool)Env::get('TEST_KEY');
            $this->assertTrue($this->expected);
        }
    }
}
