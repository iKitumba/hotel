<?php
require(__DIR__ . "/../actions/conexao.php");
?>

<section id="servicosPage">
  <header>
    <div>
      <h1>Serviços</h1>
      <h3>Listagem completa dos serviços</h3>
    </div>
    <button class="addServicoButton">+</button>
  </header>

  <table class="tabelaServicos">
    <thead>
      <tr>
        <td>Titulo</td>
        <td class="hidden940">Descrição</td>
        <td>Valor</td>
        <td class="hidden940">Quantidade</td>
        <td class="hidden600">Total a Pagar</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
    $fecthServicos = $conexao->prepare("SELECT * FROM servicos ORDER BY titulo");

    $fecthServicos->execute();
    $servicos = $fecthServicos->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < sizeof($servicos); $i++) :
      $servicoActual = $servicos[$i];
    ?>
      <tr>
        <td><?php echo $servicoActual['titulo']; ?></td>
        <td class="hidden940"><?php echo $servicoActual['descrisao']; ?></td>
        <td><?php echo $servicoActual['valor']; ?></td>
        <td class="hidden940"><?php echo $servicoActual['quantidade']; ?></td>
        <td class="hidden600"><?php echo $servicoActual['total']; ?></td>
        <td>
          <a href="pages/editServico.php?servico_id=<?php echo $servicoActual['id'] ?>">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" class="nc-icon-wrapper">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
              </g>
            </svg>
          </a>
        </td>
        <td class="hidden600">
          <a href="actions/deleteServico.php?servico_id=<?php echo $servicoActual['id'] ?>">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" class="nc-icon-wrapper">
                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" fill="#dc143c"></path>
              </g>
            </svg>
          </a>
        </td>
      </tr>
    <?php endfor ?>
  </table>

  <div id="modal-servicos" class="modal-container">
    <div class="modal">
      <button class="fechar">x</button>
      <h2>Cadastrar Serviço</h2>
      <form method="GET" action="actions/cadastrarServico.php">
        <input type="text" name="titulo" placeholder="Um titulo para o serviço" required>
        <input type="text" name="descrisao" placeholder="Descreve o serviço" required>
        <div class="custo_quantidade">
          <input type="number" min="1" name="valor" placeholder="Quanto custa?" required>
          <input type="number" min="1" name="quantidade" placeholder="Quantidade do serviço" required>
        </div>
        <button type="submit" class="cadastrar">Cadastrar</button>
      </form>
    </div>
  </div>
  <script>
    function iniciaModal(modalID) {
      const modal = document.getElementById(modalID);

      if (modal) {
        modal.classList.add('mostrar');

        modal.addEventListener('click', (e) => {
          if (e.target.id === modalID || e.target.className === 'fechar') {
            modal.classList.remove('mostrar');
          }
        });
      }
    }

    const botao = document.querySelector('.addServicoButton');

    botao.addEventListener('click', () => iniciaModal('modal-servicos'));
  </script>
</section>