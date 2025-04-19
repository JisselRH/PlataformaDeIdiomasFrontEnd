<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script src="/js/libs/speechSDK.js"></script>
<script type="module" src="/js/customJsActivities/navigation-exercise.js"></script>
<script type="module" src="/js/customJsActivities/practice/dialog.js"></script>

<script type="/text/javascript" src="https://code.jquery.com/jquery-3.6.3.js" crossorigin="anonymous"></script>

<body id="kt_body" data-bs-spy="scroll" class="mega-container">
    <div class="w-100 h-100 d-flex flex-column flex-center container-dialog" style="padding-top:25%;"><!--overflow-auto -->

        <div class="row w-100 pt-10 h-100 align-bottom align-items-end" style=" position: sticky;">

            <!--begin::Col container collapse-->
            <div class="col w-100 h-100" style=" position: absolute; margin-bottom: 25%; overflow-y: auto;">
                <!--begin::Accordion-->
                <!--begin::Section-->
                <div class="mx-10 h-800px">
                    <!--begin::Heading-->
                    <div class="d-flex align-items-center mb-0">
                        <div class="d-flex align-items-center text-center h-95px w-50 card-header  mb-0 rounded border border-3 border-white text-white opacity-100" style="background-color: #8557a7; font-size: 3vw;">
                            <span class="align-middle text-center w-100 bahnschriftRegular">DIÁLOGO</span>
                        </div>
                        <div class="card-header w-50 h-95px rounded border border-3 border-white" style="background-color:  #8557a7;">

                            <div class="container">
                                <div class="row align-middle align-items-center justify-content-center w-100 h-75px">
                                    <div class="d-inline d-flex align-items-center h-80 w-35">
                                        <span class="align-middle bahnschriftRegular text-white" style=" font-size: 3vw;">TIEMPO:</span>
                                    </div>
                                    <div class="d-inline h-80 w-20 d-flex align-items-center text-center" style="background-image: url(/images/mobile/Timer.png); background-repeat: no-repeat; background-size: cover; background-size: 60px 60px;background-position: center;">
                                        <span class="align-middle bahnschriftRegular text-white text-center w-100" id="timer-text-id" style=" font-size: 3vw;">30</span><!--timer -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Body-->
                    <div class="h-100 w-100 mb-10 pb-5">
                        <div class="h-100 w-100 d-flex flex-center flex-column">
                            <div class="dialog-container d-flex flex-column flex-center h-100 w-100 mb-5">

                                <div class="dialog-container__content h-100 d-flex w-100 space-between">

                                    <div class="w-100 h-100 dialog-content-left">
                                        <!--<div class="dc-left__head h-12 bahnschriftRegular">Conversación</div>  js-bot-image--->
                                        <div class="dc-right__body h-100">
                                            <div class="scroll-dialog-container w-100 h-100 default-scrollbar js-chat-container">

                                                <div class="chat-chunk d-flex space-between hide" id="js-bot-sample">
                                                    <div class=" w-25">
                                                        <img class="js-c-char w-100" style="background-color: #f2f2f2;">
                                                    </div>
                                                    <div class="chat-chunk__bubble w-70">
                                                        <div class="js-d-name bubble__name bahnschriftBold h1 display-6">
                                                            Doctor:
                                                        </div>
                                                        <div class="js-d-text bubble__text bahnschriftRegular" style="font-size: 2rem;"></div>
                                                    </div>
                                                </div>

                                                <div class="chat-chunk d-flex space-between hide" id="js-user-sample">
                                                    <div class="chat-chunk__bubble w-70">
                                                        <div class="js-d-name bubble__name bahnschriftBold h1 display-6">
                                                            User:
                                                        </div>
                                                        <div class="js-d-text bubble__text bahnschriftRegular" style="font-size: 2rem;"></div>
                                                    </div>
                                                    <div class="chat-chunk__img w-25">
                                                        <img class="js-bot-image w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-start w-100 h-15 mt-3 mb-15 dialog-container__buttons">
                                    <button class="btn-talk-dialog disabled p-0 w-24 h-100 text-center bg-transparent mr-1" style="border: transparent;">
                                    </button>

                                    <button class="btn-send p-0 w-24 h-100 text-center bg-transparent mr-1 disabled" style="border: transparent;">
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--end::Content-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Section-->

                <!--begin::Section-->
                <div class="mx-10 mt-15 pt-5">
                    <!--begin::Heading-->
                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_2">

                        <div class="cursor-pointer d-flex align-items-center text-start h-95px w-100 mb-0 rounded border border-3 border-white text-white" style="background-color: #000000; font-size: 3vw;">
                            <span class="align-middle text-start w-100 bahnschriftRegular">&nbsp;&nbsp;PERSONAJE</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                            &nbsp;&nbsp;
                        </div>

                    </div>
                    <!--end::Heading-->

                    <!--begin::Body src="/images/dialog/UsuarioDoctor.png"-->
                    <div id="kt_job_4_2" class="collapse fs-6 ms-1">

                        <div class="col card w-100 h-100">

                            <img class="img-fluid border-3 rounded-3 js-c-char" src="/filesimages/Reaghan Stone.png" style="width: 100%; height: 100%;">

                            <div class="d-flex flex-center text-center h-15 w-90 pt-5">
                                <div class="black-text bahnschriftRegular w-65">
                                    <h1 class="display-6 text-character">Rodolfo el maratonista</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Content-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Section-->

                <!--begin::Section-->
                <div class="mx-10">
                    <!--begin::Heading-->
                    <div class="d-flex align-items-center collapsible py-3 toggle collapsed mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_4_3">
                        <div class="cursor-pointer d-flex align-items-center text-start h-95px w-100 mb-0 rounded border border-3 border-white text-black" style="background-color: #FFC300; font-size: 3vw;">
                            <span class="align-middle text-start w-100 bahnschriftRegular pl-5">&nbsp;&nbsp;SITUACIÓN</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                            &nbsp;&nbsp;
                        </div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Body src="/images/exercise/meta.png"-->
                    <div id="kt_job_4_3" class="collapse fs-6 ms-1">
                        <div class="col card w-100 h-100">

                            <img class="js-c-char img-fluid border-3 rounded-3" style="width: 100%; height: 100%;">

                            <div class="d-flex flex-center text-center h-15 w-90 pt-5">
                                <div class="black-text bahnschriftRegular w-80">
                                    <h1 class="display-6 text-context">Crea un nuevo ejercicio de aprendizaje, elije uno
                                        previamente creado o deja que la plataforma te sugiera alguno.</h1>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--end::Content-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Section-->

                <div class="d-flex flex-center w-100 h-7">
                    <button class="btn-go-tables p-0 w-30 h-100 text-center bg-transparent btn-send-dialog inactive" style="border: transparent;">
                    </button>
                </div>

                <!--end::Accordion-->
            </div>
            <!--end::Col container collapse-->
        </div>
    </div>

</body>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/OpusMediaRecorder.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/encoderWorker.umd.js"></script>

<script>
    function habilitar() {
        
        var btn = $('.btn-talk-dialog');

        console.log(btn.length);

        if ($(".btn-talk-dialog").hasClass("disabled")) {
            console.log("IF");

            $('.btn-talk-dialog').removeClass('disabled');
        } else {
            console.log("ELSE");
            window.location.href = "/exercise/practice/dialog";
        }

    }
</script>

<?= $this->endSection() ?>