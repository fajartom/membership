<div class="row">
    @foreach($mybenefit['data'] as $key => $benefit)
    <form id="memberchoose{{$key}}" hidden>
        <input type="text" value="{{$benefit['user']}}" name="user" id="user{{$key}}">
        <input type="text" value="{{$benefit['id']}}" name="member" id="member{{$key}}">
        <input type="text" value="{{$benefit['amount']}}" name="amount" id="amount{{$key}}">
        <input type="text" value="{{$locale}}" name="locale" id="locale{{$key}}">
        <input type="text" value="{{$domain}}" name="domain" id="domain{{$key}}">

        </form>
    <div class="col-lg-4 col-md-4 mt-4 mt-md-0">
        <div class="card text-center">
            <div class="card-body py-4" style="height:250px">
                <h3 class="card-title t400">{{$benefit['name']}}</h3>
                <!-- Price Value -->
                <div class="pricing-price t600 py-2">{{$benefit['amount']}}</div>
            </div>
            <div class="line my-1"></div>
            <div class="card-body py-4">
                <ul class="iconlist ml-0" style="opacity: .8;height:120px">
                    @foreach($mybenefit['data'][$key]['benefit'] as $v => $list)
                    <li>{{$list}}</li>
                    @endforeach
                </ul>
               
                    @foreach($mybenefit['data'][$key]['periode'] as $v => $periode)
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="periode"
                                                        id="gridRadios{{$key}}" value="{{$periode}}">
                                                    <label class="form-check-label" for="gridRadios{{$key}}">
                                                    {{$periode}} bulan
                                                    </label>
                                                </div>
                                            </div>
                    @endforeach
             
                <a href="#" class="button button-rounded button-large ls0 t400 m-0 nott tab-linker"
                    id="memberpick{{$key}}" rel="3">Subscribe</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="getCodeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #FFF; max-width: 500px;">
            <div class="modal-header">
                <h4 class="modal-title text-align" id="myModalLabel"> Verify Your Account. Please Check
                    Email For Your Token Number ! </h4>
            </div>
            <div class="modal-body" id="getCode" style="overflow-x: scroll;">
                <form id="modalform">
                    <div class="form-group">
                        <label for="Pob">Input Your Token </label>
                        <input type="hidden" name="user_id" value="{{$mybenefit['data'][0]['user']}}">
                        <input type="number" id="token" name="token" placeholder="Token Number" class="form-control" id="token"
                            aria-describedby="token" required>
                        <small id="tokenHelp" class="form-text text-muted">Your Token</small>
                    </div>
                </form>
                <button type="button" class="button button-3d nomargin" id="verifybtn">
                    VERIFY
                </button>
            </div>
        </div>
    </div>
</div>
<script>
$("#memberpick0").click(function() {
    var data = $('#memberchoose0').serializeArray();
    var radioValue = $("input[name='periode']:checked").val();
    data.push({ name: "periode", value: radioValue });
    $.post("/api/memberselect/", data,
        function(data, status) {
            var success = data.success;
            $(document).ready(function() {
                setTimeout(() => {
                    $('#succ').click();
                    $('succ2').hide();
                    $('#pays').html(success.member);
                }, 300);
            });
        });
});
$("#memberpick1").click(function() {
    var data = $('#memberchoose1').serializeArray();
    var radioValue = $("input[name='periode']:checked").val();
    data.push({ name: "periode", value: radioValue });
    $.post("/api/memberselect/", data,
        function(data, status) {
            var success = data.success;
            $(document).ready(function() {
                setTimeout(() => {
                    $('#succ').click();
                    $('succ2').hide();
                    $('#prev2').hide();
                    $('#pays').html(success.member);
                }, 300);
            });
        });
});
$("#memberpick2").click(function() {
    var data = $('#memberchoose2').serializeArray();
    var radioValue = $("input[name='periode']:checked").val();
    data.push({ name: "periode", value: radioValue });
    $.post("/api/memberselect/", data,
        function(data, status) {
            var success = data.success;
            $(document).ready(function() {
                setTimeout(() => {
                    $('#succ').click();
                    $('succ2').hide();
                    $('#prev2').hide();
                    $('#pays').html(success.member);
                }, 300);
            });
        });
});
$(document).ready(function() {
    setTimeout(() => {
        $("#getCodeModal").modal('show');
    }, 300);
    $("#verifybtn").click(function() {
        var data= $('#modalform').serializeArray();
        $.post("/api/confirmregister/", data,
        function(data, status) {
            console.log(data);
            var success = data.success;
            if(success.status==true){
                $("#getCodeModal").modal('hide');
            }else{

                    $(document).ready(function() {
                            setTimeout(() => {
                                $('#tokenHelp').html("<font color='red'>Invalid Token Number</font>");
                                $("input[name=token]").css({
                                    "border-color": "red"
                                });
                            }, 300);
                        });
            }
        });
        
    });

});
</script>