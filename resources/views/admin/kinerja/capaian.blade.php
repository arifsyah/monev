@extends('layouts.adminapp')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Capaian Kinerja Tahun {{$tahun}}
		</h3>
    </div>

</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        <ul class="nav navbar-left panel_toolbox">
            <!-- <a class="btn btn-small btn-success" onclick="tambahkinerja({{$tahun}})" href="javascript:void(0)" >Tambah Kinerja</a> -->
            
        </ul>

        <ul class="nav navbar-right panel_toolbox">
            <a class="btn btn-small btn-info" href="{{ route('kinerja.index') }}" >Kembali</a>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    	<br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kegiatan.store') }}">
        	{{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                        <tbody>
                        @foreach($program as $key => $value)
                            <tr>
                                <td>
                                    <h5>{{$key+1}}. {{ $value['title'] }}</h5>
                                    <div class="paddingleft15">Indikator : {{ $value['indikator']}} </div>
                                    <div class="paddingleft15">Target : {{$value['target']}} {{$value['satuan']}}</div>
                                    <div class="paddingleft15">Realisasi : {{$value['realisasi']}} {{$value['satuan']}}</div>
                                    <div class="paddingleft15"> 
                                        
                                        <div class="">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="text-center">Target Triwulan</div>
                                                    <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                        <tr class="headings">
                                                            <th>Triwulan I</th>
                                                            <th>Triwulan II</th>
                                                            <th>Triwulan III</th>
                                                            <th>Triwulan IV</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{$value['target_tw_1']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['target_tw_2']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['target_tw_3']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['target_tw_4']}} {{$value['satuan']}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-xs-6">
                                                <div class="text-center">Realisasi Triwulan</div>
                                                    <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                        <tr class="headings">
                                                            <th>Triwulan I</th>
                                                            <th>Triwulan II</th>
                                                            <th>Triwulan III</th>
                                                            <th>Triwulan IV</th>
                                                            <th>Opsi</th>
                                                        </tr>
                                                        <tr>
                                                            <td>{{$value['realisasi_tw_1']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['realisasi_tw_2']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['realisasi_tw_3']}} {{$value['satuan']}}</td>
                                                            <td>{{$value['realisasi_tw_4']}} {{$value['satuan']}}</td>
                                                            <td><a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="realisasiprogram({{$value['id_attr']}},'{{$value['title']}}','{{$value['indikator']}}')" title="Edit"><i class='fa fa-pencil'></i></a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($value['kegiatan'])>0)
                                        <div style="padding-left:75px;">
                                            <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                            @foreach($value['kegiatan'] as $key2 => $value2 )
                                                <tr>
                                                    <td>
                                                        <div>Kegiatan : {{$value2['title']}} / Program : {{$value2['nama_program']}}</div>
                                                        <div>Indikator : {{$value2['indikator']}}</div>
                                                        <div>Target : {{$value2['target']}} {{$value2['satuan']}}</div>
                                                        <div>Realisasi : {{$value2['realisasi']}} {{$value2['satuan']}}</div>
                                                        <div>
                                                            <div class="">
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <div class="text-center">Target Triwulan</div>
                                                                        <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                                            <tr class="headings">
                                                                                <th>Triwulan I</th>
                                                                                <th>Triwulan II</th>
                                                                                <th>Triwulan III</th>
                                                                                <th>Triwulan IV</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{$value2['target_tw_1']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['target_tw_2']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['target_tw_3']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['target_tw_4']}} {{$value2['satuan']}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                    <div class="text-center">Realisasi Triwulan</div>
                                                                        <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                                            <tr class="headings">
                                                                                <th>Triwulan I</th>
                                                                                <th>Triwulan II</th>
                                                                                <th>Triwulan III</th>
                                                                                <th>Triwulan IV</th>
                                                                                <th>Opsi</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{$value2['realisasi_tw_1']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['realisasi_tw_2']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['realisasi_tw_3']}} {{$value2['satuan']}}</td>
                                                                                <td>{{$value2['realisasi_tw_4']}} {{$value2['satuan']}}</td>
                                                                                <td><a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="realisasikegiatan({{$value2['id_attr']}},'{{$value2['title']}}','{{$value2['indikator']}}','{{$value2['nama_program']}}')" title="Edit"><i class='fa fa-pencil'></i></a></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if(count($value2['subkegiatan'])>0)
                                                            @foreach($value2['subkegiatan'] as $key3 => $value3 )
                                                                <div style="padding-left:75px;">
                                                                    <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                                        <tr>
                                                                            <td>
                                                                                <div>Sub Kegiatan : {{$value3['title']}} / Kegiatan : {{$value3['nama_kegiatan']}} / Program : {{$value3['nama_program']}}</div>
                                                                                <div>Indikator : {{$value3['indikator']}}</div>
                                                                                <div>Target : {{$value3['target']}} {{$value3['satuan']}}</div>
                                                                                <div>Realisasi : {{$value3['realisasi']}} {{$value3['satuan']}}</div>
                                                                                <div>
                                                                                    <div class="">
                                                                                        <div class="row">
                                                                                            <div class="col-xs-6">
                                                                                                <div class="text-center">Target Triwulan</div>
                                                                                                <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                                                                    <tr class="headings">
                                                                                                        <th>Triwulan I</th>
                                                                                                        <th>Triwulan II</th>
                                                                                                        <th>Triwulan III</th>
                                                                                                        <th>Triwulan IV</th>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>{{$value3['target_tw_1']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['target_tw_2']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['target_tw_3']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['target_tw_4']}} {{$value3['satuan']}}</td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                            <div class="col-xs-6">
                                                                                            <div class="text-center">Realisasi Triwulan</div>
                                                                                                <table style="margin-bottom:0px !important" class="table table-striped responsive-utilities">
                                                                                                    <tr class="headings">
                                                                                                        <th>Triwulan I</th>
                                                                                                        <th>Triwulan II</th>
                                                                                                        <th>Triwulan III</th>
                                                                                                        <th>Triwulan IV</th>
                                                                                                        <th>Opsi</th>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>{{$value3['realisasi_tw_1']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['realisasi_tw_2']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['realisasi_tw_3']}} {{$value3['satuan']}}</td>
                                                                                                        <td>{{$value3['realisasi_tw_4']}} {{$value3['satuan']}}</td>
                                                                                                        <td><a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="realisasisubkegiatan({{$value3['id_attr']}},'{{$value3['title']}}','{{$value3['indikator']}}','{{$value3['nama_kegiatan']}}','{{$value3['nama_program']}}')" title="Edit"><i class='fa fa-pencil'></i></a></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            @endforeach
                                                            
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
   	</div>

