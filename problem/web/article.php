<?php

try {
    $pdo = new PDO('mysql:host=dbtest;charset=utf8;dbname=blogger', 'root', 'root');
} catch (PDOException $e) {
    echo "Une erreur c'est produite";
    http_response_code(500);
    exit(1);
}

$articleID = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($articleID === null) {
    header('Location: articles.php');
}

$sql = 'SELECT a.article_id, a.title, a.teaser, a.content, a.status, c.category_id, c.name
FROM article AS a
LEFT JOIN article_has_category AS ac
    ON a.article_id = ac.article_id
LEFT JOIN category AS c
    ON ac.category_id = c.category_id
WHERE a.article_id = ' . $articleID . ' AND a.status = 1';

$configAggregate = [
    'columns' => [
        'category_id',
        'name',
    ],
    'alias' => 'categories',
    'groupBy' => 'article_id',
];

require './lib/array.php';
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$article = array_aggregate($data, $configAggregate);

$sql = 'SELECT c.comment_id, c.content, c.created_at, c.updated_at, c.user_id, u.username
        FROM comment AS c
        JOIN user AS u
            ON c.user_id = u.user_id
        WHERE c.is_activated = 1 AND c.article_id = ' . $articleID;

$comments = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger - Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-dark text-light">

    <main class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($article as $row) : ?>
                        <article class="mb-5">
                            <h2><?= $row['title']; ?></h2>
                            <p class="text-secondary"><?= $row['teaser']; ?></p>

                            <p><?= $row['content'] ?></p>

                            <div>
                                <?php foreach ($row['categories'] as $cat) : ?>
                                    <a href="articles.php?category=<?= $cat['category_id'] ?>" class="btn btn-sm bg-warning text-dark">
                                        <span><?= $cat['name']; ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="row">
                    <h3 class="mb-4">Comments</h3>

                    <?php if (count($comments) > 0) : ?>
                        <?php foreach ($comments as $comment) : ?>
                            <div class="pt-1 pb-1">
                                <span class="text-warning"><?= ucfirst($comment['username']) ?></span>
                                <small class="text-muted">, le <?= (new Datetime($comment['created_at']))->format('d/m/Y') ?></small>
                            </div>
                            <div class="mb-3"><?= $comment['content'] ?></div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="mb-4">Devenez le premier à commenter cet article !</p>
                    <?php endif; ?>
                </div>

                <div class="row mt-4">
                    <hr>

                    <h3>Add comment</h3>

                    <form method="POST">
                        <div class="form-group">
                            <textarea class="form-control bg-dark text-light border border-secondary" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success">Send</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            $sql = 'SELECT a.status, c.category_id, c.name
                    FROM category AS c
                    JOIN article_has_category AS ac
                        ON c.category_id = ac.category_id
                    JOIN article AS a
                        ON ac.article_id = a.article_id
                    WHERE a.status = 1';
            ?>
            <div class="col-md-4">
                <h3>Categories</h3>
                <div>
                    <?php foreach ($pdo->query($sql) as $row) : ?>
                        <a href="articles.php?category=<?= $row['category_id'] ?>"><span class="badge bg-dark text-warning"><?= $row['name']; ?></span></a>
                    <?php endforeach; ?>
                    <a href="articles.php">
                        <span class="badge bg-dark text-warning">Toutes</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>

</html>