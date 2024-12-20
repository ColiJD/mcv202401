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
          <button type="button" id="togglePassword">Ver</button>
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

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('txtPswd');

  togglePassword.addEventListener('click', () => {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    togglePassword.textContent = type === 'password' ? 'Ver' : 'Ocultar';
  });
</script>

<style>
#togglePassword {
    margin-left: 10px;
    background-color: transparent;
    border: none;
    color: #007BFF;
    cursor: pointer;
    font-size: 0.9rem;
}

#togglePassword:hover {
    text-decoration: underline;
}

</style>
