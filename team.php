<?php include('assets/lib/header.php');include('assets/lib/user_details.php'); ?>



<?php
include('link.php');
$result= mysqli_query($con,"SELECT * FROM users where cmp_name = '" . $row_id['cmp_name']. "'");



?>
<!-- ======= Our Team Section ======= -->
<section id="team" class="team">
	<div class="container">

		<div class="section-title">
			<h2>Our Team</h2>
			<p>“A real friend is one who walks in when the rest of the world walks out.”</p>
		</div>

		<div class="row">
			<?php
			$i=0;
			$j= 1;
			while($row = mysqli_fetch_array($result)) {
				?>
				<div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up">
					<div class="member">
						<div class="pic"><img src="/assets/img/<?php if(!empty($row['img'])){echo $row['img'];}else{echo"no-image.jpg";}?>" class="img-fluid"  alt="<?php echo $row['img'];?>" > </div>
						<div class="member-info">
							<h4 class="text-capitalize"><?php echo $row['username']?></h4>
							<span class="text-capitalize"><?php echo $row['cmp_name']?></span>
							<div class="social">

								<a target="_blank" href="https://www.facebook.com/<?php echo $row['facebook']?>"><i class="icofont-facebook"></i><?php echo $row['username']?></a><br>
								<a target="_blank" href="https://www.instagram.com/<?php echo $row['instagram']?>"><i class="icofont-instagram"></i> <?php echo $row['instagram']?></a>

							</div>
						</div>
					</div>
				</div>

				<?php
				$i++;
			}
			?>
<style>
	.pic
	{
		width: 100%;
		height: 250px;
	}
	.member-info
	{ position: relative;
		top:  70%;
		 padding-top: 4rem;
		

	}
	.member-info,h4,.social
	{ font-size: .7rem;
		padding-bottom: 2rem;
	}

</style>
		</div>

	</div>
</section><!-- End Our Team Section -->
<?php include('footer.php'); ?>