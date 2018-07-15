<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Exceptions\InvalidProtocolException;
use NinetyNine\Url\Helpers\Protocols;

trait Protocol
{
	/** @var bool $secure */
	protected $secure;

	/** @var string $protocol */
	protected $protocol = 'http';

	/**
	 * Set if URL should be http or not
	 *
	 * @param bool $secure
	 * @return $this
	 */
	public function security(bool $secure)
	{
		if (!empty($this->protocol) && $secure) {
			$variations = Protocols::getSecureVariations($this->protocol);

			if (!empty($variations)) {
				$this->protocol = $variations[ 0 ];
			}
		}

		$this->secure = $secure;

		return $this;
	}

	/**
	 * Set security based on protocol
	 *
	 * @return $this
	 */
	public function securityBasedOnProtocol()
	{
		if (empty($this->protocol) || Protocols::isUnsecure($this->protocol)) {
			$this->secure = false;
		} elseif (Protocols::isSecure($this->protocol)) {
			$this->secure = true;
		}

		return $this;
	}

	/**
	 * Set the protocol
	 *
	 * @param string $protocol
	 * @throws \NinetyNine\Url\Exceptions\InvalidProtocolException
	 * @return $this
	 */
	public function protocol(string $protocol)
	{
		list($is_supported, $is_secure)
			= Protocols::isSupportedWithSecurity($protocol);

		if (!$is_supported) {
			throw new InvalidProtocolException;
		}

		if (is_bool($this->secure) && $this->secure !== $is_secure) {
			throw new InvalidProtocolException;
		}

		$this->protocol = strtolower($protocol);
		$this->secure   = $is_secure;

		return $this;
	}

	/**
	 * Return secure bool
	 *
	 * @return bool
	 */
	public function getSecurity()
	{
		return $this->secure;
	}

	/**
	 * Return the protocol
	 *
	 * @return string
	 */
	public function getProtocol()
	{
		return $this->protocol;
	}
}