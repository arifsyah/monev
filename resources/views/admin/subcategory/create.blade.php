@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Kategori
		</h3>
    </div>

</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <h2>Tambah data Kategori</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a href="{{ route('subcategory.index') }}" >Kembali</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('subcategory.store') }}">
        	{{ csrf_field() }}

            <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Kategori <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="itemName form-control" style="height:34px;" name="itemName"></select>
                    <input type="hidden" name="id_kategori" value="">
                    <!-- @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif -->
                </div>
            </div>

            

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
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
    $(document).ready(function(){
        $('.itemName').select2({
          placeholder: 'Select an item',
          ajax: {
            url: "{{route('category.dataselect')}}",
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
        })

        $('.itemName').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data);
        });
    })
</script>
@endsection