<h2>Listado de Libros</h2>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Categoria</th>
        <th>Estado</th>
        <th><a href="index.php?page=Libros_LibrosForm&mode=INS&libros_id=0">Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach libros}}
      <tr>
        <th>{{libros_id}}</th>
        <th><a href="index.php?page=Libros_LibrosForm&mode=DSP&libros_id={{libros_id}}">{{libros_desc}}</a></th>
        <th>{{libros_autor}}</th>
        <th>{{libros_categoria}}</th>
        <th>{{libros_estado}}</th>
        <th>
          <a href="index.php?page=Libros_LibrosForm&mode=UPD&libros_id={{libros_id}}">Editar</a>
          &nbsp;
          <a href="index.php?page=Libros_LibrosForm&mode=DEL&libros_id={{libros_id}}">Eliminar</a>
        </th>
      </tr>
      {{endfor libros}}
    </tbody>
  </table>
</section>