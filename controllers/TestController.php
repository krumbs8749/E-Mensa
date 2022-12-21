<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../models/werbeseite_data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/besucher.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/ersteller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht_hat_allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/newsletter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/wunschgericht.php');

class TestController
{
    public function test (RequestData $rd) {
        echo 'test';
    }

}