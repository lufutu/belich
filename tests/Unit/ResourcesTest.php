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
        $this->assertEquals($resources, 3);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetResourcesForNavigationTest()
    {
        $resources = Belich::displayNavigationFields('tests/Fixtures/Resources')->count();
        $this->assertEquals($resources, 2);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetResourcesValueTest()
    {
        $resources = Belich::navigationFields('Cars');
        $result = collect([
            'class' => 'Cars',
            'displayInNavigation' => true,
            'group' => 'Sección 1',
                // Only for testing
                'icon' => '',
            'label' => 'Coche',
            'pluralLabel' => 'Coches',
            'resource' => 'Cars',
        ]);

        $this->assertEquals($resources, $result);
    }
}
