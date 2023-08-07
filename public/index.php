<?php 

    require_once('../private/initialize.php'); 
    $posts_set = find_all_posts();
    include("../private/shared/public_header.php");
    $allowed_tags = '<div><img><h1><h2><h3><h4><h5><h6><p><br><strong><em><ul><li>';
?>

<main>
    <div class="message-container">
    <?php 
        echo display_session_message();
    ?>
    </div>
    <div class="posts-container">
        <?php while($post = mysqli_fetch_assoc($posts_set)){ ?>
            <article class="post">
                <a href="<?php echo url_for("/post/view.php?id={$post['id']}")?>">
                    <img class="post-img" src="<?php echo url_for("/post/uploads/{$post['post_thumbnail']}") ?>" alt="">
                    <section class="post-details">
                        <p class="post-date"><?php echo htmlspecialchars($post['publish_date']); ?></p>
                        <h2 class="post-title"><?php echo htmlspecialchars($post['post_title']); ?></h2>
                        <p class="post-excerpt"><?php echo strip_tags($post['post_excerpt'],$allowed_tags); ?></p>
                        <a class="readmore-btn" role="button" href="<?php echo url_for("/post/view.php?id={$post['id']}") ?>">Read More &rarr;</a>
                    </section>
                </a>
            </article>
        <?php } ?>
    </div>
</main>

<?php include("../private/shared/public_footer.php") ?>