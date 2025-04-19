<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script type="module" src="/js/customJsActivities/navigation.js"></script>

<div class="w-100 h-100 d-flex flex-column flex-center container-general">
    <div class="d-flex flex-center w-100 h-100">
        <div class="context-container d-flex flex-center h-100 w-100">
            <div class="row w-80 h-100 flex-column">

                <h3 class="bahnschriftBold display-5">
                    INGRESE TEMÁTICA DEL EJERCICIO:
                </h3>

                <div class="h-8">
                    <img src="../images/exercise/Iconoprompt.png" class="img-fluid w-10 h-65" alt="Iconoprompt">
                    &nbsp;
                    <input class="w-85 h-90 d-inline context-input bahnschriftRegular btn-secondary rounded border-2 form-control text-start text-muted" placeholder="&nbsp;&nbsp;&nbsp;Escribir temática..." type="text" style="font-size: 4vw;">
                </div>

                <div class="bahnschriftRegular text-muted opacity-50 h-15 mt-5" style=" font-size: 3vw; padding-left:13%;">
                    > Campeonato regional <br>de padel <br>
                    > Visita al medico <br>
                    > Capacitación de las oficinas de <br>Edutecno
                </div>

                <div class="text-center w-100 h-6 mt-15">
                    <button class="btn-go btn-next p-0 w-35 h-100 text-center bg-transparent" style="border: transparent;">
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function habilitar() {
        console.log("habilitar");
        $('.btn-next').removeClass('inactive');
    }
</script>

<?= $this->endSection() ?>