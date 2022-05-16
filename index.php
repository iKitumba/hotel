<?php
  session_start();

  if(isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])){
    $page = isset($_GET['p']) ? $_GET['p'] : 'home';
    $userID = $_SESSION['usuario'][1];
    $userName = $_SESSION['usuario'][0];
  } else {
    echo "<script>window.location = `login.html`</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IHotel - <?php echo "$userName" ?></title>
  <link rel="stylesheet" href="./styles/main.css">
  <?php if($page === 'hospedes'): ?>
    <link rel="stylesheet" href="./styles/hospedes.css">
  <?php endif ?>
  <?php if($page === 'reservas'): ?>
    <link rel="stylesheet" href="./styles/reservas.css">
  <?php endif ?>
  <?php if($page === 'quartos'): ?>
    <link rel="stylesheet" href="./styles/quartos.css">
  <?php endif ?>
  <?php if($page === 'servicos'): ?>
    <link rel="stylesheet" href="./styles/servicos.css">
  <?php endif ?>
  <?php if($page === 'pagamentos'): ?>
    <link rel="stylesheet" href="./styles/pagamentos.css">
  <?php endif ?>
  <?php if($page === 'funcionarios'): ?>
    <link rel="stylesheet" href="./styles/funcionarios.css">
  <?php endif ?>
  <?php if($page === 'usuarios'): ?>
    <link rel="stylesheet" href="./styles/usuarios.css">
  <?php endif ?>
</head>
<body>
  <div id="root">
    <header class="header">
      <a href="#" class="logo">IHotel</a>
      <figure class="profile">
        <figcaption><?php echo "$userName" ?></figcaption>
        <img src="./assets/images/joker.jpg" alt="Perfil">
      </figure>
    </header>
    <main class="main">
      <nav>
        <ul class="menu">
          <li id="home" class="listItem">
            <a href="index.php?p=home">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5zM12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z" fill="#333333">
                    </path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Home
              </span>
            </a>
          </li>
          <li id="hospedes" class="listItem">
            <a href="index.php?p=hospedes">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path d="M16.5 13c-1.2 0-3.07.34-4.5 1-1.43-.67-3.3-1-4.5-1C5.33 13 1 14.08 1 16.25V19h22v-2.75c0-2.17-4.33-3.25-6.5-3.25zm-4 4.5h-10v-1.25c0-.54 2.56-1.75 5-1.75s5 1.21 5 1.75v1.25zm9 0H14v-1.25c0-.46-.2-.86-.52-1.22.88-.3 1.96-.53 3.02-.53 2.44 0 5 1.21 5 1.75v1.25zM7.5 12c1.93 0 3.5-1.57 3.5-3.5S9.43 5 7.5 5 4 6.57 4 8.5 5.57 12 7.5 12zm0-5.5c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 5.5c1.93 0 3.5-1.57 3.5-3.5S18.43 5 16.5 5 13 6.57 13 8.5s1.57 3.5 3.5 3.5zm0-5.5c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" fill="#333333">
                    </path>
                  </g>
              </svg>
              </span>
              <span class="text">
                Hospedes
              </span>
            </a>
          </li>
          <li id="reservas" class="listItem">
            <a href="index.php?p=reservas">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-3 2v5l-1-.75L15 9V4h2zm3 12H8V4h5v9l3-2.25L19 13V4h1v12z" fill="#333333">
                    </path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Reservas
              </span>
            </a>
          </li>
          <li id="quartos" class="listItem">
            <a href="index.php?p=quartos">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path d="M22 12c0-1.1-.9-2-2-2V7c0-1.1-.9-2-2-2H6c-1.1 0-2 .9-2 2v3c-1.1 0-2 .9-2 2v5h1.33L4 19h1l.67-2h12.67l.66 2h1l.67-2H22v-5zm-4-2h-5V7h5v3zM6 7h5v3H6V7zm-2 5h16v3H4v-3z" fill="#333333">
                    </path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Quartos
              </span>
            </a>
          </li>
          <li id="servicos" class="listItem">
            <a href="index.php?p=servicos">
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" class="nc-icon-wrapper">
                  <path d="M18.98 17H2v2h20v-2h-3.02zM21 16c-.27-4.07-3.25-7.4-7.16-8.21A2.006 2.006 0 0 0 12 5a2.006 2.006 0 0 0-1.84 2.79C6.25 8.6 3.27 11.93 3 16h18zm-9-6.42c2.95 0 5.47 1.83 6.5 4.41h-13A7.002 7.002 0 0 1 12 9.58z" fill="#333333">
                  </path>
                </g>
              </svg>
              </span>
              <span class="text">
                Serviços
              </span>
            </a>
          </li>
          <li id="pagamentos" class="listItem">
            <a href="index.php?p=pagamentos">
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" class="nc-icon-wrapper">
                  <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z" fill="#333333">
                  </path>
                </g>
              </svg>
              </span>
              <span class="text">
                Pagamentos
              </span>
            </a>
          </li>
          <li id="funcionarios" class="listItem">
            <a href="index.php?p=funcionarios">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2l.01-11c0-1.11.88-2 1.99-2h4V4c0-1.11.89-2 2-2h4c1.11 0 2 .89 2 2v2h4z" fill="#333333">
                    </path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Funcionarios
              </span>
            </a>
          </li>
          <li id="usuarios" class="listItem">
            <a href="index.php?p=usuarios">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                  <g stroke-linecap="square" stroke-width="2" fill="none" stroke="#333333" stroke-linejoin="miter" class="nc-icon-wrapper" stroke-miterlimit="10">
                    <path d="M15,15H9 c-3.314,0-6,2.686-6,6v1c0,0,3.125,1,9,1s9-1,9-1v-1C21,17.686,18.314,15,15,15z"></path>
                    <path d="M7,6c0-2.761,2.239-5,5-5 s5,2.239,5,5s-2.239,6-5,6S7,8.761,7,6z" stroke="#333333"></path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Usuários
              </span>
            </a>
          </li>
          <li class="listItem">
            <a href="./actions/logout.php">
              <span class="icon">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g fill="none" class="nc-icon-wrapper">
                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5-5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" fill="#333333">
                    </path>
                  </g>
                </svg>
              </span>
              <span class="text">
                Sair
              </span>
            </a>
          </li>
        </ul>
      </nav>
      <?php
        switch($page){
          case 'hospedes':
            require('./pages/hospedes.php');
            break;
          case 'reservas':
            require('./pages/reservas.php');
            break;
          case 'quartos':
            require('./pages/quartos.php');
            break;
          case 'servicos':
            require('./pages/servicos.php');
            break;
          case 'pagamentos':
            require('./pages/pagamentos.php');
            break;
          case 'funcionarios':
            require('./pages/funcionarios.php');
            break;
          case 'usuarios':
            require('./pages/usuarios.php');
            break;
          default:
            require('./pages/home.php');
        }
        
        ?>

</main>
</div>

  <script>
    // Apply active class in selected list item
    const selectedPage = location.search.replace('?p=', '');
    const selectedItem = document.getElementById(selectedPage);

    selectedItem.classList.add('active');
  /**
    let list = document.querySelectorAll('.listItem');
    const url = new URL(location);
    console.log(url);
    for(let i = 0; i < list.length; i++) {
      list[i].onclick = function() {
        let j = 0;
        while(j < list.length){
          list[j++].className = 'listItem';
        }
        list[i].className = 'listItem active';
      }
    }
  **/ 

  </script>
  <script src="./modules/chart.js"></script>

  <?php if($page === 'home' ): ?>
  <script>
    const ctx = document.getElementById('myChart');

    const labels = [
      'Janeiro',
      'Fevereiro',
      'Março',
      'Abril',
      'Maio',
      'Junho',
      'Julho',
      'Agosto',
      'Setembro',
      'Outubro',
      'Novembro',
      'Dezembro'
    ];

    const data = {
      labels,
      datasets: [{
        data: [211, 299, 189, 344, 411, 377, 499, 389, 421, 333, 233, 502],
        label: "Total De Reservas",
        fill: false,
        backgroundColor: '#6f4ec9',
        borderColor: '#6f4ec9'
      }]
    }

    const config = {
      type: 'line',
      data,
      options: {
        responsive: true,
        radius: 4,
        hoverRadius: 10
      }
    }

    const myChart = new Chart(ctx, config);
  </script>
  <?php endif ?>
</body>
</html>