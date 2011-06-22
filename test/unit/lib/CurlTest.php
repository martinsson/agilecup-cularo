<?php

require_once dirname(__FILE__) . '/../../../lib/Curl.php';

class CurlTest extends PHPUnit_Framework_TestCase {

  public function testItGetsAnUrlAndRetrievesData() {
    $curl = new Curl();
    $curl->init();
    $result = $curl->get('http://www.google.fr');
    $this->assertNotEmpty($result);
    $this->assertEquals($result['http_code'], 200);
    $this->assertEquals($result['error_number'], 0);
    $this->assertEquals($result['error_message'], '');
  }

}

