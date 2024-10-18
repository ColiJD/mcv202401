<section class="WWList">
  <h2>Listado de Lavados</h2>
  <table class="list_Tabla">
    <thead class="tabla_Cavezal">
      <tr>
        <th>ID</th>
        <th class="disable">Nombre</th>
        <th>Token</th>
        <th>HR</th>
        <th class="disable">Tipo</th>
        <th>
          {{if carwash_new_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}">Nuevo</a>
        </th>
        {{endif carwash_new_enable}}
      </tr>
    </thead>
    <tbody>
      {{foreach carwash}}
      <tr>
        <th>{{lavado_Id}}</th>
        <th class="disable">{{lavado_Nombre}} {{lavado_Apellido}}</th>
        <th>{{lavado_Token}}</th>
        <th>{{lavado_Reservacion}}</th>
        <th class="disable">{{lavado_Tipo}}</th>
        <th>
          <a href="index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}">Ver</a>
          {{if carwash_edit_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=UPD&lavado_Id={{lavado_Id}}">Editar</a>
          {{endif carwash_edit_enable}}
          &nbsp;

         


        </th>

      </tr>
      {{endfor carwash}}
    </tbody>
  </table>
</section>