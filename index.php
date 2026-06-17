<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacéutica</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="contenedor-principal">

 <p>Almacen  <strong>></strong> <strong id="azul">Gestion de Inventario</strong></p>
    <h1 id="tituloGeneral">Inventario General</h1>
</header>

    <div class="panel-superior">

        <div class="categorias">

            <div class="titulo-panel">
                <h2>Categorías</h2>
                <button id="btnAgregarCategoria"><img src="mas.png"></button>
            </div>

            <table id="tablaCategorias">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CATEGORIA</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div class="acciones">
                <button id="btnEditarCategoria"><img src="image.png"></button>
                <button id="btnEliminarCategoria"><img src="2.png"></button>
            </div>

        </div>

        <div class="medicamentos">

            <div class="titulo-panel">
                <h2>Medicamentos</h2>
                <button id="btnAgregarMedicamento"><img src="mas.png"></button>
            </div>

            <table id="tablaMedicamentos">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE COMERCIAL</th>
                        <th>NOMBRE GENERICO</th>
                        <th>FORMA</th>
                        <th>CONCENTRACION</th>
                        <th>RECETA</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div class="acciones">
                <button id="btnEditarMedicamento"><img src="image.png"></button>
                <button id="btnEliminarMedicamento"><img src="2.png"></button>
            </div>

        </div>

    </div>

    <div class="panel-inferior">

        <div class="titulo-panel">
            <h2>Lotes</h2>
            <button id="btnAgregarLote"><img src="mas.png"></button>
        </div>

        <table id="tablaLotes">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NUMERO LOTE</th>
                    <th>FECHA INGRESO</th>
                    <th>CADUCIDAD</th>
                    <th>STOCK</th>
                    <th>UBICACION</th>
                    <th>PRECIO COMPRA</th>
                    <th>PRECIO VENTA</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="acciones">
            <button id="btnEditarLote"><img src="image.png"></button>
            <button id="btnEliminarLote"><img src="2.png"></button>
        </div>

    </div>

</div>

<dialog id="modalCategoria">

    <form id="formCategoria">

        <h2>Categoría</h2>

        <label>Nombre de Categoría</label>
        <input type="text" id="nombre_categoria" name="nombre_categoria" required>

        <div class="botones">
            <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarCategoria">Cancelar</button>
        </div>

    </form>

</dialog>

<dialog id="modalMedicamento">

    <form id="formMedicamento">

        <h2>Medicamento</h2>

        <label>Código</label>
        <input type="text" id="codigo_medicamento" name="codigo_medicamento" required>

        <label>Nombre Comercial</label>
        <input type="text" id="nombre_comercial" name="nombre_comercial" required>

        <label>Nombre Genérico</label>
        <input type="text" id="nombre_generico" name="nombre_generico" required>

        <label>Forma Farmacéutica</label>
        <input type="text" id="forma_farmaceutica" name="forma_farmaceutica" required>

        <label>Concentración</label>
        <input type="text" id="concentracion" name="concentracion" required>

        <label>Requiere Receta</label>
        <select id="requiere_receta" name="requiere_receta">
            <option value="1">SI</option>
            <option value="0">NO</option>
        </select>

        <label>Categoría</label>
        <select id="id_categoria" name="id_categoria"></select>

        <div class="botones">
            <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarMedicamento">Cancelar</button>
        </div>

    </form>

</dialog>

<dialog id="modalLote">

    <form id="formLote">

        <h2>Lote</h2>

        <label>Número de Lote</label>
        <input type="text" id="numero_lote" name="numero_lote" required>

        <label>Fecha de Ingreso</label>
        <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

        <label>Fecha de Caducidad</label>
        <input type="date" id="fecha_caducidad" name="fecha_caducidad" required>

        <label>Stock</label>
        <input type="number" id="stock" name="stock" required>

        <label>Ubicación</label>
        <input type="text" id="ubicacion_almacen" name="ubicacion_almacen" required>

        <label>Precio Compra</label>
        <input type="number" step="0.01" id="precio_compra" name="precio_compra" required>

        <label>Precio Venta</label>
        <input type="number" step="0.01" id="precio_venta" name="precio_venta" required>

        <div class="botones">
            <button type="submit">Guardar</button>
            <button type="button" id="btnCancelarLote">Cancelar</button>
        </div>

    </form>

</dialog>

<script src="js/app.js"></script>

</body>
</html>