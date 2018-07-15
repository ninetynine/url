<?php
namespace NinetyNine\Url;

use NinetyNine\Url\Traits\Host;
use NinetyNine\Url\Traits\Path;
use NinetyNine\Url\Traits\Protocol;
use NinetyNine\Url\Traits\QueryParam;
use NinetyNine\Url\Traits\Subdomain;
use NinetyNine\Url\Traits\Port;
use NinetyNine\Url\Traits\Version;

use NinetyNine\Url\Exceptions\InvalidArrayException;
use NinetyNine\Url\Exceptions\InvalidProtocolException;

class Url
{
	use Host, Path, Protocol,
		Subdomain, QueryParam,
		Port, Version;

	/**
	 * @param string $host
	 * @param array  $query_params
	 * @throws InvalidArrayException
	 */
	protected function __construct(string $host = '', array $query_params = [])
	{
		$this->host($host);
		$this->queryParams($query_params);
	}

	/**
	 * Statically create an instance
	 *
	 * @param string $host
	 * @param array  $query_params
	 * @throws InvalidArrayException
	 * @return Url
	 */
	public static function make(string $host = '', array $query_params = [])
	{
		return new self($host, $query_params);
	}

	/**
	 * Parse a URL
	 *
	 * @param string $url
	 * @param int    $tld_segments
	 * @param int    $version_segment
	 * @throws InvalidArrayException
	 * @throws InvalidProtocolException
	 * @return Url
	 */
	public static function parse(string $url, int $tld_segments, int $version_segment = null)
	{
		$parsed   = parse_url($url);
		$instance = new self;

		$parsed_host    = explode('.', $parsed[ 'host' ]);
		$hostname_index = count($parsed_host) - ($tld_segments + 1);

		$host       = array_slice($parsed_host, $hostname_index);
		$subdomains = array_slice($parsed_host, 0, $hostname_index);

		if (isset($parsed[ 'scheme' ])) {
			$instance->protocol($parsed[ 'scheme' ]);
			$instance->securityBasedOnProtocol();
		}

		if (!empty($host)) {
			$instance->host(join('.', $host));
		}

		if (!empty($subdomains)) {
			$instance->subdomains($subdomains);
		}

		if (isset($parsed[ 'port' ])) {
			$instance->port($parsed[ 'port' ]);
		}

		if (isset($parsed[ 'path' ])) {
			if (is_int($version_segment)) {
				$bits = explode('/', $parsed[ 'path' ]);

				if (isset($bits[ $version_segment ])) {
					$instance->version($bits[ $version_segment ]);
				}

				$parsed[ 'path' ] = join('/', array_slice($bits, ($version_segment + 1)));
			}

			$instance->path($parsed[ 'path' ]);
		}

		if (isset($parsed[ 'query' ])) {
			$params = explode('&', $parsed[ 'query' ]);

			foreach ($params as $param) {
				$instance->appendQueryParam(...explode('=', $param));
			}
		}

		return $instance;
	}

	/**
	 * Build URL
	 *
	 * @param bool $with_protocol
	 * @return string
	 */
	public function get(bool $with_protocol = true)
	{
		$url = $this->host;

		// Add subdomains
		if (!empty($this->subdomains)) {
			$url = $this->getSubdomainString()
				   . '.' . $url;
		}

		// Add protocol
		if (!empty($this->protocol) && $with_protocol) {
			$url = $this->protocol . '://' . $url;
		}

		// Add port
		if (!empty($this->port)) {
			$url .= ':' . $this->port;
		}

		// Add version
		if (!empty($this->version)) {
			$url .= '/' . $this->version;
		}

		// Add path
		if (!empty($this->path)) {
			$url .= '/' . $this->path;
		}

		// Add query params
		if (!empty($this->query_params)) {
			$url .= '?' . $this->getQueryParamString();
		}

		return $url;
	}
}