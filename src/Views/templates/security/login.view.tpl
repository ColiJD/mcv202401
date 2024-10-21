<section class="login">
  <form class="formulario" method="post"
    action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section>
      <h2>Iniciar Sesión</h2>
    </section>
    <section class="Lista_Formulario LF">

      <div class="Lista_Box">
        <div>
          <label for="txtUsuario">Usuario</label>
          <input type="text" id="txtUsuario" name="txtUsuario" value="{{txtUsuario}}" />

          {{if errorUsuario}}
          <div>{{errorUsuario}}</div>
          {{endif errorUsuario}}
        </div>
        <div>
          <label for="txtPswd">Contraseña</label>
          <input type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
          {{if errorPswd}}
          <div>{{errorPswd}}</div>
          {{endif errorPswd}}
        </div>
        {{if generalError}}
        <div>
          {{generalError}}
        </div>
        {{endif generalError}}
        <div class="CButton">
          <button class="btn-guardar" id="btnLogin" type="submit">Iniciar Sesión</button>
        </div>
      </div>
    </section>
  </form>
</section>