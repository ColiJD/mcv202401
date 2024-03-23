<h2>{{modeDsc}}</h2>
<form action="index.php?page=Estudiantes_EstudiantesForm&mode={{mode}}&id_estudiante={{id_estudiante}}" method="post">
  <div>
    <input type="hidden" name="mode" value="{{mode}}">
    <input type="hidden" name="cxfToken" value="{{cxfToken}}">
  </div>
  <div>
    <label for="id_estudiante">Codigo</label>
    <input type="text" name="id_estudiante" id="id_estudiante" value="{{id_estudiante}}" readonly>
  </div>
  <div>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{nombre}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" value="{{apellido}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="edad">Edad</label>
    <input type="text" name="edad" id="edad" value="{{edad}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="especialidad">Categoria</label>
    <select name="especialidad" id="especialidad" {{isReadOnly}}>
      {{foreach especialidadOptions}}
      <option value="{{key}}" {{selected}}>{{values}}</option>
      {{endfor especialidadOptions}}
    </select>
  </div>
  <div>
  {{if showActions}}
    <input type="submit" value="Guardar" {{isReadOnly}}>
{{endif showActions}}
<input type="button" value="Cancelar" onclick="location.href='index.php?page=Estudiantes_EstudiantesList'">
</div>
</form>