<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script type="module" src="/js/customJsActivities/navigation.js"></script>


<div class="w-100 h-100 d-flex flex-column flex-center container-general">
    <div class="d-flex flex-center w-100 h-100">
        <div class="d-flex flex-center h-100 w-100">
            <div class="row w-80 h-100 flex-column">
                <!-- word-panel -->
                <div class="align-middle h-80 w-100">
                    <div class="d-flex align-items-center text-start h-95px w-100 mb-0 rounded border border-3 text-white titulos">
                        <span class="align-middle text-center w-100 bahnschriftRegular">LISTA DE PALABRAS:</span>
                    </div>
                    <div class="border border-5 rounded-3 rounded h-95" style="border-color: #F2F2F2 !important;">
                        <div class="word-container h2 display-6 pt-10">
                            <!-- <div class="one-word-container">Comida</div> -->
                        </div>
                    </div>
                </div>

                <div class="text-center w-100 h-5 pt-2">
                    <button class="btn-prev w-30 h-100 text-center bg-transparent mr-2" style="border: transparent;">
                    </button>
                    <button class="btn-go btn-next p-0 w-30 h-100 text-center bg-transparent" style="border: transparent;">
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