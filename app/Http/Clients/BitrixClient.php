<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class BitrixClient
 * @package App\Http\Clients
 */
class BitrixClient
{

    /** @var string */
    protected $baseUrl;

    /** @var Client */
    protected $client;

    /**
     * BitrixClient constructor.
     * @param $token
     * @param $domain
     */
    public function __construct($token, $domain)
    {
        $this->baseUrl = "https://$domain/rest/1/$token/";

        $this->client = new Client([
            'base_uri' => $this->baseUrl
        ]);
    }

    /**
     * @param array $queryData
     * @param $bxMethod
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(array $queryData, $bxMethod)
    {
        $request = $this->client->request('get', $bxMethod, [
            'query' => $queryData
        ]);

        return json_decode($request->getBody(), true);

    }

    /**
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addLead(array $data)
    {
        $queryData = [
            'fields' => [
                'TITLE' => 'Заявка от ' . $data['participant']['first_name'] . ' ' . $data['participant']['last_name'],
                'NAME' => $data['participant']['first_name'],
                'SECOND_NAME' => $data['participant']['last_name'],
                'EMAIL' => [
                    "n0" => [
                        "VALUE" => $data['participant']['email_address'],
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'PHONE' => [
                    "n0" => [
                        "VALUE" => $data['participant']['phone_number'],
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'COMPANY_TITLE' => $data['department_name'],
                'COMMENTS' => $data['conference_name'] . "<br>" .
                    $data['lecture']['title'] ??= "",
                'SOURCE_DESCRIPTION' => 'CRM-форма'
            ],
            'params' => [
                "REGISTER_SONET_EVENT" => "Y"
            ]
        ];

        try {
            $result = $this->request($queryData, 'cm.lead.add');
        } catch (\Exception $exception) {
            $log = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
            $bxLog = new Logger('Bx');
            $bxLog->pushHandler(new StreamHandler(storage_path('logs/bx.log')));
            $bxLog->info('BxLog', $log);
        }

        return $result['result'];
    }
}
