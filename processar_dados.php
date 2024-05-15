<?php

//Recebendo dados do formulário
$name = $_POST ['name'];
$email = $_POST ['email'];
$phone = $_POST ['phone'];
$message = $_POST ['message'];
$data_atual = date('d/m/Y');
$hora_atual = date('H:i:s');

//Configurando credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario_portfolio';

//Conectando banco de dados
$conn = new mysqli($server, $usuario, $senha, $banco);


//Verificando conexão
if($conn->connect_error){
    die("Falha ao se comunicar com banco de dados: ".$conn->connect_error);
}

$smtp = $conn->prepare("INSERT INTO mensagens (nome, email, telefone, mensagem, data, hora) VALUES (?, ?, ?, ?, ?, ?)");
$smtp->bind_param("ssisss", $name, $email, $phone, $message, $data_atual, $hora_atual);

if($smtp->execute()){
    echo "Mensagem enviada com sucesso!";

}else{
    echo "Erro no envio da mensagem: ".$smtp->error;
}

$smtp->close();
$conn->close();

?>
