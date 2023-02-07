<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class NoTypeException extends Exception implements ContainerExceptionInterface
{
}
