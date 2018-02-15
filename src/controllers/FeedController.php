<?php

/**
 * Instagram Api plugin for Craft CMS 3.x
 *
 * Instagram Api guzzle endpoint plugin for JS to consume as AJAX
 *
 * @link      https://youi.design
 * @copyright Copyright (c) 2018 Adam Menczykowski
 */

namespace admench\craftinstagram\controllers;

use Craft;
use craft\web\Controller;

/**
 * Feed Controller
 *
 *
 * @author    Adam Menczykowski
 * @package   CraftInstagram
 * @since     1
 */
class FeedController extends Controller
{

    /**
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/instagram-api/feed
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $client = new \GuzzleHttp\Client;

        $response = $client->get('https://api.instagram.com/v1/users/self/media/recent', [
            'query' => [
                'access_token' => getenv("INSTAGRAM_ACCESS_TOKEN"),
                'count' => getenv("INSTAGRAM_FEED_COUNT")
            ]
        ]);
        try {
            $data = $response->getBody();
            Craft::info($data);
            return $data;
        } catch (\yii\base\Exception $e) {
            return $e;
        }


    }

}
