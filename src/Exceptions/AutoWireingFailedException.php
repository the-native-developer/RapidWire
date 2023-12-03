<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AutoWireingFailedException extends Exception implements NotFoundExceptionInterface
{
}
