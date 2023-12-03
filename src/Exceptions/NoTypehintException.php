<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class NoTypehintException extends Exception implements ContainerExceptionInterface
{
}
