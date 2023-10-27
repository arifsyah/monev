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
        <h2>Ubah data Kegiatan</h2>
        <ul class="nav navbar-right panel_toolbox">
            
                <a class="btn btn-small btn-info" href="{{ route('kegiatan.index') }}" >Kembali</a>
            
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kegiatan.update',$kegiatan->id) }}">
        	{{ csrf_field() }}

            <!-- <div class="form-group{{ $errors->has('id_program') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program">Program </label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="itemNameProgram form-control" style="height:34px;" name="itemNameProgram">
                        <option value="{{$data['id_program']}}" selected="selected" >{{ $data['program']['title'] ?? '' }}</option>
                    </select>
                    <input type="hidden" class="id_program" id="id_program" name="id_program" value="{{$data['id_program']}}">
                </div>
                
            </div> -->

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Nama Kegiatan <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" name="title" value="{{ $kegiatan->title }}" required="required" class="form-control col-md-7 col-xs-12">

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
                    <textarea name="description" class="form-control col-md-7 col-xs-12">{{ $kegiatan->description }}</textarea>
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
    $('.itemNameProgram').on('select2:select', function (e) {
            var data = e.params.data;
            $('#id_program').val(data.id);
        });

        $('.itemNameProgram').select2({
          placeholder: 'Select an item',
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
            allowClear: true,
            cache: true
          }
        })
</script>

@endsection