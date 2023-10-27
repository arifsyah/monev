@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Program
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <form method="post" id="searchform" onsubmit="return searchThis();">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<div class="col-xs-2" style="padding-left:0px;">
        		<input type="text" id="title-search" name="title" class="form-control" placeholder="Nama Program" value="{{ Request::input('title') }}" >
        	</div>
        	
        	<div class="col-xs-2">
        		<input type="submit" onclick="return searchThis();" value="Search" class="btn btn-small btn-info">
        	</div>
        	<div class="col-xs-2 pull-right">
        		<ul class="nav navbar-right panel_toolbox">
		            
		            <a class="btn btn-small btn-info" href="{{ route('program.create') }}" >Tambah Program</a>
		            
		        </ul>
        	</div>
            <input type="hidden" name="id_program_main" value="">
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
        showspinner();
    	$.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("program.alldata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {title:title ,page:page },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                // console.log(data)
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

    function detailpopup(id){
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("program.detaildata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                // $(".writeinfo").append(data.msg); 
                // console.log(data.title)
                $('#nama_kategori').html(data.title);
                $('#deskripsi').html(data.description);
                $('#user_created').html(data.created.name);
                $('#created_at').html(data.created_at);
                // $('.x_content').html(data.html)
                $('#myModal').modal('show');
            }
        }); 
    }
    
    function detailProgram(id){
        $('#id_program_modal').val(id);
        $('#id_program_main').val(id);
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("program.detaildata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                $('#modalAttr').modal({backdrop: 'static', keyboard: false});
                // console.log(data)
                loaddetail(data);
            }
        });
    }

    function loaddetail(data){
        let value = JSON.parse(JSON.stringify(data));
        let attr = value['attr'];
        // console.log(attr)
        let html = "";
        $.each(attr,(index,item)=>{
            html += '<tr class=""><td>'+value['title']+'</td>';
            html += '<td class="text-center">'+item['tahun']+'</td>';
            html += '<td class="text-center">'+item['indikator']+'</td>';
            html += '<td class="text-center">'+item['satuan']+'</td>';
            html += '<td class="text-center">'+item['target']+'</td>';
            html += '<td class="text-center">'+item['target_tw_1']+'</td>';
            html += '<td class="text-center">'+item['target_tw_2']+'</td>';
            html += '<td class="text-center">'+item['target_tw_3']+'</td>';
            html += '<td class="text-center">'+item['target_tw_4']+'</td>';
            html += '<td class="last"><a class="btn btn-sm btn-info" href="#" onclick="editdetail('+item['id']+')" title="Edit"><i class="fa fa-pencil"></i></a></td>';
            html += '<td class="last"><a class="deletebutton btn btn-sm btn-danger" onclick="hapus('+item['id']+');" href="#" title="Hapus"><i class="fa fa-trash"></i></a></td>';
            html += '</tr>';
        });
        
        $('#detailprogrambody').html(html);
    }

    function hapus(id){
        $('#id_delete').val(id);
        $('#modalAttrDelete').modal({backdrop: 'static', keyboard: false});
        
    }

    function editdetail(id){
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("program.getdetailkinerja") }}',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                let dataedit = JSON.parse(JSON.stringify(data));
                let tahun = dataedit['data']['tahun'];
                let id_edit = dataedit['data']['id'];
                let indikator = dataedit['data']['indikator'];
                let target = dataedit['data']['target'];
                let satuan = dataedit['data']['satuan'];
                let target_tw_1 = dataedit['data']['target_tw_1'];
                let target_tw_2 = dataedit['data']['target_tw_2'];
                let target_tw_3 = dataedit['data']['target_tw_3'];
                let target_tw_4 = dataedit['data']['target_tw_4'];


                $('#tahunedittext').html(tahun);
                $('#tahunedit').val(tahun);
                $('#id_edit').val(id_edit);
                $('#indikator_program_edit').val(indikator);
                $('#target_program_edit').val(target);
                $('#satuan'+satuan).prop("selected", "selected");
                $('#target_program_tw_1_edit').val(target_tw_1);
                $('#target_program_tw_2_edit').val(target_tw_2);
                $('#target_program_tw_3_edit').val(target_tw_3);
                $('#target_program_tw_4_edit').val(target_tw_4);

                $('#modalAttrEdit').modal({backdrop: 'static', keyboard: false});
            }
        });
    }
    
    function deletekinerja(){
        let id_kinerja = $('#id_delete').val();
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("program.deletekinerja") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id_kinerja:id_kinerja},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                $('#modalAttrDelete').modal('hide');
                detailProgram($('#id_program_modal').val());
            }
        });
    }
</script>
@endsection