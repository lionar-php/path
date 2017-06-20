<?php

namespace path\exceptions;

use InvalidArgumentException as invalidArgumentException;

class invalidPathException extends invalidArgumentException
{
	public function __construct ( string $path )
	{
		$this->message = "path $path can not be resolved as a valid file system path.";
	}
}