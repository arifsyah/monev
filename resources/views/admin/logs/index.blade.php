@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Catatan Aplikasi
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <form method="get">
        	<div class="col-xs-2" style="padding-left:0px;">
        		<input type="text" name="detail" class="form-control" placeholder="Detail" value="{{ Request::input('detail') }}">
        	</div>
        	
        	<div class="col-xs-2">
        		<input type="submit" value="Search" class="btn btn-small btn-info">
        	</div>
			<?php 
			/*
			<div class="col-xs-2 pull-right">
        		<ul class="nav navbar-right panel_toolbox">
		            <li>
		                <a href="{{ route('blog_categories.create') }}" >Add Blog Categories</a>
		            </li>
		        </ul>
        	</div>
			*/
			?>
        	

        </form>
        
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <table class="table table-striped responsive-utilities jambo_table 	bulk_action">
            <thead>
                <tr class="headings">
                    <th style="width:25px;">
                    	<input type="checkbox" id="check-all" class="flat">
                    </th>
	                <th class="column-title">No </th>
					<th class="column-title">Tanggal </th>
	                
	                <th class="column-title">Nama </th>
	                <th class="column-title">Nama Modul </th>
	                <th class="column-title">Detail </th>
                    <th class="bulk-actions" colspan="7">
	                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
	                </th>
			    </tr>
			</thead>

			<tbody>
				<?php 
		        if (isset($logs) && count($logs)>0) {
		        	foreach ($logs as $key => $value) {
		        		?>
		        		<tr class="<?php if($key%2 == 0){echo 'even';}else{echo 'odd';} ?> pointer">
		        			<td class="a-center ">
			        			<input type="checkbox" class="flat" name="table_records" >
                    		</td>
					        <td class=" "><?php echo $key + 1; ?></td>
							<td class=" ">{{ dateday_lang_reformat_long($value->created_at) }}</td>
					        
					        <td class=" ">{{ $value->name }}</td>
					        <td class=" ">{{ $value->module_name }}</td>
					        <td width="400" class=" ">{{ $value->detail }}</td>
							<?php 
							/*
							<td class=" last">
					        	<a class="btn btn-xs btn-default" href="#">View</a>
					        	<a class="btn btn-xs btn-info" href="{{ route('blog_categories.edit',$value->id) }}">Edit</a>
					        	<a class="deletebutton btn btn-xs btn-danger" onclick="return false;" href="{{ url('admin/blog_categories/delete').'/'.$value->id }}">Delete</a>
					        </td>
							*/
							?>
					        
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
        	{{ $logs->links() }}
        </div>
        
        
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.deletebutton').click(function(){
			// console.log($(this).attr('href'));
			if (confirm('Are you sure you want to delete from database ?')) {
			    location.href = $(this).attr('href');
			} else {
			    return false;
			}
		})
	});
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