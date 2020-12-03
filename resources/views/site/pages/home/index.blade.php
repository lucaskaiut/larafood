@extends('site.layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="title-plan">Escolha o plano</h1>
    </div>
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-md-4 col-sm-6">
                <div class="pricingTable">
                    <div class="pricing-content">
                        <div class="pricingTable-header">
                            <h3 class="title">{{ $plan->name }}</h3>
                        </div>
                        <div class="inner-content">
                            <div class="price-value">
                                <span class="currency">R$</span>
                                <span class="amount">{{ number_format($plan->price, 2, ',', '.') }}</span>
                                <span class="duration">Por Mês</span>
                            </div>
                            <ul>
                                @foreach($plan->details as $key => $detail)
                                    <li>{{ $detail->name }}</li>
                                    @if($key > 2 )
                                        <li>E mais...</li>
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                            <div class="pricingTable-signup">
                                <a href="#">Assinar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
