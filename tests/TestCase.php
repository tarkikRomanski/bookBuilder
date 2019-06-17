<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Returns a structure of the pagination.
     * @return array
     */
    public function getPaginationStructure(): array
    {
        return [
            'total',
            'count',
            'per_page',
            'current_page',
            'total_pages',
        ];
    }
}