</div>
<!--
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Tambah Capaian Kinerja</h3>
			</div>
		  	<div class="modal-body">
              <form id="formkinerja" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('kegiatan.store') }}" osubmit="return false;">
                    {{ csrf_field() }}
                    
                    <div class="form-group{{ $errors->has('id_program') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Program <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12" id="select2program">
                            <select class="id_program form-control" id="id_program" style="height:40px;" name="id_program"></select>
                        </div>
                    </div>
            
                    <div class="form-group{{ $errors->has('indikator_program') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="indikator_program">Indikator Program <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="indikator_program" name="indikator_program" required="required" class="form-control col-xs-12">

                            @if ($errors->has('indikator_program'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('indikator_program') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('target_program') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="target_program">Target Program <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="target_program" name="target_program" required="required" class="form-control col-xs-12">
                            
                            @if ($errors->has('target_program'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('target_program') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('satuan_program') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_program">Satuan Program <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="satuan_program form-control" id="satuan_program" style="height:40px;" name="satuan_program">
                                @php
                                    $satuan = Config::get('constants.satuan'); 
                                @endphp
                                @foreach ($satuan as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            
                            @if ($errors->has('satuan_program'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('satuan_program') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Target Triwulan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" id="target_program_tw_1" name="target_program_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" id="target_program_tw_2" name="target_program_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" id="target_program_tw_3" name="target_program_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" id="target_program_tw_4" name="target_program_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>
                    
                    <div class="form-group{{ $errors->has('id_kegiatan') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Kegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12" id="select2kegiatan">
                            <select class="id_kegiatan form-control" id="id_kegiatan" style="height:40px;" name="id_kegiatan"></select>
                        </div>
                    </div>
            
                    <div class="form-group{{ $errors->has('indikator_kegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="indikator_kegiatan">Indikator Kegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="indikator_kegiatan" name="indikator_kegiatan" required="required" class="form-control col-xs-12">

                            @if ($errors->has('indikator_kegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('indikator_kegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('target_kegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="target_kegiatan">Target Kegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="target_kegiatan" name="target_kegiatan" required="required" class="form-control col-xs-12">
                            
                            @if ($errors->has('target_kegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('target_kegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('satuan_kegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_kegiatan">Satuan Kegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="satuan_kegiatan form-control" id="satuan_kegiatan" style="height:40px;" name="satuan_kegiatan">
                                @php
                                    $satuan = Config::get('constants.satuan'); 
                                @endphp
                                @foreach ($satuan as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            
                            @if ($errors->has('satuan_kegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('satuan_kegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Target Triwulan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_kegiatan_tw_1" name="target_kegiatan_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_kegiatan_tw_2" name="target_kegiatan_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_kegiatan_tw_3" name="target_kegiatan_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_kegiatan_tw_4" name="target_kegiatan_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group{{ $errors->has('id_subkegiatan') ? ' has-error' : '' }}">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Subkegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12" id="select2subkegiatan">
                            <select class="id_subkegiatan form-control" id="id_subkegiatan" style="height:40px;" name="id_subkegiatan"></select>
                        </div>
                    </div>
            
                    <div class="form-group{{ $errors->has('indikator_subkegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="indikator_subkegiatan">Indikator Subkegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="indikator_subkegiatan" name="indikator_subkegiatan" required="required" class="form-control col-xs-12">

                            @if ($errors->has('indikator_subkegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('indikator_subkegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('target_subkegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="target_subkegiatan">Target Subkegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="target_subkegiatan" name="target_subkegiatan" required="required" class="form-control col-xs-12">
                            
                            @if ($errors->has('target_subkegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('target_subkegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('satuan_subkegiatan') ? ' has-error' : '' }}"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan_subkegiatan">Satuan Subkegiatan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="satuan_subkegiatan form-control" id="satuan_subkegiatan" style="height:40px;" name="satuan_subkegiatan">
                                @php
                                    $satuan = Config::get('constants.satuan'); 
                                @endphp
                                @foreach ($satuan as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            
                            @if ($errors->has('satuan_subkegiatan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('satuan_subkegiatan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Target Triwulan</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_subkegiatan_tw_1" name="target_subkegiatan_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_subkegiatan_tw_2" name="target_subkegiatan_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_subkegiatan_tw_3" name="target_subkegiatan_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-3 ">
                                    <input type="text" id="target_subkegiatan_tw_4" name="target_subkegiatan_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" id="btnsubmit" class="btn btn-success">Submit</button>
                            <input type="submit" style="display:none;">
                        </div>
                    </div>

                    
                </form>

		  	</div>
		</div> 
	</div>
</div> -->

<div id="modalRealisasiProgram" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Realisasi Program</h3>
			</div>
		  	<div class="modal-body">
			  	@include('admin.__flash')
			  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					<div class="panel panel-default">
						
						<div >
							<form id="realisasiprogram" data-parsley-validate class="form-horizontal form-label-left" method="post" action="" osubmit="return false;">	
								<input type="hidden" id="id_program_attr_modal" name="id_program_attr_modal" value="">
								<input type="hidden" id="tahun" name="tahun" value="{{$tahun}}">
								<div class="panel-body">
                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Program</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="programtextRP" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Indikator</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="indikatortextRP" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Tahunan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input type="text" id="realisasi_program_tahunan" name="realisasi_program_tahunan" required="required" class="form-control col-xs-12" value="">
												</div>

											</div>
										</div>
									</div>
                                    
									<div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Triwulan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_program_tw_1" name="realisasi_program_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_program_tw_2" name="realisasi_program_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_program_tw_3" name="realisasi_program_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_program_tw_4" name="realisasi_program_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
												</div>
											</div>
										</div>
									</div>

									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
											<button type="submit" id="btnsubmitrealisasiprogram" class="btn btn-success">Submit</button>
											<input type="submit" style="display:none;">
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div><!-- panel-group -->
				
		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modalRealisasiKegiatan" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Realisasi Kegiatan</h3>
			</div>
		  	<div class="modal-body">
			  	@include('admin.__flash')
			  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					<div class="panel panel-default">
						
						<div >
							<form id="realisasikegiatan" data-parsley-validate class="form-horizontal form-label-left" method="post" action="" osubmit="return false;">	
								<input type="hidden" id="id_kegiatan_attr_modal" name="id_kegiatan_attr_modal" value="">
								<input type="hidden" id="tahun" name="tahun" value="{{$tahun}}">
								<div class="panel-body">
                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Program</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="programtextRK" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Kegiatan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="kegiatantextRK" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Indikator</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="indikatortextRK" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Tahunan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input type="text" id="realisasi_kegiatan_tahunan" name="realisasi_kegiatan_tahunan" required="required" class="form-control col-xs-12" value="">
												</div>

											</div>
										</div>
									</div>
                                    
									<div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Triwulan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_kegiatan_tw_1" name="realisasi_kegiatan_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_kegiatan_tw_2" name="realisasi_kegiatan_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_kegiatan_tw_3" name="realisasi_kegiatan_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_kegiatan_tw_4" name="realisasi_kegiatan_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
												</div>
											</div>
										</div>
									</div>

									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
											<button type="submit" id="btnsubmitrealisasiprogram" class="btn btn-success">Submit</button>
											<input type="submit" style="display:none;">
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div><!-- panel-group -->
				
		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modalRealisasiSubKegiatan" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Realisasi Sub Kegiatan</h3>
			</div>
		  	<div class="modal-body">
			  	@include('admin.__flash')
			  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

					<div class="panel panel-default">
						
						<div >
							<form id="realisasisubkegiatan" data-parsley-validate class="form-horizontal form-label-left" method="post" action="" osubmit="return false;">	
								<input type="hidden" id="id_subkegiatan_attr_modal" name="id_subkegiatan_attr_modal" value="">
								<input type="hidden" id="tahun" name="tahun" value="{{$tahun}}">
								<div class="panel-body">
                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Program</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="programtextRS" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Kegiatan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="kegiatantextRS" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>
                                    
                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Sub Kegiatan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="subkegiatantextRS" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Indikator</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="indikatortextRS" style="padding-top:8px;"></div>
											</div>
										</div>
									</div>

                                    <div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Tahunan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input type="text" id="realisasi_subkegiatan_tahunan" name="realisasi_subkegiatan_tahunan" required="required" class="form-control col-xs-12" value="">
												</div>

											</div>
										</div>
									</div>
                                    
									<div class="row form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Realisasi Triwulan</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<div class="row">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_subkegiatan_tw_1" name="realisasi_subkegiatan_tw_1" placeholder="Triwulan I" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_subkegiatan_tw_2" name="realisasi_subkegiatan_tw_2" placeholder="Triwulan II" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_subkegiatan_tw_3" name="realisasi_subkegiatan_tw_3" placeholder="Triwulan III" required="required" class="form-control col-xs-12">
												</div>

												<div class="col-md-3 col-sm-3 col-xs-3">
													<input type="text" id="realisasi_subkegiatan_tw_4" name="realisasi_subkegiatan_tw_4" placeholder="Triwulan IV" required="required" class="form-control col-xs-12">
												</div>
											</div>
										</div>
									</div>

									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
											<button type="submit" id="btnsubmitrealisasisubkegiatan" class="btn btn-success">Submit</button>
											<input type="submit" style="display:none;">
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div><!-- panel-group -->
				
		  	</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function tambahkinerja(tahun){
        $('#myModal').modal({backdrop: 'static', keyboard: false});
    }

    $('#formkinerja').submit(function(e){
        e.preventDefault();
        let dataform = $('#formkinerja').serialize();
        
        $.ajax({
            url: "{{route('kinerja.tambahcapaian',$tahun)}}",
            type: "post",
            data: dataform,
            success: function (response) { 
                console.log(response);
            },
            error:function(reject){
                
            }
        })
    })
    
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

    $('.id_kegiatan').select2({
        placeholder: 'Pilih Kegiatan',
        allowClear: true,
        ajax: {
            url: "{{route('kegiatan.dataselect')}}",
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

    $('.id_subkegiatan').select2({
        placeholder: 'Pilih Subkegiatan',
        allowClear: true,
        ajax: {
            url: "{{route('subkegiatan.dataselect')}}",
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

    function realisasiprogram(id,nama,indikator){
        $('#programtextRP').html(nama);
        $('#indikatortextRP').html(indikator);
        $('#id_program_attr_modal').val(id);
        $.ajax({
            url: "{{route('kinerja.getrealisasiprogram')}}",
            type: "post",
            data: {id:id},
            success: function (data) { 
                let detail = data['data'][0];
                // console.log(detail['realisasi'])
                if(detail['realisasi'] != null){$('#realisasi_program_tahunan').val(detail['realisasi']) }else{$('#realisasi_program_tahunan').val('')};
                if(detail['realisasi_tw_1'] != null){$('#realisasi_program_tw_1').val(detail['realisasi_tw_1']) }else{$('#realisasi_program_tw_1').val('')};
                if(detail['realisasi_tw_2'] != null){$('#realisasi_program_tw_2').val(detail['realisasi_tw_2']) }else{$('#realisasi_program_tw_2').val('')};
                if(detail['realisasi_tw_3'] != null){$('#realisasi_program_tw_3').val(detail['realisasi_tw_3']) }else{$('#realisasi_program_tw_3').val('')};
                if(detail['realisasi_tw_4'] != null){$('#realisasi_program_tw_4').val(detail['realisasi_tw_4']) }else{$('#realisasi_program_tw_4').val('')};
                
                $('#modalRealisasiProgram').modal({backdrop: 'static', keyboard: false});        
            },
            error:function(reject){
                
            }
        })
    }

    $('#realisasiprogram').submit(function(e){
        e.preventDefault();
        let dataform = $('#realisasiprogram').serialize();
			
        $.ajax({
            url: "{{route('kinerja.editrealisasiprogram')}}",
            type: "post",
            data: dataform,
            success: function (response) { 
                $('#modalRealisasiProgram').modal('hide');
                location.reload();
            },
            error:function(reject){
                
            }
        })
        
    })

    function realisasikegiatan(id,nama,indikator,nama_program){
        $('#programtextRK').html(nama_program);
        $('#kegiatantextRK').html(nama);
        $('#indikatortextRK').html(indikator);
        $('#id_kegiatan_attr_modal').val(id);
        $.ajax({
            url: "{{route('kinerja.getrealisasikegiatan')}}",
            type: "post",
            data: {id:id},
            success: function (data) { 
                let detail = data['data'][0];
                // console.log(detail['realisasi'])
                if(detail['realisasi'] != null){$('#realisasi_kegiatan_tahunan').val(detail['realisasi']) }else{$('#realisasi_kegiatan_tahunan').val('')};
                if(detail['realisasi_tw_1'] != null){$('#realisasi_kegiatan_tw_1').val(detail['realisasi_tw_1']) }else{$('#realisasi_kegiatan_tw_1').val('')};
                if(detail['realisasi_tw_2'] != null){$('#realisasi_kegiatan_tw_2').val(detail['realisasi_tw_2']) }else{$('#realisasi_kegiatan_tw_2').val('')};
                if(detail['realisasi_tw_3'] != null){$('#realisasi_kegiatan_tw_3').val(detail['realisasi_tw_3']) }else{$('#realisasi_kegiatan_tw_3').val('')};
                if(detail['realisasi_tw_4'] != null){$('#realisasi_kegiatan_tw_4').val(detail['realisasi_tw_4']) }else{$('#realisasi_kegiatan_tw_4').val('')};
                
                $('#modalRealisasiKegiatan').modal({backdrop: 'static', keyboard: false});        
            },
            error:function(reject){
                
            }
        })
        
    }

    $('#realisasikegiatan').submit(function(e){
        e.preventDefault();
        let dataform = $('#realisasikegiatan').serialize();
			
        $.ajax({
            url: "{{route('kinerja.editrealisasikegiatan')}}",
            type: "post",
            data: dataform,
            success: function (response) { 
                $('#modalRealisasiKegiatan').modal('hide');
                location.reload();
            },
            error:function(reject){
                
            }
        })
    })

    function realisasisubkegiatan(id,nama,indikator,nama_kegiatan,nama_program){
        $('#subkegiatantextRS').html(nama);
        $('#programtextRS').html(nama_program);
        $('#kegiatantextRS').html(nama_kegiatan);
        $('#indikatortextRS').html(indikator);
        $('#id_subkegiatan_attr_modal').val(id);
        $.ajax({
            url: "{{route('kinerja.getrealisasisubkegiatan')}}",
            type: "post",
            data: {id:id},
            success: function (data) { 
                let detail = data['data'][0];
                // console.log(detail['realisasi'])
                if(detail['realisasi'] != null){$('#realisasi_subkegiatan_tahunan').val(detail['realisasi']) }else{$('#realisasi_subkegiatan_tahunan').val('')};
                if(detail['realisasi_tw_1'] != null){$('#realisasi_subkegiatan_tw_1').val(detail['realisasi_tw_1']) }else{$('#realisasi_subkegiatan_tw_1').val('')};
                if(detail['realisasi_tw_2'] != null){$('#realisasi_subkegiatan_tw_2').val(detail['realisasi_tw_2']) }else{$('#realisasi_subkegiatan_tw_2').val('')};
                if(detail['realisasi_tw_3'] != null){$('#realisasi_subkegiatan_tw_3').val(detail['realisasi_tw_3']) }else{$('#realisasi_subkegiatan_tw_3').val('')};
                if(detail['realisasi_tw_4'] != null){$('#realisasi_subkegiatan_tw_4').val(detail['realisasi_tw_4']) }else{$('#realisasi_subkegiatan_tw_4').val('')};
                
                $('#modalRealisasiSubKegiatan').modal({backdrop: 'static', keyboard: false});        
            },
            error:function(reject){
                
            }
        })

    }

    $('#realisasisubkegiatan').submit(function(e){
        e.preventDefault();
        let dataform = $('#realisasisubkegiatan').serialize();
			
        $.ajax({
            url: "{{route('kinerja.editrealisasisubkegiatan')}}",
            type: "post",
            data: dataform,
            success: function (response) { 
                $('#modalRealisasiSubKegiatan').modal('hide');
                location.reload();
            },
            error:function(reject){
                
            }
        })
    })

</script>
<style>
    .select2-container--default{
        width:100% !important;
    }

    .paddingleft15{
        padding-left:15px !important
    }
</style>
@endsection