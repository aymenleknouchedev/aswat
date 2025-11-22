<style>
	@media (max-width: 991px) {
		.m-footer {
			background: #0e0e0e;
			color: #fff;
			padding: 20px 16px 28px;
			border-top: 1px solid rgba(255,255,255,0.12);
			min-height: 50vh; /* occupy half the screen height */
			display: flex;
		}
		.m-footer .m-wrap {
			max-width: 960px;
			margin: 0 auto;
			flex: 1;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}
		.m-footer .m-logo { height: 36px; display: block; margin: 0 auto 14px; }

		.m-footer .m-icons {
			display: flex; justify-content: center; align-items: center; gap: 14px; margin: 6px 0 14px;
		}
		.m-footer .m-icon { width: 22px; height: 22px; opacity: .75; }
		.m-footer .m-icon:active { opacity: 1; }

		.m-footer .m-links { list-style: none; padding: 0; margin: 10px 0 12px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px 16px; direction: rtl; }
		.m-footer .m-links li { text-align: right; color: #eaeaea; font-size: 14px; }

		.m-footer .m-divider { height: 1px; background: rgba(255,255,255,0.12); margin: 10px 0 12px; }

		.m-footer .m-bottom { text-align: center; direction: rtl; }
		.m-footer .m-copy { margin: 0 0 6px; color: #cfcfcf; font-size: 12px; }
		.m-footer .m-brand { display: inline-flex; align-items: center; gap: 8px; color: #eaeaea; font-size: 12px; }
		.m-footer .m-brand img { height: 20px; }
	}
	@media (min-width: 992px) {
		.m-footer { display: none; }
	}
</style>

<footer class="m-footer" role="contentinfo">
	<div class="m-wrap">
		<img class="m-logo" src="{{ asset('user/assets/images/white_logo.svg') }}" alt="أصوات جزائرية">

		<div class="m-icons" aria-label="وسائل التواصل الاجتماعي">
			<span class="m-icon">@include('user.icons.facebook')</span>
			<span class="m-icon">@include('user.icons.twitter')</span>
			<span class="m-icon">@include('user.icons.youtube')</span>
			<span class="m-icon">@include('user.icons.instagram')</span>
			<span class="m-icon">@include('user.icons.telegram')</span>
			<span class="m-icon">@include('user.icons.linkedin')</span>
		</div>

		<ul class="m-links" role="list">
			<li>من نحن</li>
			<li>الوظائف</li>
			<li>اتصل بنا</li>
			<li>سياسة الخصوصية</li>
		</ul>

		<div class="m-divider" aria-hidden="true"></div>

		<div class="m-bottom">
			<p class="m-copy">جميع الحقوق محفوظة © مساحات للإعلام والثقافة والفنون 2025</p>
			<span class="m-brand">
				<span>تصميم وتطوير</span>
				<img src="{{ asset('user/assets/images/brand.svg') }}" alt="brand">
			</span>
		</div>
	</div>
    
</footer>
