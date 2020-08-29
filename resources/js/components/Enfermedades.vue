<template>
    <!-- Componente que gestiona el catalogo de las enfermedades, estas son llenadas por los medicos por lo que solo el perfil de medico puede acceder a esta vista-->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Enfermedades</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Enfermedades</a></li>
                            <li class="breadcrumb-item active"> Listado de enfermedades </li>
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
                                <h3 class="card-title"> Lista de enfermedades registradas </h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal"> <i class="fas fa-bacterium"></i> Crear nuevo registro </button>

                                </div>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de las enfermedades registradas -->
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Causa</th>
                                        <th>Administración</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="enfermedad in enfermedades" :key="enfermedad.id">
                                        
                                        <td>{{enfermedad.id}}</td>
                                        <td>{{enfermedad.nombre}}</td>
                                        <td>{{enfermedad.tipo}}</td>
                                        <td>{{enfermedad.causa}}</td>
                                        
                                        <td>
                                            <!-- Botones para actualizar o eliminar una enfermedad -->
                                            <button @click="modal_editar_enfermedad(enfermedad.id)" class="btn btn-warning"> <i class="fas fa-pen"></i> </button>
                                            <button @click="eliminarEnfermedad(enfermedad.id)" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
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

            <!-- Modal que muestra el formulario para realizar el registro de una nueva enfermedad -->
            <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Agregar registro enfermedad</h5>
                            <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Actualizar registro enfermedad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? actualizarEnfermedad() : crearEnfermedad()" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tipo:</label>
                                <input type="text" id="tipo" name="tipo" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Causa:</label>
                                <textarea type="text" id="causa" name="causa" class="form-control" required>
                                </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cerrar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success"> <i class="fas fa-pen"></i> Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary"> <i class="fas fa-plus"></i> Registrar</button>
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
        //Nombre del componente
        name: "Enfermedades",
        //Propiedades del componente
        data(){
            return {
                editMode: false,
                enfermedades: {},
                enfermedad_editar: {},
                enfermedad_editar: {
                    id: '',
                    nombre: '',
                    tipo: '',
                    causa: ''
                }
            }
        },
        //Logica del componente
        methods:{
            //Metodo que permite obtener los datos de las enfermedades registradas
            cargarEnfermedaes(){
                // Hace una peticion a la tabla diseases en la base de datos a traves de la ruta
                axios.get('api/obtenerEnfermedades')
                .then(({data}) => {
                    this.enfermedades = data;
                });
            },

            //Abre el modal para registrar una nueva enfermedad
            newModal(){
                this.editMode = false;
                var nombre = document.getElementById("nombre");
                var tipo = document.getElementById("tipo");
                var causa = document.getElementById("causa");
                nombre.value = "";
                tipo.value = "";
                causa.value = "";
                $('#modalUsuario').modal('show');
            },

            crearEnfermedad() {
                var nombre = document.getElementById("nombre");
                var tipo = document.getElementById("tipo");
                var causa = document.getElementById("causa");
                if(nombre.value == "" || tipo.value == "" || causa.value == "" ){
                    toast.fire({
                        type: 'error',
                        title: 'Llene todos los campos del formulario'
                    });
                }else{
                    axios.post('api/registrarenfermedad', {nombre: nombre.value, tipo: tipo.value, causa: causa.value})
                    .then((response)=>{
                        //Si la respuesta responde todo bien
                        //Se ejecuta la animacion de la barrita
                        this.cargarEnfermedaes();
                        //Una pequeña alerta en la esquina
                        toast.fire({
                            type: 'success',
                            title: 'Enfermedad creada correctamente'
                        });
                        this.$Progress.finish();
                        //El modal que contiene el formulario desaparece
                        $('#modalUsuario').modal('hide');
                        nombre.value = "";
                        tipo.value = "";
                        causa.value = "";

                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        this.$Progress.fail();
                        console.log(error);
                    })
                }
            },


            //Modal para editar el registro, coloca los datos actuales en el formulario
            modal_editar_enfermedad(id){

                this.editMode = true;

                var nombre = document.getElementById("nombre");
                var tipo = document.getElementById("tipo");
                var causa = document.getElementById("causa");

                //Obitene los datos del usuario a eliminar
                for(var i=0; i < this.enfermedades.length; i++){
                    if( this.enfermedades[i].id == id){
                        this.enfermedad_editar = this.enfermedades[i];
                    }
                }
                nombre.value = this.enfermedad_editar.nombre;
                tipo.value = this.enfermedad_editar.tipo;
                causa.value = this.enfermedad_editar.causa;
                $('#modalUsuario').modal('show');
            },

            actualizarEnfermedad() {

                var nombre = document.getElementById("nombre");
                var tipo = document.getElementById("tipo");
                var causa = document.getElementById("causa");
                this.enfermedad_editar.nombre = nombre.value;
                this.enfermedad_editar.tipo = tipo.value;
                this.enfermedad_editar.causa = causa.value;
                axios.post('api/actualizarenfermedad', this.enfermedad_editar )
                .then((response)=>{
                    
                    this.cargarEnfermedaes();

                    $('#modalUsuario').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Registro actualizado correctamente'
                    });
                })
                .catch(() => {
                    toast.fire({
                        type: 'success',
                        title: 'Error al actualizar'
                    });
                });
            },

            //Elimina el registro de una enfermedad
            eliminarEnfermedad(id)  {
                swal.fire({
                    title: '¿Eliminar registro de enfermedad?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cacelar',
                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarenfermedad/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Registro de enfermedad eliminado',
                                'El registro ha sido eliminado',
                                'success'
                            )

                            this.cargarEnfermedaes();

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
        //Propiedades que son obtenidas cuando el componente es cargado
        props: {
            tipo: String
        },
        //ESTO SE EJECUTA VUANDO SE TERMINA DE CARGAR LA VISTA 
        created(){
            //Compara si el usuario loggeado puede ver la vista, solo el medico y el admin pueden verla (tipos 1 y 2)
            if(this.$props.tipo == '4' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }

            this.cargarEnfermedaes();
        }
    }
</script>

<style scoped>

</style>
