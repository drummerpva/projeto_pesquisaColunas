<?php
try{
    $pdo = new PDO("mysql:dbname=projeto_pesquisacolunas;host=localhost","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erro: ".$ex->getMessage());
}
?>
<h1>Digite Email ou CPF do usuários</h1>
<form method="POST">
    <input type="text" name="campo" required placeholder="Consultar..."/><br/><br/>
    <input type="submit" value="Pesquisar"/>
</form>
<hr/>
<?php
if(!empty($_POST['campo'])){
    $campo = addslashes($_POST['campo']);
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE (email like :email) OR (cpf like :cpf) OR (nome like :nome)");
    $sql->bindValue(":email", $campo);
    $sql->bindValue(":cpf", $campo);
    $sql->bindValue(":nome", $campo);
    $sql->execute();
    if($sql->rowCount() > 0){
        foreach($sql->fetchAll() as $usuario){
            echo $usuario['nome']."<hr/>";
        }
    }
    
}

?>