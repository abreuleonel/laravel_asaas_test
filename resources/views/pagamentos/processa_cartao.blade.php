@extends('layouts.master')
@section('content')
    <div class="mt-16" style="width: 60%">
        <div class="grid grid-cols-1 gap-16">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                        <img title="Cartão de Crédito" src="/imgs/cartao.png"  style="width: 35px" />
                    </div>

                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Cartão de Crédito</h2>

                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed" >
                     
                        @if(isset($cartao['errors']))
                            <span style="color: red; font-weight: bold">ERRO:  <?= $cartao['errors'][0]['description'] ?> </span>
                        @else
                            <span style="color: green; font-weight: bold"> Compra Realizada com Sucesso! </span>
                            <br />
                            <span style="color: white"> Pedido Nº <?= $cartao['invoiceNumber'] ?> </span>
                            <br />
                            <span style="color: white"> Cartão <?= $cartao['creditCard']['creditCardBrand'] ?> XXXX XXXX XXXX <?= $cartao['creditCard']['creditCardNumber'] ?> </span>
                            <br />
                            <span style="color: white"> Para acompanhar seu pedido, <a href="<?= $cartao['invoiceUrl'] ?>" target="_blank">clique aqui</a> </span>
                        @endif
                    </p>
                </div>    
            </div>
        </div>
    </div>
@endsection