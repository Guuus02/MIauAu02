<?php
include 'conexao.php';

// Obtém o ID do pet da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Busca os detalhes do animal e da ONG
$sql = "SELECT a.*, o.nome_ong, o.numero_ong FROM animais a JOIN ongs o ON a.ong_id = o.id WHERE a.id = $id";
$res = $conexao->query($sql);

if ($res->num_rows > 0) {
  $animal = $res->fetch_assoc();
} else {
  echo '<p>Animal não encontrado.</p>';
  exit;
}

// Busca todas as fotos do animal
$sqlFotos = "SELECT caminho_foto FROM fotos_animais WHERE animal_id = $id";
$resFotos = $conexao->query($sqlFotos);
$fotos = [];
if ($resFotos && $resFotos->num_rows > 0) {
  while ($foto = $resFotos->fetch_assoc()) {
    $fotos[] = $foto['caminho_foto'];
  }
}
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detalhes de <?php echo htmlspecialchars($animal['nome_animal']); ?></title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="pet-detail-page">
    <div class="pet-header">
      <button onclick="history.back()">←</button>
      <?php if (count($fotos) > 0): ?>
        <div class="carousel-container">
          <div class="carousel">
            <?php foreach ($fotos as $i => $foto): ?>
              <img src="<?php echo htmlspecialchars($foto); ?>" alt="<?php echo htmlspecialchars($animal['nome_animal']); ?>" class="pet-main-img<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>" />
            <?php endforeach; ?>
          </div>
          <!-- Setas removidas -->
        </div>
      <?php else: ?>
        <img src="uploads/teste.png" alt="Sem foto" class="pet-main-img" />
      <?php endif; ?>
    </div>

    <div class="pet-info-section">
      <h2><?php echo htmlspecialchars($animal['nome_animal']); ?></h2>
      <div class="pet-stats">
        <span>📛 <?php echo htmlspecialchars($animal['nome_animal']); ?></span>
        <span>📅 <?php echo htmlspecialchars($animal['idade']); ?> anos</span>
        <span>⚖️ <?php echo htmlspecialchars($animal['peso']); ?> kg</span>
        <span><?php echo (isset($animal['sexo']) && strtolower($animal['sexo']) === 'femea' ? '♀️ Fêmea' : (isset($animal['sexo']) ? '♂️ Macho' : '')); ?></span>
      </div>
      <div class="bio">
        <h3>Bio</h3>
        <p><?php echo htmlspecialchars($animal['descricao'] ?? 'Sem descrição.'); ?></p>
        <h3>ONG Responsável</h3>
        <p><strong><?php echo htmlspecialchars($animal['nome_ong']); ?></strong></p>
      </div>
      <button class="adopt-btn" onclick="window.open('https://wa.me/<?php echo preg_replace('/\D/', '', $animal['numero_ong']); ?>?text=<?php echo urlencode('Olá! Tenho interesse em adotar o pet ' . $animal['nome_animal'] . '. Poderia me passar mais informações?'); ?>','_blank')">ADOTAR</button>
    </div>
  </div>

  <script>
function miauPrev(e) {
  e.stopPropagation();
  const imgs = document.querySelectorAll('.carousel .pet-main-img');
  let idx = Array.from(imgs).findIndex(img => img.classList.contains('active'));
  imgs[idx].classList.remove('active');
  idx = (idx - 1 + imgs.length) % imgs.length;
  imgs[idx].classList.add('active');
}
function miauNext(e) {
  e.stopPropagation();
  const imgs = document.querySelectorAll('.carousel .pet-main-img');
  let idx = Array.from(imgs).findIndex(img => img.classList.contains('active'));
  imgs[idx].classList.remove('active');
  idx = (idx + 1) % imgs.length;
  imgs[idx].classList.add('active');
}
// Autoplay do carrossel
(function autoplayCarousel() {
  const imgs = document.querySelectorAll('.carousel .pet-main-img');
  if (imgs.length <= 1) return;
  setInterval(() => {
    let idx = Array.from(imgs).findIndex(img => img.classList.contains('active'));
    imgs[idx].classList.remove('active');
    idx = (idx + 1) % imgs.length;
    imgs[idx].classList.add('active');
  }, 6000); // 6 segundos
})();

// Avançar ao clicar na imagem do carrossel
const carouselImgs = document.querySelectorAll('.carousel .pet-main-img');
if (carouselImgs.length > 1) {
  carouselImgs.forEach(img => {
    img.style.cursor = 'pointer';
    img.addEventListener('click', function() {
      let idx = Array.from(carouselImgs).findIndex(i => i.classList.contains('active'));
      carouselImgs[idx].classList.remove('active');
      idx = (idx + 1) % carouselImgs.length;
      carouselImgs[idx].classList.add('active');
    });
  });
}
</script>
</body>
</html>