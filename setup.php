<?php
// Rode UMA vez no navegador: http://localhost/descubra-signo/setup.php
// Cria a tabela "signos" e insere os 12 signos.
require_once 'db.php';
$pdo = conectar();

$pdo->exec("DROP TABLE IF EXISTS signos");
$pdo->exec("CREATE TABLE signos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    simbolo TEXT NOT NULL,
    inicio INTEGER NOT NULL,   -- mês*100 + dia (ex.: 21/03 = 321)
    fim INTEGER NOT NULL,
    periodo TEXT NOT NULL,
    elemento TEXT NOT NULL,
    planeta TEXT NOT NULL,
    cor TEXT NOT NULL,
    compatibilidade TEXT NOT NULL,
    caracteristicas TEXT NOT NULL,
    descricao TEXT NOT NULL
)");

$signos = [
 ['Áries','♈',321,419,'21/03 a 19/04','Fogo','Marte','Vermelho','Leão, Sagitário e Gêmeos','Corajoso, enérgico, impulsivo, competitivo','Ariano é pioneiro por natureza: gosta de começar coisas novas, enfrenta desafios de frente e tem energia de sobra. Às vezes precisa treinar a paciência.'],
 ['Touro','♉',420,520,'20/04 a 20/05','Terra','Vênus','Verde','Virgem, Capricórnio e Câncer','Paciente, leal, determinado, teimoso','Taurino valoriza estabilidade, conforto e os prazeres da vida. É persistente e confiável, mas pode ser bem teimoso quando decide algo.'],
 ['Gêmeos','♊',521,620,'21/05 a 20/06','Ar','Mercúrio','Amarelo','Libra, Aquário e Áries','Comunicativo, curioso, versátil, inquieto','Geminiano adora conversar, aprender e conhecer gente nova. É adaptável e inteligente, mas pode ter dificuldade de manter o foco.'],
 ['Câncer','♋',621,722,'21/06 a 22/07','Água','Lua','Prata','Escorpião, Peixes e Touro','Sensível, protetor, intuitivo, apegado','Canceriano é ligado à família e ao lar. Tem forte intuição e muito carinho pelos outros, mas pode se magoar com facilidade.'],
 ['Leão','♌',723,822,'23/07 a 22/08','Fogo','Sol','Dourado','Áries, Sagitário e Libra','Carismático, generoso, confiante, orgulhoso','Leonino brilha onde chega. É generoso, líder nato e adora ser reconhecido, mas precisa cuidar para o orgulho não falar mais alto.'],
 ['Virgem','♍',823,922,'23/08 a 22/09','Terra','Mercúrio','Azul-marinho','Touro, Capricórnio e Câncer','Organizado, analítico, prestativo, perfeccionista','Virginiano é detalhista e dedicado. Gosta de ordem e de ajudar, mas costuma ser muito crítico consigo mesmo.'],
 ['Libra','♎',923,1022,'23/09 a 22/10','Ar','Vênus','Rosa','Gêmeos, Aquário e Leão','Diplomático, justo, sociável, indeciso','Libriano busca equilíbrio e harmonia nas relações. É educado e justo, mas pode demorar para tomar decisões.'],
 ['Escorpião','♏',1023,1121,'23/10 a 21/11','Água','Plutão e Marte','Vinho','Câncer, Peixes e Virgem','Intenso, misterioso, determinado, ciumento','Escorpiano é profundo e apaixonado. Tem grande força de vontade e é muito leal, mas guarda mágoas por muito tempo.'],
 ['Sagitário','♐',1122,1221,'22/11 a 21/12','Fogo','Júpiter','Roxo','Áries, Leão e Aquário','Aventureiro, otimista, sincero, impaciente','Sagitariano ama liberdade, viagens e conhecimento. É otimista e honesto, às vezes até demais.'],
 ['Capricórnio','♑',1222,119,'22/12 a 19/01','Terra','Saturno','Marrom','Touro, Virgem e Escorpião','Disciplinado, ambicioso, responsável, reservado','Capricorniano é focado em objetivos e trabalha duro para alcançá-los. É maduro e confiável, mas pode ser rígido demais.'],
 ['Aquário','♒',120,218,'20/01 a 18/02','Ar','Urano e Saturno','Azul-turquesa','Gêmeos, Libra e Sagitário','Original, independente, humanitário, imprevisível','Aquariano pensa fora da caixa e valoriza a liberdade. É amigo de todos e cheio de ideias, mas pode parecer distante.'],
 ['Peixes','♓',219,320,'19/02 a 20/03','Água','Netuno e Júpiter','Verde-água','Câncer, Escorpião e Capricórnio','Sonhador, empático, artístico, distraído','Pisciano tem imaginação enorme e muita sensibilidade. É compreensivo e criativo, mas pode se perder em seu mundo de sonhos.'],
];

$stmt = $pdo->prepare("INSERT INTO signos
 (nome,simbolo,inicio,fim,periodo,elemento,planeta,cor,compatibilidade,caracteristicas,descricao)
 VALUES (?,?,?,?,?,?,?,?,?,?,?)");
foreach ($signos as $s) { $stmt->execute($s); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Setup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <div class="alert alert-success">Banco criado com sucesso! <?= count($signos) ?> signos inseridos.</div>
  <a class="btn btn-primary" href="index.php">Ir para a página inicial</a>
</body>
</html>
