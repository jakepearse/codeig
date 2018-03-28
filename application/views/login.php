<div> 
    <?php
        echo form_open('user/login');
        echo validation_errors();
        if ($error) {
            echo '<p class="warning"> '.$error.'</p>';
        }
    ?>
    <p>
        <label for "username">Username</label>
        <input type="input" name="username"/ class="field_box">
    </p>
    <p>
        <label for "pass">Password</label>
        <input type="password" name="pass" class="field_box"/>
    </p>
    <input type="submit" name="submit" value="Login" class="form_button"/>
</div>
