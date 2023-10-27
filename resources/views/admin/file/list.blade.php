<table class="table table-striped responsive-utilities jambo_table 	bulk_action">
    <thead>
        <tr class="headings">
            <th style="width:25px;">
            	<!-- <input type="checkbox" id="check-all" class="flat"> -->
            </th>
            <th class="column-title" width="20px;">No </th>
            <th class="column-title">Kategori </th>
            <th class="column-title">Judul </th>
            <th class="column-title" width="30%">Deskripsi</th>
            <th class="column-title" >Tahun</th>
            <th class="column-title" width="120">Options</th>
            <th class="bulk-actions" colspan="7">
                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
	    </tr>
	</thead>

	<tbody>
		<?php 
		if (isset($file) && count($file)>0) {
			foreach ($file as $key => $value) {
				?>
				<tr class="<?php if($key%2 == 0){echo 'even';}else{echo 'odd';} ?> pointer">
					<td class="a-center ">
		    			<!-- <input type="checkbox" class="flat" name="table_records" > -->
		    		</td>
			        <td class=" "><?php echo $key + 1; ?></td>
			        <td class=" ">
			        	{{ $value->kategori->title ?? '' }}
			        	<br/>
			        	<hr/>
			        	<a class="btn btn-default btn-xs" href="{{ route('file.download',$value->id) }}?time={{time()}}" target="_blank">Download File</a>
			        	@if($value->jumlah_history > 0)
			        		
			        		<a class="btn btn-xs btn-warning" onclick="detailpopupHistory({{$value->id}})" href="javascript:void(0)">History</a>
			        	@endif
			        </td>
			        <td class=" ">{{ $value->title }}</td>
			        <td class=" ">{{ $value->description }}</td>
			        <td class=" ">{{ $value->tahun }}</td>
			        
			        <td class=" last">
			        	<a title="View Detail" class="btn btn-xs btn-default" onclick="detailpopup({{$value->id}})" href="javascript:void(0)"><i class='fa fa-search'></i></a>
			        	
			        	<a title="Edit" class="btn btn-xs btn-info" href="{{ route('file.edit',$value->id) }}"><i class='fa fa-pencil'></i></a>
			        	<a title="Hapus" class="deletebutton btn btn-xs btn-danger" onclick="return false;" href="{{ route('file.delete',$value->id) }}"><i class='fa fa-trash'></i></a>
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

<div class="col-xs-6 text-left">
	<?php 
	/*
	<a class="btn btn-xs btn-warning" href="#">Delete Multiple</a>
	*/
	?>
</div>
<div class="col-xs-6 text-right">
	{{ $file->links() }}
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.pagination li a').click(function(){
			var urlx = $(this).attr('href');
        	event.preventDefault(); 

        	let params = (new URL(urlx)).searchParams;
			let page = params.get("page");
			let title = params.get("title");
			let tahun = params.get("tahun");
			let description = params.get("description");
			let id_kategori = params.get("id_kategori");
			let id_tag = params.get("id_tag");
			let id_bidang = params.get("id_bidang");

        	fetch_data(title,id_kategori,id_tag,description,tahun,id_bidang,page);
        });

		// var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function fetch_data(title = '',id_kategori = '',id_tag='',description='',tahun='',id_bidang='',page = ''){
        	showspinner();
        	$.ajax({
	            /* the route pointing to the post function */
	            url: ' {{ route("file.alldata") }} ',
	            type: 'POST',
	            /* send the csrf-token and the input to the controller */
	            data: {title:title,id_kategori:id_kategori,id_tag:id_tag,description:description,tahun:tahun,id_bidang:id_bidang,page:page },
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