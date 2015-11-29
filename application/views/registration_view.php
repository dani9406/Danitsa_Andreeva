<html>
    <head>
        <title>Registration Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    </head>
    <body>
        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>registration_controller/validate" method="post">
                
              <div class="form-group">
                <label class="col-sm-2 control-label">Userame:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div>                  
                    
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="email" placeholder="Enter email">
                </div>                
              </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
                </div> 
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Confirm Password:</label>
                
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                </div>
             </div>
              <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="submit">Register</button>
                </div>
              </div>
        <?php //$this->load->helper(array('form', 'url')); $this->load->library('form_validation');
        echo validation_errors(); ?>
            </form>
    </body>    
                
</html>
