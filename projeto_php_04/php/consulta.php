<?php
        /*  isset verifica se existe algum dado no campo, $_POST ou $_GET é método de envio e reserva a  variavel ["codigo" dos inputs ];*/
        if (isset($_POST['codigo']) && !empty($_POST['codigo'])) {
        /*   empty verifica de se o campo é vazia, exclamação '!' com !empty nega um campo vazio;*/

        /*   addslashes vai armazenar o valor em uma variavel e qualquer tipo de dado;*/
        $num_pesq=addslashes($_POST['codigo']);

        $dsn="mysql:dbname=turma_0096;host=localhost";
        $dbuser="root";
        $dbpass="";

            /*   try irá conectar ao banco de dados, senao irá retornar um erro;*/
        try {
            /*   PDO criando um objeto com as variaveis declaradas ($dsn, $dbuser, $dbpass);*/
            $db=new PDO($dsn, $dbuser, $dbpass);

            $sql=$db->query("SELECT * FROM tb_relacao WHERE id='$num_pesq'");
            
    
            /*   rowCount() irá contar o numero de linhas afetadas pelo valor digitado pelo usuario; vai buscar na tabela valor que usuário informou*/
            if ($sql->rowCount() > 0) {
            /*   foreach() irá organizar uma array; fazer uma lista com os reultados encontrados pelo rowCount, fazer uma array */
                foreach($sql->fetchALL() as $dados_tabela) {
            /*   fetchALL() pega toda array e joga a array dentro da variavel;*/

                }
            }
            else {
                echo 'nao existe usuário cadastrado com esse codigo';
            }
        }
        /*   PDOException irá apresentar o erro caso tiver;*/
        /*   catch() junta a mensagem entre aspas e o $erro;*/
        catch(PDOException $erro) {
            echo 'Erro ao conectar ao Banco de Dados: '.$erro->getMessage();/*   getMessage mensagem de erro.*/
        }
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/formestilo.css">
        <title>Consulta</title>
    </head>

    <body>
        
        <div class="container">

            <form action="consulta.php" method="post" name="consulta">

                <fieldset>
                    <legend>Consulte Aqui!</legend>
    
                    <label for="busca">
                        Digite aqui sua busca:
                    </label>
                    <input type="search" name="codigo" placeholder="Digite para Buscar" class="box">
                    <p>
                        <input type="submit" >
                    </p>
                    
                </fieldset>
            </form>
    
            <fieldset class="resultado">
                <legend>Resultado da busca</legend>
    
                <label for="id">
                    ID:
                </label>
                <input type="text" name="result_id" disabled class="box" value= <?php echo @$dados_tabela["ID"]; ?> >
    
                <p>
                    <label for="email">
                        email:
                    </label>
                    <input type="email" name="result_email" disabled class="box" value= <?php echo @$dados_tabela["email"]; ?> >
        
                </p>
                
                <p>
                    <label for="senha">
                       Senha:
                    </label>
                    <input type="text" name="result_senha" disabled class="box" value= <?php echo @$dados_tabela["senha"]; ?>>
        
                </p>
                
            </fieldset>
    
        </div>    

        
    </body>
</html>