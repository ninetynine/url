<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Helpers\Str;

trait Path
{
	/** @var string $path */
	protected $path;

	/**
	 * Set the path
	 *
	 * @param string $path
	 * @return $this
	 */
	public function path(string $path)
	{
		$this->path = Str::startsWith('/', $path)
			? substr($path, 1) : $path;

		return $this;
	}

	/**
	 * Reset the path
	 *
	 * @return $this
	 */
	public function resetPath()
	{
		$this->path = null;

		return $this;
	}

	/**
	 * Return the path
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}
}