// Variables globales

let idCategoria;
let codigoMedicamento;
let idLote;

let process;
let tabla;

// Cargar datos iniciales

document.addEventListener('DOMContentLoaded', ()=>{

    cargarCategorias();

    // Eventos Categorias

    document.getElementById('btnAgregarCategoria').addEventListener('click', ()=>{
// Establece el proceso como 'new' para indicar que se va a crear una nueva categoría
        process = 'new';
        // Establece la tabla como 'categorias' para indicar que se va a trabajar con la tabla de categorías
        tabla = 'categorias';
// Reinicia el formulario de categoría para limpiar cualquier dato previo
        document.getElementById('formCategoria').reset();
        // Muestra el modal de categoría para que el usuario pueda ingresar los datos de la nueva categoría
        document.getElementById('modalCategoria').showModal();

    });

    document.getElementById('btnCancelarCategoria').addEventListener('click', ()=>{

        document.getElementById('modalCategoria').close();

    });

    document.getElementById('btnEditarCategoria').addEventListener('click', ()=>{
// Verifica si se ha seleccionado una categoría (idCategoria tiene un valor)
        if(idCategoria){

            process = 'update';
            tabla = 'categorias';

            editarCategoria();

        } else {

            alert('Seleccione una categoria');

        }

    });

    document.getElementById('btnEliminarCategoria').addEventListener('click', ()=>{

        eliminar('categorias', idCategoria);

    });

    // Eventos Medicamentos

    document.getElementById('btnAgregarMedicamento').addEventListener('click', ()=>{

        process = 'new';
        tabla = 'medicamentos';

        document.getElementById('formMedicamento').reset();
        document.getElementById('modalMedicamento').showModal();

    });

    document.getElementById('btnCancelarMedicamento').addEventListener('click', ()=>{

        document.getElementById('modalMedicamento').close();

    });

    document.getElementById('btnEditarMedicamento').addEventListener('click', ()=>{

        if(codigoMedicamento){

            process = 'update';
            tabla = 'medicamentos';

            editarMedicamento();

        } else {

            alert('Seleccione un medicamento');

        }

    });

    document.getElementById('btnEliminarMedicamento').addEventListener('click', ()=>{

        eliminar('medicamentos', codigoMedicamento);

    });

    // Eventos Lotes

    document.getElementById('btnAgregarLote').addEventListener('click', ()=>{

        process = 'new';
        tabla = 'lotes';

        document.getElementById('formLote').reset();
        document.getElementById('modalLote').showModal();

    });

    document.getElementById('btnCancelarLote').addEventListener('click', ()=>{

        document.getElementById('modalLote').close();

    });

    document.getElementById('btnEditarLote').addEventListener('click', ()=>{

        if(idLote){

            process = 'update';
            tabla = 'lotes';

            editarLote();

        } else {

            alert('Seleccione un lote');

        }

    });

    document.getElementById('btnEliminarLote').addEventListener('click', ()=>{

        eliminar('lotes', idLote);

    });

    // Submit formularios

    document.getElementById('formCategoria').addEventListener('submit', (e)=>{

        e.preventDefault();
        guardarCategoria();

    });

    document.getElementById('formMedicamento').addEventListener('submit', (e)=>{

        e.preventDefault();
        guardarMedicamento();

    });

    document.getElementById('formLote').addEventListener('submit', (e)=>{

        e.preventDefault();
        guardarLote();

    });

});

// Cargar categorias

function cargarCategorias(){

    const fd = new FormData();

    fd.append('tabla', 'categorias');

    fetch('cargar_datos.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        const tbody = document.querySelector('#tablaCategorias tbody');

        tbody.innerHTML = '';

        data.forEach(categoria => {

            const row = document.createElement('tr');

            row.dataset.id = categoria.id_categoria;

            row.innerHTML = `
                <td>${categoria.id_categoria}</td>
                <td>${categoria.nombre_categoria}</td>
            `;

            row.addEventListener('click', ()=>{

                document.querySelectorAll('#tablaCategorias tbody tr')
                .forEach(f => f.classList.remove('filaSeleccionada'));

                row.classList.add('filaSeleccionada');

                idCategoria = categoria.id_categoria;

                cargarMedicamentos(idCategoria);

            });

            tbody.appendChild(row);

        });

        cargarSelectCategorias();

    });

}

// Cargar medicamentos

function cargarMedicamentos(id){

    const fd = new FormData();

    fd.append('tabla', 'medicamentos');
    fd.append('id_categoria', id);

    fetch('cargar_datos.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        const tbody = document.querySelector('#tablaMedicamentos tbody');

        tbody.innerHTML = '';

        data.forEach(medicamento => {

            const row = document.createElement('tr');

            row.dataset.id = medicamento.codigo_medicamento;

            row.innerHTML = `
                <td>${medicamento.codigo_medicamento}</td>
                <td>${medicamento.nombre_comercial}</td>
                <td>${medicamento.nombre_generico}</td>
                <td>${medicamento.forma_farmaceutica}</td>
                <td>${medicamento.concentracion}</td>
                <td>${medicamento.requiere_receta == 1 ? 'SI' : 'NO'}</td>
            `;

            row.addEventListener('click', ()=>{

                document.querySelectorAll('#tablaMedicamentos tbody tr')
                .forEach(f => f.classList.remove('filaSeleccionada'));

                row.classList.add('filaSeleccionada');

                codigoMedicamento = medicamento.codigo_medicamento;

                cargarLotes(codigoMedicamento);

            });

            tbody.appendChild(row);

        });

    });

}

