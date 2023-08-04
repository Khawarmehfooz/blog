<?php 

    require_once('../private/initialize.php'); 
    $posts_set = find_all_posts();
    include("../private/shared/public_header.php") 
?>

<main>
    <div class="posts-container">
        <?php while($post = mysqli_fetch_assoc($posts_set)){ ?>
        <article class="post">
            <img class="post-img" src="<?php echo url_for("/images/demo-image.png") ?>" alt="">
            <section class="post-details">
                <p class="post-date">Aug 1, 2023</p>
                <h2 class="post-title"><?php echo $post['post_title'] ?></h2>
                <p class="post-excerpt"><?php echo $post['post_excerpt'] ?></p>
                <a class="readmore-btn" role="button" href="<?php echo url_for("/post/view.php?id={$post['id']}") ?>">Read More &rarr;</a>
            </section>
        </article>
        <?php } ?>
    </div>
</main>

<?php include("../private/shared/public_footer.php") ?>