<h1>USo de vistas en platilero</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et debitis amet similique natus culpa reiciendis. Dolores quae fugiat quidem deleniti laboriosam placeat voluptates dolore maiores cum commodi, suscipit magnam expedita!</p>
<table border="1">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Cuenta</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{nombre}}</td>
      <td>{{cuenta}}</td>
    </tr>
  </tbody>
  <section>
    {{foreach pulseras}}
    <div>
      <strong>{{sku}} {{nombre}} {{precio}}</strong>
    </div>
    {{endfor pulseras}}
  </section>
</table>