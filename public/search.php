<?php 
    include("../private/initialize.php");
    require_once (SHARED_PATH . '/public_header.php');

    $search_query = htmlspecialchars($_GET['search']);
    $search_result = search_post($search_query);
?>
<main>
    <div class="posts-container">
        <?php while($post = mysqli_fetch_assoc($search_result)){ ?>
            <article class="post">
                <a href="<?php echo url_for("/post/view.php?id={$post['id']}")?>">
                    <img class="post-img" src="<?php echo url_for("/post/uploads/{$post['post_thumbnail']}") ?>" alt="">
                    <section class="post-details">
                        <p class="post-date"><?php echo htmlspecialchars($post['publish_date']); ?></p>
                        <h2 class="post-title"><?php echo htmlspecialchars($post['post_title']); ?></h2>
                        <p class="post-excerpt"><?php echo htmlspecialchars($post['post_excerpt']); ?></p>
                        <a class="readmore-btn" role="button" href="<?php echo url_for("/post/view.php?id={$post['id']}") ?>">Read More &rarr;</a>
                    </section>
                </a>
            </article>
        <?php } ?>
    </div>
</main>

<?php 
    require_once(SHARED_PATH . '/public_footer.php');
?>