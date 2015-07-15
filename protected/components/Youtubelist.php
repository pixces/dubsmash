<?php
/*
  * @copyright 2015 Ceasar Feijen www.cfconsultancy.nl
  * @Youtubelist generator
  * @This is not free software
  */
//Live enviroment:
//error_reporting(0);
//ini_set('display_errors', 0);
//error_reporting(E_ALL);

class Youtubelist
{
	protected $type = 'keywords';
	protected $cachexml = false;
	protected $cachelife = 86400; //24*60*60;

	protected $urldata = array('q' => 'blues', // videocode
								'maxResults' => 50,
								'order' => 'relevance', // sorteren
								'part' => 'snippet',
								'type' => 'video',
								'videoEmbeddable' => 'true',
								'start-index' => 1	);
	protected $user;
	protected $playlist;
	protected $channel;
	protected $lang;
	protected $h_d;
	protected $license;
	protected $duration;
	protected $three_d;
	protected $time;
	protected $safeSearch = 'strict';
	protected $xmlpath = './cache/';
	protected $descriptionlength = 300;
	protected $titlelength = 75;
	protected $descriptioncap = true;
	protected $titlecap = true;
	protected $api = '';

	public function __construct($type)
	{
		$this->curlinit = function_exists('curl_init');
        $this->type = $type;
	}

	protected function truncate($string, $length = '', $replacement = ' ..', $start = 75) //alternative substr
	{
		if (strlen($string) <= $start)
			return $string;
		if ($length)
		{
			return substr_replace($string, $replacement, $start, $length);
		}
		else
		{
			return substr_replace($string, $replacement, $start);
		}
	}

	protected function q($q) // Make correct string
	{
		$q = strval($q); // We need typeof string
        $q = htmlspecialchars($q, ENT_QUOTES);
		$q = preg_replace('/[[:space:]]/', ' ', trim($q));
		//$q = urlencode($q);
		return $q;
	}

    protected function mbencoding($string)
    {
        if (function_exists('mb_convert_encoding'))
        {
            return mb_convert_encoding($string, 'HTML-ENTITIES', 'UTF-8');
        }
        else
        {
            return htmlentities(utf8_encode($string));
        }
	}

	public function set_titlelength($titlelength) // Set title lenght
	{
		$this->titlelength = $titlelength;
	}

	public function set_descriptionlength($descriptionlength) // Set title lenght
	{
		$this->descriptionlength = $descriptionlength;
	}

	public function set_titlecap($titlecap) // Returns the uppercased string
	{
		$this->titlecap = $titlecap;
	}

	public function set_descriptioncap($descriptioncap) // Make a string's first character uppercase
	{
		$this->descriptioncap = $descriptioncap;
	}

	public function set_keywords($keywords) // Set keywords to search
	{
		$this->urldata['q'] = $this->q($keywords);
	}

	public function set_username($username) // Set username to search
	{
		$this->user = $this->q($username);
	}

	public function set_channel($username) // Set username to search
	{
		$this->channel = $this->q($username);
	}

	public function set_playlist($playlist) // Set playlist to search
	{
		$this->playlist = $this->q($playlist);
	}

	public function set_safeSearch($safeSearch) // Set safesearch possible: none, moderate, strict; default: strict
	{
		$mogelijk = array('none', 'moderate', 'strict');
		if(!in_array($safeSearch, $mogelijk))
		{
			throw new InvalidArgumentException('safesearch isn\'t of these: none, moderate, strict');
		}
		else
		{
            if ($this->type == 'keywords') {
			$this->urldata['safeSearch'] = $safeSearch;
			}
		}
	}

	public function set_license($license) // Set license possible: cc, youtube; default: not set
	{
		$mogelijk = array('any', 'youtube', 'creativeCommon');
		if(!in_array($license, $mogelijk))
		{
			throw new InvalidArgumentException('license isn\'t of these: any, youtube, creativeCommon');
		}
		else
		{
            if ($this->type == 'keywords') {
			$this->urldata['videoLicense'] = $license;
			}
		}
	}

	public function set_duration($duration) // Set duration possible: short, medium, long ; default: not set
	{
		$mogelijk = array('short', 'medium', 'long');
		if(!in_array($duration, $mogelijk))
		{
			throw new InvalidArgumentException('duration isn\'t of these: short, medium, long');
		}
		else
		{
            if ($this->type == 'keywords') {
			$this->urldata['duration'] = $duration;
			}
		}
	}

