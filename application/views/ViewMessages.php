<?php foreach ($messages as $message):?>


<div class='message_body'>
    <h2><a href=<?php echo '"/user/view/'.$message['user_username'].'"'?>><?php echo ucwords($message['user_username'])?></a></h2>
    <p class="message"><?php echo $message['text']?></p>
    <p class='date'><?php echo $message['posted_at']?></p>
    <?php if (isset($followed)&& $followed==false && isset($index) && $index!=true && $message['user_username']!=$user){
        echo anchor("user/follow/".$message['user_username'].'"', "Follow $followed", 'class="follow_link"');
    }?>
</div>
<?php endforeach ?>
