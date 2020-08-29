<template>
    <!-- Componente el cual contiene el calendario para la reservacion de una cita -->
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
                            <li class="breadcrumb-item active">Agendar Cita</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header"> 
                                <h3 class="card-title">Agendar nueva cita</h3>

                                <div class="card-tools">

                                    <button class="btn btn-success" @click="nuevaCitaModal"> <i class="fas fa-calendar-plus"></i> Agendar cita </button>

                                </div>    
                            </div>

                            <div class="card-body">

                            <!-- Componente que renderiza el calendario, esta configurado en app.js-->
                            <div class="col-md-12">
                                <Fullcalendar @eventClick="mostrarCita" :plugins="calendarPlugins" :events="events"/>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Formulario que permite el registro de una nueva cita -->
            <div class="modal fade" id="modalCita" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Registrar cita</h5>
                            <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Actualizar cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Se hace el llamado a una funcion o a otra dependiendo si se quiere crear una nueva cita o actualizar una ya existente -->
                        <form @submit.prevent="editMode ? actualizarCita() : agregarCita()" >
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Fecha:</label>
                                <!-- Campo de tipo fecha, el cual muestra una calendario para poder seleccionar un dia en especifico -->
                                <input type="date" id="fecha" name="fecha"  class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Hora:</label>

                                <!-- Campo de tipo hora para ser tratado de difernete forma en el navegador, muestra un campo de tipo reloj para seleccionar la hora-->
                                <input type="time" min="09:00" max="18:00" id="hora" name="hora" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Detalles:</label>
                                <textarea id="detalles" name="detalles" class="form-control" required></textarea>
                            </div>

                            <!-- Select dinamico creado con los datos de la tabla doctores (usuarios)-->
                            <div class="form-group">
                                <label>Doctor:</label>
                                <select class="form-control" name="doctor" id="doctor" required>
                                    <option v-for="doctor in doctores" :key="doctor.id" v-bind:value="doctor.id">
                                    {{doctor.name}}
                                    </option>
                                </select>
                            </div>

                            <!-- Select dinamico creado con los datos de la tabla pacientes (usuarios)-->
                            <div class="form-group">
                                <label>Paciente:</label>
                                <select class="form-control" name="paciente" id="paciente" required>
                                    <option v-for="paciente in pacientes" :key="paciente.id" v-bind:value="paciente.id">
                                    {{paciente.nombre}}
                                    </option>
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cerrar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary"> <i class="fas fa-user-plus"></i> Registrar </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div> 


            <!-- Modal que permite la visualizacion de informacion de la cita-->
            <!-- Asi como permite editarla y eliminarla-->
            <div class="modal fade" id="modalCitaChecar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Información de la cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            
                            <label> <b> Detalles: </b> </label>
                            <span id="spanDetalles"> </span>

                            <br>
                            <label> <b> Fecha: </b> </label>
                            <span id="spanFecha"></span>

                            <br>
                            <label> <b> Hora: </b> </label>
                            <span id="spanHora"></span>
                            
                            <br>
                            <label> <b> Doctor: </b> </label>
                            <span id="spanDoctor"></span>

                            <br>
                            <label> <b> Paciente: </b> </label>
                            <span id="spanPaciente"></span>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">  Cerrar</button>
                            <button  @click="editarCita" class="btn btn-warning"> <i class="fas fa-edit"></i>  Editar </button>
                            <button @click="borrarCita" class="btn btn-danger"> <i class="fas fa-trash"></i> Eliminar </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


<script>
//Se importan los modulos necesarios para full calendar, el calendario que se renderiza en el componente
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";

