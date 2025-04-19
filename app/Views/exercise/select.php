<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script type="module" src="/js/customJsActivities/select.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script> <!-- generar ids unicos-->

<!-- content-container #f5f8fa;-->

<div class="w-100 h-100 d-flex flex-column flex-center container-general" style="background-color: #f5f8fa;">
    <div class="d-flex flex-center w-100 h-100">
        <div class="d-flex flex-center w-100 h-100">
            <div class="row w-80 h-100 flex-column">

                <!--<input class="form-check-input item-radio" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="margin-left: 1%; margin-right: 1%; background-color: #ebe3e3; width: 40px; height: 40px;"-->
                <div class="mt-15 border rounded item-radio h-10 d-inline d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#kt_job_4_1">
                    <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16" style="color: #EBE3E3;">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <label class="align-middle bahnschriftBold black-text h1 display-6">
                        &nbsp;SELECCIONAR EJERCICIO
                    </label>
                </div>

                <div id="kt_job_4_1" class="collapse">
                    <div class="card card-body bahnschriftRegular text-center" style="font-size: 3vw;">
                        Maratón 10 Kms<br><br>
                        Visita al medico <br><br>
                        Capacitación.
                    </div>

                </div>

                <div class="mt-15 border rounded item-radio h-10 d-inline d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#kt_job_4_2">
                    <svg class="align-middle" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16" style="color: #EBE3E3;">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <label class="align-middle bahnschriftBold black-text h1 display-6">
                        &nbsp;SUGERIR EJERCICIO
                    </label>
                </div>

                <div id="kt_job_4_2" class="collapse">
                    <div class="card card-body bahnschriftRegular text-center" style="font-size: 3vw;">
                        No hay sugerencias actualmente
                    </div>

                </div>

                <div class="mt-15 border rounded item-radio h-10 d-inline d-flex align-items-center">
                    <svg class="align-middle " xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16" style="color: #EBE3E3;">
                        <circle cx="8" cy="8" r="8" />
                    </svg>
                    <label class="align-middle bahnschriftBold black-text h1 display-6 text-center">
                        &nbsp; CREAR EJERCICIO
                    </label>
                </div>

                <!--<div class="form-check border rounded h1 display-6">
                    <br>
                    <input class="form-check-input item-radio" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="margin-left: 1%; margin-right: 1%; background-color: #ebe3e3; width: 40px; height: 40px;">
                    <label class="form-check-label font-weight-bold bahnschriftBold black-text" for="flexRadioDefault1">
                        CREAR EJERCICIO
                    </label>
                    <br><br>
                </div>


                <div class="d-flex flex-center h-20 w-100">
                    <button class="btn btn-primary exercise-btn w-35 h-25">
                        <h1 class="display-6 bahnschriftBold">CONTINUAR</h1>
                    </button>
                </div>-->

                <div class="text-center w-100 h-6 mt-20">
                    <button class="exercise-btn btn-go p-0 w-35 h-90 text-center bg-transparent" style="border: transparent;">

                    </button>
                </div>

            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>


