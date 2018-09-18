<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Dados Contato</title>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="span10 offset 1">
                <div class="row"><br />
                    <h3><strong>Dados do Contato</strong></h3>
                </div>

                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $dados->nome; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Email:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $dados->email; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Telefone:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $dados->telefone; ?>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <a class="btn btn-default" href="index.php">Voltar</a>
                    </div>
                </div>
            </div>
    </body>
</html>