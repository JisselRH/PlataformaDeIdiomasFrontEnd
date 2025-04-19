<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>


<!--<script src="/js/libs/speechSDK.js"></script>-->
<script type="module" src="/js/customJsActivities/practice/dialog/navigation.js"></script>

<!-- <script type="module" src="/js/customJsActivities/create.js"></script> -->
<script type="module" src="/js/customJsActivities/practice/results.js"></script>

<script type="/text/javascript" src="https://code.jquery.com/jquery-3.6.3.js" crossorigin="anonymous"></script>

<body id="kt_body" data-bs-spy="scroll" class="mega-container">
    <div class="w-100 h-100 d-flex flex-column flex-center container-results" style="padding-top:25%;">

        <div class="row w-100 pt-10  h-100 align-bottom align-items-end" style=" position: sticky;">

            <!--begin::Col container collapse-->
            <div class="col w-100 h-100" style="position: absolute; margin-bottom: 25%; overflow-y: auto;">
                <!--begin::Accordion-->

                <!--begin::Section DIALOG BUBBLES-->
                <div class="m-0 h-1000px" style="margin-bottom: 10%;">
                    <!--begin::Heading-->
                    <div class="d-flex align-items-center mb-0">
                        <div class="d-flex align-items-center text-center h-95px w-100 card-header cursor-pointer bahnschriftRegular mb-0 rounded border border-3 border-white collapsible-active text-white opacity-100" style="background-color: #8557a7; font-size: 3vw;">
                            <span class="align-middle w-100 bahnschriftBold">RESULTADOS</span>
                        </div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Body-->
                    <div class="h-100 w-100">
                        <div class="h-100 w-100 d-flex flex-center flex-column">
                            <div class="dialog-container d-flex flex-column flex-center h-100 w-100 mb-5">
                                <div class="dialog-container__content h-95 d-flex w-100 space-between">
                                    <div class="w-100 h-100 dialog-content-left smooth-margin">
                                        <!--<div class="dc-left__head "h-12 bahnschriftRegular">Conversación</div>--->
                                        <div class="dc-right__body h-100">
                                            <div class="scroll-dialog-container w-100 h-95 default-scrollbar js-chat-container">

                                                <div class="chat-chunk d-flex space-between hide" id="js-bot-sample">
                                                    <div class="chat-chunk__img w-25">
                                                        <img class="js-c-char w-100" style="background-color: #f2f2f2;"> <!-- js-bot-image-->
                                                    </div>
                                                    <div class="chat-chunk__bubble w-70">
                                                        <div class="js-d-name bubble__name bahnschriftBold h1 display-6">
                                                            Doctor:
                                                        </div>
                                                        <div class="js-d-text bubble__text bahnschriftRegular" style="font-size: 2rem;">What is Lorem Ipsum?

                                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </div>
                                                    </div>
                                                </div>

                                                <div class="chat-chunk d-flex space-between hide" id="js-user-sample">
                                                    <div class="chat-chunk__bubble w-70">
                                                        <div class="js-d-name bubble__name bahnschriftBold h1 display-6">
                                                            User:
                                                        </div>
                                                        <div class="js-d-text text bubble__text bahnschriftRegular" style="font-size: 2rem;">Where does it come from?
                                                            Contrary to popular belief, Lorem Ipsum is not simply random text.
                                                            It has roots in a piece of classical Latin literature</div>
                                                    </div>
                                                    <div class="chat-chunk__img w-25">
                                                        <img class="js-bot-image w-100">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Section -->


                <div class="container flex-center card smooth-margin rounded rounded-3 w-95 h-300px mb-2" style="background-color:#FFFFFF; margin-top:10%;">
                    <div class="row d-flex flex-row flex-center w-100">

                        <div class="d-flex flex-column flex-center w-20 h-80 hide left-description">
                            <div class="h-40 d-flex flex-column flex-center text-left">
                                <span class="bahnschriftBold text-left" style="font-size: 3vw;">Palabra:</span>
                            </div>
                            <div class="h-40 mt-1 d-flex flex-column flex-center">
                                <span class="bahnschriftBold" style="font-size: 3vw;">Fonemas:</span>
                            </div>
                        </div>

                        <div class="card h-90 w-40">
                            <div class="px-0 card-body d-flex flex-column justify-content-between " style="padding: 10%;" id="word-detail">
                                <div class="d-flex flex-column flex-center">
                                    <div>
                                        <span class="selected-word bahnschriftRegular text-left" style="font-size: 3vw;"></span>
                                        <span class="small-square bahnschriftRegular selected-word-score" style="font-size: 3vw;">
                                            %
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-center flex-column mt-10" style="overflow-x: scroll;">
                                    <div class="d-flex flex-row flex-center phonemes-info" style="margin: auto">
                                        <div class="bahnschriftRegular text-black text-start d-inline w-70" style="font-size: 2vw;">
                                            Presione una de las palabras
                                            con colores en el apartado de diálogo para ver
                                            más detalles!
                                            <!-- <div class="text-center d-flex flex-column" style="margin-right: 3px; width:fit-content;">

                                                <div class="small-square bahnschriftBold" style="font-size: 3vw;">
                                                    27
                                                </div>
                                                <div class="bahnschriftRegular" style="font-size: 3vw;">
                                                    h
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Section-->
                <div class="m-0">
                    <div class="d-flex flex-column flex-center w-100 h-100 px-5">

                        <div class="h-100 w-100 d-flex flex-column">

                            <div class="card smooth-margin h-250px d-flex flex-row flex-center rounded rounded-3" style="background-color:#8557a7;">

                                <div class="container flex-center" style="margin-top: 2%; margin-bottom: 2%;">
                                    <div class="row white-text d-flex flex-row flex-center w-100">
                                        <div class="col-4 text-end px-5">
                                            <img src="/images/intentos/microfono_1.png" class="" style="width: 30%; height: 40%; object-fit: contain;">
                                        </div>
                                        <div class="col-6 h-100 text-start ">

                                            <div class="h1 display-4 h-100 text-white d-inline text-start bahnschriftBold">
                                                Pronunciación
                                            </div>
                                            <div class="h1 display-1 bahnschriftBold text-white ">
                                                <span style="font-size: 9vw;" class="pron-score" id="pron-score">50</span>%
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card smooth-margin h-250px d-flex flex-row flex-center rounded rounded-3">

                                <div class="container flex-center" style="margin-top: 2%; margin-bottom: 2%;">
                                    <div class="row white-text d-flex flex-row flex-center w-100">

                                        <div class="col-5 h-100 text-start ">

                                            <div class=" h-100 text-black d-inline text-start bahnschriftRegular" style="font-size: 3vw;">
                                                Como pronunciar
                                            </div>
                                            <div class=" bahnschriftRegular text-black" style="font-size: 3vw;">
                                                <span class="pron-score">la palabra correctamente </span>
                                            </div>
                                        </div>

                                        <div class="col-4 text-end px-5">
                                            <img src="/images/Mobile/BtnPronunciación.png" class="" style="width: 50%; height: 50%; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                    <!--begin::Separator-->
                    <div class="separator separator-dashed"></div>
                    <!--end::Separator-->

                </div>
                <!--end::Section-->

                <div class="card smooth-margin h-500px w-100 results-container text-center">

                    <div class="row white-text d-flex flex-row flex-center w-100">

                        <div class="h-100 text-start w-40">

                            <div class=" h-100 text-black d-inline text-start bahnschriftRegular text-start">
                                <span class="bahnschriftRegular text-black text-start d-inline w-50" style="font-size: 3vw;">Evaluación por:</span>
                            </div>

                        </div>

                        <div class="col-4 text-start">
                            <select class="bahnschriftRegular d-inline overall-results-selector w-300px h-60px" id="order-selector" style="border-radius: 5px; border: 2px solid #FFFFFF; font-size: 2.5vw;">
                                <option class="bahnschriftRegular" value="todas" style="font-size: 1.5vw;">sobre todas las frases</option>
                                <!--<option class="bahnschriftRegular" value="0" style="font-size: 1.5vw;">sobre la frase 1</option>
                                <option class="bahnschriftRegular" value="1" style="font-size: 1.5vw;">sobre la frase 2</option>
                                <option class="bahnschriftRegular" value="2" style="font-size: 1.5vw;">sobre la frase 3</option>-->
                            </select>
                        </div>
                    </div>

                    <div class="graph-container h-100 w-80" style=" margin:0px auto;">

                        <div class="w-100 h-100" style="background-color: red;"></div>

                    </div>
                    <!-- grafico -->
                </div>

                <div class="d-flex flex-center w-100 h-7 mt-10">
                    <button class="btn-go-tables p-0 w-30 h-100 text-center bg-transparent btn-send-word" style="border: transparent;">
                    </button>
                </div>

            </div>


            <!--end::Accordion-->
        </div>
        <!--end::Col container collapse-->
    </div>
</body>


<!--<script type="module" src="/js/mainDialog.js" crossorigin="anonymous"></script>-->

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/OpusMediaRecorder.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/encoderWorker.umd.js"></script>



<script>
    $(document).ready(function() {


        var actualizar = function(opcion) {

            console.log("2");

            const resultsSummary = getPartialResults(results, opcion.value);

            const data = extractValuesArray(resultsSummary);
            initMixedWidget10b(data);
        }
    });
</script>


<?= $this->endSection() ?>