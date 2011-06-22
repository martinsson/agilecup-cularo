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
    $this->setDefaultOptions();
  }
  
  protected function setUrl($url) {
    curl_setopt($this->curlHandler, CURLOPT_URL, $url);
  }
  
  protected function setDefaultOptions() {
    curl_setopt_array($this->curlHandler, self::$CURL_OPTS);
  }
  
  protected function setOption($name, $value) {
    curl_setopt($this->curlHandler, $name, $value);
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
  
  protected function exec() {
    return curl_exec($this->curlHandler);
  }
  
  protected function makeRequest($url) {
    $this->setUrl($url);
    $content = $this->exec();
    $header = $this->getInfo();
    $this->retrieveErrors($header);
    $this->setResponseContent($header, $content);
    $this->close();
    return $header;
  }

  public function get($url = '') {
    return $this->makeRequest($url);
  }
  
  public function post($params = array(), $url = '') {
    $this->setOption(CURLOPT_POST, true);
    $this->setOption(CURLOPT_POSTFIELDS, $params);
    return $this->makeRequest($url);
  }
}

