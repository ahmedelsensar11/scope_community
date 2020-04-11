

<?php
//get all posts

$theposts = new Post();
$trends = $theposts ->trend(); 

//$react ->savePost <?php echo $post['post_id'] , <?php echo $post['user_id'] 
?>



<div class="card" >
    <img class="card-img-top img-fluid" src="images/trends.png" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title">Trends In Scope</h4>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach($trends as $trend) { ?>
        <li class="list-group-item "><?php echo $trend['post_title'] ?></li>
        <?php }?>
    </ul>
</div>