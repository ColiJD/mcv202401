<section class="WWList">
  <h2>Listado de Lavados</h2>
  <table class="list_Tabla">
    <thead class="tabla_Cabezado">
      <tr>
        
        <th scope="col" class="disable">Nombre</th>
        <th scope="col">Token</th>
        <th scope="col" class="disable">Teléfono</th>
        <th scope="col">Tipo</th>
        <th scope="col">
          {{if carwash_new_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}">Nuevo</a>
          {{endif carwash_new_enable}}
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach carwash}}
      <tr>
        
        <td class="disable">{{lavado_Nombre}} {{lavado_Apellido}}</td>
        <td>{{lavado_Token}}</td>
        <td class="disable">{{lavado_Telefono}}</td>
        <td>{{lavado_Tipo}}</td>
        <td>
          <a href="index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}">Ver</a>
          {{if carwash_edit_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=UPD&lavado_Id={{lavado_Id}}">Editar</a>
          {{endif carwash_edit_enable}}
        </td>
      </tr>
      {{endfor carwash}}
    </tbody>
  </table>
</section>
