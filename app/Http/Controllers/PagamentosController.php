<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;

class PagamentosController extends Controller
{
    public function boleto(): View {
        $client = new Client();
        $res = $client->request('POST', 'https://sandbox.asaas.com/api/v3/payments', [
            'headers' => [
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzQzODg6OiRhYWNoXzg2ZDUyYjk1LWE3MTctNGU2My05MTlkLTViOGNmODViNzRhZA==',
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Connection' => 'keep-alive'
            ],
            'json' => [
                'customer' => 'cus_000005882105',
                'billingType' => 'BOLETO',
                'dueDate' => '2024-06-11',
                'value' => 150,
                'description' => 'Pedido 056985',
                'externalReference' => '056985',
                'discount' => [
                    'value' => 10,
                    'dueDateLimitDays' => 0
                ],
                'fine' => [
                    'value' => 1
                ],
                'interest' => [
                    'value' => 2
                ],
                'postalService' => false
            ]
        ]);

        $boleto = json_decode($res->getBody()->getContents(), true);

        $dig = $client->request('GET', 'https://sandbox.asaas.com/api/v3/payments/' . $boleto['id'] . '/identificationField', [
            'headers' => [
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzQzODg6OiRhYWNoXzg2ZDUyYjk1LWE3MTctNGU2My05MTlkLTViOGNmODViNzRhZA==',
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Connection' => 'keep-alive'
            ]
        ]);

        
        $linha_digitavel = json_decode($dig->getBody()->getContents(), true);

        return view('pagamentos.boleto', ['boleto' => $boleto, 'linha_digitavel' => $linha_digitavel]);
    }

    public function pix(): View {
        $client = new Client();
        $res = $client->request('POST', 'https://sandbox.asaas.com/api/v3/pix/qrCodes/static', [
            'headers' => [
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzQzODg6OiRhYWNoXzg2ZDUyYjk1LWE3MTctNGU2My05MTlkLTViOGNmODViNzRhZA==',
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Connection' => 'keep-alive'
            ],
            'json' => [
                'addressKey' => '7f2480bc-7dc8-4114-a5f3-4b59305c8991',
                'description' => 'Teste Integração',
                'value' => '150.00',
            ]
        ]);

        $pix = json_decode($res->getBody()->getContents(), true);

        return view('pagamentos.pix', ['pix' => $pix]);
    }
}