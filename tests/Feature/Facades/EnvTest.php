<?php

namespace Tests\Feature\Facades {
    
    use DatabaseFactory\Facades;
    use Tests\TestCase;
    
    class EnvTest extends TestCase
    {
        /** @var string $path Location of the env file(s) */
        private string $path = __DIR__ . '/../../Examples/';
        
        public function testLoadFromDefaultEnvFile(): void
        {
            Facades\Env::init($this->path);
            $this->expected = (bool)Facades\Env::get('TEST_KEY');
            $this->assertTrue($this->expected);
        }
        
        public function testLoadFromCustomEnvFile(): void
        {
            Facades\Env::init($this->path, '.env.example');
            $this->expected = (bool)Facades\Env::get('TEST_KEY');
            $this->assertTrue($this->expected);
        }
    }
}
