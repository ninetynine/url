<?php
namespace NinetyNine\Url\Traits;

use NinetyNine\Url\Helpers\Methods;

use NinetyNine\Url\Exceptions\InvalidArrayException;
use NinetyNine\Url\Exceptions\InvalidArrayElementException;

trait QueryParam
{
	/** @var array $query_params */
	protected $query_params = [];

	/**
	 * Set multiple query params
	 *
	 * @param array $query_params
	 * @throws InvalidArrayException
	 * @return $this
	 */
	public function queryParams(array $query_params)
	{
		if (!empty($query_params)) {
			Methods::isAssociativeVolatile($query_params);
		}

		$this->query_params = $query_params;

		return $this;
	}

	/**
	 * Set a single query param
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return $this
	 */
	public function queryParam(string $key, $value = null)
	{
		$this->query_params = [ $key => $value ];

		return $this;
	}

	/**
	 * Append multiple query params
	 *
	 * @param array $query_params
	 * @throws InvalidArrayException
	 * @return $this
	 */
	public function appendQueryParams(array $query_params)
	{
		Methods::isAssociativeVolatile($query_params);

		$this->query_params = array_merge(
			$this->query_params, $query_params
		);

		return $this;
	}

	/**
	 * Append a single query param
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return $this
	 */
	public function appendQueryParam(string $key, $value = null)
	{
		$this->query_params[ $key ] = $value;

		return $this;
	}

	/**
	 * Prepend multiple query params
	 *
	 * @param array $query_params
	 * @throws InvalidArrayException
	 * @return $this
	 */
	public function prependQueryParams(array $query_params)
	{
		Methods::isAssociativeVolatile($query_params);

		$this->query_params = array_merge(
			$query_params, $this->query_params
		);

		return $this;
	}

	/**
	 * Prepend a single query param
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @return $this
	 */
	public function prependQueryParam(string $key, $value = null)
	{
		$this->query_params = array_merge(
			[ $key => $value ], $this->query_params
		);

		return $this;
	}

	/**
	 * Check if multiple query params exist
	 *
	 * @param mixed|array $key
	 * @return bool
	 */
	public function hasQueryParams($key)
	{
		$keys = is_array($key)
			? $key : func_get_args();

		// Faster than count key intersect
		foreach ($keys as $key) {
			if (!$this->hasQueryParam($key)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Check if multiple query params exist or throw
	 *
	 * @param mixed|array $key
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function hasQueryParamsVolatile($key)
	{
		$keys = is_array($key)
			? $key : func_get_args();

		// Faster than count key intersect
		foreach ($keys as $key) {
			try {
				$this->hasQueryParamVolatile($key);
			} catch (\Exception $e) {
				throw new InvalidArrayElementException($key);
			}
		}

		return $this;
	}

	/**
	 * Check if a query param exists
	 *
	 * @param string $key
	 * @return bool
	 */
	public function hasQueryParam(string $key)
	{
		return array_key_exists(
			$key, $this->query_params
		);
	}

	/**
	 * Check if a query param exists or throw
	 *
	 * @param string $key
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function hasQueryParamVolatile(string $key)
	{
		if (!$this->hasQueryParam($key)) {
			throw new InvalidArrayElementException;
		}

		return $this;
	}

	/**
	 * Update multiple query params
	 *
	 * @param array $query_params
	 * @throws InvalidArrayElementException
	 * @throws InvalidArrayException
	 * @return $this
	 */
	public function updateQueryParams(array $query_params)
	{
		Methods::isAssociativeVolatile($query_params);

		foreach ($query_params as $key => $value) {
			try {
				$this->updateQueryParam($key, $value);
			} catch (\Exception $e) {
				throw new InvalidArrayElementException($key);
			}
		}

		return $this;
	}

	/**
	 * Update a single query param
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function updateQueryParam(string $key, $value = null)
	{
		$this->hasQueryParamVolatile($key);

		$this->query_params[ $key ] = $value;

		return $this;
	}

	/**
	 * Remove multiple query params
	 *
	 * @param $key
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function removeQueryParams($key)
	{
		$keys = is_array($key)
			? $key : func_get_args();

		foreach ($keys as $key) {
			try {
				$this->removeQueryParam($key);
			} catch (\Exception $e) {
				throw new InvalidArrayElementException($key);
			}
		}

		return $this;
	}

	/**
	 * Remove a single query param
	 *
	 * @param string $key
	 * @throws InvalidArrayElementException
	 * @return $this
	 */
	public function removeQueryParam(string $key)
	{
		$this->hasQueryParamVolatile($key);

		Methods::remove($key, $this->query_params);

		return $this;
	}

	/**
	 * Return an array of query params
	 *
	 * @return array
	 */
	public function getQueryParams()
	{
		return $this->query_params;
	}

	/**
	 * Return query params as string
	 *
	 * @return string
	 */
	public function getQueryParamString()
	{
		return http_build_query($this->query_params);
	}
}