<h2>Listado de Estudiantes</h2>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Edad</th>
        <th>Especialidad</th>
        <th><a href="index.php?page=Estudiantes_EstudiantesForm&mode=INS&id_estudiante=0">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach EstudianteCienciasComputacionales}}
      <tr>
        <th>{{id_estudiante}}</th>
        <th><a href="index.php?page=Estudiantes_EstudiantesForm&mode=DSP&id_estudiante={{id_estudiante}}">{{nombre}}</a></th>
        <th>{{apellido}}</th>
        <th>{{edad}}</th>
        <th>{{especialidad}}</th>
        <th>
          <a href="index.php?page=Estudiantes_EstudiantesForm&mode=UPD&id_estudiante={{id_estudiante}}">Editar</a>
          &nbsp;
          <a href="index.php?page=Estudiantes_EstudiantesForm&mode=DEL&id_estudiante={{id_estudiante}}">Eliminar</a>
        </th>
      </tr>
      {{endfor EstudianteCienciasComputacionales}}
    </tbody>
  </table>
</section>