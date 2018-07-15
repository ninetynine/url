<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Helpers\Str;

trait Version
{
	/** @var integer $version */
	protected $version;

	/**
	 * Set version
	 *
	 * @param string|int $version
	 * @return $this
	 */
	public function version($version)
	{
		$this->version = Str::startsWith('/', $version)
			? substr($version, 1) : $version;

		return $this;
	}

	/**
	 * Reset version
	 *
	 * @return $this
	 */
	public function resetVersion()
	{
		$this->version = null;

		return $this;
	}

	/**
	 * Get version
	 *
	 * @return int
	 */
	public function getVersion()
	{
		return $this->version;
	}
}