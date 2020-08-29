<template>
    <!-- Componente que es usado para registrar a los pacientes de la clinete
    asi mismo en esta pagina son mostrados el expediente, y la vista para controlar la comparticion del paciente con un medico asociado-->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pacientes</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
                            <li class="breadcrumb-item active">Lista de pacientes</li>
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

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="modalNuevoPaciente"> <i class="fas fa-user-injured"></i> Registrar paciente </button>

                                </div>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de los pacientes registrados -->
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Edad</th>
                                        <th>Altura</th>
                                        <th>Peso</th>
                                        <th>Sexo</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="paciente in pacientes" :key="paciente.id">
                                        <td>{{paciente.id}}</td>
                                        <td>{{paciente.nombre}}</td>
                                        <td>{{paciente.apellido}}</td>
                                        <td>{{paciente.edad}}</td>
                                        <td>{{paciente.altura}}</td>
                                        <td>{{paciente.peso }}</td>
                                        <td>{{paciente.sexo}}</td>
                                        <td>{{paciente.fecha_nacimiento}}</td>

                                        <td>

                                        <button @click="modal_editar_usuario(paciente.id)" class="btn btn-warning"> <i class="fas fa-pen"></i> </button>
                                        <button @click="eliminarUsuario(paciente.id)" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                        <button @click="verExpediente(paciente.id, paciente.nombre, paciente.apellido)" class="btn btn-primary"> <i class="fas fa-eye"></i></button>
                                        <button @click="comprartirPaciente(paciente.id, paciente.nombre, paciente.apellido)" class="btn btn-success"> <i class="fas fa-share-square"></i></button>

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


            <!-- MODAL PARA LA COMPARTICACION DEL EXPEDIENTE DEL PACIENTE -->
            <div class="modal fade" id="compartirPacienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compartir expediente del paciente <b> {{ pacienteACompartirNombre + " "  + pacienteACompartirApellido }} </b> con medico asociado </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Seleccione el medico asociado y lo que puede ver </b> </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tabla que despliega la informaci+on de los usuarios registrados -->
                                    
                                    <!-- Formulario para compartir el expediente a un medico asociado -->
                                    <form @submit.prevent="guardarComparticion()" >
                                    
                                        <div class="form-group">
                                            <label>Medico asociado: </label>
                                            <select class="form-control" name="doctorasoc" id="doctorasoc" required>
                                                <option v-for="asociado in asociados" :key="asociado.id" v-bind:value="asociado.id">
                                                {{asociado.name}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Informacion del paciente: </label>
                                            <select class="form-control" name="info_paciente" id="info_paciente" required>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Alergias: </label>
                                            <select class="form-control" name="alergias_paciente" id="alergias_paciente" required>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Enfermedades: </label>
                                            <select class="form-control" name="enfermedades_paciente" id="enfermedades_paciente" required>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Medicamentos: </label>
                                            <select class="form-control" name="medicamentos_paciente" id="medicamentos_paciente" required>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary"> <i class="fas fa-user-plus"></i> Guardar </button>
                                    </form>

                                </div>
                                
                                </div>
                            </div>
                        </div>
                        

                        

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#registroModal">
                            <i class="fas fa-share"></i> Compartir a medico asociado
                        </button>

                        

                        <!-- Tabla que despliega la informaci+on de la comparticion de los pacientes -->
                        <table class="table table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th> Medico que compartio</th>
                                <th> Medico asociado </th>
                                <th> Fecha </th>
                                <th> Puede ver </th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="expediente in expedientesPaciente" :key="expediente.id">
                                <td>{{expediente.nombreMedico + " " + expediente.apellidoMedico}}</td>
                                <td>{{expediente.nombreAsociado + " " + expediente.apellidoAsociado }}</td>
                                <td>{{expediente.fecha}}</td>
                                <td> 
                                    <!-- Despliega las secciones del expediente que puede ver un medico asocaido-->
                                    <span v-show="expediente.info==1">Información <br> </span>
                                    <span v-show="expediente.alergias==1"> Alergias <br>  </span>
                                    <span v-show="expediente.enfermedades==1">Enfermedades <br>  </span>
                                    <span v-show="expediente.medicinas==1">Medicinas <br>  </span>
                                </td>
                                <td>
                                <button @click="eliminarComparticion(expediente.id)" class="btn btn-danger"> <i class="fas fa-trash"></i> </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    
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
                        <!-- Despleiga toda la informacion del paciente, en un expediente -->
                        
                        <h1> {{ pacienteACompartirNombre + " "  + pacienteACompartirApellido }} </h1>
                        Código: {{ pacienteACompartir }}

                        <hr>

                        <div class="card bg-light mb-3" style="max-width: 100%;">
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

                        <div class="card bg-light mb-3" style="max-width: 100%;">
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

                        <div class="card bg-light mb-3" style="max-width: 100%;">
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

                        <div class="card bg-light mb-3" style="max-width: 100%;">
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
                        
                        <!-- Boton que imprime el expediente del paciente dependiento de lo que el usuario loggrado pueda ver, los medicos y el admin pueden ver todo
                        mientras que los medicos asociados pueden ver unicamente las partes en donde se le dieron permiso -->
                        <a @click="imprimirExpediente('imprimirExp')" class="btn btn-danger"> <i class="fas fa-file-pdf"></i>  Descargar </a> 

                    </div>

                    </div>
                </div>
            </div>



            <!-- Modal para realizar el registro de un nuevo paciente -->
            <div class="modal fade" id="modalPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Registrar paciente</h5>
                            <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Actualizar paciente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? actualizarUsuario() : crearUsuario()" >
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" id="nombre" name="nombre"  class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Apellido:</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" >
                            </div>


                            <div class="form-group">
                                <label>Edad:</label>
                                <input type="number" id="edad" name="edad" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Altura:</label>
                                <input type="number" step=".01" id="altura" name="altura" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Peso:</label>
                                <input type="number" step=".01" id="peso" name="peso" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Sexo:</label>
                                <select class="form-control" name="sexo" id="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Fecha de Nacimiento:</label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cerrar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary"> <i class="fas fa-user-plus"></i> Registrar</button>
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
        name: "Pacientes",
        //Propiedades del componente, puede ser accedidas a traves de todo el documento
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
            //FUNCION QUE SE ENCARGA DE IMPRIMIR EL EXPEDIENTE DEL USUARIO CON EL USO DE JAVASCRIPT
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

            //Guarda un registro en la tabla usuario_paciente, en lacual se puede saber que medico ascodiado puede ver que expediente de que paciente
            guardarComparticion(){

                var doctor_id = document.getElementById("doctorasoc");
                var info_paciente = document.getElementById("info_paciente");
                var alergias_paciente = document.getElementById("alergias_paciente");
                var enfermedades_paciente = document.getElementById("enfermedades_paciente");
                var medicamentos_paciente = document.getElementById("medicamentos_paciente");

                //Se hace una peticion para editar los datos, asi como se manda los datos a traves de un objeto de javascript
                axios.post('api/registrarComparticion', {id_paciente: this.pacienteACompartir, doctor_id : this.$props.id ,doctor_asociado: doctor_id.value, info: info_paciente.value, alergias: alergias_paciente.value, enfermedades: enfermedades_paciente.value, medicamentos: medicamentos_paciente.value } )
                .then((response)=>{
                    //Si todo salio correctamente se despliega un peuqño mensaje
                    Fire.$emit('despuesActualizar');
                    $('#compartirPacienteModal').modal('hide');
                    $('#registroModal').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Compartición realizada correctamente'
                    });
                    this.comprartirPaciente();
                })
                .catch(() => {
                    this.$Progress.fail();
                });


            },

            //Eliminar una comparticion de una expediente
            eliminarComparticion(id){

                axios.delete('api/eliminarComparticion/'+id).then((response)=>{            
                    //Pequeña alerta que confirma la eliminacion de la comparticion del expediente
                    swal.fire(
                        'Comparticion del expediente eliminada',
                        'Comparticion del expediente eliminada',
                        'success'
                    )

                    Fire.$emit('despuesEliminar');
                    $('#compartirPacienteModal').modal('hide');
                    $('#registroModal').modal('hide');

                }).catch(function (error) {
                    // Maneja el error si la peticion no se llevo a cabo correctamente
                    swal.fire(
                        'Error al eliminar',
                        'La comparticion no pudo ser eliminada',
                        'error'
                    )
                })

            },


            //Registra una nueva comparticion de un paciente
            comprartirPaciente(id, nombre, apellido){

                this.pacienteACompartir = id;
                this.pacienteACompartirNombre = nombre;
                this.pacienteACompartirApellido = apellido;

                this.expedientesPaciente = [];

                for(var i = 0; i < this.expdientesCompartidos.length; i ++){
                    if(this.expdientesCompartidos[i].pacienteId == id){
                        this.expedientesPaciente.push( this.expdientesCompartidos[i] );
                    }
                }
                $('#compartirPacienteModal').modal('show');
            },

            verExpediente(id, nombre, apellido){

                //expedienteModal
                this.pacienteACompartir = id;
                this.pacienteACompartirNombre = nombre;
                this.pacienteACompartirApellido = apellido;
                
                for( var i = 0; i < this.pacientes.length; i ++ ){
                    if(this.pacientes[i].id == id)
                    {
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
            //funcion para editar losd atos de un ususario
            actualizarUsuario(){
                //Se obtienen los campos del formulario
                var nombre = document.getElementById("nombre");
                var apellido = document.getElementById("apellido");
                var edad = document.getElementById("edad");
                var altura = document.getElementById("altura");
                var peso = document.getElementById("peso");
                var sexo = document.getElementById("sexo");
                var fecha_nacimiento = document.getElementById("fecha_nacimiento");

                this.pacientes_editar.nombre = nombre.value;
                this.pacientes_editar.apellido = apellido.value;
                this.pacientes_editar.edad = edad.value;
                this.pacientes_editar.altura = altura.value;
                this.pacientes_editar.peso = peso.value;
                this.pacientes_editar.sexo = sexo.value;
                this.pacientes_editar.fecha_nacimiento = fecha_nacimiento.value;
                

                //Se hace una peticion para editar los datos, asi como se manda los datos a traves de un objeto de javascript
                axios.post('api/actualizarPaciente', this.pacientes_editar )
                .then((response)=>{
                    //Si todo salio correctamente se despliega un peuqño mensaje
                    Fire.$emit('despuesActualizar');
                    $('#modalPaciente').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Paciente actualizado correctamente'
                    });
                })
                .catch(() => {
                    this.$Progress.fail();
                });


            },

            modal_editar_usuario(id){
                this.editMode = true;

                //Obitene los datos del usuario a eliminar
                for(var i=0; i < this.pacientes.length; i++){
                    if( this.pacientes[i].id == id){
                        this.pacientes_editar = this.pacientes[i];
                    }
                }
                
                //Se obtienen los campos del formulario
                var nombre = document.getElementById("nombre");
                var apellido = document.getElementById("apellido");
                var edad = document.getElementById("edad");
                var altura = document.getElementById("altura");
                var peso = document.getElementById("peso");
                var sexo = document.getElementById("sexo");
                var fecha_nacimiento = document.getElementById("fecha_nacimiento");

                //Limpia los campos del formulario
                nombre.value = "";
                apellido.value = "";
                edad.value = "";
                altura.value = "";
                peso.value = "";
                sexo.value = "";
                fecha_nacimiento.value = "";

                
                //Abre el modal para esta vez para editar los datos
                $('#modalPaciente').modal('show');

                //Llena los campos con los del usuario a editar
                
                nombre.value = this.pacientes_editar.nombre;
                apellido.value = this.pacientes_editar.apellido;
                edad.value = this.pacientes_editar.edad;
                altura.value = this.pacientes_editar.altura;
                peso.value = this.pacientes_editar.peso;
                sexo.value = this.pacientes_editar.sexo;
                fecha_nacimiento.value = this.pacientes_editar.fecha_nacimiento;
                
            },

            modalNuevoPaciente(){
                this.editMode = false;

                var nombre = document.getElementById("nombre");
                var apellido = document.getElementById("apellido");
                var edad = document.getElementById("edad");
                var altura = document.getElementById("altura");
                var peso = document.getElementById("peso");
                var sexo = document.getElementById("sexo");
                var fecha_nacimiento = document.getElementById("fecha_nacimiento");

                nombre.value = "";
                apellido.value = "";
                edad.value = "";
                altura.value = "";
                peso.value = "";
                sexo.value = "";
                fecha_nacimiento.value = "";

                $('#modalPaciente').modal('show');
            },

            eliminarUsuario(id){

                var paciente_eliminar;
                for(var i=0; i < this.pacientes.length; i++){
                    if( this.pacientes[i].id == id){
                        paciente_eliminar = this.pacientes[i];
                    }
                }

                swal.fire({
                    title: 'Eliminar paciente',
                    text: "¿Estás seguro que quieres eliminar al paciente " + paciente_eliminar.nombre + " " + paciente_eliminar.apellido + " ?" ,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarPaciente/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Paciente eliminado',
                                'El paciente ha sido eliminado',
                                'success'
                            )

                            Fire.$emit('despuesEliminar');

                        }).catch(function (error) {
                            // Maneja el error si la peticion no se llevo a cabo correctamente
                            swal.fire(
                                'Error al eliminar',
                                'El paciente no se ha podido eliminar',
                                'error'
                            )
                        })
                    }
                })
            },

            //Metodo que permite obtener los datos de los pacientes registrados
            cargarPacientes(){

                // Hace una peticion a la tabla pacientes a traves del controllador de PacientesController
                axios.get('api/obtenerPacientes').then(({data}) => {
                    this.pacientes = data
                })

                axios.get('api/obtenerDoctores').then(({data}) => {
                    this.doctores = data
                })

                axios.get('api/obtenerMedicosAsociados').then(({data}) => {
                    this.asociados = data
                })

                axios.get('api/obtenerComparticiones').then(({data}) => {
                    this.expdientesCompartidos  = data;
                })

            },

            crearUsuario(){
                

                //Realiza una peticion de tipo post a la ruta registrarUsuarios que se encarga de guardar los datos pasados por medio del formulario del modal

                //Se obtienen los campos del formulario
                var nombre = document.getElementById("nombre");
                var apellido = document.getElementById("apellido");
                var edad = document.getElementById("edad");
                var altura = document.getElementById("altura");
                var peso = document.getElementById("peso");
                var sexo = document.getElementById("sexo");
                var fecha_nacimiento = document.getElementById("fecha_nacimiento");

                //Valida que el formulario tenga todos los datos
                if( nombre.value == "" || apellido.value == "" || edad.value == "" || altura.value == "" || peso.value == ""
                    || sexo.value == "" || fecha_nacimiento.value == "" ){
                    //Si no es asi aparece un pequeño mensaje de error
                    toast.fire({
                            type: 'error',
                            title: 'Llene todos los datos'
                        });
                }else{
                    this.$Progress.start();
                    axios.post('api/registrarPaciente', {nombre: nombre.value, apellido: apellido.value, edad: edad.value , altura: altura.value, peso: peso.value, sexo: sexo.value ,fecha_nacimiento: fecha_nacimiento.value })
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
                        $('#modalPaciente').modal('hide');

                        nombre.value = "";
                        apellido.value = "";
                        edad.value = "";
                        altura.value = "";
                        peso.value = "";
                        sexo.value = "";
                        fecha_nacimiento.value = "";

                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        this.$Progress.fail();

                    })

                }

            }
        },
        //Datos que son pasados al comopnente al momento en el cual este es accedido
        props: {
            tipo: String,
            id : String
        },
        created(){
            //Verifica si el usuario loggrado puede ver el componente, sino es el caso lo manda a una vista con un mensaje correspondiente
            if(this.$props.tipo == '4' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }

            this.cargarPacientes();
            Fire.$on('despuesCrear',() => this.cargarPacientes());
            Fire.$on('despuesEliminar',() => this.cargarPacientes());
            Fire.$on('despuesActualizar',() => this.cargarPacientes());
        }
    }
</script>

<style scoped>

</style>

