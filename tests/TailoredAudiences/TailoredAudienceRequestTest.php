<?php
/*
 * This file is part of pmg/twitterads
 *
 * (c) PMG <https://www.pmg.com>. All rights reserved.
 */

namespace PMG\TwitterAds\TailoredAudiences;

class TailoredAudienceRequestTest extends \PMG\TwitterAds\UnitTestCase
{
    private $twitter, $account;

    public function testAudiencesCanBeFetchedForAnAccountFromTheApi()
    {
        $id = $this->account['id'];

        $request = new TailoredAudienceRequest('accounts/:account_id/tailored_audiences', [
            'account_id' => $id,
        ]);

        $response = $this->twitter->send($request);

        $data = $response->getData();
        $this->assertGreaterThan(0, count($data));
    }

    public function testAudiencesCanBeFetchedByIdFromTheApi()
    {
        $id = $this->account['id'];

        $request = new TailoredAudienceRequest('accounts/:account_id/tailored_audiences', [
            'account_id' => $id,
        ]);

        $response = $this->twitter->send($request);
        $this->assertSuccessfulResponse($response);

        $data = $response->getData();
        $this->assertGreaterThan(0, count($data));

        $audience = $data[0]['id'];

        $request = new TailoredAudienceRequest('accounts/:account_id/tailored_audiences/:id', [
            'account_id' => $id,
            'id'         => $audience,
        ]);

        $response = $this->twitter->send($request);
        $this->assertSuccessfulResponse($response);
    }

    protected function setUp()
    {
        $this->twitter = $this->getTwitterAds();
        $this->account = $this->getAccountFromTwitter();
    }
}
