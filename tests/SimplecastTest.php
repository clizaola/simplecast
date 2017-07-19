<?php
namespace Tests\Unit;

use Tests\TestCase;
use Clizaola\Simplecast\Simplecast;


class SimplecastTest extends TestCase
{
	/**
     * A basic test example.
     *
     * @return void
     */
    public function testGetPodcasts()
    {
        $simplecast = new Simplecast;

        $simplecast->podcasts();
    }
}
