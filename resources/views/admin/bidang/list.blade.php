<table class="table table-striped responsive-utilities jambo_table 	bulk_action">
    <thead>
        <tr class="headings">
            <th style="width:25px;">
            	<!-- <input type="checkbox" id="check-all" class="flat"> -->
            </th>
            <th class="column-title" width="20px;">No </th>
            <th class="column-title">Nama Unit Kerja </th>
            <th class="column-title" width="30%">Deskripsi</th>
            <th class="column-title" width="">Dibuat oleh</th>
            <th class="column-title">Options</th>
            <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
	    </tr>
	</thead>

	<tbody>
		<?php 
		if (isset($bidang) && count($bidang)>0) {
			foreach ($bidang as $key => $value) {
				?>
				<tr class="<?php if($key%2 == 0){echo 'even';}else{echo 'odd';} ?> pointer">
					<td class="a-center ">
		    			<!-- <input type="checkbox" class="flat" name="table_records" > -->
		    		</td>
			        <td class=" "><?php echo $key + 1; ?></td>
			        <td class=" ">{{ $value->title }}</td>
			        <td class=" ">{{ $value->description }}</td>
			        <td class=" ">{{ $value->created->name }}<br/>{{ date_lang_reformat_long($value->created_at) }}</td>
			        
			        <td class=" last">
			        	<a class="btn btn-sm btn-default" onclick="detailpopup({{$value->id}})" href="javascript:void(0)" title="View Detail"><i class='fa fa-search'></i></a>
			        	<a class="btn btn-sm btn-info" href="{{ route('unit_kerja.edit',$value->id) }}" title="Edit"><i class='fa fa-pencil'></i></a>
			        	<a class="deletebutton btn btn-sm btn-danger" onclick="return false;" href="{{ route('unit_kerja.delete',$value->id) }}" title="Hapus"><i class='fa fa-trash'></i></a>
			        </td>
		        </tr>
				<?php
			}
		}else{
			?>
			<tr>
				<td colspan="10" class="text-center">
					Tidak ada data
				</td>
			</tr>
			<?php
		}
		?>

	</tbody>

</table>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Detail Unit Kerja</h3>
			</div>
		  	<div class="modal-body">
		  		<table class="table table-striped responsive-utilities jambo_table 	bulk_action">
		  			<tr>
		  				<td>Nama Unit Kerja</td>
		  				<td>:</td>
		  				<td><span id="nama_kategori"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Deskripsi Unit Kerja</td>
		  				<td>:</td>
		  				<td><span id="deskripsi"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Dibuat Oleh</td>
		  				<td>:</td>
		  				<td><span id="user_created"></span></td>
		  			</tr>
		  			<tr>
		  				<td>Dibuat Pada</td>
		  				<td>:</td>
		  				<td><span id="created_at"></span></td>
		  			</tr>
		  		</table>

		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="col-xs-6 text-left">
	<?php 
	/*
	<a class="btn btn-xs btn-warning" href="#">Delete Multiple</a>
	*/
	?>
</div>
<div class="col-xs-6 text-right">
	{{ $bidang->links() }}
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var title_bidang = '';
		var description_bidang = '';
		var user_created = '';
		var user_modified = '';
		var date_modified = '';
		var date_created = '';

		$('.pagination li a').click(function(){
			var urlx = $(this).attr('href');
        	event.preventDefault(); 

        	let params = (new URL(urlx)).searchParams;
			let page = params.get("page");
			let title = params.get("title");

        	fetch_data(title,page);
        });

		// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function fetch_data(title = '',page = ''){
        	showspinner();
        	$.ajax({
	            /* the route pointing to the post function */
	            url: ' {{ route("unit_kerja.alldata") }} ',
	            type: 'POST',
	            /* send the csrf-token and the input to the controller */
	            data: {title:title, page:page },
	            dataType: 'JSON',
	            /* remind that 'data' is the response of the AjaxController */
	            success: function (data) { 
	                // $(".writeinfo").append(data.msg); 
	                console.log(data)
	                $('.x_content').html(data.html)
	            }
	        }); 
        }

        $('.deletebutton').click(function(){
			// console.log($(this).attr('href'));
			if (confirm('Are you sure you want to delete from database ?')) {
			    location.href = $(this).attr('href');
			} else {
			    return false;
			}
		});

	});
</script>