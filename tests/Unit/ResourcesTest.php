<?php

namespace Daguilarm\Belich\Tests\Unit;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Tests\TestCase;

// test --filter=ResourcesTest
class ResourcesTest extends TestCase
{
    // test --filter=testResourcesMethodsTest
    public function testResourcesMethodsTest(): void
    {
        $this->assertEquals(Belich::name(), 'Belich Dashboard');
        $this->assertEquals(Belich::path(), '/dashboard');
        $this->assertEquals(Belich::pathName(), 'dashboard');
        $this->assertEquals(Belich::url(), 'http:/localhost/dashboard');
    }

    // test --filter=testGetResourceValuesTest
    public function testGetResourceValuesTest(): void
    {
        $class = Belich::getResource('car');

        $this->assertEquals($class::$group, 'Sección 1');
        $this->assertEquals($class::$label, 'Coche');
        $this->assertEquals($class::$pluralLabel, 'Coches');
    }
}
