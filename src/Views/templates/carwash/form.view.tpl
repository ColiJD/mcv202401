<section class="Lista_Contenedor">
  <h2>{{modeDsc}}</h2>
  <form class="Lista_Formulario" action="index.php?page=CarWash_CarWashForm&mode={{mode}}&lavado_Id={{lavado_id}}"
    method="post" enctype="multipart/form-data">
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
        <label for="lavado_token">Token de Lavado</label>
        <!-- Mostrar el token pero con readonly para que no sea editable -->
        <input type="text" id="lavado_token" name="lavado_token" value="{{lavado_token}}" readonly required>
      </div>
      <div>
        <label for="lavado_reservacion">Hora de la reservación</label>
        <select name="lavado_reservacion" id="lavado_reservacion" {{isReadOnly}}>
          {{foreach horasReservacion}}
          <option value="{{key}}" {{selected}}>{{values}}</option>
          {{endfor horasReservacion}}
        </select>
      </div>
      <div>
        <label for="lavado_tipo">Estado</label>
        <select name="lavado_tipo" id="lavado_tipo" {{isReadOnly}}>
          {{foreach tipoOpciones}}
          <option value="{{key}}" {{selected}}>{{values}}</option>
          {{endfor tipoOpciones}}
        </select>
      </div>
      <div>
        <label for="lavado_img">Imagen del Pago</label>
        <input type="file" name="lavado_img" id="lavado_img" accept="image/*" {{isReadOnly}}>
      </div>
      <!-- Mostrar la imagen si está disponible -->
      {{if lavado_img}}
      <div>
        <label>Imagen del Pago</label>
        <img src="data:image/jpeg;base64,{{lavado_img}}" alt="Imagen de Lavado"
          style="max-width: 200px; max-height: 200px;">
      </div>
      {{endif lavado_img}}
      <div>
        {{if showActions}}
        <input type="submit" value="Guardar" {{isReadOnly}} class="btn-guardar">
        {{endif showActions}}
        <input style="display: none;" type="button" value="Cancelar"
          onclick="location.href='index.php?page=CarWash_CarWashList'">
      </div>
    </div>
  </form>
</section>