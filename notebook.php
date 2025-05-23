<?php
require_once("./conexao.php");
require_once("header.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Atendimento Ao Cliente</title>
</head>
<body>
<h1>Atendimento Para Celular</h1>
<?php
//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Verificar se o usuário clicou no botão
if (!empty($dados['CadUsuario'])) {
//var_dump($dados);

$empty_input = false;

$dados = array_map('trim', $dados);
if (in_array("", $dados)) {
$empty_input = true;
echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
} elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
$empty_input = true;
echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
}

if (!$empty_input) {
$query_usuario = "INSERT INTO notebook (nome, email, marca, modelo, numero1, contato) VALUES (:nome, :email, :marca, :modelo, :numero1, :contato) ";
$cad_usuario = $conn->prepare($query_usuario);
$cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
$cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
$cad_usuario->bindParam(':marca', $dados['marca'], PDO::PARAM_STR);
$cad_usuario->bindParam(':modelo', $dados['modelo'], PDO::PARAM_STR);
$cad_usuario->bindParam(':numero1', $dados['numero1'], PDO::PARAM_STR);
$cad_usuario->bindParam(':contato', $dados['contato'], PDO::PARAM_STR);


$cad_usuario->execute();
if ($cad_usuario->rowCount()) {
echo "<script language='javascript' type='text/javascript'>alert('Atendimento Registrado Com Sucesso');window.location.href='https://api.whatsapp.com/send?phone=5513996989366';</script>";
unset($dados);
} else {
echo "<p style='color: #f00;'>Erro: Atendimento não Registrado , Houve Um Erro</p>";
}
}
}
?>
<form name="cad-usuario" method="POST" action="">
<label>Nome: </label>
<input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
if (isset($dados['nome'])) {
echo $dados['nome'];
}
?>"><br><br>
<label>E-mail: </label>
<input type="email" name="email" id="email" placeholder="Seu melhor e-mail" value="<?php
if (isset($dados['email'])) {
echo $dados['email'];
}
?>"><br><br>
<label>Numero De contato: </label>
<input type="contato" name="contato" id="contato" placeholder="Seu Numero De Contato" value="<?php
if (isset($dados['contato'])) {
echo $dados['contato'];
}
?>"><br><br>
<br/>
<label for="estado">Selecione a Marca Do Aparelho: </label>
<select type="modelo" name="modelo" value="<?php
if (isset($dados['modelo'])) {
echo $dados['modelo'];
}
?>">
<option value=""> Selecione o modelo: </option>
<option value=""> Selecione a Marca Do Notebook: </option>
<option value="Asus Vivobook 15 X1500EA-EJ3669"> Asus Vivobook 15 X1500EA-EJ3669 </option>
<option value="Samsung Book NP550XDA-KV3BR"> Samsung Book NP550XDA-KV3BR </option>
<option value="Samsung Galaxy Book GO NP340XLA-K06BR"> Samsung Galaxy Book GO NP340XLA-K06BR </option>
<option value="Lenovo IdeaPad 3 82MFS00100">Lenovo IdeaPad 3 82MFS00100</option>
<option value="Acer Aspire 5 A514-54-789C"> Acer Aspire 5 A514-54-789C</option>
<option value="Dell Latitude 3420"> Dell Latitude 3420</option>
<option value="Samsung Galaxy Book 2"> Samsung Galaxy Book 2 </option>
<option value="Outro Modelo">Outro Modelo (Não Descrito)</option>
</select> 
<br/>
<label for="estado">Selecione o Marca Do Aparelho: </label>
<select type="marca" name="marca" value="<?php
if (isset($dados['marca'])) {
echo $dados['marca'];
}
?>">
<option value=""> Selecione o Marca Do Aparelho: </option>
<option value=""> Selecione a Marca Do Notebook: </option>
<option value="Dell"> Dell</option>
<option value="Acer"> Acer</option>
<option value="Asus"> Asus </option>
<option value="LG"> LG </option>
<option value="HP"> HP</option>
<option value="Apple"> Apple</option>
<option value="Lenovo"> Lenovo </option>
<option value="Avell"> Avell</option>
<option value="Vaio"> Vaio</option>
</select> 
<br/>
<label for="estado">Selecione Seu Problema No Aparelho: </label>
<select type="numero1" name="numero1" value="<?php
if (isset($dados['numero1'])) {
echo $dados['numero1'];
}
?>">
<option value=""> Selecione o Problema Do Aparelho: </option>
<option value="Travamento De Bios (Com Senha)"> Travamento De Bios (Com Senha)</option>
<option value="Aparelho com tela quebrada"> Aparelho com tela quebrada</option>
<option value="Inicia , Mas Não inicia a tela"> Inicia , Mas Não inicia a tela </option>
<option value="Problema No HD"> Problema No HD</option>
<option value="Problema Na Memoria Ram"> Problema Na Memoria Ram</option>
<option value="Problema Com a camera"> Problema Com a Camera</option>
<option value="Problema Na Entrada de Carregamento"> Problema Na Entrada de Carregamento</option>
<option value="Problema Na Entrada Usb"> Problema Na Entrada Usb</option>
<option value="Problema Na Carcassa"> Problema na Carcassa</option>
<option value="Problema No Auto falante"> Problema No Auto Falante</option>
<option value="Problema No Audio ou Drivers"> Problema No Audio ou Drivers</option>
<option value="Problema No Windows/ Mac / linux "> Problema No Windows/ Mac / linux</option>
<option value="Problema No Processador e Troca De Pasta Térmica"> Problema No Processador e Troca De Pasta Térmica</option>
</select> 
<br/>
<br/>
<input type="submit" value=" Finalizar   " placeholder =" Finalizar Cadastro  " name="CadUsuario">
</form>

<br/>
<br/>

<?php require_once("rodape.php");?>
</body>
</html>
