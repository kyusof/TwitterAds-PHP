<?php

namespace Blackburn29\TwitterAds;

use Blackburn29\TwitterAds\Util\VerifyCredentialsRequest;

class TwitterAdsTest extends UnitTestCase
{
    private $twitter;

    public function testSuppliedCredentialsAreValid()
    {
        $request = new VerifyCredentialsRequest();
        $response = $this->twitter->send($request);
        $this->assertSuccessfulResponse($response);
        $body = $response->getBody();
        $this->assertArrayHasKey('name', $body);
        echo "\nAuthenticated As: ".$body['name']." :) \n";
    }

    protected function setUp()
    {
        $this->twitter = $this->getTwitterAds();
    }
}
