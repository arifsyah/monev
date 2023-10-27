@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Sub Kategori
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <form method="post" id="searchform" onsubmit="return searchThis();">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<div class="col-xs-2" style="padding-left:0px;">
        		<input type="text" id="title-search" name="title" class="form-control" placeholder="Title" value="{{ Request::input('title') }}" >
        	</div>
        	
        	<div class="col-xs-2">
        		<input type="submit" onclick="return searchThis();" value="Search" class="btn btn-small btn-info">
        	</div>
        	<div class="col-xs-2 pull-right">
        		<ul class="nav navbar-right panel_toolbox">
		            <li>
		                <a href="{{ route('subcategory.create') }}" >Tambah Sub Kategori</a>
		            </li>
		        </ul>
        	</div>

        </form>
        
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        
        
    </div>
</div>
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$(document).ready(function(){
		
		// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		//initial
		fetch_data();

        
	});


	function fetch_data(title = '', page = ''){
    	$.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("subcategory.alldata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {title:title ,page:page },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                console.log(data)
                $('.x_content').html(data.html)
            }
        }); 
    }

    function searchThis(){

		var frm = document.searchform;
		event.preventDefault(); 
		// alert('adsasd')
		var title = $('#title-search').val();
		// return false;
		fetch_data(title);
	}
	// function confirmdialog(){
	// 	console.log(this);
	// 	var href = this.href;
	// 	if (confirm('Are you sure you want to save this thing into the database?')) {
	// 	    // Save it!
	// 	} else {
	// 	    // Do nothing!
	// 	}


	// }
</script>
@endsection