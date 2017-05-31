@extends('layouts.UserMaster')

@section('title','Gift points')

@section('anyone_head')

@show

@section('menu')
    @include('partials.Menu')
@stop

@section('content')
<div class="panel panel-default" style="margin-top: 25px;">
    <div class="panel-heading">
        <h2 class="panel-title">贈送積分</h2>
    </div>
    <div class="panel-body">
        <form>
        	<label>優惠送點(%)</label>
        	<input id="gift_point" class="form-control" type="text" value="0">
        	<div class="panel panel-default">
			  <div class="panel-body" style="padding: 10px;">
			  	<h5>試算：</h5>
			  	<h5 id="total_point" data-total_point="{{ $result }}">目前會員總積分：{{ $result }}</h5>
			  	<h5 id="final_point" >優惠贈點後積分：{{ $result }}</h5>
			  </div>
			</div>
			<a id="give_gift" class="btn btn-primary">贈點</a>
        </form>
    </div>
</div>

<div class="fade message_modal" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">確認贈點</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action=" {{ route('GiftIntegral') }}  ">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label>優惠送點(%)</label>
                    <input id="check_gift" class="form-control" type="text" name="GiftIntegral" value="0" readonly>
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">確認贈送</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#gift_point').change(function(event) {
            var gift_point =$(this).val();
            var total_point = $('#total_point').attr('data-total_point');
            var final_point = parseInt(total_point)+parseInt(total_point)*parseInt(gift_point)/100;
            $('#final_point').text('優惠贈點後積分：'+parseInt(final_point));
        });

        $('#give_gift').click(function(event) {
            var gift_point =$('#gift_point').val();
            $('#check_gift').val(gift_point);
            $('.message_modal').show();

        });
        
    });
</script>

@stop

@if(count($message_text))
    @include('partials.Message')
@endif

@section('js_area')
<script type="text/javascript" src=" {{ asset('js/Message.js') }} "></script>
@show