<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UnresolvableParameterException extends InvalidArgumentException
{
}
