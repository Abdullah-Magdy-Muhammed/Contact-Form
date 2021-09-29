<?php
    // check if user coming from a request
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        // assign variable
        $user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $cell = filter_var($_POST['cellphone'],FILTER_SANITIZE_NUMBER_INT);
        $msg = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
     
        
        // creating array of errors
        $formerrors = array();

        if(strlen($user) <= 3){
            $formerrors[] = "username must be larger than <strong>3</strong> characters";
        }
        
        if(strlen($msg) <= 10){
            $formerrors[] = "message can not be less than <strong>10</strong> characters";
        }
    // if no errors send the mail [mail (to, subject, message, headers, parameters)]
        $headers = 'from: ' . $email . '\r\n';
        $mymail = 'magdyabdullah200@gmail.com';
        $subject = 'Contact Form';

        if(empty($formerrors)){

            mail($mymail, $subject, $msg, $headers);

            $user = '';
            $email = '';
            $cell = '';
            $msg = '';

            $success = '<div class="alert alert-success"> We Have Recieved Your Message </div>';
     
        }
     
    }

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">   
</head>
<body>
    <!-- start form -->
    <div class="contianer">
        <h1 class="text-center">Contact Me</h1>
       
        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
           

                <?php if(! empty($formerrors)){ ?>
                    <div class="alert alert-danger alert-dismissible" role="start" >
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                <?php       
                     foreach($formerrors as $errors){
                      echo $errors . '<br>';
                        }
                    ?>
                    </div>
                   <?php } ?> 
                   <?php if(isset($success)) {echo $success;} ?>  
          <div class="form-group">
                <input
                    type="text"
                    class="form-control" 
                    name="username" 
                    placeholder="Type Your User Name"
                    value="<?php if(isset($user)) {echo $user;} ?>"/>
                    <i class="fa fa-user fa-fw"></i>
                    <span class="asterisx">*</span>
          </div>

           <div class="form-group">
                <input 
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Type a Valid E-mail"
                    value="<?php if(isset($email)) {echo $email;} ?>"/>
                    <i class="fa fa-envelope fa-fw"></i>
                    <span class="asterisx">*</span>
           </div>

            <input
                type="text" 
                class="form-control" 
                name="cellphone" 
                placeholder="Type Your Cell Phone"
                value="<?php if(isset($cell)) {echo $cell;} ?>"/>
                <i class="fa fa-phone fa-fw"></i>
                

            <input
                class="form-control" 
                placeholder="Your Message"
                name="message"
                value="<?php if(isset($msg)) {echo $msg;} ?>"/>

            <input 
                class="btn btn-success" 
                type="submit"
                value="Send Message"/>
                <i class="fas fa-paper-plane fa-fw send-icon"></i>

        </form>
    </div>
    <!-- end form -->

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>