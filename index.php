MESTRE

<?php
// abre sessao no navegador
session_start();

// incluir arquivo de configuracao
require_once('include/config.php');

// incluir o arquivo de conexao
require_once('include/conn.php');

// inicializa a mensagem de erro, caso exista para escrever no form
$msg = "";

#LOGIN
// recebe as informacoes de login
if(isset($_POST['email']) && isset($_POST['senha'])) {

  // atribui posts em variaveis
  $email = trim($_POST['email']); // trim() tira os espaï¿½os
  $senha   = trim($_POST['senha']);

  // VERIFICACOES
  // se usuario e senha existe e tem pelo menos 6 caracteres
  if((isset($email[5])) && (isset($senha[4]))){

    // o sql
    $sql = "SELECT * FROM fornecedor WHERE email = '".$email."'";
    // executa o sql
    $query = mysql_query($sql);
    // conta quantos registros retornaram
    $registros = mysql_num_rows($query);
    
    // verifica se retornou um usuario
    if($registros == 1) {
    // ï¿½ pq o usuario existe
      $sql = "SELECT * FROM fornecedor WHERE senha = '".md5($senha)."' AND email = '".$email."'";
      echo $sql;
      $query = mysql_query($sql);
      // conta quantos registros retornaram
      $registros = mysql_num_rows($query);

      if($registros == 1) {
      // usuario e senha conferem
      // criar sessao de usuario logado
        $_SESSION['autenticado'] = "bender";

        // pega o ID que foi autenticado
        $rs = mysql_fetch_array($query);
        $_SESSION['idFornecedor'] = $rs['id'];

        echo '<br>'.$_SESSION['autenticado'];
        // redireciona para a pagina de listagem
        header('Location: logado.php');


      } else {
      // ï¿½ pq o usuario e senha NAO conferem
        $msg .= "<br>Dados nao conferem";
      }

    } else {
    // ï¿½ pq o usuario NAO existe
      $msg .= "<br>Dados nao conferem";
    }

  } else {
    $msg .= "<br>Usuario e senha devem possuir pelo menos 5 caracteres!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="iso-8859-1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?=TITULO?></title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      < src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></>
      < src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></>
      <![endif]-->
    </head>
    <body>

      <?=$msg?>

      <h1>Autenticacao de usuario</h1>
      <form name="autenticacao" method="post" action="#">

        <label for="email">Email</label> <br>
        <input type="text" name="email" id="email"> <br><br>

        <label for="senha">Senha</label> <br>
        <input type="password" name="senha" id="senha"> <br><br>

        <input type="submit" name="logar" value="logar">

      </form>


      <div class="row">
        <div class="col-xs- col-sm- col-md-3 col-lg-3 logo_index">
          <img src="images/logo1_trasparente2.png">
        </div>
        <div class="col-xs- col-sm- col-md-3 col-lg-3"></div>
<!-- 
        <div class="col-xs- col-sm- col-md-6 col-lg-6 login_index">
          <form name="logar" action="#" method="POST">
            <input type="text" name="email" id="email" placeholder="Insira seu e-mail">
            <input type="password" name="senha" id="senha">
            <input type="submit" name="logar" value="login">
          </form>
        </div>
      </div> -->

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 busca_index">
          <form name="buscarFornecedor" action="listarFornecedores.php" method="GET">
            <label for="termo"><h4>Procurar Fornecedor:</h4></label>
            <input type="text" name="termo" id="termo">
            <input type="submit" name="buscar" value="buscar">
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 conteudo_index">
          <div class="video_index"> O vídeo vai aqui</div>
        </div>
      </div>

      <div class="row">
        <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
         <div class="menu_index"> 

          <div class="escolha_index">
           <a href="#">Entrar</a>
         </div>
         <div class="escolha_index">
          <a href="cadastroFornecedor.php">Cadastrar</a> 
        </div>
        <div class="escolha_index">
          <a href="listaFornecedores.php">Fornecedores</a>
        </div>
        <div class="escolha_index">
          <a href="aUpFileDown.php">Fale Conosco</a>
        </div>
      </div>
    </div>
  </div>
  <div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
  <?php
// incluir arquivo do rodape
  require_once('include/footer.php');
  ?>
