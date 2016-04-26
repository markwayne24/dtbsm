<?php
namespace App\Aindong\SMS;

class Chikka
{

    /**
     * @var string
     */
    protected $url          = null;
    /**
     * @var string
     */
    protected $client_id    = null;
    /**
     * @var string
     */
    protected $secret_key   = null;
    /**
     * @var string
     */
    protected $short_code   = null;

    /**
     * @var array
     */
    protected $requiredOptions = [
        'message_type',
        'mobile_number',
        'message'
    ];

    /**
     * @var array
     */
    protected $options = [];

    public function __construct()
    {
        $this->url          = 'https://post.chikka.com/smsapi/request';
        $this->client_id    = getenv('CHIKKA_CLIENT_ID');
        $this->secret_key   = getenv('CHIKKA_SECRET_KEY');
        $this->short_code   = getenv('CHIKKA_SHORT_CODE');
    }

    /**
     * @param array $options
     * @return $this
     * @throws MissingRequiredOption
     */
    public function setOptions(Array $options)
    {
        $this->options = array_merge($this->options, $options);

        foreach ($this->requiredOptions as $option)
        {
            if (! array_key_exists($option, $this->options)) {
                throw new \Exception('Missing the required option: ' . $option, 400);
            }
        }

        return $this;
    }

    /**
     * @return mixed|null|string
     */
    public function sendNotification()
    {
        $result = $this->sendSMS();

        return $result;
    }

    /**
     * @param $message_id
     * @return array
     */
    private function buildSmsParams($message_id)
    {
        return array(
            'message_type'  => $this->options['message_type'],
            'mobile_number' => $this->options['mobile_number'],
            'shortcode'     => $this->short_code,
            'message_id'    => $message_id,
            'message'       => $this->options['message'],
            'client_id'     => $this->client_id,
            'secret_key'    => $this->secret_key,
        );
    }

    /**
     * @return mixed|null|string
     */
    private function sendSMS()
    {
        $message_id = str_pad(rand(), 32, '0', STR_PAD_LEFT);
        $params = $this->buildSmsParams($message_id);

        $query = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Parse Response
        $response = $this->parseResponse($response, $message_id, $httpcode);

        return $response;
    }

    /**
     * @param $response
     * @param $message_id
     * @return mixed|null|string
     */
    private function parseResponse($response, $message_id, $httpcode)
    {
        $response = null;

        // Add the message_id in the response.
        $response = json_decode($response, true);
        $response['message_id'] = $message_id;
        $response['code']       = $httpcode;

        return $response;
    }
}