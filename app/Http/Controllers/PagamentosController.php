<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use GuzzleHttp\Client;

class PagamentosController extends Controller
{
    public function boleto(): View {
        $client = new Client();
        $res = $client->request('POST',  env('ASAAS_URI') . '/payments', [
            'headers' => [
                'access_token' => env('ASAAS_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Connection' => 'keep-alive'
            ],
            'json' => [
                'customer' => env('ASAAS_TEST_CUSTOMER'),
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

        $dig = $client->request('GET', env('ASAAS_URI') . '/payments/' . $boleto['id'] . '/identificationField', [
            'headers' => [
                'access_token' => env('ASAAS_TOKEN'),
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
        $res = $client->request('POST', env('ASAAS_URI') . '/pix/qrCodes/static', [
            'headers' => [
                'access_token' => env('ASAAS_TOKEN'),
                'Content-Type' => 'application/json',
                'Accept' => '*/*',
                'Connection' => 'keep-alive'
            ],
            'json' => [
                'addressKey' => env('ASAAS_TEST_PIX_KEY'),
                'description' => 'Teste Integração',
                'value' => '150.00',
            ]
        ]);

        $pix = json_decode($res->getBody()->getContents(), true);

        return view('pagamentos.pix', ['pix' => $pix]);
    }

    public function cartao(): View {
        return view('pagamentos.cartao');
    }

    public function ProcessaCartao(Request $request): View {
        $client = new Client();

        $dataForm = $request->post();
        $cartao = [];
        try {
            $res = $client->request('POST',  env('ASAAS_URI') . '/payments', [
                'http_errors' => false,
                'headers' => [
                    'access_token' => env('ASAAS_TOKEN'),
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Connection' => 'keep-alive'
                ],
                'json' => [
                    'customer' => env('ASAAS_TEST_CUSTOMER'),
                    'billingType' => 'CREDIT_CARD',
                    'dueDate' => '2024-06-11',
                    'value' => 150,
                    'description' => 'Pedido 056985',
                    'externalReference' => '056985',
                    'creditCard' => [
                        'holderName' => $dataForm['holderName'],
                        'number' => $dataForm['number'],
                        'expiryMonth' => $dataForm['expiryMonth'],
                        'expiryYear' => $dataForm['expiryYear'],
                        'ccv' => $dataForm['ccv']
                    ],
                    'creditCardHolderInfo' => [
                        'name' => 'Bruno de Abreu',
                        'email' => 'abreuleonel64@gmail.com',
                        'cpfCnpj' => '41709325011',
                        'postalCode' => '18208030',
                        'addressNumber' => 86,
                        'phone' => '11993856595',
                        'mobilePhone' => '11996586598'
                    ], //Deixei dados fixos, pq não faz diferença em sandbox.
                    'creditCardToken' => '76496073-536f-4835-80db-c45d00f33695'
                ]
            ]);
            $cartao = json_decode($res->getBody()->getContents(), true);
        } catch(RequestException $e) {
            $cartao = json_decode($e->getMessage(), true);
            
        }
        
        return view('pagamentos.processa_cartao', ['cartao' => $cartao]);
    }
}