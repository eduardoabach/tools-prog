<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Atualizar Dados</title>
        <meta charset="utf-8">
        <link href="http://localhost/testeMoovin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
        <script src="http://localhost/testeMoovin/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="span 10 offset1">
                <div class="row"><br />
                    <h3><strong>Atualizar Dados</strong></h3>
                </div>

                <form class="form-horizontal" action="" method="post">
                    <div class="control-group">
                        <label class="control-label">Nome</label>
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
                        <button type="submit" class="btn btn-success">Atualizar</button>
                        <a class="btn btn-default" href="index.php">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>