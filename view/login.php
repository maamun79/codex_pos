<?=mi_header();?>

<style>
    .login-block{
        background: #fff;
        width:100%;
        height: 100vh;

    }
    .banner-sec{ min-height:500px;padding:0;}
    .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
    .carousel-inner{border-radius:0 10px 10px 0;}
    .carousel-caption{text-align:left; left:5%;}
    .login-sec{padding: 50px 30px; position:relative;}
    .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
    .login-sec .copy-text i{color:#FEB58A;}
    .login-sec .copy-text a{color:#E36262;}
    .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
    .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
    .btn-login{background: #DE6262; color:#fff; font-weight:600;}
    .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
    .banner-text h2{color:#fff; font-weight:600;}
    .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
    .banner-text p{color:#fff;}
    .calcumodal{
        display: none !important;
    }
    .d-block.img-fluid{
        height: 100vh;
        width: 100%;
    }
</style>

    <div class="container-fluid login-block" style="overflow: hidden">
        <div class="row">
            <div class="col-md-4 login-sec">
                <div class="text-center pb-3"><img style="max-width:200px;" src="<?=MI_CDN_URL;?>assets/img/logo.png"></div>
                <h2 class="text-center pb-1">Authenticate Here</h2>
                <form class="login-form pt-1" id="mi_authen_form" autocomplete="off">
                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1" class="text-uppercase">User Id</label>
                        <input type="text" autocomplete="off" class="form-control" placeholder="Enter your user id" name="mi_authenticator_user_id">
                    </div>

                    <br><br>

                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1" class="text-uppercase">User Password</label>
                        <input type="password" autocomplete="off" class="form-control" placeholder="Enter your user password" name="mi_authenticator_user_password">
                    </div>


                    <div class="form-check">
                        <button type="submit" class="btn btn-login btn-lg" style="width: 100%;">Enter System</button>
                    </div>
                
                </form>
                <div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="https://www.softminion.com/" target="_blank">Soft Minion</div>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active bg-dark"
                             style="    background: url('<?=MI_CDN_URL.'uploads/login-back.jpg'?>');
                                     background-position: center;
                                     background-blend-mode: multiply;
                                     background-size: cover;">
                            <img class="d-block img-fluid" style="opacity: 0" alt="First slide">

                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>
                                        A better solution is the most required for the technical world.
                                        <br> We want to do some revolutionary inventions for the current world.
                                        <br>
                                    </p>
                                    <p><a href="https://www.softminion.com/" target="_blank"><strong>Soft Minion</strong></a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<div class="foot" style="display: none;">
    <?=mi_footer();?>
</div>