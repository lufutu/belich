<?php

namespace Daguilarm\Belich\Tests\Unit;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Tests\TestCase;

class ResourcesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetResourcesFromFolderTest()
    {
        $resources = Belich::allResources('tests/Fixtures/Resources')->count();
        dd(Belich::allResources('tests/Fixtures/Resources'));

        $this->assertEquals($resources, 3);
    }
}
