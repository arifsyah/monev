@extends('layouts.adminapp')

@section('content')
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 350px;
}

</style>

<script type="text/javascript">
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    var datafromdb = JSON.parse('<?php echo $data; ?>');
    var data = [];
    var value = 50;
    // for(var i = 0; i < 30; i++){
    //   var date = new Date();
    //   date.setHours(0,0,0,0);
    //   date.setDate(i);
    //   value -= Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
    //   data.push({date:date, value: value});
    // }

    chart.data = datafromdb;
    // console.log(data)
    console.log(datafromdb)
    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 60;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "value";
    series.dataFields.dateX = "date";
    series.tooltipText = "{value}"

    series.tooltip.pointerOrientation = "vertical";

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.snapToSeries = series;
    chart.cursor.xAxis = dateAxis;

    //chart.scrollbarY = new am4core.Scrollbar();
    // chart.scrollbarX = new am4core.Scrollbar();

</script>  




<!-- top tiles -->
<div class="row tile_count">
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-file"></i> Total File/Dokumen</span>
            <div class="count">{{$jumlah}}</div>
            <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-book"></i> Jumlah Pengguna</span>
            <div class="count"><i class="green">{{$jumlah_user}}</i></div>
            
        </div>
    </div>
    <!-- <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
            <div class="count green">2,500</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
            <div class="count">4,567</div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>
    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div> -->

</div>
<!-- /top tiles -->
<hr/>
<div class="row">
    <div class="col-xs-12">
        <h4>Jumlah Dokumen Harian</h4>
        <div id="chartdiv"></div>
    </div>
</div>
<hr/>
<h4>File / Dokumen Terbaru</h4>
<div class="row">

    <table class="table table-striped responsive-utilities jambo_table  bulk_action">
        <thead>
            <tr class="headings">
                <th style="width:25px;">
                    <!-- <input type="checkbox" id="check-all" class="flat"> -->
                </th>
                <th class="column-title" width="20px;">No </th>
                <th class="column-title">Kategori </th>
                <th class="column-title">Title </th>
                <th class="column-title" width="30%">Description</th>
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
                            <br/><hr/>
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

</div>

<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail File</h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped responsive-utilities jambo_table  bulk_action">
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><span id="kategori"></span></td>
                    </tr>
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td><span id="judul"></span></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><span id="deskripsi"></span></td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td><span id="tahun"></span></td>
                    </tr>

                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td><span id="file"></span></td>
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

<div id="detailHistory" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Detail File History</h3>
            </div>
            <div class="modal-body" id="modal-body">
                <?php 

                ?>
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

    var title_category = '';
    var description_category = '';
    var user_created = '';
    var user_modified = '';
    var date_modified = '';
    var date_created = '';
    function detailpopup(id){
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("file.detaildata") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                
                $('#kategori').html(data.kategori.title);
                $('#judul').html(data.title);
                $('#deskripsi').html(data.description);
                $('#user_created').html(data.created.name);
                $('#created_at').html(data.created_at);
                $('#tahun').html(data.tahun);
                
                $('#file').html('<a href="{{ url('/file/download/' ) }}/'+data.id+'?time='+Math.random()+'  " target="_blank" >Link File</a>');
                // $('.x_content').html(data.html)
                $('#detailModal').modal('show');
            }
        }); 
    }

    function detailpopupHistory(id){
        var innerhtml = '';
        var url = '{{url("file/download")}}';
        var url_history = '{{url("file/downloadHistory")}}';
        $.ajax({
            /* the route pointing to the post function */
            url: ' {{ route("file.datahistory") }} ',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {id:id},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 

                innerhtml += '<ul class="list-unstyled timeline widget">';
                $.each(data,function(index,value){
                    innerhtml += '<li>';
                        innerhtml += '<div class="block">';
                            innerhtml += '<div class="class="block_content">';
                                innerhtml += '<h2 class="title">'+value.title+'</h2>';
                                if (index == 0) {
                                    innerhtml += '<div class="byline"><span>'+value.updated_at+' </span> by <a>'+value.created.name+'</a></div>';    
                                }else{
                                    innerhtml += '<div class="byline"><span>'+value.created_at+' </span> by <a>'+value.created.name+'</a></div>';
                                }
                                
                                innerhtml += '<p class="excerpt">'+value.description+'</p>' ;

                                if (index == 0) {
                                    innerhtml += '<div><a href="'+url+'/'+value.id+'?time='+Math.random()+'" target="_blank" >Lihat File</a></div>' ;
                                }else{
                                    innerhtml += '<div><a href="'+url_history+'/'+value.id+'?time='+Math.random()+'" target="_blank" >Lihat File</a></div>' ;    
                                };
                            innerhtml += '</div>';
                        innerhtml += '</div>';
                    innerhtml += '</li>';
                })

                innerhtml  += '</ul>';

                $('#modal-body').html(innerhtml)
                $('#detailHistory').modal('show');
            }
        }); 
    }
</script>
@endsection