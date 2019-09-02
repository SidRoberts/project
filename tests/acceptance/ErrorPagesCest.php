<?php

namespace Tests\Acceptance;

use Tests\AcceptanceTester;

class ErrorPagesCest
{
    public function pageNotFound(AcceptanceTester $I)
    {
        $I->amOnPage("/a/page/that/doesnt/exist");

        $I->seeResponseCodeIs(404);
    }

    public function pageForbidden(AcceptanceTester $I)
    {
        $I->amOnPage("/error/403");

        $I->seeResponseCodeIs(403);
    }

    public function internalServerError(AcceptanceTester $I)
    {
        $I->amOnPage("/error/500");

        $I->seeResponseCodeIs(500);
    }
}
