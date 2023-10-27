@extends('layouts.adminapp')


@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>
			Data LPPD Tahun 2020
		</h3>
    </div>
</div>

<div class="x_panel">
	
    <div class="x_title">
        
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        
        <div class="content">
            <div class="tabset">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="airLimbah" checked>
                <label for="tab1">Akses Air Limbah 2020</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab2" aria-controls="airMinum">
                <label for="tab2">Akses Air Minum 2020</label>
                

                <div class="tab-panels">
                    <section id="airLimbah" class="tab-panel">
                        @include('admin.statis.airlimbah')
                    </section>
                    <section id="airMinum" class="tab-panel">
                        @include('admin.statis.airminum')
                    </section>
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection