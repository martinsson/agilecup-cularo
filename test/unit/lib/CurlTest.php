<?php

require_once dirname(__FILE__) . '/../../../lib/Curl.php';

class CurlTest extends PHPUnit_Framework_TestCase {

  public function testItGetsAnUrlAndRetrievesData() {
    $curl = new Curl();
  }

}

