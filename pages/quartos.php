<?php
require(__DIR__ . "/../actions/conexao.php");
?>

<section id="quartosPage">
  <header>
    <div>
      <h1>Quarto</h1>
      <h3>Listagem completa dos quartos</h3>
    </div>
    <button class="addQuartoButton">+</button>
  </header>


  <table class="tabelaQuartos">
    <thead>
      <tr>
        <td class="hidden600">Número</td>
        <td class="hidden940">Código</td>
        <td>Tipo de Quarto</td>
        <td class="hidden940">Ocupado</td>
        <td class="hidden940">Dimensão</td>
        <td>Valor por noite</td>
        <td>Editar</td>
        <td class="hidden600">Remover</td>
      </tr>
    </thead>
    <?php
    $fecthQuartos = $conexao->prepare("SELECT * FROM tipos_quartos JOIN quartos ON tipos_quartos.id = quartos.tipo_quarto ORDER BY quartos.numero");

    $fecthQuartos->execute();
    $quartos = $fecthQuartos->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < sizeof($quartos); $i++) :
      $quartoActual = $quartos[$i];
    ?>
      <tr>
        <td class="hidden600"><?php echo $quartoActual['numero']; ?></td>
        <td class="hidden940"><?php echo $quartoActual['codigo']; ?></td>
        <td><?php echo $quartoActual['titulo']; ?></td>
        <td class="hidden940"><?php echo $quartoActual['ocupado']; ?></td>
        <td class="hidden940"><?php echo $quartoActual['dimensao']; ?></td>
        <td><?php echo number_format($quartoActual['valor_por_noite'], 2, ','); ?></td>
        <td>
          <a href="pages/editQuarto.php?quarto_id=<?php echo $quartoActual['id'] ?>">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="none" class="nc-icon-wrapper">
                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" fill="#6f4ec9"></path>
              </g>
            </svg>
          </a>
        </td>
        <td class="hidden600">
          <a href="actions/deleteQuarto.php?quarto_id=<?php echo $quartoActual['id'] ?>">
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


  <div id="modal-quarto" class="modal-container">
    <div class="modal">
      <button class="fechar">x</button>
      <h2>Cadastrar Quarto</h2>
      <form method="GET" action="actions/cadastrarQuarto.php">
        <input type="number" name="numero" placeholder="Número para o quarto" required>
        <input type="text" name="codigo" placeholder="Codigo para o quarto" required>
        <input type="text" name="dimensao" placeholder="Dimensão (3m x 2.5m)" required>
        <fieldset class="ocupado">
          <legend>Ocupado?</legend>
          <label>
            <input type="radio" name="ocupado" value="Nao" checked> Não
          </label>
          <label>
            <input type="radio" name="ocupado" value="Sim"> Sim
          </label>
        </fieldset>
        <select name="tipo_quarto">
          <?php
          $query = $conexao->prepare("SELECT * FROM tipos_quartos");

          $query->execute();
          $quartos = $query->fetchAll(PDO::FETCH_ASSOC);
          for ($i = 0; $i < sizeof($quartos); $i++) :
            $quartosAtual = $quartos[$i];
          ?>
            <option value=<?php echo $quartosAtual["id"] ?>><?php echo $quartosAtual['titulo'] ?></option>
          <?php endfor ?>
          <input type="text" name="descricao" placeholder="Uma breve descricao do quarto">
        </select>
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

    const botao = document.querySelector('.addQuartoButton');

    botao.addEventListener('click', () => iniciaModal('modal-quarto'));
  </script>
</section>