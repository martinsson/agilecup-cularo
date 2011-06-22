<?php

require_once dirname(__FILE__) . '/../../../lib/Curl.php';

class CurlTest extends PHPUnit_Framework_TestCase {

  protected function getCurlMock() {
    return $this->getMock("Curl");
  }

  public function testItGetsAnUrlAndRetrievesData() {
    $curlMock = $this->getCurlMock();

    $curlMock->expects($this->once())
            ->method('get')
            ->will($this->returnValue(array('content' => 'this is page content', 'http_code' => 200, 'error_number' => 0, 'error_message' => '')));

    $result = $curlMock->get('http://www.google.fr');
    $this->assertNotEmpty($result);
    $this->assertEquals($result['http_code'], 200);
    $this->assertEquals($result['error_number'], 0);
    $this->assertEquals($result['error_message'], '');
  }

}

