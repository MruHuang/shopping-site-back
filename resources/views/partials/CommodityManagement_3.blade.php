<form role="form" class="form-inline" method="POST" id="update_order" action=" {{ route('AddCommoditySpecies') }} ">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
    	<label>新增商品種類</label>
    	<input type="text" name="specise_name">
    </div>
    <button type="submit" class="btn btn-success">新增</button>
</form>
<div class="alert alert-warning">注意! 若種類名稱為"預設"，則新增商品的種類選取中不會出現該選項。</div>
<table class="table">
	<tr>
		<th class="text-center">總類</th>
		<th class="text-center">商品類別</th>
		<th class="text-center"></th>
	</tr>
	<?php $MAX=count($AllInformation)?>
	@for($i=0;$i<$MAX;$i++)
	<tr>
		<form role="form" method="POST" action=" {{ route('EditCommoditySpecies') }}  ">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<input type="hidden" name="this_page" value="{{ $this_page }}">
			<input type="hidden" name="specise_id" value="{{ $AllInformation[$i]['speciseID'] }}">
			<td class="text-center">
			{{ ($i+1) }}
			</td>
			<td class="text-center">
			<input type="text" class="form-control" name="specise_name" placeholder="輸入類別" value="{{ $AllInformation[$i]['speciseName'] }}">
				
			</td>
			<td class="text-center">
				<button type="submit" class="btn btn-default">修改</button>
			</td>
		</form>
	</tr>
	@endfor
</table>
	<select class="form-control this_page" style="width:7%; margin-left: auto; margin-right: auto;">
	    @for($i=1;$i<=$count_page;$i++)
	   		@if($i == $this_page)
	        <option selected>{{ $i }}</option>
	        	@else
	    	<option>{{ $i }}</option>
	        @endif
	    @endfor
	</select>
	<div class="text-center" style="margin-top: 10px;">第{{ $this_page }}/{{ (int)$count_page }}頁</div>
<script type="text/javascript">
	var url = "{{ route('CommoditySpecies') }}";
	$('.this_page').change(function(event) {
	  	this_page = $(this).val();
	  	url = url+"/"+this_page;
	  	document.location.href=url;
	  });
</script>
