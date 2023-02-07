<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class UnresolvableException extends Exception implements ContainerExceptionInterface
{
}
