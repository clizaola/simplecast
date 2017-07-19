<?php

namespace Clizaola\Simplecast;
use Illuminate\Support\Facades\Facade;

class SimplecastFacade extends Facade
{
    
    protected static function getFacadeAccessor() { return 'simplecast'; }

}
