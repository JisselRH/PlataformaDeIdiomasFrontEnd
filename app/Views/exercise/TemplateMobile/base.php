<!DOCTYPE html>

<html lang="es">
<!--begin::Head-->
<?= $this->include('exercise/TemplateMobile/head') ?>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page
        <div class="page d-flex flex-row flex-column-fluid">-->
            <?= $this->renderSection('content') ?>
        <!--</div>
        end::Page-->
    </div>
    <!--end::Root-->

     <!--begin::Modals-->
     <?= $this->include('exercise/TemplateMobile/modals') ?>
    <!--end::Modals-->
    
    <!--begin::Footer-->
    <?= $this->include('exercise/TemplateMobile/footer') ?>
    <!--end::Footer-->

</body>
<!--end::Body-->

</html>