<template>
    <!-- Componente que esta destinado al medico asociado, este componente sirve para que el medico asociado escriba una comentario 
    de la radiografica (imagen) que le ha compartido un medico principal o un administrador -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Radiografias compartidas</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Radiografias compartidas</a></li>
                            <li class="breadcrumb-item active"> Lista de radiografias compartidas </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="container">
                <div class="row justify-content-center">


                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Lista de radiografias compartidas </h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <!-- Se muestran las radiografias compartidas con el medico asociado, realiza un filtrado unicamente en las que esta asociado
                                es decir no puede ver las de otro medico asociado-->
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Medico que comparte</th>
                                        <th>Comentario</th>
                                        <th>Administracion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="radiografia in radiografias" :key="radiografia.id">
                                        <td>
                                            <!-- Esta celda muestra la imagen pero ademas la hace cliqueable para que la imagen se muestra completa en otra pestaña-->
                                            <a :href="'http://142.93.49.246/images/'+radiografia.ruta" target="_blank">
                                                <img :src="'/images/'+radiografia.ruta" style="width:100px;">
                                            </a>
                                        </td>
                                        <td>
                                            {{radiografia.nombreMedico + " " + radiografia.apellidoMedico}}
                                        </td>
                                        <td>{{radiografia.comentario}}</td>
                                        <td>
                                            <!-- Abre un modal para que el medico asociado escriba un comentario sobre la radiografia -->
                                            <button @click="abrirModalComentario(radiografia.id_usuario_archivo)" class="btn btn-primary btn-block"> <i class="fas fa-comment"></i> Dejar comentario</button>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- Modal para escribir el comentario, contiene un boton para guardar los cambios -->
                    <div class="modal fade" id="comentarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Registrar/Editar comentario </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="guardarComentario()" >
                                    
                                    <div class="form-group">
                                        <label>Comentario: </label>
                                        
                                        <textarea id="observaciones_ta" class="form-control" rows='3'> </textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-comment-medical"></i> Guardar </button>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
</template>

<script>
    export default {
        //Nombre del compoenente
        name: "Comentar radiografias",
        //Propiedades del componente
        data(){
            return {
                image:'',
                radiografias: {},
                asociados : [],
                radiografia: {}
            }
        },
        //Logica del componente
        methods:{

            //Metodo que permite obtener los datos de las radiograficas compartidas registradas
            cargarRadiografias(){
                
                axios.get('api/obtenerRadiografiasCompartidas/'+this.$props.id)
                .then(({data}) => {
                    this.radiografias = data;
                });

                axios.get('api/obtenerMedicosAsociados').then(({data}) => {
                    this.asociados = data;
                })

            },

            //Abre el modal y ademas muestra el texto si ya se ha guardado uno antes (Para realizar una edicion)
            abrirModalComentario(id)  {
                $('#comentarioModal').modal('show');

                var comentario_actual = document.getElementById("observaciones_ta");

                //Busqueda del comentario seleccionado
                for(var i = 0; i < this.radiografias.length; i++ ){
                    if(this.radiografias[i].id_usuario_archivo == id){
                        this.radiografia = this.radiografias[i];
                        comentario_actual.value= this.radiografias[i].comentario;
                        break;
                        
                    }
                }
                
            },

            //Guarda el comentario en la base de datos a traves de una peticion post con axios
            guardarComentario(){
                var comentario_actual = document.getElementById("observaciones_ta");

                axios.post('api/guardarComentarioRadiografia', {id: this.radiografia.id_usuario_archivo , comentario: comentario_actual.value})
                    .then((response)=>{

                        console.log(response);

                        //Una pequeña alerta en la esquina
                        toast.fire({
                            type: 'success',
                            title: 'Comentario guardado'
                        });

                        //El modal que contiene el formulario desaparece
                        $('#comentarioModal').modal('hide');

                        this.cargarRadiografias();

                    }).catch(function (error) {
                        console.log(error);
                    })
            }
        },
        //Propiedades que son obtenidas cuando el componente es creado
        props: {
            tipo: String,
            id: String
        },
        //Metdo que carga las radiografias en cuanto es accedido
        created(){
            //Comparacion si el usuario loggeado puede ver la pagina
            if(this.$props.tipo == '2' || this.$props.tipo == '4'){
                this.$router.push('noacceso') 
            }
            this.cargarRadiografias();
        }
    }
</script>

<style scoped>

</style>
