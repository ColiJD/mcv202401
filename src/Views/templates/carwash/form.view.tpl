<section class="Lista_Contenedor">
  <h2>{{modeDsc}}</h2>
  <form class="Lista_Formulario" action="index.php?page=CarWash_CarWashForm&mode={{mode}}&lavado_Id={{lavado_id}}"
    method="post" enctype="multipart/form-data">
    <legend>Reservaciones disponibles:{{totalReservaciones}}</legend>
    <div class="Lista_Box">
      <div class="">
        <input type="hidden" name="mode" value="{{mode}}">
        <input type="hidden" name="cxfToken" value="{{cxfToken}}">
      </div>
      <div style="display: none;">
        <label for="lavado_id">Código</label>
        <input type="text" name="lavado_id" id="lavado_id" value="{{lavado_id}}" readonly>
      </div>
      <div>
        <label for="lavado_token">Token de Lavado</label>
        <!-- Mostrar el token pero con readonly para que no sea editable -->
        <input type="text" id="lavado_token" name="lavado_token" value="{{lavado_token}}" readonly required>
      </div>
      <div>
        <label for="lavado_nombre">Nombre</label>
        <input type="text" name="lavado_nombre" id="lavado_nombre" value="{{lavado_nombre}}" {{isReadOnly}} required
          autofocus>
      </div>
      <div>
        <label for="lavado_apellido">Apellido</label>
        <input type="text" name="lavado_apellido" id="lavado_apellido" value="{{lavado_apellido}}" {{isReadOnly}}
          required>
      </div>
      <div>
        <label for="lavado_Telefono">Teléfono</label>
        <input type="number" id="lavado_Telefono" name="lavado_Telefono" value="{{lavado_Telefono}}" {{readonly}}
          required min="10000000">
      </div>
      <div>
        <label for="lavado_tipo">Estado</label>
        <select name="lavado_tipo" id="lavado_tipo" {{isReadOnly}}>
          {{foreach tipoOpciones}}
          <option value="{{key}}" {{selected}}>{{values}}</option>
          {{endfor tipoOpciones}}
        </select>
      </div>
      <div style="display: none;">
        <label for="lavado_reservacion">Reservación</label>
        <select name="lavado_reservacion" id="lavado_reservacion" {{isReadOnly}}>
          {{foreach horasReservacion}}
          <option value="{{key}}" {{selected}}>{{values}}</option>
          {{endfor horasReservacion}}
        </select>
      </div>

      <div>
        <label for="lavado_img">Imagen del Pago</label>
        <input type="file" name="lavado_img" id="lavado_img" accept="image/*" {{isReadOnly}} required>
      </div>
      <!-- Mostrar la imagen si está disponible -->
      {{if lavado_img}}
      <div>
        <label>Imagen del Pago</label>
        <img src="data:image/{{formato}};base64,{{lavado_img}}" alt="Imagen de Lavado" class="Lista_Imagen"
          style="width: 100%; transition: transform 0.5s; cursor: pointer; overflow: auto" onclick="if (this.style.transform === 'scale(2)') {
                  this.style.transform = 'scale(1)';
              } else {
                  this.style.transform = 'scale(2)';
                  
              }">
      </div>
      {{endif lavado_img}}
      <div>
        {{if showActions}}
        <input type="submit" value="Guardar" {{isReadOnly}} class="btn-guardar">
        {{endif showActions}}
        {{if noActions}}
        <input type="button" value="Imprimir" {{isReadOnly}} onclick="window.print()" class="btn-guardar">
        {{endif noActions}}
        <input style="display: none;" type="button" value="Cancelar"
          onclick="location.href='index.php?page=CarWash_CarWashList'">
      </div>
    </div>
  </form>
</section>