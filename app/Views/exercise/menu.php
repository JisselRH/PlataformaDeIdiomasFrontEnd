<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script type="module" src="/js/customJsActivities/menu.js"></script>

<div class="w-100 h-100 d-flex flex-column flex-center">

    <div class="d-flex flex-center w-100 h-100">
        <div class="w-90 h-100 d-flex flex-center">
            <div class="row w-100 h-100 ">

                <div class="d-flex align-items-center text-center h-95px w-100 mb-0 rounded rounded-3 border border-3 text-white titulos">
                    <span class="align-middle text-center w-100 bahnschriftRegular">SELECTOR DE ENTRENAMIENTO</span>
                </div>

                <div class=" h-100 w-100 align-items-center flex-column">

                    <div class="ms-10 w-90 h-25 d-flex flex-center border border-5 rounded-3 rounded" style="border-color: #F2F2F2 !important; background-color:white;">
                        <div class="w-70">
                            <div>
                                <img src="../images/exercise/Palabra.png" class="img-fluid d-inline" height="50px" width="50px">
                                <h2 class="d-inline align-middle bahnschriftBold display-5"> &nbsp;&nbsp;PALABRAS</h2>
                            </div>
                            <div class="bahnschriftRegular h1 display-6 mt-5">
                                Practica pronunciar palabras con respecto al tema que ingresaste previamente.
                            </div>
                        </div>

                        <div class="w-25 h-100 d-flex flex-center align-middle" style="display: flex; justify-content: center;">

                            <div class="btn-play btn-practice-words">

                            </div>
                        </div>

                    </div>

                    <div class="ms-10 w-90 h-25 d-flex flex-center mt-5 border border-5 rounded-3 rounded" style="border-color: #F2F2F2 !important; background-color:white;">
                        <div class="w-70">
                            <div>
                                <img src="../images/exercise/Frase.png" class="img-fluid d-inline" height="50px" width="50px">
                                <h2 class="d-inline align-middle bahnschriftBold display-5">&nbsp;&nbsp;FRASES</h2>
                            </div>
                            <div class="bahnschriftRegular h1 display-6 mt-5">
                                Practica pronunciar frases con respecto al tema que ingresaste previamente.
                            </div>
                        </div>

                        <div class="w-25 h-100 d-flex flex-center align-middle" style="display: flex; justify-content: center;">

                            <div class="btn-play btn-practice-phrases">

                            </div>
                        </div>
                    </div>

                    <div class="ms-10 w-90 h-25 d-flex flex-center mt-5 border border-5 rounded-3 rounded" style="border-color: #F2F2F2 !important; background-color:white;">
                        <div class="w-70">
                            <div>
                                <img src="../images/exercise/Dialogo.png" class="img-fluid d-inline" height="50px" width="50px">
                                <h2 class="d-inline align-middle bahnschriftBold display-5">&nbsp;&nbsp;DIÁLOGO</h2>
                            </div>
                            <div class="bahnschriftRegular h1 display-6 mt-5">
                                Entrena con un diálogo relacionado al tema que ingresaste previamente.
                            </div>
                        </div>

                        <div class="w-25 h-100 d-flex flex-center align-middle" style="display: flex; justify-content: center;">

                            <div class="btn-play-disabled btn-practice-dialog">

                            </div>
                        </div>


                    </div>

                    <div class="text-center w-100 h-7 mt-15">
                        <button class="btn-go p-0 w-35 h-90 text-center bg-transparent btn-all-exercises" style="border: transparent;">
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <div class="d-flex flex-center" style=" margin-bottom: 1%; height: 15%; width: 90%;">

        <button class="btn btn-primary btn-all-exercises">
            <h1 class="display-6 bahnschriftBold">CONTINUAR</h1>
        </button>
    </div>

</div>
<?= $this->endSection() ?>