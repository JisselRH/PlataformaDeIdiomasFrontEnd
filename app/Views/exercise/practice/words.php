<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script src="/js/libs/speechSDK.js"></script>
<script type="module" src="/js/customJsActivities/practice/words-pron.js"></script>
<script type="module" src="/js/customJsActivities/navigation-exercise.js"></script>

<div class="w-100 h-auto d-flex flex-column flex-center container-general" style="position:absolute;">

    <div class="d-flex flex-center w-100 h-100">
        <div class="d-flex flex-center w-100 h-100">
            <div class="row w-100 h-100 align-middle align-items-center">
                <div class="h-100 w-100 d-flex flex-center flex-column">
                    <div class="row d-block h-100 w-100 align-middle align-items-center">
                        <div class="col h-100 w-100 align-items-center align-middle text-center">
                            <table class="table-responsive h-80 w-95 table-wrapper-scroll-y my-custom-scrollbar align-items-center" style="margin-bottom: 25%;">
                                <thead style="position: sticky; top: 0;">
                                    <tr style="height: 80px;">
                                        <th scope="col" class="titulos bahnschriftRegular text-center rounded-start border border-5 border-white col-5 text-white w-400px">PALABRA</th>
                                        <th scope="col" class="titulos bahnschriftRegular text-center col-5 text-white w-300px h-76px">PUNTUACIÓN</th>
                                        <th scope="col" class="col-2 w-100px border border-5 border-white micro-head rounded-end"></th>
                                    </tr>
                                </thead>

                                <tbody class="exercise-word-container">
                                    <tr class="exercise-word h-150px">
                                        <td class="w-50 bahnschriftBold text-black align-middle h2 display-6 mt-5 pl-10 word-content">
                                            Word
                                        </td>

                                        <td class="text-center word-feedback h2 display-6 w-30">0/100</td>

                                        <td class="w-20 text-end btn-content">
                                            <button class="btn btn-talk-disabled btn-talk-clic float-right"></button>
                                        </td>
                                    </tr>
                                <span class="texto-prueba" style="font-size: 32px;">texto de prueba 1</span>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <div class="d-flex flex-center w-100 h-5">
                                                <button class="btn-prev-tables p-0 w-30 h-30 text-center bg-transparent btn-prev-exercise" style="border: transparent;">
                                                </button>
                                                <button class="btn-go-tables p-0 w-30 h-30 text-center bg-transparent btn-send-word" style="border: transparent;">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function habilitar() {
        
        var btn = $('.active-word').find('.btn-content');
        btn.find('.btn').removeClass("btn-talk-active");
        btn.find('.btn').addClass("btn-talk");
    }
</script>

<?= $this->endSection() ?>