<?php
require_once 'db.php';

// 1) Só aceita envio do formulário
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['nascimento'])) {
    header('Location: index.php?erro=' . urlencode('Informe sua data de nascimento.'));
    exit;
}

// 2) Valida a data
$data = DateTime::createFromFormat('Y-m-d', $_POST['nascimento']);
$valida = $data && $data->format('Y-m-d') === $_POST['nascimento'];
if (!$valida || $data > new DateTime()) {
    header('Location: index.php?erro=' . urlencode('Data inválida. Tente novamente.'));
    exit;
}

// 3) Calcula mês*100+dia e busca o signo no SQLite
$md = (int)$data->format('n') * 100 + (int)$data->format('j');

try {
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT * FROM signos
        WHERE (inicio <= fim AND :md BETWEEN inicio AND fim)
           OR (inicio >  fim AND (:md >= inicio OR :md <= fim))
        LIMIT 1");
    $stmt->execute([':md' => $md]);
    $signo = $stmt->fetch();
} catch (Exception $e) {
    die('Erro no banco de dados. Você já rodou o setup.php?');
}

if (!$signo) {
    header('Location: index.php?erro=' . urlencode('Não foi possível encontrar o signo.'));
    exit;
}

$h = fn($t) => htmlspecialchars($t);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Seu signo: <?= $h($signo['nome']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="estrelas"></div>

  <main class="container py-5">
    <div class="card cartao-signo mx-auto p-4 p-md-5">
      <div class="text-center mb-4">
        <div class="simbolo-grande"><?= $signo['simbolo'] ?></div>
        <p class="mb-1 text-light-emphasis">Nascido em <?= $data->format('d/m/Y') ?>, seu signo é</p>
        <h1 class="titulo"><?= $h($signo['nome']) ?></h1>
        <span class="badge selo"><?= $h($signo['periodo']) ?></span>
      </div>

      <p class="lead text-center mb-4"><?= $h($signo['descricao']) ?></p>

      <div class="row g-3 mb-4">
        <div class="col-6 col-md-3"><div class="info"><small>Elemento</small><strong><?= $h($signo['elemento']) ?></strong></div></div>
        <div class="col-6 col-md-3"><div class="info"><small>Planeta regente</small><strong><?= $h($signo['planeta']) ?></strong></div></div>
        <div class="col-6 col-md-3"><div class="info"><small>Cor</small><strong><?= $h($signo['cor']) ?></strong></div></div>
        <div class="col-6 col-md-3"><div class="info"><small>Compatível com</small><strong><?= $h($signo['compatibilidade']) ?></strong></div></div>
      </div>

      <h2 class="h5">Principais características</h2>
      <p>
        <?php foreach (explode(',', $signo['caracteristicas']) as $c): ?>
          <span class="badge selo me-1 mb-1"><?= $h(trim($c)) ?></span>
        <?php endforeach; ?>
      </p>

      <a href="index.php" class="btn btn-estrela btn-lg mt-3 w-100">← Consultar outra data</a>
    </div>
  </main>
</body>
</html>
