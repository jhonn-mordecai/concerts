<?php 
	require_once('includes/global_variables.php');
	require_once('includes/db_conn.php');
	require_once('includes/all_shows.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Concert Log</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="John Mordecai's concert log -- a record of more-or-less every show I've attended.">
		
		<meta property="og:title" content="John Mordecai - Concert Log">
		<meta property="og:description" content="A record of more-or-less every show I've attended.">
		<meta property="og:url" content="https://johnmordecai.com/concerts">
  		<meta property="og:site_name" content="John Mordecai - Concert Log"> 		
		<meta property="og:image" content="https://johnmordecai.com/concerts/concerts-crowd-og.png" />
		<meta property="og:image:type" content="image/png" />
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="favicon.png" />
	
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
		<link rel="stylesheet" href="styles/styles.css">
	</head>
	<body>
		<div class="page-wrapper">
			<div id="top" class="title-container">
				<h1>Concert Log</h1>
			</div>
			<div class="fluid-container">
				<section class="top">

					<div class="stats-row top-stat">
						<div class="stat-box">
							<span class="stat-count band-count">
								<span class="badge-pill badge-dark"><?= $band_count; ?></span>
								<span class="stat-label">Bands/artists seen since 1989</span>
							</span>
						</div>
						<div class="stat-box modal-buttons">
							<a href="#artists_modal" class="stat-badge info-badge" data-toggle="modal" data-target="#artists_modal">Most-Seen <i class="fa fa-info-circle" aria-hidden="true"></i></a>
							<a href="#disclaimer" class="stat-badge disclaimer-badge" data-toggle="modal" data-target="#disclaimer">Disclaimers <i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>
							<a href="#covid_gap" class="stat-badge info-badge" data-toggle="modal" data-target="#covid_gap">C-19 <i class="fa fa-bug" aria-hidden="true"></i></a>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="card search-card">
								<div class="card-header">
									<span class="header-title">Search Concerts</span>
									<span class="toggle-holder">
										<a data-toggle="collapse" href="#search-container" role="button" class="toggle-search-view" aria-expanded="false" aria-controls="search-container"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
									</span>
								</div>
								<div id="search-container" class="card-body">
									<form id="concert-search">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" name="text-search" class="form-control" placeholder="Band/Artist/Venue/City" />
											</div>
											<div class="col-md-1 text-center">
												<p style="padding-top:8px;"><b>OR</b></p>
											</div>
											<div class="col-md-3">
												<select id="year" name="year" class="form-control">
													<option value="" selected="selected">Year</option>
													<?php foreach($years as $year): ?>
													<option value="<?= $year; ?>"><?= $year; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="col-md-2">
												<button class="btn btn-block btn-dark btn-clear" type="button" disabled>Reset</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="stats-row total-counts">
						<div class="stat-box">
							<p>
								<span class="stat-count concert-count"></span>
								<a href="#concert_year_modal" class="stat-badge info-badge" data-toggle="modal" data-target="#concert_year_modal">Count By Year <i class="fa fa-info-circle" aria-hidden="true"></i></a>
							</p>
						</div>
						<div class="stat-box">
							<p>
								<span class="stat-count venues"></span>
								<a href="#venues_modal" class="stat-badge info-badge" data-toggle="modal" data-target="#venues_modal">20 Most-Visited <i class="fa fa-info-circle" aria-hidden="true"></i></a>
							</p>
						</div>
						<div class="stat-box">
							<p>
								<span class="stat-count cities"></span>
								<a href="#cities_modal" class="stat-badge info-badge" data-toggle="modal" data-target="#cities_modal">10 Most-Visited <i class="fa fa-info-circle" aria-hidden="true"></i></a>
							</p>
						</div>
					</div>
				</section>

				<!-- Concert List -->
				<section class="concerts-list">
					<div class="list-container"></div>
				</section>
			</div>
		</div>
		<div class="back-top">
			<a href="#top"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
		</div>

		<footer>
			<div>
				<span class="copy">&copy;<?= date('Y'); ?> John Mordecai</span>
			</div>
		</footer>	

		<?php include_once('includes/modals.php'); ?>

		<!-- jQuery first, then Tether, then Bootstrap JS, then mine -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="scripts.js"></script>
	</body>
</html>