<?= $this->extend('/exercise/TemplateMobile/base') ?>
<?= $this->section('content') ?>

<script type="module" src="/js/customJsActivities/navigation.js"></script>
<script src="/plugins/global/plugins.bundle.js"></script>
<link href="/css/style.bundle.css" rel="stylesheet" type="text/css" />

<div class="w-100 h-auto d-flex flex-column flex-center container-general" style="position:absolute;">

    <div class="row w-100 h-100">

        <div class="d-flex flex-center w-100 h-100">

            <div class="w-100 h-100">

                <div class="card-body d-block d-lg-block h-11 w-98" style="margin-left:2%;">
                    <!--<div class="d-flex flex-wrap flex-sm-nowrap w-90 pl-5">-->
                    <ul class="ml-5 nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent w-100 h-100" id="myTab" role="tablist">
                        <li class="nav-item w-30 h-100">
                            <a class="nav-link text-active-primary w-100 h-100" id="character-tab" data-toggle="tab" href="#character" role="tab" aria-controls="character" aria-selected="false">
                                <button class="btn w-100 h-100 text-center bg-transparent mr-3 character-tab active" style="border: transparent;">
                                </button>
                            </a>
                        </li>
                        <li class="nav-item w-30 h-100">
                            <a class="nav-link text-active-primary w-100 h-100" id="circumstance-tab" data-toggle="tab" href="#circumstance" role="tab" aria-controls="circumstance" aria-selected="false">
                                <button class="btn w-100 h-100 text-center bg-transparent circumstance-tab" style="border: transparent;">
                                </button>
                            </a>
                        </li>
                    </ul>

                    <!-- </div>-->

                </div>

                <div class="tab-content d-block h-100 w-100 h-40" id="myTabContent" style="margin-bottom: 18%; padding-top: 5%; overflow-y: scroll;">

                    <div class="tab-pane fade show active h-100" id="character" role="tabpanel" aria-labelledby="character-tab" style="padding-bottom: 1%; overflow-y: scroll;">
                        <div class="d-flex flex-column flex-center w-100 h-100 mt-5">
                            <!--  src="/images/exercise/rodolfo.png" image-holder-->
                            <div class="d-flex flex-center text-center h-85 w-85">
                                <img class="img-fluid border-3 rounded-3 w-100 h-100 image-holder" style="background-color: #dedbdb;">
                            </div>

                            <div class="d-flex flex-center text-center h-6 w-90 pt-5">
                                <div class="black-text bahnschriftRegular w-90 text-start">
                                    <p class="character-name text-start" style="font-size: 3vw;">Rodolfo, el maratonista</p>
                                </div>
                            </div>
                            <div class="text-center w-100 h-8 mt-2">
                                <button class="btn-prev w-28 h-100 text-center bg-transparent mr-2" style="border: transparent;">
                                </button>
                                <button class="btn-go btn-finish-create p-0 w-28 h-100 text-center bg-transparent" style="border: transparent;">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade h-100" id="circumstance" role="tabpanel" aria-labelledby="circumstance-tab" style="padding-bottom: 1%;overflow-y: scroll;">

                        <div class="d-flex flex-column flex-center h-100 w-100 mt-5">

                            <div class="d-flex flex-center text-center h-85 w-85">
                                <!-- src="/images/exercise/meta.png" -->
                                <img class="img-fluid border-3 rounded-3 w-100 h-100 image-holder" style="background-color: #dedbdb;">
                            </div>

                            <div class="d-flex flex-center text-center h-40 w-90 pt-5">
                                <div class="black-text text-start bahnschriftRegular w-100">
                                    <!-- character-description-->
                                    <p class="character-description" style="font-size: 3vw;">Marcus Blackwell is a close friend of Tony Stark aka Iron Man, and the head of security for Stark Industries.He is
                                        fiercely loyal and a true friend, helping to protect Tony and his company from any potential threats.While he may not
                                        be a superhero himself, he is a real - life superhero, serving others and placing himself in harm's way to protect the
                                        ones he loves.Marcus is an expert at hand - to - hand combat and firearms and is able to use his incredible skills to take
                                        out anyone that stands in his way.He is also a master at technology, and is often able to hack into the toughest of
                                        systems to retrieve useful information.He is an all around great guy and proves himself to be a strong companion to
                                        those in his life.</p>
                                </div>
                            </div>

                            <div class="text-center w-100 h-7 mt-5 mb-10">
                                <button class="btn-prev w-28 h-100 text-center bg-transparent mr-2" style="border: transparent;">
                                </button>
                                <button class="btn-go btn-finish-create p-0 w-28 h-100 text-center bg-transparent" style="border: transparent;">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>