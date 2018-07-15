<?php
namespace NinetyNine\Url\Traits;

trait Port
{
	/** @var integer $port */
	protected $port;

	/**
	 * Set port
	 *
	 * @param int $port
	 * @return $this
	 */
	public function port(int $port)
	{
		$this->port = $port;

		return $this;
	}

	/**
	 * Reset port
	 *
	 * @return $this
	 */
	public function resetPort()
	{
		$this->port = null;

		return $this;
	}

	/**
	 * Get port
	 *
	 * @return int
	 */
	public function getPort()
	{
		return $this->port;
	}
}