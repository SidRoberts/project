<?php

namespace Tests\Acceptance;

use Tests\AcceptanceTester;

class IndexCest
{
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage("/");

        $I->seeResponseCodeIs(200);

        $I->see("Sid Roberts");
    }
}
