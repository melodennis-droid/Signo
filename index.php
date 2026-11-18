<?php
$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Descubra o seu signo!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="estrelas"></div>

  <main class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card cartao-signo text-center p-4 p-md-5">
      <div class="simbolos mb-3">♈ ♉ ♊ ♋ ♌ ♍ ♎ ♏ ♐ ♑ ♒ ♓</div>
      <h1 class="titulo mb-2">Descubra o seu signo!</h1>
      <p class="text-light-emphasis mb-4">Informe sua data de nascimento e veja o que as estrelas dizem sobre você.</p>

      <?php if ($erro): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="resultado.php" method="post">
        <div class="mb-4 text-start">
          <label for="nascimento" class="form-label">Data de nascimento</label>
          <input type="date" class="form-control form-control-lg" id="nascimento"
                 name="nascimento" max="<?= date('Y-m-d') ?>" required>
        </div>
        <button type="submit" class="btn btn-estrela btn-lg w-100">Descobrir meu signo ✨</button>
      </form>
    </div>
  </main>
</body>
</html>
