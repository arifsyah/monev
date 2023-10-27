@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Kegiatan
		</h3>
    </div>

</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <h2>Tambah data Kegiatan</h2>
        <ul class="nav navbar-right panel_toolbox">
            
                <a class="btn btn-small btn-info" href="{{ route('kegiatan.index') }}" >Kembali</a>
            
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kegiatan.store') }}">
        	{{ csrf_field() }}
            <!-- <div class="form-group{{ $errors->has('id_program') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Program <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="id_program form-control" id="id_program" style="height:40px;" name="id_program"></select>
                </div>
            </div> -->

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Nama Kegiatan <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Deskripsi</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
            </div>
            
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <input type="submit" style="display:none;">
                </div>
            </div>

        </form>
   	</div>

</div>
<script type="text/javascript">
    $('.id_program').select2({
        placeholder: 'Pilih Program',
        allowClear: true,
        ajax: {
            url: "{{route('program.dataselect')}}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.title,
                          id: item.id
                      }
                  })
              };
            },
            cache: true
        }
    });
</script>
@endsection