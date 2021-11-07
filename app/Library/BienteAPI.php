<?php
namespace App\Library;
use \GuzzleHttp\Client as GuzzleClient;

class BienteAPI
{
    protected $apiURL;
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
        $this->apiURL = 'https://ecommerce.biente.shop/demo1/index.php?route=';
    }

    /**
     * @param $method
     * @param null $data
     * @param null $path
     * @return bool|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $path = null, $data = null)
    {
        $return = $this->client->request($method, $this->apiURL . $path, ['form_params' => json_decode($data)]);
        if (!$return) {
            return false;
        }
        return json_decode($return->getBody()->getContents());
    }
}
