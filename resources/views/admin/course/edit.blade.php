@extends('layouts.adminapp')

@section('content')
<script>
    $(document).ready(function(){
        var arr_months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
        var arr_day = ["Ming.", "Sen", "Sel", "Rab","Kam", "Jum", "Sab"]
        $('#date_open').datetimepicker({
            lang: 'id',
            i18n:{
                id:{
                    months: arr_months ,
                    dayOfWeek: arr_day
                }
            },
            timepicker: true,
            mask: false,
            closeOnDateSelect:true,
            format:'Y-m-d H:i:s',
            scrollInput:false,
        });

        $('#date_closed').datetimepicker({
            lang: 'id',
            i18n:{
                id:{
                    months: arr_months ,
                    dayOfWeek: arr_day
                }
            },
            timepicker: true,
            mask: false,
            closeOnDateSelect:true,
            scrollInput:false,
            format:'Y-m-d H:i:s',
            onShow:function( ct ){
                this.setOptions({
                    minDate:$('#date_open').val()?$('#date_open').val():'0',
                    formatDate:'Y-m-d H:i:s'
                })
            },
        });
    })
</script>

<div class="page-title">
    <div class="title_left">
        <h3>
            Kelas
        </h3>
    </div>

</div>
<div class="x_panel">
    @include('admin.__flash')
    <div class="x_title">
        <h2>Tambah data Kelas</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <a href="{{ route('course.index') }}" >Back to Kelas</a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ url('admin/course/updatedata').'/'.$course->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Kategori</label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <select name="id_categories" class="form-control" >
                    <?php 
                    if(isset($category) && count($category)>0 ){
                        foreach($category as $key => $value){
                            ?>
                            <option <?php if($value->id == $course->id_categories){echo "selected='selected'";} ?> value="{{ $value->id }}"> {{$value->title}} </option>
                            <?php
                        }
                    }
                    ?>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title <span class="required">*</span></label>
                
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12" value="{{$course->title}}">

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" class="form-control col-md-7 col-xs-12">{{$course->description}}</textarea>
                </div>
            </div>

            <div class="form-group {{ $errors->has('date_open') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date Open <span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <input type="text" id="date_open" name="date_open" value="{{$course->date_open}}" class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('date_open'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_open') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('date_closed') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date Closed <span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <input type="text" id="date_closed" name="date_closed" value="{{$course->date_closed}}" class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('date_closed'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_closed') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('harga') ? ' has-error' : '' }}">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga <span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <input type="text" id="harga" name="harga" value="{{$course->harga}}" class="form-control col-md-7 col-xs-12">
                    @if ($errors->has('harga'))
                        <span class="help-block">
                            <strong>{{ $errors->first('harga') }}</strong>
                        </span>
                    @endif
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
@endsection