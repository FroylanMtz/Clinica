<template>

    <!-- Compoenente que muestra las citas ya agendadas, esta visa se usa para seleccionar una y llenar sus detalles
    Este componente esta pensado para ser visto por el personal medico unacamente, ya que ellos son los que atienden las citas medicas y llenan los datos-->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Citas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Citas</a></li>
                            <li class="breadcrumb-item active"> Listado de citas </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 ">
                        <div class="card">
                            <!-- Esta tabla muestra unicamente las cita que estan agendadas para el dia presente en que se accede a la pagina-->
                            <div class="card-header">
                                <h3 class="card-title"> <b> Citas de hoy </b> </h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Detalles</th>
                                            <th>Paciente</th>
                                            <th>Doctor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cita in citashoy" :key="cita.id">
                                            <td>{{cita.id}}</td>
                                            <td>{{cita.fecha}}</td>
                                            <td>{{cita.hora}}</td>
                                            <td>{{cita.detalles}}</td>
                                            <td>{{cita.nombre + " " + cita.apellido}}</td>
                                            <td>{{cita.nombredoctor + " " + cita.apellidodoctor}}</td>
                                            <td>
                                                <button @click="abrirMostrarPagina(cita.id)" class="btn btn-success"> <i class="fas fa-eye"></i> </button>

                                                <!-- La descarga del PDF esta condicionada para que se muestre unicamente si se han registrado los datos de la cita asi como el pago de la misma -->
                                                <span v-show="!(cita.id_enfermedad==null || cita.pago == null)">
                                                    <a :href="'api/generarReporteCitas/'+cita.id" class="btn btn-danger"> <i class="fas fa-file-pdf"></i>  </a> 
                                                </span>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <b> Otras citas </b> </h3>
                            </div>
                            <!-- Esta tabla muestra las demas citas registradas en otros dias que no sea el de hoy, incluso las que ya han pasado -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Detalles</th>
                                            <th>Paciente</th>
                                            <th>Doctor</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cita in citas" :key="cita.id">
                                            <td>{{cita.id}}</td>
                                            <td>{{cita.fecha}}</td>
                                            <td>{{cita.hora}}</td>
                                            <td>{{cita.detalles}}</td>
                                            <td>{{cita.nombre + " " + cita.apellido}}</td>
                                            <td>{{cita.nombredoctor + " " + cita.apellidodoctor}}</td>
                                            <td>
                                                <button @click="abrirMostrarPagina(cita.id)" class="btn btn-success"> <i class="fas fa-eye"></i> </button>
                                                
                                                <!-- La descarga del PDF esta condicionada para que se muestre unicamente si se han registrado los datos de la cita asi como el pago de la misma -->
                                                <span v-show="!(cita.id_enfermedad==null || cita.pago == null)">
                                                    <a :href="'api/generarReporteCitas/'+cita.id" class="btn btn-danger"> <i class="fas fa-file-pdf"></i>  </a> 
                                                </span>
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
        name: "lista_citas",

        //Propiedades del componente
        data(){
            return {
                citas: {},
                citashoy: {}
            }
        },

        //Metodos del componente, son los que realizan la mayor parte de la logica del componente
        methods:{
            abrirMostrarPagina(id){
                //Regidrecciona hacia otro componente en el cual son registrados los detalles de la cita
                this.$router.push({ name: 'mostrarcita', params: {id: id}})
            },

            //Fucion que se usa para cargar las citas
            cargarcitas(){


                if( this.$props.tipo == '2' ){
                    //Si se accede con la sesion de medico muestra las citas asociadas a el
                    axios.get('api/obtnerCitas/'+this.$props.id)
                    .then(({data}) => {
                        this.citas = data;
                    });

                    axios.get('api/obtenerCitasHoy/'+this.$props.id)
                    .then(({data}) => {
                        this.citashoy = data;
                    });

                }else{
                    //Si se accede como admin se muestran todas las citas
                    axios.get('api/obtnerCitas/0')
                    .then(({data}) => {
                        this.citas = data;
                    });

                    axios.get('api/obtenerCitasHoy/0')
                    .then(({data}) => {
                        this.citashoy = data;
                    });
                }
                
            }
        },
        //Propiedades que son pasadas al componente cuando este es accedido
        props: {
            tipo: String,
            id: String
        },

        //Metodo que se ejecuta cuando el componente es creado, muestra las citas en las tablas
        created(){
            //Valida si el usuario loggeado puede ver la pagina, sino lo redirecciona hacia un componente que muestra un mensaje de error
            if(this.$props.tipo == '4' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }
            this.cargarcitas();
        }
    }
</script>