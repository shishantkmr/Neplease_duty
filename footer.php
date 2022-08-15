
</main><!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="bg-dark">
	

	<div class="container">
		
		<div class="credits">
			<p>
				 Street Kolejowa-67 <br>
				Zipcode 56-513, Miedzyborz
			</p>
			Designed by <a href=""> Neplese</a>
		</div>
		<div class="copyright">
			&copy; <?php echo date('Y');?> Copyright <strong><span>Nepalese</span></strong>. All Rights Reserved 
		</div>
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function () {
		'use strict';
		setTimeout(function() {
			// $('.msg').click(function(){ alert('hello');});
			$('.msg').slideUp('fast');
		}, 2000);
	});


	$(document).ready(function(){
		$('#datepicker').datepicker({dateFormat:'yy-mm-dd'});
  $('.keyboard').attr('readonly','readonly');// for mobile keypad disable
});


    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );



</script>

</body>

</html>