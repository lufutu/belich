<?php

namespace Daguilarm\Belich\Tests\Unit;

use Daguilarm\Belich\Facades\Belich;
use Daguilarm\Belich\Tests\TestCase;

// test --filter=SidebarTest
class SidebarTest extends TestCase
{
    // test --filter=testGetTotalGroupsOfResourcesFromFolderTest
    public function testGetTotalGroupsOfResourcesFromFolderTest(): void
    {
        $groups = Belich::sidebar()->count();
        $this->assertEquals($groups, 2);
    }

    // test --filter=testGetTotalResourcesFromFolderTest
    public function testGetTotalResourcesFromFolderTest(): void
    {
        $resources = Belich::sidebar()->map(function($items) {
            return $items;
        })
            ->collapse()
            ->count();

        $this->assertEquals($resources, 3);
    }

    // test --filter=testGetValuesFromResourceTest
    public function testGetValuesFromResourceTest(): void
    {
        $resource = Belich::sidebar()->first()->first();
        $result = collect([
            'class' => 'Cars',
            'group' => 'Sección 1',
                // Only for testing
                'icon' => '',
            'label' => 'Coche',
            'pluralLabel' => 'Coches',
            'resource' => 'Cars',
        ]);

        $this->assertEquals($resource, $result);
    }
}
