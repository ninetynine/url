<?php
namespace NinetyNine\Url\Helpers;

use NinetyNine\Url\Exceptions\InvalidProtocolException;

class Protocols
{
	/** @var array https://www.iana.org/assignments/uri-schemes/uri-schemes.xhtml */
	const SUPPORTED_PROTOCOLS
		= [
			'aaa'                      => [ 'aaas' ],
			'about'                    => null,
			'acap'                     => null,
			'acct'                     => null,
			'acr'                      => null,
			'adiumxtra'                => null,
			'afp'                      => null,
			'afs'                      => null,
			'aim'                      => null,
			'appdata'                  => null,
			'apt'                      => null,
			'attachment'               => null,
			'aw'                       => null,
			'barion'                   => null,
			'beshare'                  => null,
			'bitcoin'                  => null,
			'blob'                     => null,
			'bolo'                     => null,
			'browserext'               => null,
			'callto'                   => null,
			'cap'                      => null,
			'chrome'                   => null,
			'chrome-extension'         => null,
			'cid'                      => null,
			'coap'                     => null,
			'coap+tcp'                 => null,
			'coap+ws'                  => null,
			'com-event-brite-attendee' => null,
			'content'                  => null,
			'conti'                    => null,
			'crid'                     => null,
			'cvs'                      => null,
			'data'                     => null,
			'dav'                      => null,
			'diaspora'                 => null,
			'dict'                     => null,
			'did'                      => null,
			'dis'                      => null,
			'dlna-playcontainer'       => null,
			'dlna-playsingle'          => null,
			'dns'                      => null,
			'dntp'                     => null,
			'dtn'                      => null,
			'dvb'                      => null,
			'ed2k'                     => null,
			'elsi'                     => null,
			'example'                  => null,
			'facetime'                 => null,
			'fax'                      => null,
			'feed'                     => null,
			'feedready'                => null,
			'file'                     => null,
			'filesystem'               => null,
			'finger'                   => null,
			'fish'                     => null,
			'ftp'                      => [ 'sftp' ],
			'geo'                      => null,
			'gg'                       => null,
			'git'                      => null,
			'gizmoproject'             => null,
			'go'                       => null,
			'gopher'                   => null,
			'graph'                    => null,
			'gtalk'                    => null,
			'h323'                     => null,
			'ham'                      => null,
			'hcp'                      => null,
			'http'                     => [ 'https', 'shttp' ],
			'hxxp'                     => [ 'hxxps' ],
			'hydrazone'                => null,
			'iax'                      => null,
			'icap'                     => null,
			'icon'                     => null,
			'im'                       => null,
			'imap'                     => null,
			'info'                     => null,
			'iotdisco'                 => null,
			'ipn'                      => null,
			'ipp'                      => [ 'ipps' ],
			'irc'                      => [ 'ircs' ],
			'irc6'                     => null,
			'iris'                     => null,
			'iris.beep'                => null,
			'iris.lwz'                 => null,
			'iris.xpc'                 => [ 'iris.xpcs' ],
			'isostore'                 => null,
			'itms'                     => null,
			'jabber'                   => null,
			'jar'                      => null,
			'jms'                      => null,
			'keyparc'                  => null,
			'lastfm'                   => null,
			'idap'                     => [ 'idaps' ],
			'lvlt'                     => null,
			'magnet'                   => null,
			'mailserver'               => null,
			'mailto'                   => null,
			'maps'                     => null,
			'market'                   => null,
			'message'                  => null,
			'mid'                      => null,
			'mms'                      => null,
			'modem'                    => null,
			'mongodb'                  => null,
			'moz'                      => null,
			'msnim'                    => null,
			'msrp'                     => [ 'msrps' ],
			'mtqp'                     => null,
			'mumble'                   => null,
			'mupdate'                  => null,
			'mvn'                      => null,
			'news'                     => [ 'snews' ],
			'nfs'                      => null,
			'ni'                       => null,
			'nih'                      => null,
			'nntp'                     => null,
			'notes'                    => null,
			'ocf'                      => null,
			'oid'                      => null,
			'onenote'                  => null,
			'onenote-cmd'              => null,
			'opaquelocktoken'          => null,
			'openpgp4fpr'              => null,
			'pack'                     => null,
			'palm'                     => null,
			'paparazzi'                => null,
			'pkcs11'                   => null,
			'platform'                 => null,
			'pop'                      => null,
			'pres'                     => null,
			'prospero'                 => null,
			'proxy'                    => null,
			'pwid'                     => null,
			'psyc'                     => null,
			'qb'                       => null,
			'query'                    => null,
			'redis'                    => null,
			'rediss'                   => null,
			'reload'                   => null,
			'res'                      => null,
			'resource'                 => null,
			'rmi'                      => null,
			'rsync'                    => null,
			'rtmfp'                    => null,
			'rtmp'                     => null,
			'rtsp'                     => [ 'rtsps' ],
			'rtspu'                    => null,
			'secondlife'               => null,
			'service'                  => null,
			'session'                  => null,
			'sgn'                      => null,
			'sieve'                    => null,
			'sip'                      => [ 'sips' ],
			'skype'                    => null,
			'smb'                      => null,
			'sms'                      => null,
			'snmp'                     => null,
			'soap.beep'                => [ 'soap.beeps' ],
			'soldat'                   => null,
			'spiffe'                   => null,
			'spotify'                  => null,
			'ssh'                      => null,
			'steam'                    => null,
			'stun'                     => [ 'stuns' ],
			'submit'                   => null,
			'snv'                      => null,
			'tag'                      => null,
			'teamspeak'                => null,
			'tel'                      => null,
			'teliaeid'                 => null,
			'telnet'                   => null,
			'tftp'                     => null,
			'things'                   => null,
			'thismessage'              => null,
			'tip'                      => null,
			'tn3270'                   => null,
			'tool'                     => null,
			'turn'                     => [ 'turns' ],
			'tv'                       => null,
			'udp'                      => null,
			'unreal'                   => null,
			'urn'                      => null,
			'ut2004'                   => null,
			'v-event'                  => null,
			'vemmi'                    => null,
			'entrilo'                  => null,
			'videotex'                 => null,
			'vnc'                      => null,
			'view-source'              => null,
			'wais'                     => null,
			'webcal'                   => null,
			'wpid'                     => null,
			'ws'                       => [ 'wss' ],
			'wtai'                     => null,
			'wyciwyg'                  => null,
			'xcon'                     => null,
			'xcon-userid'              => null,
			'xmlrpc.beep'              => [ 'xmlrpc.beeps' ],
			'xmpp'                     => null,
			'xri'                      => null,
			'ymsgr'                    => null,
			'z39.50'                   => null,
			'z39.50r'                  => null,
			'z39.50s'                  => null,
		];

