<!-- cross site script -->

<?php
    $nome = 'campoTeste" /> <script>alert(teste);</script>';

?>

<!-- addslashes Escapa as aspas -->
<imput type="text" name="<?= addslashes($nome) ?>" />


<?= PHP_EOL . '-------------------------------------------------' . PHP_EOL ?>

<!-- htmlentities encoda html -->
<imput type="text" name="<?= htmlentities($nome) ?>" />
<?= PHP_EOL . '-------------------------------------------------' . PHP_EOL ?>




<!--
// com o prepare a conexão de banco já protege de algumas coisas
$stm = $conn->prepare('INSERT INTO depoimentos (depoimento) value (?);
$stm->bindValue(1, $depoimento);
$stm->execute();


ao invés de usar $_POST ou $_GET use:
$_POST -> filter_input(INPUT_POST, 'depoimento', FILTER_SANITIZE_STRING)

FILTER_SANITIZE_STRING -> remove tags e muda as aspas



-->

