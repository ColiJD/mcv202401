<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{SITE_TITLE}}</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css_src/styles/style.css" />


</head>

<body>

  <header class="header">
    <input type="checkbox" id="toggle_menu" style="display: none;">
    <label class="menu_toggle_icon" for="toggle_menu">
      <div class="hmb dgn pt-1"></div>
      <div class="hmb hrz"></div>
      <div class="hmb dgn pt-2"></div>
    </label>

    <nav id="menu">
      <ul class="header_lista">
        <li><a href="index.php?page={{PUBLIC_DEFAULT_CONTROLLER}}"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
        {{foreach PUBLIC_NAVIGATION}}
        <li><a href="{{nav_url}}">{{nav_label}}</a></li>
        {{endfor PUBLIC_NAVIGATION}}
      </ul>
    </nav>
    <div class="header_detalles">
      <h2>Tres Valles</h2>
      <img class="header_img"
        src="https://productoresdeazucarhonduras.com/wp-content/uploads/elementor/thumbs/2-1-ptr6xjo4tghogauxsqkxxwrk395sc23efl66d3570w.png"
        alt="MDN" />
    </div>
  </header>

  <main>
    {{{page_content}}}
  </main>
  <footer>
    <div class="footer_detalles">
      <div>Azucarera Tres Valles {{~CURRENT_YEAR}}</div>
      <img class="footer_img"
        src="https://productoresdeazucarhonduras.com/wp-content/uploads/elementor/thumbs/2-1-ptr6xjo4tghogauxsqkxxwrk395sc23efl66d3570w.png"
        alt="MDN" />
    </div>
    <div class="footer_colaboradores">
      <div class="cotenedor">
        <div class="colaboradores_div">
          <p>Colaboradores:</p>
          <ul>
            <li>Rodrigo Sanchez</li>
            <li>Jonathan Alvarez</li>
            <li>Jose Colindres</li>
          </ul>
        </div>
        <p>Tecnología de la información</p>
      </div>
    </div>
  </footer>
  {{foreach EndScripts}}
  <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor EndScripts}}
</body>

</html>