@extends('layouts.master')
@section('content')
    <div class="mt-16" style="width: 60%">
        <div class="grid grid-cols-1 gap-16">
            <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    <form action="/pagamento/processa_cartao" method="post">
                        @csrf
                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                            <img title="Cartão de Crédito" src="/imgs/cartao.png"  style="width: 35px" />
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Cartão de Crédito</h2>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed" >
                            <input type="text" name="number" id="number" style="width:16em; padding:5px;" onblur="checkCard(this.value)" placeholder="Número do Cartão" /> 
                            <label id="card_type"></label>
                        </p>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed" >
                            <input type="text" name="holderName" id="holderName" style="width:16em; padding: 5px;" placeholder="Nome do Titular" /> 
                        </p>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed" >
                            <label> Expira em: <br />
                                <input type="number" name="expiryMonth" id="expiryMonth" style="width:5em; padding: 5px;" placeholder="Mês" /> 
                                <input type="number" name="expiryYear" id="expiryYear" style="width:5em; padding: 5px;" placeholder="Ano" /> 
                                <input type="number" name="ccv" id="ccv" style="width:5em; padding: 5px;" placeholder="CCV" />   
                            </label>
                        </p>

                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed" >
                            <button type="submit" > Finalizar Compra </button>
                        </p>
                    </form>
                </div>    
            </div>
        </div>
    </div>
@endsection