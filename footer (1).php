<?php

/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<footer class="footer pt-5 pb-4 fs-15">
	<div class="container-xxl">
		<div class="row gy-3 align-items-lg-center">
			<div class="col-12 col-lg-5 pe-xl-5">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid d-block mb-3 logo-footer" alt="<?php echo get_bloginfo('name'); ?>" decoding="async" loading="lazy" />
				<!-- <p class="color-white-o-6 mb-4">At Deluxenailfresno, we pride ourselves on providing our clients fabulously indulgent nail care with the lastest techniques and products in hopes of creating the experience of enlightenment and beauty while servicing you in a soothing and comfortable atmosphere after a long, hard workday. Our professionally trained staff is dedicated to delivering exceptional value in assisting your nails into looking healthy, vibrant, and beautiful.</p> -->
			</div>
			<div class="col-12 col-lg-7">
				<div class="row gy-4 ps-xl-4">
					<div class="col-12 col-sm-6 col-lg-6">
						<h3 class="fw-bold fs-18 color-eee365 mb-3 mb-lg-4">Contact us</h3>
						<div class="mb-3 mb-lg-4">
							<?php if (get_option('address_company') != '') {
								echo '<div class="d-flex mb-3 mb-lg-3 text-white"><div><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" class="w-35" xml:space="preserve" fill="#ffffff" width="35px" height="25px"><g><g><path d="M446.812,493.966l-67.499-142.781c-1.347-2.849-3.681-5.032-6.48-6.223l-33.58-14.949l58.185-97.518c0.139-0.234,0.27-0.471,0.395-0.713c11.568-22.579,17.434-46.978,17.434-72.515c0-42.959-16.846-83.233-47.435-113.402C337.248,15.703,296.73-0.588,253.745,0.016c-41.748,0.579-81.056,17.348-110.685,47.22c-29.626,29.87-46.078,69.313-46.326,111.066c-0.152,25.515,5.877,50.923,17.431,73.479c0.124,0.241,0.255,0.479,0.394,0.713l58.184,97.517l-33.774,15.031c-2.763,1.229-4.993,3.408-6.285,6.142L65.187,493.966c-2.259,4.775-1.306,10.453,2.388,14.23c3.693,3.777,9.345,4.859,14.172,2.711l84.558-37.646l84.558,37.646c3.271,1.455,7.006,1.455,10.277,0l84.558-37.646l84.558,37.646c1.652,0.735,3.401,1.093,5.135,1.093c3.331,0,6.608-1.318,9.037-3.803C448.119,504.419,449.071,498.743,446.812,493.966z M136.473,219.906c-9.73-19.132-14.599-39.805-14.47-61.453c0.428-72.429,59.686-132.17,132.094-133.173c36.166-0.486,70.263,13.199,95.993,38.576c25.738,25.383,39.911,59.267,39.911,95.412c0,21.359-4.869,41.757-14.473,60.638L266.85,402.054c-3.318,5.56-8.692,6.16-10.849,6.16c-2.158,0-7.532-0.6-10.849-6.16L136.473,219.906z M350.834,447.891c-3.271-1.455-7.006-1.455-10.277,0l-84.558,37.646l-84.558-37.646c-3.271-1.455-7.006-1.455-10.277,0l-58.578,26.08l50.938-107.749l32.258-14.356l37.668,63.133c6.904,11.572,19.072,18.481,32.547,18.481c13.475,0,25.643-6.909,32.547-18.48l37.668-63.133l32.261,14.361l50.935,107.744L350.834,447.891z"/></g></g><g><g><path d="M256.004,101.607c-31.794,0-57.659,25.865-57.659,57.658s25.865,57.658,57.659,57.658c31.793,0.001,57.658-25.865,57.658-57.658S287.797,101.607,256.004,101.607z M256.004,191.657c-17.861,0.001-32.393-14.529-32.393-32.392c0-17.861,14.531-32.392,32.393-32.392c17.861,0,32.392,14.531,32.392,32.392S273.865,191.657,256.004,191.657z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></div><span class="ps-2">' . get_option('address_company') . '</span></div>';
							} ?>

							<?php if (get_option('mail_company') != '') {
								echo '<div class="d-flex mb-3 mb-lg-3 text-white text-break"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" fill="#ffffff" width="30px" height="21px"><g><g><path d="M511.609,197.601c-0.001-0.77-0.173-1.933-0.472-2.603c-0.787-2.854-2.536-5.461-5.154-7.281l-73.292-50.948V82.153c0-7.24-5.872-13.112-13.112-13.112H335.26l-71.743-49.878c-4.484-3.121-10.437-3.134-14.935-0.026l-72.206,49.904H92.426c-7.242,0-13.112,5.872-13.112,13.112v53.973L5.666,187.027c-3.623,2.504-5.583,6.507-5.645,10.6C0.017,197.704,0,197.777,0,197.857l0.391,284.235c0.005,3.477,1.391,6.81,3.852,9.266c2.458,2.451,5.788,3.827,9.26,3.827c0.007,0,0.012,0,0.018,0l485.385-0.667c7.24-0.01,13.104-5.889,13.094-13.13L511.609,197.601z M432.69,168.708l41.898,29.118l-41.898,29.128V168.708z M256.015,45.884l33.31,23.156h-66.812L256.015,45.884z M105.538,95.265h300.928v149.921L305.43,315.428l-41.194-31.954c-0.064-0.05-0.119-0.081-0.181-0.126c-4.604-3.454-11.116-3.581-15.894,0.126l-41.493,32.185l-101.13-69.893V95.265z M79.314,168.003v59.64l-43.146-29.819L79.314,168.003z M26.258,222.867l158.669,109.655L26.578,455.346L26.258,222.867z M51.875,468.909l204.324-158.484l203.591,157.923L51.875,468.909z M327.144,332.271l158.276-110.036l0.32,233.059L327.144,332.271z"/></g></g><g><g><path d="M344.77,147.713H167.234c-7.24,0-13.112,5.872-13.112,13.112s5.872,13.112,13.112,13.112H344.77c7.242,0,13.112-5.872,13.112-13.112S352.012,147.713,344.77,147.713z"/></g></g><g><g><path d="M344.77,215.895H167.234c-7.24,0-13.112,5.872-13.112,13.112c0,7.24,5.872,13.112,13.112,13.112H344.77c7.242,0,13.112-5.872,13.112-13.112C357.882,221.767,352.012,215.895,344.77,215.895z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
										<a class=" text-decoration-none ms-2 text-white" href="mailto:' . get_option('mail_company') . '" title="' . get_option('mail_company') . '">' . get_option('mail_company') . '</a></div>';
							} ?>

							<?php if (get_option('phone_company') != '') {
								echo '<div class="d-flex mb-3 mb-lg-3 text-white"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 476 476" class="w-35 mt-1" style="enable-background:new 0 0 476 476;" xml:space="preserve" fill="#ffffff" width="35px" height="25px"><g><path d="M400.85,181v-18.3c0-43.8-15.5-84.5-43.6-114.7c-28.8-31-68.4-48-111.6-48h-15.1c-43.2,0-82.8,17-111.6,48c-28.1,30.2-43.6,70.9-43.6,114.7V181c-34.1,2.3-61.2,30.7-61.2,65.4V275c0,36.1,29.4,65.5,65.5,65.5h36.9c6.6,0,12-5.4,12-12V192.8c0-6.6-5.4-12-12-12h-17.2v-18.1c0-79.1,56.4-138.7,131.1-138.7h15.1c74.8,0,131.1,59.6,131.1,138.7v18.1h-17.2c-6.6,0-12,5.4-12,12v135.6c0,6.6,5.4,12,12,12h16.8c-4.9,62.6-48,77.1-68,80.4c-5.5-16.9-21.4-29.1-40.1-29.1h-30c-23.2,0-42.1,18.9-42.1,42.1s18.9,42.2,42.1,42.2h30.1c19.4,0,35.7-13.2,40.6-31c9.8-1.4,25.3-4.9,40.7-13.9c21.7-12.7,47.4-38.6,50.8-90.8c34.3-2.1,61.5-30.6,61.5-65.4v-28.6C461.95,211.7,434.95,183.2,400.85,181z M104.75,316.4h-24.9c-22.9,0-41.5-18.6-41.5-41.5v-28.6c0-22.9,18.6-41.5,41.5-41.5h24.9V316.4z M268.25,452h-30.1c-10,0-18.1-8.1-18.1-18.1s8.1-18.1,18.1-18.1h30.1c10,0,18.1,8.1,18.1,18.1S278.25,452,268.25,452z M437.95,274.9c0,22.9-18.6,41.5-41.5,41.5h-24.9V204.8h24.9c22.9,0,41.5,18.6,41.5,41.5V274.9z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
										<div class="ms-2"><a href="tel:' . get_option('phone_company') . '" title="' . get_option('phone_company') . '" class="text-decoration-none d-block fs-16 text-white">' . get_option('phone_company') . '</a></div></div>';
							} ?>
						</div>
						<ul class="list-inline d-flex align-items-center flex-wrap list-social mb-0">
							<?php if (get_option('facebook') != '') {
								echo '<li class="list-inline-item px-1 px-md-1 px-xl-1 py-2"><a target="_blank" href="' . get_option('facebook') . '" title="Facebook" class="d-flex justify-content-center align-items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg></a></li>';
							} ?>
							<?php if (get_option('instagram') != '') {
								echo '<li class="list-inline-item px-1 px-md-1 px-xl-1 py-2"><a target="_blank" href="' . get_option('instagram') . '" title="Instagram" class="d-flex justify-content-center align-items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg></a></li>';
							} ?>
							<?php if (get_option('yelp') != '') {
								echo '<li class="list-inline-item px-1 px-md-1 px-xl-1 py-2"><a target="_blank" href="' . get_option('yelp') . '" title="Yelp" class="d-flex justify-content-center align-items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M42.9 240.32l99.62 48.61c19.2 9.4 16.2 37.51-4.5 42.71L30.5 358.45a22.79 22.79 0 0 1-28.21-19.6 197.16 197.16 0 0 1 9-85.32 22.8 22.8 0 0 1 31.61-13.21zm44 239.25a199.45 199.45 0 0 0 79.42 32.11A22.78 22.78 0 0 0 192.94 490l3.9-110.82c.7-21.3-25.5-31.91-39.81-16.1l-74.21 82.4a22.82 22.82 0 0 0 4.09 34.09zm145.34-109.92l58.81 94a22.93 22.93 0 0 0 34 5.5 198.36 198.36 0 0 0 52.71-67.61A23 23 0 0 0 364.17 370l-105.42-34.26c-20.31-6.5-37.81 15.8-26.51 33.91zm148.33-132.23a197.44 197.44 0 0 0-50.41-69.31 22.85 22.85 0 0 0-34 4.4l-62 91.92c-11.9 17.7 4.7 40.61 25.2 34.71L366 268.63a23 23 0 0 0 14.61-31.21zM62.11 30.18a22.86 22.86 0 0 0-9.9 32l104.12 180.44c11.7 20.2 42.61 11.9 42.61-11.4V22.88a22.67 22.67 0 0 0-24.5-22.8 320.37 320.37 0 0 0-112.33 30.1z"></path></svg></a></li>';
							} ?>
							<?php if (get_option('google') != '') {
								echo '<li class="list-inline-item px-1 px-md-1 px-xl-1 py-2"><a target="_blank" href="' . get_option('google') . '" title="Google" class="d-flex justify-content-center align-items-center rounded"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg></a></li>';
							} ?>
							<li class="list-inline-item px-1 px-md-1 px-xl-1 py-2"><a target="_blank" href="https://deluxenailfresno.com/#reviews" title="reviews google map" class="d-flex justify-content-center align-items-center rounded"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/qr_map.jpg" class="img-fluid" alt="Reviews google map" decoding="async" loading="lazy" /></a></li>
						</ul>
					</div>
					<div class="col-12 col-sm-6 col-lg-6">
						<h3 class="fw-bold fs-18 color-eee365 mb-3 mb-lg-4">Business Hours</h3>
						<div class="d-inline-block block-hours p-4">
							<p>Monday - Firday: 09:30 am - 07:00 pm</p>
							<p>Saturday: 09:00 am - 06:00 pm</p>
							<p class="mb-0">Sunday: 10:00 am - 05:00 pm</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<h3 class="fw-bold fs-18 color-eee365 mb-3 mb-lg-3 mt-md-3">Pages</h3>
				<ul class="list-inline mb-0">
					<li class="list-inline-item"><a class="color-white-o-6 hover-line text-decoration-none d-inline-block mb-2 mb-lg-3" href="<?php bloginfo('url'); ?>/about-us" title="About Us">About Us</a></li>
					<li class="list-inline-item"><a class="color-white-o-6 hover-line text-decoration-none d-inline-block mb-2 mb-lg-3" href="<?php bloginfo('url'); ?>/contact" title="Contact">Contact</a></li>
					<li class="list-inline-item"><a class="color-white-o-6 hover-line text-decoration-none d-inline-block mb-2 mb-lg-3" href="<?php bloginfo('url'); ?>/blogs/" title="Blogs">Blogs</a></li>
					<li class="list-inline-item"><a class="color-white-o-6 hover-line text-decoration-none d-inline-block mb-2 mb-lg-3" href="<?php bloginfo('url'); ?>/gallerys/" title="Gallery">Gallery</a></li>
				</ul>
			</div>
			<div class="col-12 col-md-6">
				<h3 class="fw-bold fs-18 color-eee365 mb-3 mb-lg-3 mt-md-3">Services</h3>
				<?php
				$current_queried_post_type = "services";
				$services = new WP_Query(array(
					'post_type' => $current_queried_post_type,
					'post_status' => 'publish',
					'posts_per_page' => '-1',
					'orderby' => 'date',
					'order' => 'DESC',
				));

				if ($services->have_posts()) {
					echo '<ul class="list-inline mb-0">';
					while ($services->have_posts()) {
						$services->the_post();
						echo '<li class="list-inline-item"><a class="color-white-o-6 hover-line text-decoration-none d-inline-block mb-2 mb-lg-3" href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
					}
					echo '</ul>';
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<hr class="hr-2 mb-lg-4">
		<div class="text-center text-white">Copyright © 2022 Deluxenailfresno. All rights reserved</div>
	</div>
	<a id="totop" class="totop tooltip-r d-flex align-items-center justify-content-center" href="#" title="Go to top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
			<path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
		</svg></a>
</footer>

<?php wp_footer(); ?>
<div class="wrap-action d-flex flex-column justify-content-between">
	<?php if (get_option('phone_company') != '') {
		echo '<div class="btn-phone py-2 px-3 mb-3"><a title="' . get_option('phone_company') . '" href="tel:' . get_option('phone_company') . '" class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">   <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path> </svg>' . get_option('phone_company') . '</a></div>';
	} ?>
	<div class="btn-book-now cursor-pointer py-2 px-3"><a href="https://nailsolutionplus.firebaseapp.com/?storeKey=-NdpNKRl_SlFnvZdQjWR&fbclid=IwAR0G4vPt6XrR1fgvFOAo8ZRXIiBaqdqy3Z99OdaUYiLwoTdB1dGnI_nE0-Y" title="Book now" class="d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
				<path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z"></path>
			</svg>Book now</a></div>
</div>
<div id="reviews" class="feedback-card">
	<div class="feedback-card-inner">
		<div class="logo-placeholder">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-fluid" alt="<?php echo get_bloginfo('name'); ?>" decoding="async" loading="lazy" />
		</div>

		<div id="step-1" class="step active">
			<h2>Your Opinion Matters</h2>
			<p>How was your experience today at <strong>DELUXE&nbsp;Nails&nbsp;and&nbsp;Spa</strong>?</p>
			<div class="stars-container" id="stars">
				<span class="star" data-v="1">★</span>
				<span class="star" data-v="2">★</span>
				<span class="star" data-v="3">★</span>
				<span class="star" data-v="4">★</span>
				<span class="star" data-v="5">★</span>
			</div>
			<button id="btn-next-step" class="w-75 bg-black text-white mb-5 mb-md-4 rounded-10 py-2 mx-auto text-uppercase" style="display: none;">Continue</button>
		</div>

		<div id="step-good" class="step">
			<h2>You're Awesome! ❤️</h2>
			<p>Redirecting to Google Maps... <br>Please <strong>tap 5 stars</strong> and post to claim your coupon!</p>
			<div class="spinner"></div>
		</div>

		<div id="step-bad" class="step">
			<h2>We want to improve! 🥺</h2>
			<p>Please share your thoughts. Our manager will contact you personally.</p>
			<input class="mb-3 form-control" type="text" placeholder="Tên của bạn" id="cust_name">
			<input required class="mb-3 form-control" type="tel" placeholder="Phone Number (e.g. 202-555-0123)" id="cust_phone">
			<textarea required class="mb-3 form-control" id="msg" placeholder="Tell us what happened..."></textarea>
			<div class="d-flex gap-2">
				<button class="btn-submit" onclick="submitInternal()">Send Feedback</button>
			</div>
		</div>
	</div>
</div>

<!-- Start Modal -->
<!-- <div class="modal fade" id="AppointmentModal" tabindex="-1" aria-labelledby="AppointmentModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-uppercase" id="AppointmentModalLabel">Appointment</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="text-center mb-4">The best way to enjoy a treatment at our salon is to book an appointment with the desired technicians. Fill in the form below and we will contact you to discuss your appointment.</div>
						<?php //if(function_exists('appointmentForm')){appointmentForm();} 
						?>
					</div>
				</div>
			</div>
		</div> -->
<!-- End Modal -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>

<script>
	function checkHash() {
		const popup = document.getElementById('reviews');
		const body = document.body;
		if (window.location.hash === '#reviews') {
			popup.classList.add('active');
			body.classList.add('overflow-hidden');
		} else {
			popup.classList.remove('active');
			body.classList.remove('overflow-hidden');
		}
	}
	window.addEventListener('load', checkHash);
	window.addEventListener('hashchange', checkHash);
	let selectedRating = 0;
	const googleLink = "https://search.google.com/local/writereview?placeid=ChIJpd430w9plIARLkZarWGfy3Q";
	const stars = document.querySelectorAll('.star');
	const btnNext = document.getElementById('btn-next-step');

	stars.forEach(s => {
		s.onclick = () => {
			selectedRating = parseInt(s.getAttribute('data-v'));

			stars.forEach(st => {
				const starVal = parseInt(st.getAttribute('data-v'));
				starVal <= selectedRating ? st.classList.add('active') : st.classList.remove('active');
			});

			btnNext.style.display = "block";
		};
	});
	btnNext.onclick = () => {
		if (selectedRating >= 5) {
			showStep('step-good');
			setTimeout(() => {
				window.location.href = googleLink;
			}, 1500);
		} else {
			showStep('step-bad');
		}
	};

	function showStep(id) {
		document.querySelectorAll('.step').forEach(st => st.classList.remove('active'));
		const targetStep = document.getElementById(id);
		targetStep.classList.add('active');

		// Nếu quay lại step 1, ẩn nút continue cho đến khi chọn lại sao (tùy chọn)
		if (id === 'step-1' && selectedRating === 0) {
			btnNext.style.display = "none";
		}
	}

	// function showStep(id) {
	// 	document.querySelectorAll('.step').forEach(st => st.classList.remove('active'));
	// 	document.getElementById(id).classList.add('active');
	// }

	function submitInternal() {
		const text = document.getElementById('msg').value;
		const name = document.getElementById('cust_name').value;
		const phone = document.getElementById('cust_phone').value;
		const btn = document.querySelector('.btn-submit');

		const rawPhone = phone.replace(/\D/g, '');
		if (text.trim() === "") {
			return alert("Please enter your comments!");
		}
		if (rawPhone.length !== 10) {
			return alert("Please enter a valid 10-digit US phone number!");
		}

		btn.innerText = "Sending...";
		btn.disabled = true;

		const formData = new FormData();
		formData.append('action', 'send_internal_feedback'); // Khớp với wp_ajax_... trong PHP
		formData.append('cust_name', name);
		formData.append('cust_phone', phone);
		formData.append('msg', text);

		fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
				method: 'POST',
				body: formData
			})
			.then(r => r.json())
			.then(data => {
				if (data.success) {
					alert("We've received your feedback. Our manager will contact you soon. Thank you!");
					window.location.href = "<?php echo home_url('/'); ?>";
				} else {
					alert("Error: Could not send feedback.");
					btn.innerText = "Send Feedback";
					btn.disabled = false;
				}
			})
			.catch(() => {
				alert("Network error!");
				btn.innerText = "Send Feedback";
				btn.disabled = false;
			});
	}
</script>
</body>

</html>