<div class="menu-area">
    <div class="container">
        <div class="main-menu">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="menu">
                        <ul id="nav">
                            <li><a href="<?= base_url()?>home">Home</a></li>
                            <li><a href="<?= base_url()?>users/all-books">Books</a></li>  
                        </ul>
                    </div>           
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="menu">
                        <ul id="nav">
                        <!-- #For admin button  -->
                        <?php if($this->session->userdata('type') == 'A'): ?>
                            <li class="btn-user"><a href="<?= base_url()?>admin"><i class="fas fa-tools"></i> Admin panel</a></li>
                        <?php endif; ?>
                        
                        <!-- #For user account button  -->
                        <?php $type = $this->session->userdata('type') ?>
                            <?php if($type == 'U'): ?>
                            <li class="btn-user"><a href="<?= base_url()?>user-home"><i class="far fa-user"></i> My account</a></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