	/**
	 * Return all supported protocols
	 *
	 * @return array
	 */
	public static function supported()
	{
		$protocols = array_merge(
			static::unsecureSupported(),
			static::secureSupported()
		);

		sort($protocols);

		return $protocols;
	}

	/**
	 * Return all unsecure supported protocols
	 *
	 * @return array
	 */
	public static function unsecureSupported()
	{
		return array_keys(self::SUPPORTED_PROTOCOLS);

	}

	/**
	 * Return all secure supported protocols
	 *
	 * @return array
	 */
	public static function secureSupported()
	{
		$secure = array_values(self::SUPPORTED_PROTOCOLS);

		return Methods::flattern(array_filter($secure));
	}

	/**
	 * Check if a protocol is supported
	 *
	 * @param string $protocol
	 * @return bool
	 */
	public static function isSupported(string $protocol)
	{
		return in_array(strtolower($protocol), static::supported());
	}

	/**
	 * Check if a protocol is supported and if secure
	 *
	 * @param string $protocol
	 * @return bool[]
	 */
	public static function isSupportedWithSecurity(string $protocol)
	{
		if (static::isUnsecure($protocol)) {
			return [ true, false ];
		}

		if (static::isSecure($protocol)) {
			return [ true, true ];
		}

		return [ false, false ];
	}

	/**
	 * Check if a protocol is supported or throw
	 *
	 * @param string $protocol
	 * @throws InvalidProtocolException
	 */
	public static function isSupportedVolatile(string $protocol)
	{
		if (!static::isSupported($protocol)) {
			throw new InvalidProtocolException;
		}
	}

	/**
	 * Check if a protocol is unsecure and supported
	 *
	 * @param string $protocol
	 * @return bool
	 */
	public static function isUnsecure(string $protocol)
	{
		return in_array(strtolower($protocol), static::unsecureSupported());
	}

	/**
	 * Check if a protocol is unsecure and supported or throw
	 *
	 * @param string $protocol
	 * @throws InvalidProtocolException
	 */
	public static function isUnsecureVolatile(string $protocol)
	{
		if (!static::isUnsecure($protocol)) {
			throw new InvalidProtocolException;
		}
	}

	/**
	 * Check if a protocol is secure and supported
	 *
	 * @param string $protocol
	 * @return bool
	 */
	public static function isSecure(string $protocol)
	{
		return in_array(strtolower($protocol), static::secureSupported());
	}

	/**
	 * Check if a protocol is secure and supported or throw
	 *
	 * @param string $protocol
	 * @throws InvalidProtocolException
	 */
	public static function isSecureVolatile(string $protocol)
	{
		if (!static::isSecure($protocol)) {
			throw new InvalidProtocolException;
		}
	}

	public static function getSecureVariations(string $protocol)
	{
		if (isset(self::SUPPORTED_PROTOCOLS[ $protocol ])) {
			return self::SUPPORTED_PROTOCOLS[ $protocol ];
		}

		return null;
	}
}