	public function set_3d($three_d) // Set search only 3d
	{
        if ($this->type == 'keywords') {
		$this->urldata['videoDimension'] = $three_d; // No check
		}
	}

	public function set_hd($h_d) // Set search only HD
	{
        if ($this->type == 'keywords') {
		$this->urldata['videoDefinition'] = $h_d; // No check
		}
	}

	public function set_time($time) // Valid values for this parameter are today (1 day), this_week (7 days), this_month (1 month) and all_time. The default value for this parameter is all_time.
	{
        if ($this->type == 'keywords') {
		$this->urldata['time'] = $time; // No check
		}
	}

	public function set_max($max) // Set max results; default: 50
	{
		$this->urldata['maxResults'] = intval($max); // We need typeof int
	}

	public function set_api($api) // V3 API key
	{
		$this->urldata['key'] = $api;
	}

	public function set_start($start) // Set start-index; default: 1
	{
		$this->urldata['start-index'] = intval($start); // We need typeof int
	}

	public function set_order($order) // set sorting order: relevance, date, rating, title, videoCount and viewCount; default: relevance
	{
		$mogelijk = array('relevance', 'date', 'rating', 'title', 'videoCount', 'viewCount' , 'none');
		if(!in_array($order, $mogelijk))
		{
			throw new InvalidArgumentException('order isn\'t of these: relevance (default), date, viewCount, rating, title, videoCount, none');
		}
		else
		{
			$this->urldata['order'] = $order;
		}
	}

	public function set_lang($lang) // Set lang; default 'en', codes can be found here http://www.loc.gov/standards/iso639-2/php/code_list.php row ISO 639-1 Code
	{
        if ($this->type == 'keywords') {
		$this->lang = $lang; // No check
		}
	}

	public function set_cachexml ($cache) // Bool, 1 use cache, 0 don't use cache
	{
		if($cache === false || $cache === true)
		{
			$this->cachexml = $cache;
		}
		else
		{
			throw new InvalidArgumentException('set_cachexml can only be boolean');
		}
	}

	public function set_cachelife ($cachelife) // Lifetime of cache NOTE: USE SECONDS!
	{
		$this->cachelife = $cachelife; // No check
	}

	public function set_xmlpath ($path) // Set where to store xml files
	{
		$this->xmlpath = $path;
	}

	protected function build_url($type, $urldata) // Generate url
	{
		if(!is_null($this->lang))
		{
			$urldata['relevanceLanguage'] = $this->lang;
		}
		switch ($type)
		{
			case 'keywords':
                //echo 'https://www.googleapis.com/youtube/v3/search?' . http_build_query($urldata, '', '&') . ' ';
				return 'https://www.googleapis.com/youtube/v3/search?' . http_build_query($urldata, '', '&');
				break;
			case 'username':
        		$findfeed = $this->urlGetContents('https://www.googleapis.com/youtube/v3/channels?part=contentDetails&maxResults=' . $this->urldata['maxResults'] . '&forUsername=' . $this->user . '&key=' . $this->urldata['key'] . '');
				$findNode = json_decode($findfeed, true);
	            if (isset($findNode['items']['0']['contentDetails']['relatedPlaylists']['uploads'])) {
        			$playlistId = $findNode['items']['0']['contentDetails']['relatedPlaylists']['uploads'];
                	//echo 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status&maxResults=' . $this->urldata['maxResults'] . '&playlistId=' . $playlistId . '&type=video&videoEmbeddable=true&key=' . $this->urldata['key'] . ' ';
					return 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status&maxResults=' . $this->urldata['maxResults'] . '&playlistId=' . $playlistId . '&type=video&videoEmbeddable=true&key=' . $this->urldata['key'];
                }
				break;
			case 'channel':
        		$findfeed = $this->urlGetContents('https://www.googleapis.com/youtube/v3/channels?part=contentDetails&maxResults=' .$this->urldata['maxResults'] . '&id=' . $this->channel . '&key=' . $this->urldata['key'] . '');
        		$findNode = json_decode($findfeed, true);
				if (isset($findNode['items']['0']['contentDetails']['relatedPlaylists']['uploads'])) {
        			$playlistId = $findNode['items']['0']['contentDetails']['relatedPlaylists']['uploads'];
                	//echo 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status&maxResults=' .$this->urldata['maxResults'] . '&playlistId=' . $playlistId . '&type=video&videoEmbeddable=true&key=' . $this->urldata['key'].' ';
					return 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status&maxResults=' .$this->urldata['maxResults'] . '&playlistId=' . $playlistId . '&type=video&videoEmbeddable=true&key=' . $this->urldata['key'];
                }
				break;
			case 'playlist':
                //echo 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId=' . $this->playlist . '&' . http_build_query($urldata, '', '&');
				return 'https://www.googleapis.com/youtube/v3/playlistItems?playlistId=' . $this->playlist . '&' . http_build_query($urldata, '', '&');
				break;
			default:
				throw new InvalidArgumentException('Build_url need right type');
		}
	}

