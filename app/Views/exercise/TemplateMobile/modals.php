<style>
    .modal-fullscreen-xl {
        padding: 0 !important;
    }

    .modal-dialog-xl {

        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-content-xl {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-body-xl {
        overflow-y: auto;
    }

    .iframePDF-xl {
        height: 100%;
    }
</style>

<!-- begin:: Modal Error servidor-->
<div class="modal fade bd-example-modal-lg" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content rounded-3" style="width: 800px; height:400px;">
            <div class="modal-body text-center ">
                <div class="d-flex flex-center text-center h-100 w-100 justify-content-center text-center">
                    <img class="img-fluid" src="/images/Mobile/Servidor.png">
                </div>
                <span id="titulo" name="titulo" class="text-black bahnschriftRegular text-center" style="font-size: 2rem;">Problemas con el servidor</span>

            </div>
            <div class="modal-footer row justify-content-center">
                <div class="text-center ">
                    <button type="reset" id="modal_error_close" onclick="habilitar()" name="cerrar" data-bs-dismiss="modal" class="btn btn-lg btn-retry w-65 h-75 text-center"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Modal Error servidor-->

<!-- begin:: Modal Error conexion-->
<div class="modal fade bd-example-modal-lg" id="error-conexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content rounded-3" style="width: 800px; height:400px;">
            <div class="modal-body text-center ">
                <div class="d-flex flex-center text-center h-100 w-100 justify-content-center text-center">
                    <img class="img-fluid" src="/images/Mobile/wifi.png">
                </div>
                <span id="titulo" name="titulo" class="text-black bahnschriftRegular text-center" style="font-size: 2rem;">Sin conexión</span>

            </div>
            <div class="modal-footer row justify-content-center">
                <div class="text-center ">
                    <button type="reset" id="modal_error_close" name="cerrar" onclick="habilitar()" data-bs-dismiss="modal" class="btn btn-lg btn-retry w-65 h-75 text-center"></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Modal Error conexion-->

<!--begin::Loading-->
<div class="modal modal-fullscreen-xl" id="modal-fullscreen-xl" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-xl" role="document" id="modal-dialog-fullscreen">
        <div class="modal-content modal-content-xl" id="modal-content-fullscreen">
            <div class="modal-body modal-body-xl justify-content-center text-center" id="modal-body-fullscreen">
                <div class="d-flex justify-content-center text-center h-100 w-100" style=" position:absolute; align-items: center;">
                    <div>
                        <img class="img-fluid" src="/images/Mobile/gif.gif">
                        <br><br>
                        <h1 class="bahnschriftBold" style="font-size: 3rem;">Cargando...</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Loading-->

<!--begin::Modal -->
<?= $this->renderSection('modals') ?>
<!--end::Modal-->