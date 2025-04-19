<!--begin::Head-->

<head>
	<base href="">
	<title>Mic - Play</title>
	<meta name="description" content="" />
	<meta name="keywords" content="pronunciación, dialog, ia, openia" />
	<!--<meta name="viewport" content="width=device-width, initial-scale=1" />-->
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Mic-Play" />
	<link rel="shortcut icon" href="/images/logo.png" />

	<link href="/css/style.fonts.css" rel="stylesheet" type="text/css" />
	<link href=" /css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href=" /css/common.css" rel="stylesheet" type="text/css" />
	<link href=" /css/dinamic-font.css" rel="stylesheet" type="text/css" />
	<link href=" /css/select.css" rel="stylesheet" type="text/css" />
	<script src="/js/sidebar/jquery-3.3.1.min.js"></script>
	<script src="/js/libs/cookie.js"></script>
	<script src="/js/libs/axios.js"></script>

	<script src="/js/jquery/jquery-3.3.1.min.js"></script>
	<script src="/plugins/global/plugins.bundle.js"></script>
	<script src="/js/scripts.bundle.js"></script>

</head>
<!--end::Head-->

<!--begin::HEADER Section position:absolute;-->
<div class="bgi-no-repeat w-100 h-28 head-general position-relative" style="background-image: url(/images/Mobile/FondoUp.png); background-position: center;
 background-repeat: no-repeat; background-size: cover; background-size: 100% 100%; aspect-ratio: 1.88/1;">
	<div class="container h-25">
		<div class="d-flex align-items-center">
			<!--begin::menu left-->
			<img src="/images/Mobile/Menu.png" class="h-120px w-130px btn pt-10 pl-10 ml-3 float-left" />
			<!--end::menu left-->

			<!--begin::Logo-->
			<div class="d-flex mx-auto pt-15">
				<a href="#">
					<img alt="Logo" src="/images/Mobile/Logo.png" class="h-70px" />
				</a>
			</div>
			<!--end::Logo-->

			<!--begin::Perfil-->
			<img src="/images/Mobile/Perfil.png" class="h-120px w-130px btn pt-10 pr-10 float-right" />
			<!--begin::Perfil-->

		</div>
	</div>

	<div class="d-flex flex-center text-center h-75 w-100 align-items-center">
		<div class="bahnschriftRegular w-75 h-80 text-center text-white" style="font-size: 3.8vw;">
			<?= $help; ?>
		</div>
	</div>

</div>
<!--end::HEADER Section-->