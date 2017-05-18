<?php

namespace Path\Exceptions;

use InvalidArgumentException;

class PathDuplicateException extends InvalidArgumentException
{
	public function __construct ( string $pathname )
	{
		$this->message = "A path with the name $pathname is already registered.";
	}
}