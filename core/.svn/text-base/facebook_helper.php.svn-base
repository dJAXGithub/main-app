<?php
class facebook_helper {

	//Application Configurations
	public $site_url	= "http://localhost/rhovit/trunk/site/login_fb.php";
	public $facebook;
	public $userlogged;
	
	public function facebook_helper($app_id, $app_secret) {
		// Create our application instance
		$facebook = new Facebook(array(
			'appId'		=> $app_id,
			'secret'	=> $app_secret,
			));
		$this->facebook = $facebook;
		//var_dump($facebook);		
	}
	
	public function GetUserLogged(){
		// Get User ID
		$user = $this->facebook->getUser();
		$this->userlogged = $user;
		return $user;
	}
	
	public function GetLogginUrl($url_callback){
		// Get login URL
		$loginUrl = $this->facebook->getLoginUrl(array(
		'scope'		=> 'read_stream, publish_stream, email, user_location',
		'redirect_uri'	=> $url_callback,
		));
		return $loginUrl;
	}
	
	public function PublishSignIn(){
			$user = $this->facebook->getUser();
			try{
				$publishStream = $this->facebook->api("/$user/feed", 'post', array(
					'message'		=> 'I just joined to RHOVIT! Come to see!',
					'link'			=> 'http://www.rhovit.com',
					'picture'		=> 'https://twimg0-a.akamaihd.net/profile_images/2543517281/2b994rr0pyzzn2c0vwnk_bigger.jpeg',
					'name'			=> 'Rhovit.com',
					'caption'		=> 'Rhovit.com',
					'description'		=> 'A new form of entertainment marketplace for FILM/TV/MUSIC/GAMES/BOOKS/AND COMICS',
					));
			}catch(FacebookApiException $e){
				error_log($e);
			}
	}
	
	public function GetUserData($type){
		// Save your method calls into an array
		$queries = array(
			array('method' => 'GET', 'relative_url' => '/'.$this->userlogged),
			array('method' => 'GET', 'relative_url' => '/'.$this->userlogged.'/home?limit=50'),
			array('method' => 'GET', 'relative_url' => '/'.$this->userlogged.'/friends'),
			array('method' => 'GET', 'relative_url' => '/'.$this->userlogged.'/photos?limit=6'),
			);
		if($this->facebook->getUser()){
		// POST your queries to the batch endpoint on the graph.
		try{
			$batchResponse = $this->facebook->api('?batch='.json_encode($queries), 'POST');
		}catch(Exception $o){
			error_log($o);
		}}else return "Not logged user";

		//Return values are indexed in order of the original array, content is in ['body'] as a JSON
		//string. Decode for use as a PHP array.
		$user_info		= json_decode($batchResponse[0]['body'], TRUE);
		$feed			= json_decode($batchResponse[1]['body'], TRUE);
		$friends_list		= json_decode($batchResponse[2]['body'], TRUE);
		$photos			= json_decode($batchResponse[3]['body'], TRUE);
		
		switch($type){
			case 'user_info' : 
				return $user_info;
				break;
			case 'feed' :
				return $feed;
				break;
			case 'friends_list' :
				return $friends_list;
				break;
			case 'photos' :
				return $photos;
				break;
		}
	}
	
	public function GetUserProfile(){
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $this->facebook->api('/me');
		return $user_profile;
	}
	
}
?>