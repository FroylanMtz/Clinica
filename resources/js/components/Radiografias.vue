<template>
    <!-- Componente que despliega las ragiografias compartidas con los medicos asociados, esta vista es solo accedida por el admin y los medicos,
    Se puede subir una nueva imagen y compartirla con un medico asociado en el formulario de esta vista -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Radiografias</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Radiografias</a></li>
                            <li class="breadcrumb-item active"> Listado de radiografias </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="container">
                <div class="row justify-content-center">
                    <!-- Formulario con el que selecciona el medico asociado a compartir la iamgen, asi como subir la imagen seleccionandola de un archivo local de tu computadora -->
                    <div class="col-md-3">
                        <div class="card card-default">
                            <div class="card-header">Compartir radiografia</div>
                            <div class="card-body">
                            <div class="row">

                                <div class="form-group">
                                    <label>Medico asociado: </label>
                                    <select class="form-control" name="doctorasoc" id="doctorasoc" required>
                                        <option v-for="asociado in asociados" :key="asociado.id" v-bind:value="asociado.id">
                                        {{asociado.name}}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <!-- Para seleccionar una imagen de nuestra computadora y subirla al servidor -->
                                    <label> Archivo: </label>
                                    <input type="file" v-on:change="onImageChange" class="form-control">
                                </div>
                                
                            </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" @click="uploadImage"> <i class="fas fa-image"></i> Compartir </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Lista de radiografias compartidas </h3>
                            </div>
                            <div class="card-body table-responsive p-0">

                                <!-- Listado de las imagenes compartidas con los medicos asociados,
                                Puede verse tambien la imagen que se compartio y si se da clic en ella se abre ene grande en otra pestaña del navegador-->
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Medico</th>
                                        <th>Medico Asociado</th>
                                        <th>Comentario</th>
                                        <th>Administracion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="radiografia in radiografias" :key="radiografia.id">
                                        <td>
                                            <a :href="'http://142.93.49.246/images/'+radiografia.ruta" target="_blank">
                                                <img :src="'/images/'+radiografia.ruta" style="width:100px;">
                                            </a>
                                        </td>
                                        <td>
                                            {{radiografia.nombreMedico + " " + radiografia.apellidoMedico}}
                                        </td>
                                        <td>
                                            {{radiografia.nombreAsociado + " " + radiografia.apellidoAsociado}}
                                        </td>
                                        <td> <b> {{radiografia.comentario}} </b> </td>
                                        <td>
                                        <button @click="eliminarRadiografia(radiografia.id)" class="btn btn-danger btn-block"> <i class="fas fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
        //Nombre del componente
        name: "Radiografias",
        //Datos del componente, entre ellas esta la imagen que va a subirse
        data(){
            return {
                image:'',
                radiografias: {},
                asociados : [], //Almacena los medicos asociados, para seleccionar a cual sera compartida la radiografia
            }
        },

        //Logica del componente
        methods:{
            
            //Obtiene la imagen que se ha seleccionado para subirla al server
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },

            //Obtiene la imagen subida y la guarda en una variable
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            //Metodo que permite subir una foto al server, las imagenes subidas son guardadas en la carpeta images en la carpeta publica
            uploadImage(){
                var asociado = document.getElementById("doctorasoc");
                axios.post('api/guardarRadiografia', {image: this.image, asociado: asociado.value, medico: this.$props.id }).then(response => {
                   console.log(response);

                   this.cargarRadiografias();
                });
            },

            //Metodo que permite obtener los datos de las radiografias compartidas
            cargarRadiografias(){
                
                axios.get('api/obtenerRadiografias')
                .then(({data}) => {
                    this.radiografias = data;
                });

                axios.get('api/obtenerMedicosAsociados').then(({data}) => {
                    this.asociados = data;
                })

            },

            //Funcion que se encarga de eliminar lso datos de una radiografia compartida, esto no elimina el archivo previamente subido al servidor
            eliminarRadiografia(id)  {
                console.log("id " + id);
                swal.fire({
                    title: '¿Deseas eliminar la radiografia? ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cacelar',
                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarRadiografia/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Radiografia eliminada',
                                'El registro ha sido eliminado',
                                'success'
                            )
                            
                            console.log( response );

                            this.cargarRadiografias();

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
        //Propiedades que son pasadas al componete cuando este es acceido
        props: {
            tipo: String,
            id: String
        },
        created(){
            //Verifica si el usuario loggeado puede ver la vista
            if(this.$props.tipo == '4' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }
            this.cargarRadiografias();
        }
    }
</script>

<style scoped>

</style>
