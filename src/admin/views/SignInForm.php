<?php

class SignInForm
{
    private $id;
    private $action;

    public function __construct(String $action, String $id="sign_in_form") {
        $this->action=$action;
        $this->id=$id;
    }
    public function show(array $errors=array()) {
        echo '<p>Insert your e-mail and password:</p>';
        echo '<form method="post" action="'.$this->action.'" id="'.$this->id.'">';
        if( isset($errors['mail']) )
            echo '<p class="error">'.$errors['mail'].'</p>';
		echo '<input type="email" name="mail" placeholder="E-mail" />';
		if( isset($errors['password']) )
		    echo '<p class="error">'.$errors['password'].'</p>';
		echo '<input type="password" name="password" placeholder="Password" />';
		echo '<input type="submit" value="Sign in" name="sign_in"/>';
		echo '</form>';
    }
}