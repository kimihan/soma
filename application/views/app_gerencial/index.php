
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../">
        <?php $this->load->view("app_gerencial/scripts");?>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
        <?php $this->load->view("app_gerencial/header");?>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Aside-->
				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<!--begin::Brand-->
					<div class="brand flex-column-auto" id="kt_brand">
						<!--begin::Logo-->
						<a href="index.html" class="brand-logo">
							<img alt="Logo" src="<?=base_url()?>public/metronic/media/logos/logo-light.png" />
						</a>
						<!--end::Logo-->
						<!--end::Toolbar-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside Menu-->
                        <?php $this->load->view("app_gerencial/menu");?>
					<!--end::Aside Menu-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper" style="padding-top: 0px !important;">
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="padding: 0;">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container" style="padding: 0px; max-width: 100%; margin: 0;">
                                <?=$view;?>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
                    <?php $this->load->view("app_gerencial/footer");?>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		<!--end::Demo Panel-->
		<!--begin::Global Config(global config for global JS scripts)-->
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?=base_url()?>public/metronic/plugins/global/plugins.bundle.js?v=7.0.3"></script>
		<script src="<?=base_url()?>public/metronic/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3"></script>
		<script src="<?=base_url()?>public/metronic/js/scripts.bundle.js?v=7.0.3"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="<?=base_url()?>public/metronic/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.3"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM?v=7.0.3"></script>
		<script src="<?=base_url()?>public/metronic/plugins/custom/gmaps/gmaps.js?v=7.0.3"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?=base_url()?>public/metronic/js/pages/widgets.js?v=7.0.3"></script>
		<!--end::Page Scripts-->
        <!--end::Global Theme Bundle-->
        <!--begin::Page Vendors(used by this page)-->
        <script src="<?=base_url()?>public/metronic/plugins/custom/datatables/datatables.bundle.js?v=7.0.3"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="<?=base_url()?>public/metronic/js/pages/crud/datatables/basic/paginations.js?v=7.0.3"></script>
        <!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>