<?php

namespace Tests;

use Faker\Factory as Faker;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{
    protected $fake;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    function __construct($name = null, $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->fake = Faker::create('de_DE');
    }
}
