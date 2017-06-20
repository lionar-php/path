<?php

namespace path\exceptions;

use InvalidArgumentException as invalidArgumentException;

class pathDuplicateException extends invalidArgumentException
{
	public function __construct ( string $pathname )
	{
		$this->message = "A path with the name $pathname is already registered.";
	}
}