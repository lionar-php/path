<?php

namespace Path\Exceptions;

use InvalidArgumentException;

class InvalidPathException extends InvalidArgumentException
{
	public function __construct ( string $path )
	{
		$this->message = "path $path can not be resolved as a valid file system path.";
	}
}