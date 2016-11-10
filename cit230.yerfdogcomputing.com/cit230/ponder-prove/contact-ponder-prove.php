<?php
//Check to see if the form has been submitted, if so use php to validate the inputs
//This check sees if the btnSubmitMessage key exists in the POST object, if "true" the form has been submitted
if($_POST['submit']) {

    // Create an empty error array to store any found errors
    $errors = array();

    //Check the name field using using the empty function
    if(empty($_POST['txtfName'])) {
        $errors['fname'] = 'The first name field is empty, please enter your name';
    }

    //Check the name field using using the empty function
    if(empty($_POST['txtlName'])) {
        $errors['lname'] = 'The last name field is empty, please enter your name';
    }

    //Check the name field using the empty function
    if(empty($_POST['rSubject'])) {
        $errors['subject'] = 'The subject is not selected, please select a subject.';
    }

    //Check the message field using the empty function
    if(empty($_POST['taMessage'])) {
        $errors['message'] = 'The message field is empty, please enter your message';
    }

    //Check the email field
    if(empty($_POST['txtEmail'])) {
        $errors['email'] = 'The email field is empty, please enter a email address';
    }

    //Check the length of the email address -- x@x.xx
    $tempEmail = trim($_POST['txtEmail']);
    if(strlen($tempEmail) < 6) {
        $errors['emaillength'] = 'The email provided is too short, please enter a valid email address';
    }

    //Check the form of the email address using a regular expression
    $checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';
    if(!preg_match($checkEmail,$tempEmail)) {
        $errors['invalidform'] = "Please provide a valid email address";
    }



//If there are no errors stored in the error array proceed to form and then send the email message
if(!$errors) {
    $to = 'brygodfrey3@gmail.com';
    $txtfName = $_POST['txtfName']."\n";
    $txtlName = $_POST['txtlName']."\n";
    $rSubject = $_REQUEST['rSubject'];
    $taMessage = $_POST['taMessage'];
    $txtEmail = $_POST['txtEmail']."\n";
    $from = 'From:'.$_POST['from'];
    $degree = $_POST['reason'];
    $likeit =$_POST['likeit'];
    $how =$_POST['how'];

    $message = "Hello!

Your contact form has been submitted by:

First Name: $txtfName
Last Name: $txtlName
E-mail: $txtEmail

Like this website? $likeit
How did he/she find it? $how

What information did you come? $reason

Comments: $taMessage

End of message
            ";

    mail($to, $rSubject, $message);

//	mail($to,$subject,$message);
    // After the message is sent create a confirmation message to display
    $successmessage = "Your message has been sent. Thank you.";
}
}
?>

<?php
// This displays the errors array if it is not empty, 
        // if it is empty this does nothing
        if ($errors) {
            echo '<div>';
            echo '<ul class="warning">';
            foreach ($errors as $alert) {
                echo "<li>$alert</li>";
            }
            echo '</ul>';
            echo '</div>';
        } elseif($successmessage) {
            echo "<p class=\"warning\">".$successmessage."</p>";
        }
        ?>
