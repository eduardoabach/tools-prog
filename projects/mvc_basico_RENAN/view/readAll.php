<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <title>CRUD App </title>
    </head>
    <body>
        <div class="container">
            <div class="row"><br />
                <h1><strong><a href="index.php"> CRUD </a></strong></h1><br />
            </div>

            <div class="row">
                <p>
                    <a href="index.php?op=novo" class="btn btn-success">Novo</a>
                </p>	
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php foreach ($dados as $dado) : ?>						
                            <tr>
                                <td><?php echo htmlentities($dado->nome); ?></td>
                                <td><?php echo htmlentities($dado->email); ?></td>
                                <td><?php echo htmlentities($dado->telefone); ?></td>
                                <td>
                                    <a class="btn btn-info" href="index.php?op=listar&id=<?php echo $dado->id; ?>">Visualizar</a>
                                    <a class="btn btn-success" href="index.php?op=editar&id=<?php echo $dado->id; ?>">Atualizar</a>
                                    <a class="btn btn-danger" href="index.php?op=deletar&id=<?php echo $dado->id; ?>">Deletar</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

