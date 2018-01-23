<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Crud App</title>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="span 10 offset1">
                <div class="row">
                    <h3><strong>Deletar Contato</strong></h3>
                </div>

                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlentities($dados->nome); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input type="text" name="email" placeholder="Email" value="<?php echo htmlentities($dados->email); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input type="text" name="telefone" placeholder="Telefone" value="<?php echo htmlentities($dados->telefone); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <input type="hidden" name="form-submitted" value="1">
                        <button type="submit" class="btn btn-danger">Deletar</button>
                        <a class="btn btn-default" href="index.php">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>