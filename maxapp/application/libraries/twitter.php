<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class created for skin cupcake
**/
require_once(APPPATH . 'third_party/twitteroauth/twitteroauth/twitteroauth.php');

class Twitter
{
	protected $_conn = NULL;

	function __construct()
	{
		$this->connection();
	}

	protected function connection()
	{
		$this->_conn = new TwitterOAuth(
		    config("consumer_key"),
		    config("consumer_secret"),
		    config("oauth_token"),
		    config("oauth_token_secret")
		);
		
	}

	public function show($limit = 10, $screen_name = 'DepEzequielRN')
	{
		$result = $this->_conn->get(
			'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $screen_name . '&count=' . $limit
		);

		$html = '<ul class="unstyled"><div>';

		$i = 1;
		foreach($result as $node)
		{
			if($i % 2 && $i != 1)
			{
				$html .= "</div><div>";
			}

			$link = "http://twitter.com/" . $node->user->screen_name. "/status/" . $node->id;
			$text = $node->text;
			$time = show_date_twitter(strtotime($node->created_at));
			$html .= "<li>".make_link_twitter($text)."<span class=\"time\">".$time."</span></li>";
			$i++;
		}
		$html .= '</div></ul>';
		return $html;
	}
}