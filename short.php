<?php

namespace shortest\Api;


class shortest {
  private $KEY;
  private $URL = 'https://api.short.st/v1/data/url';

  public function __construct($key)
  {
    $this->KEY  = $key;
  }

  public function __get($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->URL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'public-api-token: '.$this->KEY
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array(
      'urlToShorten' => $url
    )));

    $response = curl_exec($ch);
    $json = json_decode($response);
    if ($json->status === 'ok') {
      return $json->shortenedUrl;
    }
    return false;
  }
}
