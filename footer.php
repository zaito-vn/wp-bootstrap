		<hr>
		<div style="text-align: center;">
		  <em>&reg; Ghi rõ nguồn "TechLead.vn" khi phát hành lại thông tin từ website này.</em>
		</div>
	</div>
<?php
	wp_footer();
?>
	<script type="text/javascript">
	$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#gotop').fadeIn();	
			} else {
				$('#gotop').fadeOut();
			}
		});
	});
	</script>
	<a href="#gotop" id="gotop" onclick="$('body,html').animate({scrollTop:0},800);"></a>
</body>
</html>
