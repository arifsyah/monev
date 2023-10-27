@extends('layouts.adminapp')
<!-- <script src="https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css" rel="stylesheet" /> -->

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Data Taman Kota Bandung
		</h3>
    </div>
</div>

<div class="x_panel">
	@include('admin.__flash')
    <div class="x_title">
        
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <!-- <div id='map' style="height:400px;"></div> -->
        <!-- <br/><br/> -->
        <div class="content">
            <div class="tabset">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="tamankecamatan" checked>
                <label for="tab1">Banyaknya Taman Kota Tahun 2020</label>
                <!-- Tab 2 -->
                <!-- <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
                <label for="tab2">Rauchbier</label> -->
                <!-- Tab 3 -->
       

                <div class="tab-panels">
                <section id="tamankecamatan" class="tab-panel">
                    <h2>Banyaknya Taman Kota Menurut Kecamatan di Kota Bandung Tahun 2020</h2>
                    <style type="text/css">
                    .tamanKec  {border-collapse:collapse;border-spacing:0;}
                    .tamanKec td{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                      overflow:hidden;padding:10px 5px;word-break:normal;}
                    .tamanKec th{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
                      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                    .tamanKec .tamanKec-0lax{text-align:left;vertical-align:top}
                    </style>
                    <table class="tamanKec" style="undefined;width: 100%">
                        <!-- colgroup>
                            <col style="width: 35px">
                            <col style="width: 234px">
                            <col style="width: 250px">
                            <col style="width: 328px">
                        </colgroup> -->
                        <thead>
                            <tr>
                                <th class="tamanKec-0lax textcenter"><b>No</b></th>
                                <th class="tamanKec-0lax textcenter"><b>Kecamatan</b></th>
                                <th class="tamanKec-0lax textcenter"><b>Luas Taman (m2)</b></th>
                                <th class="tamanKec-0lax textcenter"><b>Total (Taman)</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tamanKec-0lax textcenter">1</td>
                                <td class="tamanKec-0lax">Andir</td>
                                <td class="tamanKec-0lax textright">25.167,02</td>
                                <td class="tamanKec-0lax textright">16</td>
                            </tr>
                            <tr>
                                <td class="tamanKec-0lax textcenter">2</td>
                                <td class="tamanKec-0lax">Antapani</td>
                                <td class="tamanKec-0lax textright">27.124,60</td>
                                <td class="tamanKec-0lax textright">40</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">3</td>
                                <td class="tamanKec-0lax">Arcamanik</td>
                                <td class="tamanKec-0lax textright">689.016,40</td>
                                <td class="tamanKec-0lax textright">42</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">4</td>
                                <td class="tamanKec-0lax">Astana Anyar</td>
                                <td class="tamanKec-0lax textright">1.693,05</td>
                                <td class="tamanKec-0lax textright">9</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">5</td>
                                <td class="tamanKec-0lax">Babakan Ciparay</td>
                                <td class="tamanKec-0lax textright">5.092,36</td>
                                <td class="tamanKec-0lax textright">11</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">6</td>
                                <td class="tamanKec-0lax">Bandung Kidul</td>
                                <td class="tamanKec-0lax textright">24.346,21</td>
                                <td class="tamanKec-0lax textright">26</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">7</td>
                                <td class="tamanKec-0lax">Bandung Kulon</td>
                                <td class="tamanKec-0lax textright">8.524,81</td>
                                <td class="tamanKec-0lax textright">10</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">8</td>
                                <td class="tamanKec-0lax">Bandung Wetan</td>
                                <td class="tamanKec-0lax textright">300.179,87</td>
                                <td class="tamanKec-0lax textright">59</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">9</td>
                                <td class="tamanKec-0lax">Batununggal</td>
                                <td class="tamanKec-0lax textright">29.907,74</td>
                                <td class="tamanKec-0lax textright">11</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">10</td>
                                <td class="tamanKec-0lax">Bojongloa Kaler</td>
                                <td class="tamanKec-0lax textright">9.935,38</td>
                                <td class="tamanKec-0lax textright">18</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">11</td>
                                <td class="tamanKec-0lax">Bojongloa Kidul</td>
                                <td class="tamanKec-0lax textright">993,20</td>
                                <td class="tamanKec-0lax textright">9</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">12</td>
                                <td class="tamanKec-0lax">Buah Batu</td>
                                <td class="tamanKec-0lax textright">38.314,28</td>
                                <td class="tamanKec-0lax textright">53</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">13</td>
                                <td class="tamanKec-0lax">Cibeunying Kaler</td>
                                <td class="tamanKec-0lax textright">30.774,39</td>
                                <td class="tamanKec-0lax textright">19</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">14</td>
                                <td class="tamanKec-0lax">Cibeunying Kidul</td>
                                <td class="tamanKec-0lax textright">13.671,39</td>
                                <td class="tamanKec-0lax textright">17</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">15</td>
                                <td class="tamanKec-0lax">Cibiru</td>
                                <td class="tamanKec-0lax textright">9.120,37</td>
                                <td class="tamanKec-0lax textright">10</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">16</td>
                                <td class="tamanKec-0lax">Cicendo</td>
                                <td class="tamanKec-0lax textright">52.278.14</td>
                                <td class="tamanKec-0lax textright">36</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">17</td>
                                <td class="tamanKec-0lax">Cidadap</td>
                                <td class="tamanKec-0lax textright">10.735,87</td>
                                <td class="tamanKec-0lax textright">9</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">18</td>
                                <td class="tamanKec-0lax">Cinambo</td>
                                <td class="tamanKec-0lax textright">6.779,68</td>
                                <td class="tamanKec-0lax textright">9</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">19</td>
                                <td class="tamanKec-0lax">Coblong</td>
                                <td class="tamanKec-0lax textright">251.729,65</td>
                                <td class="tamanKec-0lax textright">34</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">20</td>
                                <td class="tamanKec-0lax">Gedebage</td>
                                <td class="tamanKec-0lax textright">3.478,96</td>
                                <td class="tamanKec-0lax textright">6</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">21</td>
                                <td class="tamanKec-0lax">Kiaracondong</td>
                                <td class="tamanKec-0lax textright">8.866,50</td>
                                <td class="tamanKec-0lax textright">17</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">22</td>
                                <td class="tamanKec-0lax">Lengkong</td>
                                <td class="tamanKec-0lax textright">60.883,24</td>
                                <td class="tamanKec-0lax textright">44</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">23</td>
                                <td class="tamanKec-0lax">Mandalajati</td>
                                <td class="tamanKec-0lax textright">93.094,13</td>
                                <td class="tamanKec-0lax textright">26</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">24</td>
                                <td class="tamanKec-0lax">Panyileukan</td>
                                <td class="tamanKec-0lax textright">49.130,71</td>
                                <td class="tamanKec-0lax textright">52</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">25</td>
                                <td class="tamanKec-0lax">Rancasari</td>
                                <td class="tamanKec-0lax textright">17.807,65</td>
                                <td class="tamanKec-0lax textright">26</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">26</td>
                                <td class="tamanKec-0lax">Regol</td>
                                <td class="tamanKec-0lax textright">212.250,93</td>
                                <td class="tamanKec-0lax textright">19</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">27</td>
                                <td class="tamanKec-0lax">Sukajadi</td>
                                <td class="tamanKec-0lax textright">58.801,32</td>
                                <td class="tamanKec-0lax textright">32</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">28</td>
                                <td class="tamanKec-0lax">Sukasari</td>
                                <td class="tamanKec-0lax textright">56.330,82</td>
                                <td class="tamanKec-0lax textright">32</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">29</td>
                                <td class="tamanKec-0lax">Sumur Bandung</td>
                                <td class="tamanKec-0lax textright">61.471,54</td>
                                <td class="tamanKec-0lax textright">24</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter">30</td>
                                <td class="tamanKec-0lax">Ujung Berung</td>
                                <td class="tamanKec-0lax textright">9.248,70</td>
                                <td class="tamanKec-0lax textright">17</td>
                            </tr>

                            <tr>
                                <td class="tamanKec-0lax textcenter"></td>
                                <td class="tamanKec-0lax"><b>Total</b></td>
                                <td class="tamanKec-0lax textright"><b>2.166.698.91</b></td>
                                <td class="tamanKec-0lax textright"><b>733</b></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section id="rauchbier" class="tab-panel">
                    <h2>1/h2>
                    <p></p>
                </se><strong>History:</strong> Originated in the Northern German city of Einbeck, which was a brewing center and popular exporter in the days of the Hanseatic League (14th to 17th century). Recreated in Munich starting in the 17th century. The name “bock” is based on a corruption of the name “Einbeck” in the Bavarian dialect, and was thus only used after the beer came to Munich. “Bock” also means “Ram” in German, and is often used in logos and advertisements.</p>
                </section>
                </div>

                </div>
        </div>
    </div>
</div>
<!-- Async script executes immediately and must be after any cross-domain elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjANayM6-u6FEUZ3wpUeNEe71Cp9AiuJk&callback=initMap&v=weekly" async></script>

<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let map;
    

    function initMap() {
        var infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: { lat: -6.914744, lng: 107.609810 },
        });
        // NOTE: This uses cross-domain XHR, and may not work on older browsers.
        map.data.loadGeoJson(
            "{{url('/')}}/map.geojson"
        );

        map.data.addListener('click', function(event) {
            var feat = event.feature;
            var html = "<b>"+feat.getProperty('KECAMATAN')+"</b>";
            infowindow.setContent(html);
            infowindow.setPosition(event.latLng);
            infowindow.setOptions({pixelOffset: new google.maps.Size(0,-34)});
            infowindow.open(map);

            getKec(feat.getProperty('ID_KEC'));
        });


    }

    function getKec(id){
        
    }

</script>
@endsection