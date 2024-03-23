<h2>{{modeDsc}}</h2>
<form action="index.php?page=Libros_LibrosForm&mode={{mode}}&libros_id={{libros_id}}" method="post">
  <div>
    <input type="hidden" name="mode" value="{{mode}}">
    <input type="hidden" name="cxfToken" value="{{cxfToken}}">
  </div>
  <div>
    <label for="libros_id">Codigo</label>
    <input type="text" name="libros_id" id="libros_id" value="{{libros_id}}" readonly>
  </div>
  <div>
    <label for="libros_desc">Libro</label>
    <input type="text" name="libros_desc" id="libros_desc" value="{{libros_desc}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="libros_autor">Autor</label>
    <input type="text" name="libros_autor" id="libros_autor" value="{{libros_autor}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="libros_isbn">Editorial</label>
    <input type="text" name="libros_isbn" id="libros_isbn" value="{{libros_isbn}}" {{isReadOnly}}>
  </div>
  <div>
    <label for="libros_categoria">Categoria</label>
    <select name="libros_categoria" id="libros_categoria" {{isReadOnly}}>
      {{foreach categoriesOptions}}
      <option value="{{key}}" {{selected}}>{{values}}</option>
      {{endfor categoriesOptions}}
    </select>
  </div>
  <div>
    <label for="libros_estado">Estado</label>
    <select name="libros_estado" id="libros_estado" {{isReadOnly}}>
      {{foreach estadoOpciones}}
      <option value="{{key}}" {{selected}}>{{values}}</option>
      {{endfor estadoOpciones}}
    </select>
  </div>
  <div>
  {{if showActions}}
    <input type="submit" value="Guardar" {{isReadOnly}}>
{{endif showActions}}
<input type="button" value="Cancelar" onclick="location.href='index.php?page=Libros_LibrosList'">
</div>
</form>