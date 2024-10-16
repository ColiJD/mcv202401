<h2>Listado de Lavados</h2>
<section class="WWList">
  <table >
    <thead >
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Token</th>
        <th>Hora de Reservación</th>
        <th>Estado</th>
        <th>
          {{if carwash_new_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=INS&lavado_Id=0">Nuevo</a></th>
        {{endif carwash_new_enable}}
      </tr>
    </thead>
    <tbody>
      {{foreach carwash}}
      <tr>
        <th>{{lavado_Id}}</th>
        <th>{{lavado_Nombre}}</th>
        <th>{{lavado_Apellido}}</th>
        <th>{{lavado_Token}}</th>
        <th>{{lavado_Reservacion}}</th>
        <th>{{lavado_Tipo}}</th>
        <th>
          <a href="index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}">Ver</a>
          {{if ~carwash_edit_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=UPD&lavado_Id={{lavado_Id}}">Editar</a>
          &nbsp;
          {{endif carwash_edit_enable}}
          
          {{if ~carwash_delete_enable}}
          <a href="index.php?page=CarWash_CarWashForm&mode=DEL&lavado_Id={{lavado_Id}}">Eliminar</a>
           &nbsp;
          {{endif carwash_delete_enable}}
          
          
        </th>
        
      </tr>
      {{endfor carwash}}
    </tbody>
  </table>
</section>
