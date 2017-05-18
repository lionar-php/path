<?php

namespace Path\Exceptions;

use InvalidArgumentException;

class MissingPathException extends InvalidArgumentException
{
	public function __construct ( string $pathname )
	{
		$this->message = "A path with the name $pathname can not be found.";
	}
}