<?php

namespace path;

use path\exceptions\invalidPathException;
use path\exceptions\missingPathException;
use path\exceptions\pathDuplicateException;

class collection
{
	private $root = '';
	private $paths = [ ];

	public function __construct ( string $root )
	{
		if ( ! $path = realpath ( $root ) )
			throw new invalidPathException ( $root );	
		$this->root = $path . '/';
		$this->paths [ 'root' ] = $this->root;
	}

	public function add ( string $pathname, string $path )
	{
		if ( $this->has ( $pathname ) )
			throw new pathDuplicateException ( $pathname );
		$this->paths [ $pathname ] = $this->compose ( $path );
	}

	public function has ( string $pathname ) : bool
	{
		return array_key_exists ( $pathname, $this->paths );
	}

	public function to ( string $pathname ) : string
	{
		if ( empty ( $file = pathinfo ( $pathname, PATHINFO_EXTENSION ) ) )
			return $this->form ( $pathname );	
		
		$file = basename ( $pathname );
		$pathname = dirname ( $pathname );

		return $this->form ( $pathname, $file );
	}

	private function form ( string $pathname, string $file = '' )
	{
		if ( $this->has ( $pathname ) )
			return rtrim ( $this->paths [ $pathname ] . $file, '/' );
		if ( $this->canAutoResolve ( $pathname ) )
			return rtrim ( $this->compose ( $pathname ) . $file, '/' );

		throw new missingPathException ( $pathname );
	}

	private function canAutoResolve ( string $pathname ) : bool
	{
		return is_dir ( $this->root . $pathname );
	}

	private function compose ( string $path ) : string
	{
		$path = $this->correct ( $path );
		return $this->root . $path;
	}

	private function correct ( string $path )
	{
		if ( $path === '.' or $path === '/' )
			return '';
		else
			return rtrim ( $path, '/' );
	}
}