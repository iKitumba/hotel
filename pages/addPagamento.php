<?php
require(__DIR__ . "/../actions/conexao.php");
session_start();

if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
} else {
  echo "<script>window.location = `../login.php`</script>";
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/ihotel-icon.svg" type="image/svg+xml">
  <title>Cadastrar pagamentos</title>
</head>

<body>

  <pre>
    <?php
    $id_reserva = $_GET['id_reserva'];
    $fecthDadosReserva = $conexao->prepare("SELECT reservas.id AS id_reserva, reservas.codigo AS codigo_reserva, reservas.data_entrada, reservas.data_saida, reservas.status, hospedes.id AS id_hospede, hospedes.nome, hospedes.contacto, quartos.id AS id_quarto, quartos.numero, tipos_quartos.id AS id_tipo_quarto, tipos_quartos.titulo, tipos_quartos.valor_por_noite FROM reservas JOIN hospedes ON reservas.hospede_id = hospedes.id JOIN quartos ON reservas.quarto_id = quartos.id JOIN tipos_quartos ON quartos.tipo_quarto = tipos_quartos.id WHERE reservas.id = ?");
    $fecthDadosReserva->execute(array($id_reserva));
    $reserva = $fecthDadosReserva->fetchAll(PDO::FETCH_ASSOC)[0];
    print_r($reserva);

    $dataEnParsed = new DateTime($reserva['data_entrada']);
    $dataSaParsed = new DateTime($reserva['data_saida']);

    $diference = date_diff($dataSaParsed, $dataSaParsed, true);
    print_r($diference);
    ?>
  </pre>
  <form action="">
    <h1>Cadastrando pagamento</h1>
    <input type="text" value="<?php echo $reserva['valor_por_noite'] ?>" readonly>
    <input type="text" id="totalPagar" readonly>
  </form>

  <pre>
  Nome Completo -> Lorem Ipsum
Contacto -> 924439071
Número do Quarto -> 10
Data de Entrada -> 10-12-2022
Data de Saída -> 13-12-2022

Noites -> 3

Preço por noites -> 1000,00
Total a pagar -> 3000,00

Pago aos

Comprovado por -> Imtatic
  </pre>

  <script>
    const data_entrada = new Date(<?php echo $reserva['data_entrada'] ?>);
    const data_saida = new Date(<?php echo $reserva['data_saida'] ?>);
    const d_en_nu = Number(data_entrada);
    const d_sa_nu = Number(data_saida);
    const totPag = document.getElementById('totalPagar');

    var millSeEn = data_entrada.getTime();
    var millSeSa = data_saida.getTime();

    console.log({
      d_en_nu,
      d_sa_nu
    });

    var resDates = millSeSa - millSeEn;

    totPag.value = resDates * 20000;

    console.log({
      millSeEn,
      millSeSa,
      resDates,
      totalPagar
    });
  </script>
</body>

</html>