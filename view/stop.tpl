	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".promo-close").click(function() {
				jQuery(".promo").hide();
				jQuery(".promo-hidden").show();
			});
			jQuery(".promo-hidden").hover(function() {
				jQuery(".promo-hidden").css("height","20px");
			},
			function() {
				jQuery(".promo-hidden").css("height","10px");
			});
			jQuery(".promo-hidden").click(function() {
				jQuery(".promo-hidden").hide();
				jQuery(".promo").show();
			});
		});
	</script>
</body>
</html>