<template>
    <!--Componente para registrar nuevos uusarios que pueden acceder al sistema.
        Esta vista solo puede ser vista por el administrador del sistema -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Usuarios</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                            <li class="breadcrumb-item active">Lista de usuarios</li>
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
                                <h3 class="card-title">Lista usuarios</h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal"> <i class="fas fa-user-plus"></i> Crear nuevo usuario</button>
                                </div>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de los usuarios registrados -->
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Tipo</th>
                                        <th>Administración</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{user.id}}</td>
                                        <td>{{user.name}}</td>
                                        <td>{{user.last_name}}</td>
                                        <td>{{user.email}}</td>
                                        
                                        <td>
                                            <span v-if="user.tipo == '1'" class="tag tag-success">
                                                Administrador
                                            </span>
                                            <span v-else-if="user.tipo == '2'" class="tag tag-success"> 
                                                Medico
                                            </span>
                                            <span v-else-if="user.tipo == '3'" class="tag tag-success"> 
                                                Medico asociado
                                            </span>
                                            <span v-else-if="user.tipo == '4'" class="tag tag-success"> 
                                                Secretaria
                                            </span>
                                        </td>
                                        
                                        <td>
                                        <button @click="modal_editar_usuario(user.id)" class="btn btn-warning"> <i class="fas fa-pen"></i> </button>
                                        <button @click="eliminarUsuario(user.id)" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
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
            <!-- Modal -->
            <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Agregar usuario</h5>
                            <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Actualizar usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? actualizarUsuario() : crearUsuario()" >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Apellido:</label>
                                <input id="lastName" type="text" name="lastName" class="form-control" >
                            </div>


                            <div class="form-group">
                                <label>Correo:</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Tipo de usuario:</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="1">Administrador</option>
                                    <option value="2">Medico</option>
                                    <option value="3">Medico asociado</option>
                                    <option value="4">Secretaria</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label v-show="!editMode">Contraseña: </label>
                                <input v-show="!editMode" type="password" name="password" id="password" class="form-control" >
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Registrar</button>
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
        name: "User",
        //Propiedades del componente, pueden ser accedidas por todo el componente, incluyendo los metodos y plantilla
        data(){
            return{
                editMode : false,
                users : {},
                usuario_editar: {},

            }
        },
        methods:{

            //funcion para editar losd atos de un ususario
            actualizarUsuario(){
                //Se obtienen los campos del formulario
                var nombre = document.getElementById("name");
                var apellido = document.getElementById("lastName");
                var tipo = document.getElementById("type");
                var correo = document.getElementById("email");
                var contrasena = document.getElementById("password");

                this.usuario_editar.name = nombre.value;
                this.usuario_editar.last_name = apellido.value;
                this.usuario_editar.tipo = tipo.value;
                this.usuario_editar.email = correo.value;
                

                //Se hace una peticion para editar los datos, asi como se manda los datos a traves de un objeto de javascript
                axios.post('api/actualizarUsuario', this.usuario_editar )
                .then((response)=>{
                    //Si todo salio correctamente se despliega un peuqño mensaje
                    Fire.$emit('despuesActualizar');
                    $('#modalUsuario').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Usuario actualizado correctamente'
                    });

                    console.log(response);
                })
                .catch(() => {
                    this.$Progress.fail();
                });


            },

            modal_editar_usuario(id){
                this.editMode = true;

                //Obitene los datos del usuario a eliminar
                for(var i=0; i < this.users.length; i++){
                    if( this.users[i].id == id){
                        this.usuario_editar = this.users[i];
                    }
                }
                
                //Se obtienen los campos del formulario
                var nombre = document.getElementById("name");
                var apellido = document.getElementById("lastName");
                var tipo = document.getElementById("type");
                var correo = document.getElementById("email");
                var contrasena = document.getElementById("password");

                //Limpia los campos del formulario
                nombre.value = "";
                apellido.value = "";
                tipo.value = "1";
                correo.value = "";
                contrasena.value = "";

                //Abre el modal para esta vez para editar los datos
                $('#modalUsuario').modal('show');

                //Llena los campos con los del usuario a editar
                nombre.value = this.usuario_editar.name;
                apellido.value = this.usuario_editar.last_name;
                tipo.value = this.usuario_editar.tipo;
                correo.value = this.usuario_editar.email;
                
                
                delete this.usuario_editar.password;
                //contrasena.value = usuario_editar.password;

                //this.form.fill(user);
            },

            //Abre el modal para registrar un nuevo usuario pero antes de eso lo limpia
            newModal(){
                this.editMode = false;
                var nombre = document.getElementById("name");
                var apellido = document.getElementById("lastName");
                var tipo = document.getElementById("type");
                var correo = document.getElementById("email");
                var contrasena = document.getElementById("password");

                nombre.value = "";
                apellido.value = "";
                tipo.value = "1";
                correo.value = "";
                contrasena.value = "";

                $('#modalUsuario').modal('show');
            },


            //Metodo para realzar la eliminacion de un usuario, la eliminacion se realiza de manera fisica de la base de datos
            eliminarUsuario(id){
                swal.fire({
                    title: 'Eliminar usuario',
                    text: "¿Estás seguro que quieres eliminar a este usuario?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarUsuario/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Usuario eliminado',
                                'El usuario ha sido eliminado',
                                'success'
                            )

                            Fire.$emit('despuesEliminar');

                        }).catch(function (error) {
                            // Maneja el error si la peticion no se llevo a cabo correctamente
                            swal.fire(
                                'Error al eliminar',
                                'El usuario no se ha podido eliminar',
                                'error'
                            )
                        })
                    }
                })
            },

            //Metodo que permite obtener los datos de los usuarios registrados
            cargarUsuarios(){
                // Hace una peticion a los usuarios registrados en la bd
                axios.get('api/usuarios').then(({data}) => (this.users = data.data))

            },


            //Guarda a un nuevo usuario
            crearUsuario(){
                

                //Realiza una peticion de tipo post a la ruta registrarUsuarios que se encarga de guardar los datos pasados por medio del formulario del modal

                //Se obtienen los campos del formulario
                var nombre = document.getElementById("name");
                var apellido = document.getElementById("lastName");
                var tipo = document.getElementById("type");
                var correo = document.getElementById("email");
                var contrasena = document.getElementById("password");

                //Valida que el formulario tenga todos los datos
                if( nombre.value == "" || apellido.value == "" || tipo.value == "" || correo.value == "" || contrasena.value == "" ){
                    //Si no es asi aparece un pequeño mensaje de error
                    toast.fire({
                            type: 'error',
                            title: 'Llene todos los datos'
                        });
                }else{
                    this.$Progress.start();
                    axios.post('api/registrarUsuario', {name: nombre.value, lastName: apellido.value, type: tipo.value , email: correo.value, password: contrasena.value })
                    .then((response)=>{
                        
                        //Si la respuesta responde todo bien
                        //Se ejecuta la animacion de la barrita
                        Fire.$emit('despuesCrear');

                        //Una pequeña alerta en la esquina
                        toast.fire({
                            type: 'success',
                            title: 'Usuario creado correctamente'
                        });
                        this.$Progress.finish();

                        //El modal que contiene el formulario desaparece
                        $('#modalUsuario').modal('hide');

                        nombre.value = "";
                        apellido.value = "";
                        tipo.value = "1";
                        correo.value = "";
                        contrasena.value = "";

                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        this.$Progress.fail();
                        console.log(error);
                    })

                }

            }
        },
        //Prpiedades que son accedidas cuando el componente es accedido
        props: {
            tipo: String
        },
        created(){
            //Solo el administrador puede ver esta vista
            if(this.$props.tipo != '1'){
                this.$router.push('noacceso') 
            }

            this.cargarUsuarios();
            Fire.$on('despuesCrear',() => this.cargarUsuarios());
            Fire.$on('despuesEliminar',() => this.cargarUsuarios());
            Fire.$on('despuesActualizar',() => this.cargarUsuarios());

            
        }
    }
</script>