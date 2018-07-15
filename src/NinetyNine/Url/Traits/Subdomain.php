<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Exceptions\InvalidArrayElementException;

trait Subdomain
{
	/** @var array $subdomains */
	protected $subdomains = [];

	/**
	 * Set multiple subdomains
	 *
	 * @param string|array $subdomain
	 * @return $this
	 */
	public function subdomains($subdomain)
	{
		$this->subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		return $this;
	}

	/**
	 * Set a single subdomain
	 *
	 * @param string $subdomain
	 * @return $this
	 */
	public function subdomain(string $subdomain)
	{
		return $this->subdomains($subdomain);
	}

	/**
	 * Check if multiple subdomains exist
	 *
	 * @param string|array $subdomain
	 * @return bool
	 */
	public function hasSubdomains($subdomain)
	{
		$subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		foreach ($subdomains as $subdomain) {
			if (!$this->hasSubdomain($subdomain)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Check if multiple subdomains exist or throw
	 *
	 * @param string|array $subdomain
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function hasSubdomainsVolatile($subdomain)
	{
		$subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		foreach ($subdomains as $subdomain) {
			try {
				$this->hasSubdomainVolatile($subdomain);
			} catch (\Exception $e) {
				throw new InvalidArrayElementException($subdomain);
			}
		}

		return $this;
	}

	/**
	 * Check if a subdomain exists
	 *
	 * @param string $subdomain
	 * @return bool
	 */
	public function hasSubdomain(string $subdomain)
	{
		return in_array(
			$subdomain, $this->subdomains
		);
	}

	/**
	 * Check if a subdomain exists or throw
	 *
	 * @param string $subdomain
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function hasSubdomainVolatile(string $subdomain)
	{
		if (!$this->hasSubdomain($subdomain)) {
			throw new InvalidArrayElementException;
		}

		return $this;
	}

	/**
	 * Append multiple subdomains
	 *
	 * @param string|array $subdomain
	 * @return $this
	 */
	public function appendSubdomains($subdomain)
	{
		$subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		$this->subdomains = array_merge(
			$this->subdomains, $subdomains
		);

		return $this;
	}

	/**
	 * Append a single subdomain
	 *
	 * @param string $subdomain
	 * @return $this
	 */
	public function appendSubdomain(string $subdomain)
	{
		return $this->appendSubdomains($subdomain);
	}

	/**
	 * Prepend multiple subdomains
	 *
	 * @param string|array $subdomain
	 * @return $this
	 */
	public function prependSubdomains($subdomain)
	{
		$subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		$this->subdomains = array_merge(
			$subdomains, $this->subdomains
		);

		return $this;
	}

	/**
	 * Prepend a single subdomain
	 *
	 * @param string $subdomain
	 * @return $this
	 */
	public function prependSubdomain(string $subdomain)
	{
		return $this->prependSubdomains($subdomain);
	}

	/**
	 * Remove multiple subdomains
	 *
	 * @param string|array $subdomain
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function removeSubdomains($subdomain)
	{
		$subdomains = is_array($subdomain)
			? $subdomain : func_get_args();

		$this->hasSubdomainsVolatile($subdomain);

		$this->subdomains = array_filter(
			$this->subdomains,
			function ($subdomain) use ($subdomains) {
				return !in_array($subdomain, $subdomains);
			}
		);

		return $this;
	}

	/**
	 * Remove a single subdomain
	 *
	 * @param string $subdomain
	 * @throws InvalidArrayElementException
	 * @return Subdomain
	 */
	public function removeSubdomain(string $subdomain)
	{
		$this->hasSubdomainVolatile($subdomain);

		return $this->removeSubdomains($subdomain);
	}

	/**
	 * Remove all subdomains
	 *
	 * @return $this
	 */
	public function resetSubdomains()
	{
		$this->subdomains = [];

		return $this;
	}

	/**
	 * Return an array of subdomains
	 *
	 * @return array
	 */
	public function getSubdomains()
	{
		return $this->subdomains;
	}

	/**
	 * Return subdomains as a string
	 *
	 * @return string
	 */
	public function getSubdomainString()
	{
		return join('.', $this->subdomains);
	}
}