<?php

namespace Path;

use Path\Exceptions\InvalidPathException;
use Path\Exceptions\MissingPathException;
use Path\Exceptions\PathDuplicateException;

class Collection
{
	private $root = '';
	private $paths = [ ];

	public function __construct ( string $root )
	{
		if ( ! $path = realpath ( $root ) )
			throw new InvalidPathException ( $root );	
		$this->root = $path . '/';
		$this->paths [ 'root' ] = $this->root;
	}

	public function add ( string $pathname, string $path )
	{
		if ( $this->has ( $pathname ) )
			throw new PathDuplicateException ( $pathname );
		$this->paths [ $pathname ] = $this->compose ( $path );
	}

	public function has ( string $pathname ) : bool
	{
		return array_key_exists ( $pathname, $this->paths );
	}

	public function to ( string $pathname ) : string
	{
		if ( $this->has ( $pathname ) )
			return $this->paths [ $pathname ];
		if ( $this->canAutoResolve ( $pathname ) )
			return $this->autoResolve ( $pathname );

		throw new MissingPathException ( $pathname );
	}

	private function canAutoResolve ( string $pathname ) : bool
	{
		return is_dir ( $this->root . $pathname );
	}

	private function autoResolve ( string $pathname ) : string
	{
		return $this->compose ( $pathname );
	}

	private function compose ( string $path ) : string
	{
		return $this->root . rtrim ( $path, '/' ) . '/';
	}
}