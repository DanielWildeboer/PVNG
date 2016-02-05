			<div class="footer">
				<div id="skyline">
				</div>
				<div class="row footerTextContainer">
					<div class="col-md-1">
						
					</div>
					<div class="col-md-2">
						<?php
							$contactpost = get_post(151); 
							echo "<h4>" . $contactpost->post_title . "</h4>";
							echo "<p>" . $contactpost->post_content . "</p>";
						?>
					</div>
					<div class="col-md-2">
						<?php
							$contactpost = get_post(152); 
							echo "<h4>" . $contactpost->post_title . "</h4>";
							echo "<p>" . $contactpost->post_content . "</p>";
						?>
					</div>
					<div class="col-md-2">
						<?php
							$contactpost = get_post(153); 
							echo "<h4>" . $contactpost->post_title . "</h4>";
							echo "<p>" . $contactpost->post_content . "</p>";
						?>
					</div>
					<div class="col-md-2">
						<?php
							$contactpost = get_post(154); 
							echo "<h4>" . $contactpost->post_title . "</h4>";
							echo "<p>" . $contactpost->post_content . "</p>";
						?>
					</div>
					<div class="col-md-2">
						<?php
							$contactpost = get_post(155); 
							echo "<h4>" . $contactpost->post_title . "</h4>";
							echo "<p>" . $contactpost->post_content . "</p>";
						?>
					</div>
					<div class="col-md-1">
					</div>
				</div>
				<div class="copyrightfooter">
				&copy; Copyright 2015 - Publiek Vervoer Noord-Groningen -<a id="stenden" href="https://stenden.com/"> Made By Students</a>
				</div>
			</div>
		</div> <!-- content -->
		<?php wp_footer(); ?>
	</body>
</html>