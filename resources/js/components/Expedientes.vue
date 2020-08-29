<template>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Expedientes</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Expedientes</a></li>
                            <li class="breadcrumb-item active">Lista de expedientes</li>
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
                                <h3 class="card-title">Lista de pacientes</h3>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de los usuarios registrados -->
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="paciente in pacientes" :key="paciente.id">
                                        <td>{{paciente.id}}</td>
                                        <td>{{paciente.nombre}}</td>
                                        <td>{{paciente.apellido}}</td>

                                        <td>

                                        
                                        
                                        <button @click="verExpediente(paciente.id, paciente.nombre, paciente.apellido)" class="btn btn-primary"> <i class="fas fa-eye"></i></button>
                                        

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



            <!-- MODAL PARA VER EL EXPEDIENTE DEL PACIETE  -->
            <div class="modal fade" id="expedienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Expediente de paciente </b> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="imprimirExp">
                        <!-- Tabla que despliega la informaci+on de los usuarios registrados -->
                        
                        <h1> {{ pacienteACompartirNombre + " "  + pacienteACompartirApellido }} </h1>
                        Código: {{ pacienteACompartir }}

                        <hr>

                        <div v-show="this.pacientes_editar.info == 1" class="card bg-light mb-3" style="max-width: 100%;">
                            <div class="card-header">Información</div>
                            <div class="card-body">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Nombre: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.nombre }} </h5>
                                        </div>
                                    </div>
                                </div>
                                <!--permitira mostrar el apellido del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Apellido: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.apellido }} </h5>
                                        </div>
                                    </div>
                                </div>
                                <!--permitira mostrar la edad del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Edad: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.edad }}  </h5>
                                        </div>
                                    </div>
                                </div>
                                <!--permitira mostrar la altura del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Altura: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.altura }}  </h5>
                                        </div>
                                    </div>
                                </div>
                                <!--permitira mostrar el peso del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Peso: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.peso }}  </h5>
                                        </div>
                                    </div>
                                </div>
                                <!--permitira mostrar el sexo del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Sexo: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.pacientes_editar.sexo }} </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">IMC: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ (this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura)).toFixed(2) }} </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Condición: </label>
                                        </div>
                                        <div class="col-md-6">

                                            <span v-if="this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) < 18.5" class="tag tag-success">
                                                <h5> Peso inferior </h5>
                                            </span>
                                            <span v-else-if="this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) > 18.5 && this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) < 24.9 " class="tag tag-success"> 
                                                <h5> Normal </h5>
                                            </span>
                                            <span v-else-if="this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) > 25.0 && this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) <  29.9" class="tag tag-success"> 
                                               <h5> Sobrepeso </h5>
                                            </span>
                                            <span v-else-if="this.pacientes_editar.peso / (this.pacientes_editar.altura * this.pacientes_editar.altura) > 30.0" class="tag tag-success"> 
                                                <h5> Obesidad </h5>
                                            </span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div v-show="this.pacientes_editar.alergias == 1" class="card bg-light mb-3" style="max-width: 100%;">
                            <div class="card-header">Información sobre alergias</div>
                            <div class="card-body">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th> Algergia </th>
                                        <th> Tipo </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="alergia in alergias_paciente" >
                                        <td> {{ alergia.nombreAlergia }} </td>
                                        <td>{{ alergia.tipoAlergia }}</td>
                                        
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div v-show="this.pacientes_editar.enfermedades == 1" class="card bg-light mb-3" style="max-width: 100%;">
                            <div class="card-header">Información sobre enfermedades</div>
                            <div class="card-body">
                                
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th> cita </th>
                                        <th> Fecha de cita </th>
                                        <th> Enfermedad </th>
                                        <th> Observaciones </th>
                                        <th> Tipo </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="enfermedad in enfermedades_paciente" >
                                        <td>{{ enfermedad.id}}  </th>
                                        <td>{{ enfermedad.fecha }}</td>
                                        <td>{{ enfermedad.nombre}}</td>
                                        <td>{{ enfermedad.observaciones }}</td>
                                        <td>{{ enfermedad.tipo }}</td>
                                        
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div v-show="this.pacientes_editar.medicinas == 1" class="card bg-light mb-3" style="max-width: 100%;">
                            <div class="card-header">Información sobre medicinas</div>
                            <div class="card-body">
                                
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th> Cita</th>
                                        <th> Fecha de cita </th>
                                        <th> Medicamento </th>
                                        
                                        <th> Presentación </th>
                                        <th> Cantidad </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="medicamento in medicamentos_paciente" >
                                        <td> {{ medicamento.id_cita }} </td>
                                        <td>{{ medicamento.fecha }}</td>
                                        <td>{{medicamento.nombre}}</td>
                                        
                                        <td>{{ medicamento.presentacion }}</td>
                                        <td>{{ medicamento.observaciones }}</td>
                                        
                                    </tr>
                                    </tbody>
                                </table>


                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <a @click="imprimirExpediente('imprimirExp')" class="btn btn-danger"> <i class="fas fa-file-pdf"></i>  Descargar </a> 
                    </div>

                    </div>
                </div>
            </div>



           

        </div>
    </div>
</template>


<script>
    export default {
        name: "User",
        data(){
            return{
                editMode : false,
                pacientes : {},
                pacientes_editar: {},
                doctores: {},
                pacienteACompartir: {},
                pacienteACompartirNombre: "",
                pacienteACompartirApellido: "",
                asociados: {},
                expdientesCompartidos: {},
                expedientesPaciente: [],

                alergias_paciente: [],
                enfermedades_paciente: [],
                medicamentos_paciente: []

            }
        },
        methods:{
            
            
            imprimirExpediente(elem){
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                mywindow.document.write('<html><head><title>' + document.title  + '</title>');
                mywindow.document.write('</head><body >');
                mywindow.document.write('<h1>' + document.title  + '</h1>');
                mywindow.document.write(document.getElementById(elem).innerHTML);
                mywindow.document.write('</body></html>');
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/
                mywindow.print();
                mywindow.close();

                return true;
            },
            verExpediente(id, nombre, apellido){

                //expedienteModal
                this.pacienteACompartir = id;
                this.pacienteACompartirNombre = nombre;
                this.pacienteACompartirApellido = apellido;
                
                for( var i = 0; i < this.pacientes.length; i ++ ){
                    if(this.pacientes[i].id == id){
                        this.pacientes_editar = this.pacientes[i];
                    }
                }

                axios.get('api/obtenerAlergiasPaciente/'+id).then(({data}) => {
                    this.alergias_paciente = data;
                })

                axios.get('api/obtenerEnfermedadesPaciente/'+id).then(({data}) => {
                    this.enfermedades_paciente = data;
                })

                axios.get('api/obtenerMedicamentosPaciente/'+id).then(({data}) => {
                    this.medicamentos_paciente = data;
                })
                
                $('#expedienteModal').modal('show');

            },
            //Metodo que permite obtener los datos de los pacientes registrados
            cargarPacientes(){

                // Hace una peticion a la tabla pacientes a traves del controllador de PacientesController
              

                axios.get('api/obtenerPacientesExpediente/' + this.$props.id).then(({data}) => {
                    this.pacientes = data
                    console.log("Tamaño de this.pacientes " + this.pacientes.length);
                    console.log(data);
                })
            },

            
        },
        props: {
            tipo: String,
            id : String
        },
        created(){
            
            if(this.$props.tipo == '4' || this.$props.tipo == '2' ){
                this.$router.push('noacceso') 
            }

            this.cargarPacientes();
        }
    }
</script>

<style scoped>

</style>

