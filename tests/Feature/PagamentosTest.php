<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagamentosTest extends TestCase
{
    /** @test */
    public function welcome(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function cartao_credito(): void
    {
        $response = $this->get('/pagamento/cartao');
        $response->assertStatus(200);
    }

    /** @test */
    public function testa_post_da_pagina_processa_cartao_sucesso(): void
    {
        $response = $this->post('/pagamento/processa_cartao', [
            '_token' => csrf_token(),
            'holderName' => 'Bruno de Abreu',
            'number' => '4582359514456885',
            'expiryMonth' => 06,
            'expiryYear' => 2028,
            'ccv' => 336

        ]);
        $response->assertSee('Compra Realizada com Sucesso!');
        $response->assertStatus(200);
    }

    /** @test */
    public function testa_post_da_pagina_processa_cartao_erro(): void
    {
        $response = $this->post('/pagamento/processa_cartao', [
            '_token' => csrf_token(),
            'holderName' => 'Bruno de Abreu',
            'number' => '4582359514456885',
            'expiryMonth' => 06,
            'expiryYear' => 2022,
            'ccv' => 336

        ]);
        $response->assertSee('ERRO:');
        $response->assertStatus(200);
    }

    /** @test */
    public function pix(): void
    {
        $response = $this->get('/pagamento/pix');
        $response->assertStatus(200);
    }

    /** @test */
    public function pagamento_boleto(): void
    {
        $response = $this->get('/pagamento/boleto');
        $response->assertStatus(200);
    }
}
