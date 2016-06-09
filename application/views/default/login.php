<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>
<style>
    body {
        background: #e9e9e9;
        font-family: 'Roboto', sans-serif;
        text-align: center;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

</style>


<div class='login_form aniamted bounceIn'>
   
    <div class='login'>
        <h2><?php echo $this->lang->line('LOGIN_TITLE');?></h2>
        <form class="form-inline" action="<?php echo $CI->get_encoded_url("home/login");?>" method="post">

             <div class="form-group">

    <input type="text"  class="form-control" placeholder="<?php echo $this->lang->line('USERNAME');?>" name="username" required autofocus>
  </div>
            
             <div class="form-group">
  <input type="password" class="form-control"  placeholder="<?php echo $this->lang->line('PASSWORD');?>" name="password" required>
  </div>
            
            <input type="submit" class="btn btn-lg btn-primary loginuser" value="<?php echo $this->lang->line('LOGIN');?>">
        </form>
        <a href="<?php echo base_url() ?>home/resetpassword">পাসওয়ার্ড   ভুলে গেছেন ?</a>
    </div>
    
</div>




<div class="clearfix"></div>
<script type="text/javascript">

    $(document).ready(function()
    {
        $('#system_wrapper').addClass('wrapper_login');
    });

    $('.switch').click(function(){
        $(this).children('i').toggleClass('fa-pencil');
        $('.login').animate({height: "toggle", opacity: "toggle"}, "slow");
        $('.register').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>