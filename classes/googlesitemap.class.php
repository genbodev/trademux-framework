<?php 
     
class GoogleSiteMap 
{ 
    protected $xml = '';            //Resulting XML String container
	protected $yahoo_appid = 'roma_yakovenko_wat06';  // remove @yahoo.com prefix
    protected $curl;
    protected $site;
    protected $docroot;
    protected $filename;
    protected $donotifyall = false;

    /**
     * Create google site map generator object
     *
     * @param string $docroot - document root (with no trailing slash)
     * @param string $filename - filename with path related to doc root (with no trailing slash)
     * @param string $site - site url (with no trailing slash)
     */
    public function __construct($docroot = '.', $filename = 'sitemap.xml', $site = '')
    {
    	$this->docroot = $docroot;
        $this->curl = new Curl();
        $this->reset($filename, $site);
    }
    
    /**
     * Clear sitemap cache
     *
     * @param string $filename - filename with path related to doc root
     * @param string $site - site url (with no trailing slash)
     */
    public function reset($filename = 'sitemap.xml', $site = '')
    {
    	$this->filename = $filename;
    	$this->site = $site;
    	$this->xml = '';
    	
    	if (!file_exists($this->docroot.'/'.$this->filename)) $this->donotifyall = true;
    }
    
	/**
	 * Creates sitemap files (text and gzipped text)
	 *
	 */
    public function writeMap()
    {
    	$xml  = '<?xml version="1.0" encoding="UTF-8"?>'."\n"; 
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"; 
        $xml .= $this->xml;
        $xml .= '</urlset>';
        
        file_put_contents($this->docroot.'/'.$this->filename, $xml);
        file_put_contents($this->docroot.'/'.$this->filename.'.gz', gzencode($xml));
    } 
    
    /**
     * Add url to sitemap
     *
     * @param string $url - domain relative site url 
     * @param string $lastmod - last modify date time
     * @param string $changefreq - 'always','hourly','daily','weekly','monthly','yearly','never'
     * @param float $priority - 0-1 page priority
     */
    public function addURL($url, $lastmod = '', $changefreq = 'monthly', $priority = 0.1)
    {
    	if (!preg_match('/https?:\/\//', $url)) $url = $this->site.'/'.$url;
        $this->xml .= '<url>'."\n";
        $this->xml .= '<loc>'.$this->clearURL($url).'</loc>'."\n";
        if (!empty($lastmod)) 
        {
        	$date = new DateTime($lastmod);
        	$this->xml .= '<lastmod>'.$date->format('Y-m-d\TH:i:sO').'</lastmod>'."\n";
        }
        $this->xml .= '<changefreq>'.$changefreq.'</changefreq>'."\n";
        $this->xml .= '<priority>'.$priority.'</priority>'."\n";
        $this->xml .= '</url>'."\n";
    } 
    
    /**
     * Add array of urls
     *
     * @param array $a - array of arrays in format for addURL function
     */
    public function bulkAddURLs(array $a)
    { 
		foreach ($a as $v) $this->addURL($v['url'], $v['lastmod'], $v['changefreq'], $v['priority']);
    } 
     
    /**
     * This function make a clean url with HTML ENTITIES end UTF-8 conversions 
     * 
     */
    protected function clearURL($s)
    { 
        return utf8_encode(htmlentities($s, ENT_QUOTES, 'UTF-8')); 
    } 
    
    /**
     * Submits sitemap to google webamsters tools
     *
     * @return bool
     */
    protected function notifyGoogle()
    {
    	$res = $this->curl->get('http://www.google.com/webmasters/sitemaps/ping?sitemap='.urlencode($this->site.'/'.$this->filename.'.gz'));
    	return (bool)$res;
    }
    
    /**
     * Submits sitemap to yahoo
     *
     * @return bool
     */
    protected function notifyYahoo()
    {
        $res = $this->curl->get('http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid='.$this->yahoo_appid.'&url='.urlencode($this->site.'/'.$this->filename.'.gz'));
        return (bool)$res;
    }
    
    /**
     * Submits sitemap to bing/msn
     *
     * @return bool
     */
    protected function notifyBing()
    {
    	$res = $this->curl->get('http://www.bing.com/webmaster/ping.aspx?sitemap='.urlencode($this->site.'/'.$this->filename));
    	return (bool)$res;
    }
    
    /**
     * Submits sitemap to ask.com
     *
     * @return bool
     */
    protected function notifyAsk()
    {
    	$res = $this->curl->get('http://submissions.ask.com/ping?sitemap='.urlencode($this->site.'/'.$this->filename.'.gz'));
    	return (bool)$res;
    }
    
    /**
     * Submits sitemap to google, yahoo, bing, ask.com
     *
     * @param bool $force - force notify, do not check sitemap file existing
     * @return unknown
     */
    public function notifyAll($force = false)
    {
    	if ($this->donotifyall || $force)
    	{
	    	$this->notifyGoogle();
	    	$this->notifyYahoo();
	    	$this->notifyBing();
	    	$this->notifyAsk();
    	}
    }
    
    /**
     * Adds array of links to sitemap, creates files, submits to google, yahoo, bing, ask.com
     *
     * @param array $urls - array of arrays in format for addURL function
     */
    public function generateAndSubmit(array $urls = array())
    {
    	$this->bulkAddURLs($urls);
    	$this->writeMap();
    	$this->notifyAll();
    }
} 
     
?>