// Cargar lotes

function cargarLotes(codigo){

    const fd = new FormData();

    fd.append('tabla', 'lotes');
    fd.append('codigo_medicamento', codigo);

    fetch('cargar_datos.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        const tbody = document.querySelector('#tablaLotes tbody');

        tbody.innerHTML = '';

        data.forEach(lote => {

            const row = document.createElement('tr');

            row.dataset.id = lote.id_lote;

            row.innerHTML = `
                <td>${lote.id_lote}</td>
                <td>${lote.numero_lote}</td>
                <td>${lote.fecha_ingreso}</td>
                <td>${lote.fecha_caducidad}</td>
                <td>${lote.stock}</td>
                <td>${lote.ubicacion_almacen}</td>
                <td>$ ${lote.precio_compra}</td>
                <td>$ ${lote.precio_venta}</td>
            `;

            row.addEventListener('click', ()=>{

                document.querySelectorAll('#tablaLotes tbody tr')
                .forEach(f => f.classList.remove('filaSeleccionada'));

                row.classList.add('filaSeleccionada');

                idLote = lote.id_lote;

            });

            tbody.appendChild(row);

        });

    });

}

// Select categorias

function cargarSelectCategorias(){

    const fd = new FormData();

    fd.append('tabla', 'categorias');

    fetch('cargar_datos.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        const select = document.getElementById('id_categoria');

        select.innerHTML = '';

        data.forEach(categoria => {

            select.innerHTML += `
                <option value="${categoria.id_categoria}">
                    ${categoria.nombre_categoria}
                </option>
            `;

        });

    });

}

// Guardar categoria

function guardarCategoria(){

    const fd = new FormData(document.getElementById('formCategoria'));

    fd.append('tabla', 'categorias');
    fd.append('process', process);
    fd.append('id', idCategoria);

    fetch('guardar.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('modalCategoria').close();

        cargarCategorias();

    });

}

// Guardar medicamento

function guardarMedicamento(){

    const fd = new FormData(document.getElementById('formMedicamento'));

    fd.append('tabla', 'medicamentos');
    fd.append('process', process);
    fd.append('id', codigoMedicamento);

    fetch('guardar.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('modalMedicamento').close();

        cargarMedicamentos(idCategoria);

    });

}

// Guardar lote

function guardarLote(){

    const fd = new FormData(document.getElementById('formLote'));

    fd.append('tabla', 'lotes');
    fd.append('process', process);
    fd.append('id', idLote);
    fd.append('codigo_medicamento', codigoMedicamento);

    fetch('guardar.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('modalLote').close();

        cargarLotes(codigoMedicamento);

    });

}

// Editar categoria

function editarCategoria(){

    const fd = new FormData();

    fd.append('tabla', 'categorias');
    fd.append('id', idCategoria);

    fetch('edit.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('nombre_categoria').value = data.nombre_categoria;

        document.getElementById('modalCategoria').showModal();

    });

}

// Editar medicamento

function editarMedicamento(){

    const fd = new FormData();

    fd.append('tabla', 'medicamentos');
    fd.append('id', codigoMedicamento);

    fetch('edit.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('codigo_medicamento').value = data.codigo_medicamento;
        document.getElementById('nombre_comercial').value = data.nombre_comercial;
        document.getElementById('nombre_generico').value = data.nombre_generico;
        document.getElementById('forma_farmaceutica').value = data.forma_farmaceutica;
        document.getElementById('concentracion').value = data.concentracion;
        document.getElementById('requiere_receta').value = data.requiere_receta;
        document.getElementById('id_categoria').value = data.id_categoria;

        document.getElementById('modalMedicamento').showModal();

    });

}

// Editar lote

function editarLote(){

    const fd = new FormData();

    fd.append('tabla', 'lotes');
    fd.append('id', idLote);

    fetch('edit.php',{

        method:'POST',
        body:fd

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('numero_lote').value = data.numero_lote;
        document.getElementById('fecha_ingreso').value = data.fecha_ingreso;
        document.getElementById('fecha_caducidad').value = data.fecha_caducidad;
        document.getElementById('stock').value = data.stock;
        document.getElementById('ubicacion_almacen').value = data.ubicacion_almacen;
        document.getElementById('precio_compra').value = data.precio_compra;
        document.getElementById('precio_venta').value = data.precio_venta;

        document.getElementById('modalLote').showModal();

    });

}

// Eliminar

function eliminar(tabla, id){
    if(id){

        if(alert('¿Desea eliminar el registro?')){
            const fd = new FormData();

            fd.append('tabla', tabla);
            fd.append('id', id);

            fetch('eliminar.php',{

                method:'POST',
                body:fd

            })

            .then(response => response.json())

            .then(data => {

                if(tabla == 'categorias'){

                    cargarCategorias();

                }

                if(tabla == 'medicamentos'){

                    cargarMedicamentos(idCategoria);

                }

                if(tabla == 'lotes'){

                    cargarLotes(codigoMedicamento);

                }

            });

        }

    } else {

        alert('Seleccione un registro');

    }

}