export default {
    //Se import el compoenente del calendario para ser usado en el modulo
    components: {
        Fullcalendar
    },

    data() {
        //Propiedades del compoenente
        return {
            calendarPlugins: [dayGridPlugin, interactionPlugin],
            events: [],
            z: "", //Las citas son traidas de la base de datos en la tabla Citas
            pacientes : {},
            doctores : {},
            newCita:{
                id: "",
                fecha: "",
                hora: "",
                detalles: "",
                id_enfermedad: "",
                doctor_id: "",
                paciente_id: "",
                pago: "",
                observaciones: ""
            },
            editMode: false,
            idCitaEliminar: 0,
        };
    },

    props: {
        tipo: String
    },
    //Metodo que se ejecuta al inicializar el compoenente
    created() {
        
        if(this.$props.tipo == '3'){
            this.$router.push('noacceso') 
        }

        this.getEvents();
        this.cargarPacientes();
    },

    methods: {

        //Obtiene todas las citas registradas en la base de datos
        getEvents() {
            axios.get("/api/cita")
            .then(resp => {
                //Se obtienen los registros de la tabla citas
                this.citas = resp.data.data;
                
                for( var i=0; i < this.citas.length; i++ ){
                    var evento = new Object();
                    evento.id = this.citas[i].id;
                    evento.title = this.citas[i].detalles;
                    evento.start = this.citas[i].fecha;
                    this.events.push(evento);
                    console.log(this.events);
                }                
            })
            .catch(err => console.log(err.response.data));
        },

        //Carga los datos de los pacientes para que sean mostrados en el select de pacientes al momento de realizar una cita nueva, ah y tambien los doctores, es decir los usuarios que ene el campo tipo tengan un 2
        cargarPacientes(){
            axios.get('api/obtenerPacientes').then(({data}) => {
                this.pacientes = data
                console.log(data);
            })

            axios.get('api/obtenerDoctores').then(({data}) => {
                this.doctores = data
                console.log(data);
            })
        },

        //Almacena los datos de la cita obteniendo los datos del formulario del modal
        agregarCita() {
            
            var fecha = document.getElementById("fecha");
            var hora = document.getElementById("hora");
            var detalles = document.getElementById("detalles");
            var doctor = document.getElementById("doctor");
            var paciente = document.getElementById("paciente");
            var error = false;

            var cita_data = {
                fecha: fecha.value,
                hora: hora.value,
                detalles: detalles.value,
                doctor_id: doctor.value,
                paciente_id: paciente.value
            }
            
            //Aqui se valida para que no se registre una cita con la misma hora y dia que otra ya registrada previamnete
            for( var i=0; i < this.citas.length; i++ )
            {
                if( this.citas[i].fecha == fecha.value && hora.value.split(':')[0] == this.citas[i].hora.split(':')[0])
                {
                    error = true;
                }
            }

            
            if(error){
                swal.fire(
                    'Error al crear cita',
                    'Ya existe una cita en esta hora',
                    'error'
                )

            }else{

                axios.post("/api/agendarcita", {
                    ...cita_data
                })
                .then(data => {
                    this.events = [];
                    this.getEvents();
                    $('#modalCita').modal('hide');

                    swal.fire(
                        'Cita guardada',
                        'La cita se ha guardado con exito',
                        'success'
                    )

                    fecha.value = "";
                    hora.value = "";
                    detalles.value = "";
                })
                .catch(err =>
                    console.log("No se pudo guardar la cita", err.response.data)
                );

            }
            
            
        },

        //Metodo que se utiliza para actualizar la informacion de una cita ya creada, pone la informacion ya guardada en los campos del formulario
        actualizarCita(){

            var fecha = document.getElementById("fecha");
            var hora = document.getElementById("hora");
            var detalles = document.getElementById("detalles");
            var doctor = document.getElementById("doctor");
            var paciente = document.getElementById("paciente");
            var error = false;

            var cita_data = {
                id: this.idCitaEliminar,
                fecha: fecha.value,
                hora: hora.value,
                detalles: detalles.value,
                doctor_id: doctor.value,
                paciente_id: paciente.value
            }

            //Aqui se valida para que no se registre una cita con la misma hora y dia que otra ya registrada previamnete
            for( var i=0; i < this.citas.length; i++ )
            {
                if( this.citas[i].id != this.idCitaEliminar && this.citas[i].fecha == fecha.value && hora.value.split(':')[0] == this.citas[i].hora.split(':')[0])
                {
                    error = true;
                }
            }

            //Compara si existe un error para mostrar una pqueña alerta proporcionada por la bilbioteca sweet alert.
            if(error){
                swal.fire(
                    'Error al crear cita',
                    'Ya existe una cita en esta hora',
                    'error'
                )

            }else{

                axios.post("/api/actualizarcita", {
                    ...cita_data
                })
                .then(data => {
                    this.events = [];
                    this.getEvents();
                    $('#modalCita').modal('hide');

                    swal.fire(
                        'Cita acualizada',
                        'La cita se ha actualizado con exito',
                        'success'
                    )

                    fecha.value = "";
                    hora.value = "";
                    detalles.value = "";
                })
                .catch(err =>
                    console.log("No se pudo guardar la cita", err.response.data)
                );

            }



        },

        //Abre el modal que contiene el formulario que tiene los campos para crear una cita nueva
        nuevaCitaModal() {
            this.editMode = false;
            $('#modalCita').modal('show');

            var fecha = document.getElementById("fecha");
            var hora = document.getElementById("hora");
            var detalles = document.getElementById("detalles");
            var doctor = document.getElementById("doctor");
            var paciente = document.getElementById("paciente");

            fecha.value = "";
            hora.value = "";
            detalles.value = "";

        },

        //Muestra los datos de una cita en el modal, ahi mismo se encuentran varios opciones de amdinistracion
        mostrarCita(arg) {
            $('#modalCitaChecar').modal('show');
            

            for( var i=0; i < this.citas.length; i++ ){
                
                var spanDetalles = document.getElementById("spanDetalles");
                var spanFecha = document.getElementById("spanFecha");
                var spanHora = document.getElementById("spanHora");
                var spanDoctor = document.getElementById("spanDoctor");
                var spanPaciente = document.getElementById("spanPaciente");

                if(this.citas[i].id == arg.event.id)
                {
                    spanDetalles.innerHTML = this.citas[i].detalles;
                    spanFecha.innerHTML = this.citas[i].fecha;
                    spanHora.innerHTML = this.citas[i].hora;
                    
                    for(var j=0; j < this.doctores.length; j++){
                        if( this.doctores[j].id == this.citas[i].doctor_id ){
                            spanDoctor.innerHTML = this.doctores[j].name + " " + this.doctores[j].last_name;
                        }
                    }

                    for(var k=0; k < this.pacientes.length; k++){
                        if(this.pacientes[k].id == this.citas[i].paciente_id){
                            spanPaciente.innerHTML = this.pacientes[k].nombre + " " + this.pacientes[k].apellido;
                        }

                    }
                }


            }
            this.idCitaEliminar = arg.event.id;
        },


        //Realiza el mostrado del modal para ver la informacion de la cita
        editarCita(){
            this.editMode = true;
            $('#modalCitaChecar').modal('hide');
            $('#modalCita').modal('show');
            
            var fecha = document.getElementById("fecha");
            var hora = document.getElementById("hora");
            var detalles = document.getElementById("detalles");
            var doctor = document.getElementById("doctor");
            var paciente = document.getElementById("paciente");

            for(var i = 0; i < this.citas.length; i++){
                if( this.idCitaEliminar == this.citas[i].id ){

                    fecha.value = this.citas[i].fecha;
                    hora.value = this.citas[i].hora;
                    detalles.value = this.citas[i].detalles;
                    doctor.value = this.citas[i].doctor_id;
                    paciente.value = this.citas[i].paciente_id;
                    break;
                }

            }

            console.log(this.citas);


        },

        //Metodo que se encarga de borrar una cita seleccionada en el calendario
        borrarCita(){
            console.log(this.idCitaEliminar);

            swal.fire({
                title: 'Eliminar cita',
                text: "¿Estás seguro que desea eliminar la cita ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No',
            }).then((result) => {

                if (result.value) {

                    axios.delete('api/eliminarcita/'+this.idCitaEliminar).then((response)=>{           
                        //Pequeña alerta que confirma la eliminacion del usuario
                        $('#modalCitaChecar').modal('hide');
                        swal.fire(
                            'Cita eliminada',
                            'La cita ha sido eliminada',
                            'success'

                        )
                        
                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        swal.fire(
                            'Error al eliminar',
                            'La cita no ha sido eliminada',
                            'error'
                        )
                    })

                    this.events = [];
                    this.getEvents();

                }
            });

                
            
            

        }
    }
};
</script>

<style lang="css">
    /* Se importan estilos de css para ver correctamente el calendario*/
    @import "~@fullcalendar/core/main.css";
    @import "~@fullcalendar/daygrid/main.css";

    /*Estas propiedades son destinadas a las fechas ya reservadas en la cita (Las pequeñas tarjetitas azules con el tema de la cita)*/
    .fc-title {
        color: #fff;
    }
    .fc-title:hover {
        cursor: pointer;
    }

</style>