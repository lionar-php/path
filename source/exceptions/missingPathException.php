<?php

namespace path\exceptions;

use InvalidArgumentException as invalidArgumentException;

class missingPathException extends invalidArgumentException
{
	public function __construct ( string $pathname )
	{
		$this->message = "A path with the name $pathname can not be found.";
	}
}