<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Animal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Cadastrar Novo Animal</h2>

  <form action="cadastrar.php" method="POST" enctype="multipart/form-data">
    <label>Número da ONG (WhatsApp):</label><br>
    <input type="text" name="numero_ong" pattern="\+55\d{10,11}" placeholder="+5599999999999" required><br><br>

    <label>Nome da ONG:</label><br>
    <input type="text" name="nome_ong" required><br><br>

    <label>Nome do Animal:</label><br>
    <input type="text" name="nome_animal" required><br><br>

    <label>Peso (kg):</label><br>
    <input type="number" name="peso" step="0.01" required><br><br>

    <label>Descrição (bio):</label><br>
    <textarea name="descricao" rows="4" required></textarea><br><br>

    <label>Idade (anos):</label><br>
    <input type="number" name="idade" required><br><br>

    <label>Tipo do Animal:</label><br>
    <select name="tipo" required>
      <option value="cachorro">Cachorro</option>
      <option value="gato">Gato</option>
      <option value="passaro">Pássaro</option>
      <option value="coelho">Coelho</option>
    </select><br><br>

    <label>Sexo:</label><br>
    <select name="sexo" required>
      <option value="macho">Macho</option>
      <option value="femea">Fêmea</option>
    </select><br><br>

    <label>Fotos do Animal:</label><br>
    <input type="file" name="fotos[]" accept="image/*" multiple required><br><br>

    <button type="submit">Cadastrar Animal</button>
  </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_ong = $_POST['numero_ong'];
    if (strpos($numero_ong, '+55') !== 0) {
        echo "<p style='color:red;'>O número da ONG deve começar com +55 (código do Brasil).</p>";
        exit;
    }
    $nome_ong = $_POST['nome_ong'];
    $nome_animal = $_POST['nome_animal'];
    $peso = $_POST['peso'];
    $descricao = $_POST['descricao'];
    $idade = $_POST['idade'];
    $tipo = $_POST['tipo'];
    $sexo = $_POST['sexo'];

    // Verifica se a ONG já existe
    $sqlOng = "SELECT id FROM ongs WHERE numero_ong = '$numero_ong' AND nome_ong = '$nome_ong'";
    $resOng = $conexao->query($sqlOng);
    if ($resOng->num_rows > 0) {
        $ong = $resOng->fetch_assoc();
        $ong_id = $ong['id'];
    } else {
        $conexao->query("INSERT INTO ongs (numero_ong, nome_ong) VALUES ('$numero_ong', '$nome_ong')");
        $ong_id = $conexao->insert_id;
    }

    // Cadastra o animal
    $sqlAnimal = "INSERT INTO animais (ong_id, nome_animal, peso, descricao, idade, tipo, sexo) VALUES ($ong_id, '$nome_animal', $peso, '$descricao', $idade, '$tipo', '$sexo')";
    if ($conexao->query($sqlAnimal) === TRUE) {
        $animal_id = $conexao->insert_id;
        // Upload das fotos
        $total = count($_FILES['fotos']['name']);
        $sucesso = true;
        for ($i = 0; $i < $total; $i++) {
            $nomeFoto = basename($_FILES['fotos']['name'][$i]);
            $tmpFoto = $_FILES['fotos']['tmp_name'][$i];
            $destino = "uploads/" . uniqid() . "_" . $nomeFoto;
            if (move_uploaded_file($tmpFoto, $destino)) {
                $conexao->query("INSERT INTO fotos_animais (animal_id, caminho_foto) VALUES ($animal_id, '$destino')");
            } else {
                $sucesso = false;
            }
        }
        if ($sucesso) {
            echo "<p style='color:green;'>Animal cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color:orange;'>Animal cadastrado, mas houve erro ao enviar uma ou mais fotos.</p>";
        }
    } else {
        echo "<p style='color:red;'>Erro ao cadastrar animal: " . $conexao->error . "</p>";
    }
}
?>
</body>
</html>