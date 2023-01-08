<?php 
    $pages->protected(true);
    $pages->load_theme_file(array('file'=>'head', 'folder' => 'global'));
    $pages->load_theme_file(array('file'=>'sidebar', 'folder' => 'global'));
    $pages->load_theme_file(array('file'=>'header', 'folder' => 'global'));
?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">My Dashboard: User Level <?php echo $uinfo['level'] ?></h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-body">
                        Now that you are here, can you escalate the application level privileges to an admin of this site?

                        <?php if($uinfo['level'] === 2){?>
                            <hr>
                            <div class="alert alert-info">
                                Congratulations for figuring out how to chain IDOR with password reset to gain access to the admin account. For your efforts, please find the flag <code>cske{1D0R_2_P455W0RD_R3537}</code>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<?php $pages->load_theme_file(array('file'=>'footer', 'folder' => 'global'));?>