<div class="row justify-content-center">
    <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
        <div class="card text-center">
            <div class="card-body py-4">
                <h3 class="card-title t400">Payment With {{ $payment['payment_method_name'] }}</h3>
            </div>
            <div class="line my-1"></div>
            <div class="card-body py-4">
                <p class="card-text pricing-sub t600">{!! $payment['desc'] !!}</p>
                <p class="card-text pricing-sub t600">Total : {{$payment['total_amount']}}</p>
                <p class="card-text pricing-sub t600">{!! $payment['expired'] !!}</p>
                <strong>Thank You.</strong> Your order has processed once we verify the Payment !. Go to <a href="http://{{$domain}}">{{$domain}}</a>
            </div>
        </div>
    </div>
</div>