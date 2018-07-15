<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Helpers\Str;

trait Host
{
	/** @var string $host */
	protected $host;

	/**
	 * Set the host
	 *
	 * @param string $host
	 * @return $this
	 */
	public function host(string $host)
	{
		$this->host = Str::startsWith('www.', $host)
			? substr($host, 4) : $host;

		return $this;
	}

	/**
	 * Return the host
	 *
	 * @return string
	 */
	public function getHost()
	{
		return $this->host;
	}
}