<?php

namespace TheNativeDeveloper\RapidWire\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class DuplicateContainerIdException extends Exception implements ContainerExceptionInterface
{

}