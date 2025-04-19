
<div class="tab-pane" role="tabpanel" id="" style='width: 100%;'>
    <div class="active-window"><!--begin:: aspect-ratio: 700/300 flex-grow: 2; style="flex-grow: 2"-->
        <div id="" class="h-100">
            <div class="row g-0 h-100">
                <div class="col h-100 flex-column flex-center d-flex">
                    <div class="row g-0" style="max-height: 80%;">
                        <!--begin::Col Semana-->
                        <div class="col-xxl-6 rounded-3">
                            <!--begin::Mixed Widget 5-->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                            <div class="card card-xxl-stretch smooth-margin">

                                <!--begin::Header-->
                                <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                                    <div class="me-2">
                                        <span class="fw-bolder text-gray-800 d-block fs-3">Semana</span>
                                        <hr style="height: 3px; width:100%; background-color:  #ada2ab ; padding: 0 0 0; margin: 0 0 0; " />
                                        <span class="text-gray-400 fw-bold">Experiencia diaria</span>
                                    </div>
                                    <div class="fw-bolder fs-3 text-primary bg-light-primary rounded-2">+20 EXP</div>
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column" style="padding: 0 0 0; margin: 0 0 1;">
                                    <!--begin::Chart-->
                                    <div class="mixed-widget-dashboard-chart card-rounded-top" data-kt-chart-color="primary" style="height: 200px"></div>
                                    <!--end::Chart-->

                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Mixed Widget 5-->
                        </div>
                        <!--end::Col Semana-->

                        <!--begin::Col Mes-->
                        <div class="col-xxl-6">
                            <!--begin::Mixed Widget 5-->
                            <div class="card card-xxl-stretch smooth-margin">
                                <!--begin::Header-->
                                <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                                    <div class="me-2">
                                        <span class="fw-bolder text-gray-800 d-block fs-3">Mensual</span>
                                        <hr style="height: 3px; width:100%; background-color:  #ada2ab ; padding: 0 0 0; margin: 0 0 0; " />
                                        <span class="text-gray-400 fw-bold">Experiencia promedio por semana</span>
                                    </div>
                                    <div class="fw-bolder fs-3 text-danger bg-light-danger rounded-2">+100 EXP</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column" style="padding: 0 0 0; margin: 0 0 0;">
                                    <!--begin::Chart-->
                                    <div class="mixed-widget-dashboard-chart-2 card-rounded-top" data-kt-chart-color="danger" style="height: 200px"></div>

                                    <!--end::Chart-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Mixed Widget 5-->
                        </div>
                        <!--end::Col Mes-->

                        <!-- PIE GRAPH-->
                        <div class="h-100 py-3 px-4 col card smooth-margin">
                            <div class="me-2">
                                <span class="fw-bolder text-gray-800 d-block fs-3">Porcentaje final</span>
                                <hr style="height: 3px; width:100%; background-color:  #ada2ab ; padding: 0 0 0; margin: 0 0 0; " />
                            </div>

                            <div class="row g-0" style=" max-height: 80%">
                                <div class="col-xxl-3 d-inline" style="height: 100%; width:60%; margin-top:1%;">
                                    <div class="position-relative d-flex flex-center me-15 mb-2" style="height: 10%; width:55%; margin-top:1%;">
                                        <canvas id="kt_pie_chart" style="height: 40px;">
                                        </canvas>
                                    </div>
                                </div>
                                <div class="col-xxl-3 d-inline align-items-center" style="height: 100%; width:40%; margin-top:15%;">
                                    <div>
                                        <span class="fw-bolder text-gray-400 d-block fs-3">Porcentaje final de inglés</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- PIE GRAPH -->

                        <!-- progress bar -->
                        <div class="h-100 py-3 px-4 col card smooth-margin" style="height: 100 px">
                            <div class="me-2">
                                <span class="fw-bolder text-gray-800 d-block fs-3">Porcentaje final</span>
                                <hr style="height: 3px; width:100%; background-color:  #ada2ab ; padding: 0 0 0; margin: 0 0 0; " />
                            </div>

                            <div class="card-body my-3" style="margin-top:20%;">

                                <div class="d-flex flex-row">

                                    <div class="py-1 d-inline" style="width: 20%;">
                                        <span class="text-dark fw-bold me-2" style="font-size: 1.2rem;">1. Hablado</span>
                                    </div>

                                    <div class="py-1 d-inline" style="width:70%;">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" id="progress1" role="progressbar" style="width: 10%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="py-1 d-inline d-flex flex-row-reverse" style="width: 10%;">
                                        <span id="span1" class="fw-bolder fs-7 text-warning"></span>
                                    </div>

                                </div>

                                <div class="d-flex flex-row">

                                    <div class="py-1 d-inline" style="width: 20%;">
                                        <span  class="text-dark fw-bold me-2" style="font-size: 1.2rem;">2. Escrito</span>
                                    </div>

                                    <div class="py-1 d-inline" style="width:70%;">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" id="progress2" role="progressbar" style="" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="py-1 d-inline d-flex flex-row-reverse" style="width: 10%;">
                                        <span id="span2" class="fw-bolder fs-7 text-warning">50%</span>
                                    </div>

                                </div>

                                <div class="d-flex flex-row">

                                    <div class="py-1 d-inline" style="width: 20%;">
                                        <span class="text-dark fw-bold me-2" style="font-size: 1.2rem;">3. Escuchado</span>
                                    </div>

                                    <div class="py-1 d-inline" style="width:70%;">
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" id="progress3" role="progressbar" style="width: 50%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="py-1 d-inline d-flex flex-row-reverse" style="width: 10%;">
                                        <span id="span3" class="fw-bolder fs-7 text-warning">50%</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- progress bar -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>