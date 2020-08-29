<template>
    <!-- Componente que se encarga de la gestion del catalogo de medicamentos -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Medicamentos</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>
                            <li class="breadcrumb-item active"> Listado de medicamentos </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 ">
                        <!-- Tarjeta del modal -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Lista de medicamentos registrados </h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="nuevoMedicamentoModal"> <i class="fas fa-tablets"></i> Crear nuevo registro de medicamento </button>

                                </div>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de los medicamentos registrados -->
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Presentación</th>
                                        <th>Detalles</th>
                                        <th>Administración</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="medicamento in medicamentos" :key="medicamento.id">
                                        
                                        <td>{{medicamento.id}}</td>
                                        <td>{{medicamento.nombre}}</td>
                                        <td>{{medicamento.presentacion}}</td>
                                        <td>{{medicamento.detalles}}</td>
                                        
                                        <td>
                                        <button @click="modalEditarMedicamento(medicamento.id)" class="btn btn-warning"> <i class="fas fa-pen"></i> </button>
                                        <button @click="eliminarMedicamento(medicamento.id)" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                        </td>
                                    
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

            <!-- Modal que despliega el fomrulario para registrar un nuevo medicamento -->
            <div class="modal fade" id="modalMedicamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!modoedicion" class="modal-title" id="exampleModalLongTitle">Agregar nuevo medicamento</h5>
                            <h5 v-show="modoedicion" class="modal-title" id="exampleModalLongTitle">Actualizar datos del medicamento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="modoedicion ? actualizarMedicamento() : crearMedicamento()" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Presentación:</label>
                                <input type="text" id="presentacion" name="presentacion" class="form-control" required>
                            </div>


                            <div class="form-group">
                                <label>Detalles:</label>
                                <textarea type="text" id="detalles" name="detalles" class="form-control" required>
                                </textarea>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cerrar</button>
                            <button v-show="modoedicion" type="submit" class="btn btn-success"> <i class="fas fa-pen"></i> Actualizar</button>
                            <button v-show="!modoedicion" type="submit" class="btn btn-primary"> <i class="fas fa-plus"></i> Registrar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        //Nombre del medicamento
        name: "Medicamentos",
        //DAtos del componete estos pueden ser accedidos en todos los metodos del componente o en la plantilla
        data(){
            return {
                modoedicion: false,
                medicamentos: {},
                medicamento_editar: {},
                medicamento_editar: {
                    id: '',
                    nombre: '',
                    presentacion: '',
                    detalles: ''
                }                
            }
        },
        //Logica del componente
        methods:{

            //Metodo que permite obtener los datos de las medicamentos registradas
            cargarMedicamentos(){
                // Hace una peticion a la tabla diseases en la base de datos a traves de la ruta
                axios.get('api/obtenermedicamentos')
                .then(({data}) => {
                    this.medicamentos = data;
                });
            },

            nuevoMedicamentoModal(){
                this.modoedicion = false;
                var nombre = document.getElementById("nombre");
                var presentacion = document.getElementById("presentacion");
                var detalles = document.getElementById("detalles");
                nombre.value = "";
                presentacion.value = "";
                detalles.value = "";
                $('#modalMedicamento').modal('show');
            },

            crearMedicamento() {
                var nombre = document.getElementById("nombre");
                var presentacion = document.getElementById("presentacion");
                var detalles = document.getElementById("detalles");
                if(nombre.value == "" || presentacion.value == "" || detalles.value == "" )
                {
                    toast.fire({
                        type: 'error',
                        title: 'Llene todos los campos del formulario'
                    });

                }else{
                    //Peticion post al controlador para guardar los datos de un nuevo medicamento
                    axios.post('api/registrarMedicamento', {nombre: nombre.value, presentacion: presentacion.value, detalles: detalles.value})
                    .then((response)=>{
                        
                        //Si la respuesta responde todo bien
                        //Se ejecuta la animacion de la barrita
                        this.cargarMedicamentos();

                        //Una pequeña alerta en la esquina
                        toast.fire({
                            type: 'success',
                            title: 'Medicamento creado correctamente'
                        });
                        this.$Progress.finish();

                        //El modal que contiene el formulario desaparece
                        $('#modalMedicamento').modal('hide');

                        nombre.value = "";
                        presentacion.value = "";
                        detalles.value = "";

                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        this.$Progress.fail();
                        console.log(error);
                    })


                }

            },

            //Abre el modal con el formulario, solo que en esta ocasion coloca los datos en el formulario del medicamento seleccionado
            modalEditarMedicamento(id){
                this.modoedicion = true;
                var nombre = document.getElementById("nombre");
                var presentacion = document.getElementById("presentacion");
                var detalles = document.getElementById("detalles");
                //Obitene los datos del medicamento a editar
                for(var i=0; i < this.medicamentos.length; i++){
                    if( this.medicamentos[i].id == id){
                        this.medicamento_editar = this.medicamentos[i];
                    }
                }
                nombre.value = this.medicamento_editar.nombre;
                presentacion.value = this.medicamento_editar.presentacion;
                detalles.value = this.medicamento_editar.detalles;
                $('#modalMedicamento').modal('show');
            },
            //Metodo que manda la peticion al controlador para que edite los datos de un medicamento
            actualizarMedicamento() {
                var nombre = document.getElementById("nombre");
                var presentacion = document.getElementById("presentacion");
                var detalles = document.getElementById("detalles");
                this.medicamento_editar.nombre = nombre.value;
                this.medicamento_editar.presentacion = presentacion.value;
                this.medicamento_editar.detalles = detalles.value;
                axios.post('api/actualizarMedicamento', this.medicamento_editar )
                .then((response)=>{
                    this.cargarMedicamentos();
                    $('#modalMedicamento').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Medicamento actualizado correctamente'
                    });
                })
                .catch(() => {
                    toast.fire({
                        type: 'success',
                        title: 'Error al actualizar el medicamento'
                    });
                });
            },

            //Metodo que elimina los datos de un medicamento reistrado, realiza una eliminacion fisica de la base de datos
            eliminarMedicamento(id)  {
                swal.fire({
                    title: '¿Eliminar medicamento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cacelar',
                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarMedicamento/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Registro de enfermedad eliminado',
                                'El registro ha sido eliminado',
                                'success'
                            )

                            this.cargarMedicamentos();

                        }).catch(function (error) {
                            // Maneja el error si la peticion no se llevo a cabo correctamente
                            swal.fire(
                                'Error al eliminar',
                                'El registro no se ha podido eliminar',
                                'error'
                            )
                        })
                    }
                })
            }


        },
        //Propiedades que son pasadas al componente cuando es accedido, estas propiedades vienen desde el archivo master.blade.php
        props: {
            tipo: String
        },

        created(){
            //Hace la comparacion si el usuario loggeado puede ver la vista, sino lo redirecciona a un componete de alerta
            if(this.$props.tipo == '4' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }
            
            //Carga los medicamentos que son mostrados en la tabla
            this.cargarMedicamentos();
        }
    }
</script>