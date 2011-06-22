<?php

class Curl {

  private $curlHandler;
  public static $CURL_OPTS = array(
      CURLOPT_CONNECTTIMEOUT => 10,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 60
  );

  public function __construct() {
    
  }

  public function init() {
    if (!function_exists('curl_init')) {
      throw new Exception('Application needs the CURL PHP extension');
    }
    $this->curlHandler = curl_init();
  }
  
  protected function setUrlAndOptions($url) {
    $options = self::$CURL_OPTS;
    $options[CURLOPT_URL] = $url;
    curl_setopt_array($this->curlHandler, $options);
  }
  
  protected function getInfo() {
    return curl_getinfo($this->curlHandler);
  }
  
  protected function close() {
     curl_close($this->curlHandler);
  }
  
  protected function retrieveErrors(&$header) {
    $header['error_number']   = curl_errno($this->curlHandler);
    $header['error_message']  = curl_error($this->curlHandler);
  }
  
  protected function setResponseContent(&$header, $content) {
    $header['content'] = $content;
  }
  
  protected function executeRequest() {
    return curl_exec($this->curlHandler);
  }
  
  public function get($url) {
    $this->setUrlAndOptions($url);
    $content = $this->executeRequest();
    $header = $this->getInfo();
    $this->retrieveErrors($header);
    $this->setResponseContent($header, $content);
    $this->close();
    return $header;
  }
}

