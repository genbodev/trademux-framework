<?php
/**
 * Class for convinient using of curl library
 *
 */
class Curl
{
	/**
	 * var with resource of curl
	 *
	 * @var resource
	 */
	public $ch;

	/**
	 * If active curl instance attempts to create snapshots of server responses.
	 *
	 * @var boolean
	 */
	public $use_snapshots = false;
	
	/**
	 * Snapshots directory. Active only if {$this->use_snapshots} is true
	 *
	 * @var string
	 */
	public $snapshots_path = '/tmp/php_curl/';
	
	/**
	 * Curl options
	 *
	 * @var array
	 */
	protected $options;
	
	/**
	 * Proxies list
	 * 
	 * @var array
	 */
	protected $proxies = array();
	
	/**
	 * Change proxy automatically on each request
	 * 
	 * @var bool
	 */
	protected $auto_proxy = false;	
	
	/**
	 * Throw exception if list of all proxies checked and non of them was working
	 * 
	 * @var bool
	 */
	protected $throw_proxy_error = false;
	
	/**
	 * Address of file with cookies
	 * 
	 * @var string
	 */
	protected $cookiesfile = '';
	
	/**
	 * Init CURL
	 *
	 * @param mixed $proxy list of proxies to use. May be in format array(0 => 'ip:port|login:password', ...) or 
	 *                                                                array(0 => array('proxy' => 'ip:port', 'auth' => 'login:password'), ...) or 
	 * 																  string - set proxy ip:port
	 * @param string $proxy_auth - if proxy is string then set here login:password
	 * @param string $cookiesfile 	 
	 * @param bool $auto_proxy change proxy before each request
	 * @param bool $throw_proxy_error throw exception if list of all proxies will fail to retrieve data
	 */
	public function __construct($proxy = "", $proxy_auth = "", $cookiesfile = "", $auto_proxy = false, $throw_proxy_error = false)
	{
		$this->init($proxy, $proxy_auth, $cookiesfile, $auto_proxy, $throw_proxy_error);
	}
	
	/**
	 * Initialize CURL parameters
	 *
	 * @param mixed $proxy list of proxies to use. May be in format array(0 => 'ip:port|login:password', ...) or 
	 *                                                                array(0 => array('proxy' => 'ip:port', 'auth' => 'login:password'), ...) or 
	 * 																  string - set proxy ip:port
	 * @param string $proxy_auth - if proxy is string then set here login:password
	 * @param string $cookiesfile 	 
	 * @param bool $auto_proxy change proxy before each request
	 * @param bool $throw_proxy_error throw exception if list of all proxies will fail to retrieve data
	 */
	protected function init($proxy = "", $proxy_auth = "", $cookiesfile = "", $auto_proxy = false, $throw_proxy_error = false)
	{
		$this->ch = curl_init();
		$this->options = array(
		    CURLOPT_RETURNTRANSFER => true,         // return web page
		    CURLOPT_FOLLOWLOCATION => true,         // follow redirects
		    CURLOPT_AUTOREFERER    => true,         // set referer on redirect
		    CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
		    CURLOPT_TIMEOUT        => 120,          // timeout on response
		    CURLOPT_SSL_VERIFYPEER => false,
		    CURLOPT_SSL_VERIFYHOST => false,
		    CURLOPT_USERAGENT		=> 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.1) Gecko/2008070208',
			CURLINFO_HEADER_OUT 	=> 1
		);
		
		curl_setopt_array($this->ch, $this->options);
		if (!empty($cookiesfile)) $this->setCookiesFile($cookiesfile);
		
