<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MiauAu</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="logo">
      <img src="./uploads/teste.png" alt="Logo do site" onclick="location.reload()" style="cursor: pointer;" />
    </div>
  </header>

  <div class="search-section">
    <input type="text" placeholder="Pesquisar..." />
    <!-- Botão de pesquisa removido -->
  </div>

  <section class="categories">
    <h3>Categorias de Animais</h3>
    <div class="category-buttons">
      <?php
        $sqlTipos = "SELECT DISTINCT tipo FROM animais ORDER BY tipo";
        $resTipos = $conexao->query($sqlTipos);
        if ($resTipos->num_rows > 0) {
          while ($tipo = $resTipos->fetch_assoc()) {
            echo '<button onclick="filtrarCategoria(\'' . htmlspecialchars($tipo['tipo']) . '\')">' . htmlspecialchars(ucfirst($tipo['tipo'])) . '</button>';
          }
        } else {
          echo '<p>Nenhuma categoria disponível.</p>';
        }
      ?>
    </div>
  </section>

  <section class="pet-list">
    <h3>Adote um Amigo</h3>
    <div class="pet-cards" id="pet-cards">
      <?php
        $sql = "SELECT a.*, o.nome_ong FROM animais a JOIN ongs o ON a.ong_id = o.id";
        $res = $conexao->query($sql);

        if ($res->num_rows > 0) {
          while ($pet = $res->fetch_assoc()) {
            // Buscar a primeira foto do animal
            $foto = 'uploads/teste.png'; // padrão caso não tenha foto
            $id_animal = $pet['id'];
            $sqlFoto = "SELECT caminho_foto FROM fotos_animais WHERE animal_id = $id_animal LIMIT 1";
            $resFoto = $conexao->query($sqlFoto);
            if ($resFoto && $resFoto->num_rows > 0) {
              $fotoRow = $resFoto->fetch_assoc();
              $foto = htmlspecialchars($fotoRow['caminho_foto']);
            }
            echo '<div class="pet-card" data-tipo="' . htmlspecialchars($pet['tipo']) . '" onclick="window.location.href=\'pet.php?id=' . htmlspecialchars($pet['id']) . '\'">';
            echo '<img src="' . $foto . '" alt="Imagem de ' . htmlspecialchars($pet['nome_animal']) . '" loading="lazy" />';
            echo '<div class="pet-info">';
            echo '<h4>' . htmlspecialchars($pet['nome_animal']) . '</h4>';
            echo '<p>' . htmlspecialchars($pet['idade']) . ' anos</p>';
            echo '<p>' . (isset($pet['sexo']) ? (ucfirst($pet['sexo']) === 'Femea' ? 'Fêmea' : ucfirst($pet['sexo'])) : '') . '</p>';
            echo '</div></div>';
          }
        } else {
          echo '<p>Nenhum animal disponível para adoção no momento.</p>';
        }
      ?>
    </div>
  </section>

  <script src="script.js"></script>
</body>
</html>