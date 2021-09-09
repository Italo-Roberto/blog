<?php
//Armazenando sessão em cookie durante uma hora
$sessao = time()+3600;
session_start();
setcookie($sessao);

include_once('control/list.php');
include_once('templates/header.php');
error_reporting(0);
?>

<div class="w-50 d-flex my-2 mx-auto">
    <div class="card w-75 p-3 mx-auto my-2 border-0 shadow-sm">
        <h1>Postagens</h1>
        <? if(!isset($_SESSION['user'])) { ?>
            <div class="d-flex">
                <a href="login.php" class="btn btn-success shadow-sm m-2">Login</a>
            </div>
        <? } else { ?>
            <!-- Button trigger modal -->
            <div class="d-flex">
                <button type="button" class="btn btn-primary shadow-sm m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Novo Post
                </button>
                <a href="logout.php" class="btn btn-danger shadow-sm m-2">Sair</a>
            </div>
        <? } ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">Escrever Postagem</h5>
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./control/create.php" method="post">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Título">
                        </div><br>
                        <input type="hidden" name="author" value="<?= $_SESSION['user'] ?>">
                        <div class="form-group">
                            <textarea id="content" name="body" class="form-control" placeholder="Conteúdo"></textarea>
                        </div><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Postar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="d-flex flex-wrap p-2 my-2 mx-auto justify-content-center">
    <?php foreach ($posts as $post) { ?>
        <div class="card w-25 shadow-sm border-0 m-1">
            <div class="card-header">
                <h3><?= $post['title']; ?></h3>
            </div>
            <div class="card-body">
                <div><?= $post['body']; ?></div><br>
                <p class="text-muted">Autor: <?= $post['author']; ?></p>
                <hr>
                <div class="d-flex">
                    <? if ($_SESSION['user']) : ?>
                        <button class="btn btn-warning m-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $post['id'] ?>">Editar</button>
                        <form action="./control/delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <button id="delete" type="submit" class="btn btn-danger m-1 shadow-sm">Excluir</button>
                        </form>
                    <? endif; ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit<?= $post['id'] ?>" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="edit">Editar Postagem</h5>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./control/update.php" method="post">
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" value="<?= $post['title']; ?>">
                            </div><br>
                            <div class="form-group">
                                <input type="text" name="author" class="form-control" value="<?= $post['author']; ?>">
                            </div><br>
                            <div class="form-group">
                                <textarea id="content" name="body" class="form-control"><?= $post['body']; ?></textarea>
                            </div><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success shadow-sm">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>


</div>

<?php
include_once('templates/footer.php');
?>