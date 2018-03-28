    <?php
        echo form_open('message/index');
        echo validation_errors();
    ?>
    <p>
        <label for "message">Post your Message</label>
        <textarea name="message" width="50px"></textarea>
    </p>
    
    <p><input type="submit" name="submit" value="Submit" class="form_button"/></p>
</div>