	public function get_videos() // Use this function. You have to use the right type
	{
		switch ($this->type)
		{
			case 'keywords':
                $temparray = $this->urldata;
				$url = $this->build_url('keywords', $temparray);
				break;
			case 'username':
				$temparray = $this->urldata;
				$url = $this->build_url('username', $temparray);
				break;
			case 'channel':
				$temparray = $this->urldata;
				$url = $this->build_url('channel', $temparray);
				break;
			case 'playlist':
				$temparray = $this->urldata;
                unset($temparray['order']);
				unset($temparray['q']);
				$url = $this->build_url('playlist', $temparray);
				//echo $url;
				break;
			default:
				throw new InvalidArgumentException('get_videos need right type');
		}

		# Load from cache
        $filename = realpath($this->xmlpath) . DIRECTORY_SEPARATOR . md5($url) . '.json';

        if($this->cachexml && $this->cache_file($filename)) {
            $json = file_get_contents($filename);
        }else{
            $json = $this->urlGetContents($url);
            file_put_contents($filename,$json);
        }

        # Error
        if($json === false || $json == ''){
			echo 'Loaded JSON is empty';
			return;
        }

        $json = json_decode($json,true);

		//print_r($json);
		//exit();

		if (!isset($json['items'])) {
            echo 'No valid json found';
			return;
		}

		$data = $json['items'];
		$videodata = array();
		foreach($data as $dat)
		{
			$temparray = array();

            //Check if video has a thumbnail
			if (isset($dat['snippet']['thumbnails'])) {

				if (isset($dat['snippet']['description'])) {
	                if ($this->descriptioncap == true)
	                {
						$temparray['description'] = $this->mbencoding(ucfirst(strtolower($this->truncate($dat['snippet']['description'],'',' ..',$this->descriptionlength))));
					}else{
	                	$temparray['description'] = $this->mbencoding($this->truncate($dat['snippet']['description'],'',' ..',$this->descriptionlength));
	                }
				}else{
	            	$temparray['description'] = '';
	            }

				if ($this->titlecap == true)
				{
					$temparray['title'] = $this->mbencoding(strtoupper($this->truncate($dat['snippet']['title'],'',' ..',$this->titlelength)));
				}else{
				    $temparray['title'] = $this->mbencoding($this->truncate($dat['snippet']['title'],'',' ..',$this->titlelength));
				}

				if (isset($dat['id']['videoId']) && $dat['kind'] == 'youtube#searchResult')
				{
				    $temparray['videoid'] = $dat['id']['videoId'];
				}else{
				    $temparray['videoid'] = $dat['snippet']['resourceId']['videoId'];
				}

	            //Skip video's which contains some words like interview|cover
				//if(preg_match('[interview|cover]', strtolower($temparray['title'])) == true)
				//{
				//	continue;
				//}

				$videodata[] = $temparray;
	            //END check video
			}
		}
		return $videodata;
	}

    /**
     * Get content from URL
     * @param $url
     * @return mixed|string
     */
    protected function urlGetContents($url){
        if(function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec') && function_exists('curl_exec')){
            # Use cURL
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
            if(stripos($url,'https:') !== false){
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            }

            $content = @curl_exec($curl);
            curl_close($curl);
        }else{
            # Use FGC, because cURL is not supported
            ini_set('default_socket_timeout',5);
            $content = @file_get_contents($url);
        }
        return $content;
    }

	protected function cache_file($file) // check for cache life time
	{
		return file_exists($file) && filemtime($file) > time() - $this->cachelife;
	}
}