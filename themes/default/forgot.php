<?php 
    $pages->protected(false);
    $pages->load_theme_file(array('file'=>'head', 'folder' => 'global'));
?>
<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Did your forget your password?</h1>
							<p class="lead">
								Don't worry, it happens...Just enter the email address associated with your account here and we will send your an email with the password reset link.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="<?php echo ICE_ACTIONS_URL .'users' ?>" method="POST">
										<input type="hidden" name="ice_op" value="<?php echo $converter->encrypt('forgot') ?>">
    									<input type="hidden" name="ice_nonce" value="<?php echo $ice->nonce()?>">
										
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Get Link</button> or <a href="<?php echo ICE_URL .'forgot' ?>" class="text-center">Sign In</a>
											<hr>
											<a href="<?php echo ICE_URL ?>" class="text-center">Sign Up</a>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
<?php $pages->load_theme_file(array('file'=>'footer', 'folder' => 'global'));?>