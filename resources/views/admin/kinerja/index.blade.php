@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Kinerja
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <form method="post" id="searchform" onsubmit="return searchThis();">
        	
        	<div class="col-xs-12 text-center">    
		        <a class="btn btn-lg btn-info" href="{{ route('kinerja.capaian',2022) }}" >2022</a>
		        <a class="btn btn-lg btn-warning" href="{{ route('kinerja.capaian',2023) }}" >2023</a>
		        <a class="btn btn-lg btn-success" href="{{ route('kinerja.capaian',2024) }}" >2024</a>
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

    function detailpopup(id){
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("kegiatan.detaildata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                console.log(data.title)
                $('#nama_kategori').html(data.title);
                $('#deskripsi').html(data.description);
                $('#user_created').html(data.created.name);
                $('#created_at').html(data.created_at);
                // $('.x_content').html(data.html)
                $('#myModal').modal({backdrop: 'static', keyboard: false});
            }
        }); 

        // $('#myModal').modal('show');
        // title_bidang = 'sssssssssssssss'
        // alert('adasd')
    }
    
</script>
@endsection