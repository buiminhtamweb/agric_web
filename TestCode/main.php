<div class="postList">
    <?php
    // Include the database configuration file
    include 'dbConfig.php';

    // Get records from the database
    $query = $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 2");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $postID = $row['id'];
    ?>
    <div class="list_item"><?php echo $row['title']; ?></div>
    <?php } ?>
    <div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
        <span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Show more</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
    </div>
    <?php } ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'ajax_more-without-design.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
            }
        });
    });
});
</script>