		$this->cookiesfile = $cookiesfile;
		$this->auto_proxy = $auto_proxy;
		$this->throw_proxy_error = $throw_proxy_error;
		if (is_array($proxy))
		{
			// check first element of array
			if (is_array(reset($proxy))) $this->proxies = $proxy;
			else 
			{
				foreach ($proxy as $p)
				{
					$p = explode('|', $p);
					$this->proxies[] = array('proxy' => $p[0], 'auth' => $p[1]);
				}
			}
			
			if (!$auto_proxy && !empty($proxy)) $this->changeProxy(); // if not auto change proxies then select random one for all requests
		}
		else if (!empty($proxy))
		{
			$this->setProxy($proxy, $proxy_auth);
			if (!empty($proxy)) $this->proxies[] = array('proxy' => $proxy, 'auth' => $proxy_auth);
		}
	}
	
	/**
	 * Reset session. Reinitializes CURL object
	 * If cookiesfile is not set then session cookies will be deleted
	 *
	 */
	public function reSession()
	{
		curl_close($this->ch);
		$this->init($this->proxies, '', $this->cookiesfile, $this->auto_proxy, $this->throw_proxy_error);		
	}
	
	/**
	 * Change proxy
	 * 
	 * @return proxy key from the proxies list
	 */
	public function changeProxy()
	{
		$k = array_rand($this->proxies);
		$this->setProxy($this->proxies[$k]['proxy'], $this->proxies[$k]['auth']);
		return $k;
	}
	
	public function setCookiesFile($file)
	{
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, $file);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, $file);
	}
	
	public function setProxy($proxy = "", $proxy_auth = "")
	{
		curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
		curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
	}
	
	/**
	 * Set curl options
	 *
	 * @param array $options
	 */
	public function setOptions($options)
	{
		curl_setopt_array($this->ch, $options);
	}
	
	public function setHeaderReturn($flag)
	{
		curl_setopt($this->ch, CURLOPT_HEADER, $flag);
	}
	
	/**
	 * send request with POST data, if it is set
	 *
	 * @param string $url
	 * @param array or url encoded string $data
	 * @param boolean $postfile
	 * @param string $snapshot_name If specified curl makes snapshot of retrived data in file system
	 * @return string
	 */
	public function post($url, $data, $postfile = false, $snapshot_name = '')
	{
		$used_proxy_keys = array();
		$all_proxy_keys = array_keys($this->proxies);
		$proxy_fail = false;
			
		do 
		{
			if ($this->proxies && ($this->auto_proxy || $proxy_fail)) $used_proxy_keys[] = $this->changeProxy();
			
			curl_setopt($this->ch, CURLOPT_URL, $url);
			curl_setopt($this->ch, CURLOPT_POST, true);
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
			
			//if File parameter passes (it starts with @) - don't format query
			if (is_array($data) && !$postfile) $data = $this->_toQueryString($data);
	        
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
			        		
			$response = curl_exec($this->ch);
			
			$proxy_fail = stripos($response, '<TITLE>ERROR: Cache Access Denied</TITLE>') !== false ||
				in_array($this->getErrNum(), array(CURLE_COULDNT_RESOLVE_PROXY, CURLE_COULDNT_CONNECT))/* || $response === false*/; // proxy failed to retrieve data
		} 
		while ($this->proxies && count(array_diff($all_proxy_keys, $used_proxy_keys)) > 0 && $proxy_fail);		

		if (!empty($snapshot_name)) $this->_snapshot($snapshot_name, $response);
		
		if ($proxy_fail && $this->throw_proxy_error) throw new Exception('Proxy error! Request '.$url.' failed with message "'.$this->getError().'"');
        
        return $response;
	}
	
	/**
	 * Send request with GET data
	 *
	 * @param string $url
	 * @param string $snapshot_name If specified curl makes snapshot of retrived data in file system
	 * @return string
	 */
	public function get($url, $snapshot_name = '')
	{
		$used_proxy_keys = array();
		$all_proxy_keys = array_keys($this->proxies);
		$proxy_fail = false;
			
		do 
		{
			if ($this->proxies && ($this->auto_proxy || $proxy_fail)) $used_proxy_keys[] = $this->changeProxy();
		
			curl_setopt($this->ch, CURLOPT_URL, $url);
			curl_setopt($this->ch, CURLOPT_POST, false);
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
			
			$response = curl_exec($this->ch);
		
			$proxy_fail = stripos($response, '<TITLE>ERROR: Cache Access Denied</TITLE>') !== false ||
				in_array($this->getErrNum(), array(CURLE_COULDNT_RESOLVE_PROXY, CURLE_COULDNT_CONNECT))/* || $response === false */; // proxy failed to retrieve data
		} 
		while ($this->proxies && count(array_diff($all_proxy_keys, $used_proxy_keys)) > 0 && $proxy_fail);		

		if (!empty($snapshot_name)) $this->_snapshot($snapshot_name, $response);
		
		if ($proxy_fail && $this->throw_proxy_error) throw new Exception('Proxy error! Request '.$url.' failed with message "'.$this->getError().'"');
        
        return $response;
	}
	
	/**
	 * Creates "/path/to/snapshots/$snapshot_name.html" file with curl response data
	 *
	 * @param string $snapshot_name
	 * @param string $response
	 * @return void
	 */
	protected function _snapshot($snapshot_name = '', $response = 'Empty')
	{
		if (!$this->use_snapshots) return;
		
		if (!file_exists($this->snapshots_path)) mkdir($this->snapshots_path, 0777);
		
		$file = fopen(($this->snapshots_path.$snapshot_name.'.html'), 'w+');
		fwrite($file, $response);
		fclose($file);
	}
	
    /**
     * Serializes array to http query string
     * @param mixed $obj array for parsing
     * @param string $key if specified key uses during query string creating
     * @return string
     */
    protected function _toQueryString($obj, $key = '')
    {
        $components = array();
        
        foreach ($obj as $k => $v)
        {
            $qKey = '';
            if (empty($key) && $key !== '0') $qKey .= $k;
            else $qKey = $key . '[' .$k. ']';
            
            if (is_array($v))
            {
                array_push($components, $this->_toQueryString($v, $qKey));
            }
            else
            {
                array_push($components, ($qKey.'='.$v));
            }
        }
        
        return ( count($components) > 0 ) ? ( implode('&', $components) ) : '';
    }
	
	/**
	 * Close resource file
	 *
	 */
	public function __destruct()
	{
		curl_close($this->ch);
	}
	
	/**
	 * Close resource file
	 *
	 */
	public function close()
	{
		curl_close($this->ch);
	}	
		
	public function getInfo($param = CURLINFO_HTTP_CODE)
	{
		return curl_getinfo($this->ch, $param);
	}
	
	/**
	 * Send PUT request 
	 *
	 * @param unknown_type $url
	 * @param string $data data / dir to file
	 * @param boolean $putfile
	 * @param unknown_type $snapshot_name
	 * @return unknown
	 */
	public function put($url, $data, $putfile = false, $snapshot_name = '')
	{			
		$used_proxy_keys = array();
		$all_proxy_keys = array_keys($this->proxies);
		$proxy_fail = false;
			

		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');

		// if send file		
		if ($putfile) 
		{
			$fp = fopen ($data, "r"); 
			curl_setopt($this->ch, CURLOPT_PUT, true);
			curl_setopt($this->ch, CURLOPT_INFILE, $fp);
			curl_setopt($this->ch, CURLOPT_INFILESIZE, filesize($data)); 
		}
		else 
		{
			curl_setopt($this->ch, CURLOPT_POST, true);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		} 
		
		do 
		{
			if ($this->proxies && ($this->auto_proxy || $proxy_fail)) $used_proxy_keys[] = $this->changeProxy();			        		
			$response = curl_exec($this->ch);			
			$proxy_fail = stripos($response, '<TITLE>ERROR: Cache Access Denied</TITLE>') !== false ||
				in_array($this->getErrNum(), array(CURLE_COULDNT_RESOLVE_PROXY, CURLE_COULDNT_CONNECT))/* || $response === false*/; // proxy failed to retrieve data
		} 
		while ($this->proxies && count(array_diff($all_proxy_keys, $used_proxy_keys)) > 0 && $proxy_fail);	
		
		if ($putfile) curl_setopt($this->ch, CURLOPT_PUT, false);	

		if (!empty($snapshot_name)) $this->_snapshot($snapshot_name, $response);
		
		if ($proxy_fail && $this->throw_proxy_error) throw new Exception('Proxy error! Request '.$url.' failed with message "'.$this->getError().'"');
        
        return $response;
	}
	
	/**
	 * Get error message
	 *
	 * @return unknown
	 */
	public function getError()
	{
		return curl_error($this->ch);
	}
	
	/**
	 * Get error number
	 *
	 * @return unknown
	 */
	public function getErrNum()
	{
		return curl_errno($this->ch);
	}
}