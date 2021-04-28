<div class="row justify-content-center">
    @foreach($payment as $key => $val)
    <form id="paymentchoose{{$key}}" hidden>
        <input type="text" value="{{$locale}}" name="locale">
        <input type="text" value="{{$payment[0]['user']}}" name="user" id="user{{$key}}">
        <input type="text" value="{{$payment[0]['id_artist']}}" name="artist" id="artist{{$key}}">
        <input type="text" value="{{$payment[0]['member_select']}}" name="member" id="member{{$key}}">
        <input type="text" value="{{$payment[0]['amount']}}" name="amount" id="amount{{$key}}">
        <input type="text" value="{{$payment[0]['periode']}}" name="periode" id="periode{{$key}}">
        <input type="text" value="{{$locale}}" name="locale" id="locale{{$key}}">
        <input type="text" value="{{$domain}}" name="domain" id="domain{{$key}}">
        <input type="text" value="{{$val['name']}}" name="payment_name" id="payment_name{{$key}}">
        <input type="text" value="{{$val['id']}}" name="payment_id" id="payment_id{{$key}}">

    </form>
    <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
        <div class="card text-center">
            <div class="card-body py-4">
                <h3 class="card-title t400">{{$val['name']}}</h3>
            </div>
            <div class="line my-1"></div>
            <div class="card-body py-4">
                <p class="card-text pricing-sub t600"><img class="rounded" src="{{ asset("storage/setting/{$val['logo']}") }}" alt="" style="max-height:64px"></p>
                <a href="#" class="button button-rounded button-large ls0 t400 m-0 nott" id="payment{{$key}}">Pay Now</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script type="text/javascript">
    $("#payment0").click(function() {
        var data = $('#paymentchoose0').serializeArray();
        $.post("/api/paymentselect/", data,
            function(data, status) {
                var success = data.success;
                $(document).ready(function(){
                   setTimeout(() => {
                    $('#succ2').click();
                     $('#thanks').html(success.thanks);
                }, 300);
               });
            });
    });
    $("#payment1").click(function() {
        var data = $('#paymentchoose1').serializeArray();
        $.post("/api/paymentselect/", data,
            function(data, status) {
                var success = data.success;
                $(document).ready(function(){
                   setTimeout(() => {
                    $('#succ2').click();
                     $('#thanks').html(success.thanks);
                }, 300);
               });
            });
    });
</script>