<template>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pagos</h1>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Pagos</a></li>
                            <li class="breadcrumb-item active">Lista de pagos</li>
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
                                <h3 class="card-title">Lista de pagos</h3>

                                <div class="card-tools">
                                    <button class="btn btn-success" @click="modalNuevoPago"> <i class="fas fa-file-invoice-dollar"></i> Registrar pago </button>

                                </div>
                            </div>
                            <!-- /.Cuerpo de la tarjeta -->
                            <div class="card-body table-responsive p-0">
                                <!-- Tabla que despliega la informaci+on de los usuarios registrados -->
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Detalles</th>
                                        <th>Tipo</th>
                                        <th>Cita</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="pago in pagos" :key="pago.id">
                                        <td>{{pago.id}}</td>
                                        <td>{{pago.fecha}}</td>
                                        <td>{{pago.total}}</td>
                                        <td>{{pago.detalles}}</td>
                                        <td>{{pago.tipo}}</td>
                                        <td  >
                                            <span  v-for="cita in citas" v-show="pago.id==cita.pago" >{{cita.id}}</span>
                                        </td>

                                        <td>
                                            <button @click="modal_editar_pago(pago.id)" class="btn btn-primary"> <i class="fas fa-pen"></i> </button>

                                            <button @click="eliminarPago(pago.id)" class="btn btn-warning"> <i class="fas fa-trash"></i> </button>

                                            

                                            <span  v-for="cita in citas" v-show="pago.id==cita.pago" >
                                                <a :href="'api/generarReportePago/'+pago.id" class="btn btn-danger"> <i class="fas fa-file-pdf"></i>  </a> 
                                            </span>
                                            
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
            <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editMode" class="modal-title" id="exampleModalLongTitle">Registrar pago</h5>
                            <h5 v-show="editMode" class="modal-title" id="exampleModalLongTitle">Actualizar pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? actualizarPago() : crearPago()" >
                        <div class="modal-body">

                            <!--formulario pagos-->
                            <div class="form-group">
                                <label>Fecha:</label>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Total:</label>
                                <input type="number" id="total" name="total" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Detalles:</label>
                                <input type="text" id="detalles" name="detalles"  class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>Tipo:</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Transferencia">Transferecia electrónica</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Cita:</label>
                                <select class="form-control" name="cita" id="cita" required>
                                    <option v-for="cita in citas" :key="cita.id" v-bind:value="cita.id" >
                                    {{cita.id}}
                                    </option>
                                </select>
                            </div>

                            <!--<div class="form-group">
                                <label>Estado:</label>
                                <input type="text" id="estado" name="estado" class="form-control">
                            </div>-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-ban"></i> Cerrar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary"> <i class="fas fa-hand-holding-usd"></i> Registrar</button>
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
        name: "User",
        data(){
            return{
                editMode : false,
                pacientes : {},
                pagos_editar: {},
                doctores: {},
                pagos: {},
                citas: []
            }
        },
        methods:{

            //funcion para editar losd atos de un ususario
            actualizarPago(){
                //Se obtienen los campos del formulario
                var fecha = document.getElementById("fecha");
                var total = document.getElementById("total");
                var detalles = document.getElementById("detalles");
                var tipo = document.getElementById("tipo");
                var cita = document.getElementById("cita");

                this.pagos_editar.fecha = fecha.value;
                this.pagos_editar.total = total.value;
                this.pagos_editar.detalles = detalles.value;
                this.pagos_editar.tipo = tipo.value;

                this.pagos_editar.id_cita = cita.value;

                
                

                //Se hace una peticion para editar los datos, asi como se manda los datos a traves de un objeto de javascript
                axios.post('api/actualizarPagos', this.pagos_editar )
                .then((response)=>{
                    //Si todo salio correctamente se despliega un peuqño mensaje
                    Fire.$emit('despuesActualizar');
                    $('#modalPago').modal('hide');
                    toast.fire({
                        type: 'success',
                        title: 'Pago actualizado correctamente'
                    });

                    console.log(response);
                })
                .catch(() => {
                    this.$Progress.fail();
                });


            },

            modal_editar_pago(id){
                this.editMode = true;

                var id_cita = 0;
                //Obitene los datos del usuario a eliminar
                for(var i=0; i < this.pagos.length; i++){
                    if( this.pagos[i].id == id){
                        this.pagos_editar = this.pagos[i];
                    }
                }


                for(var i=0; i < this.citas.length; i++){
                    if( id == this.citas[i].pago ){
                        id_cita = this.citas[i].id;
                    }
                }
                
                //Se obtienen los campos del formulario
                var fecha = document.getElementById("fecha");
                var total = document.getElementById("total");
                var detalles = document.getElementById("detalles");
                var tipo = document.getElementById("tipo");
                var cita = document.getElementById("cita");

                //Limpia los campos del formulario
                fecha.value = "";
                total.value = "";
                detalles.value = "";
                tipo.value = "";

                cita.value = "";

                
                //Abre el modal para esta vez para editar los datos
                $('#modalPago').modal('show');

                //Llena los campos con los del usuario a editar
                
                fecha.value = this.pagos_editar.fecha;
                total.value = this.pagos_editar.total;
                detalles.value = this.pagos_editar.detalles;
                tipo.value = this.pagos_editar.tipo;    
                cita.value = id_cita;
            },

            modalNuevoPago(){
                this.editMode = false;

                var fecha = document.getElementById("fecha");
                var total = document.getElementById("total");
                var detalles = document.getElementById("detalles");
                var tipo = document.getElementById("tipo");
                var cita = document.getElementById("cita");

                fecha.value = "";
                total.value = "";
                detalles.value = "";
                tipo.value = "";
                cita.value = "";

                $('#modalPago').modal('show');
            },

            eliminarPago(id){

                var pagos_eliminar;
                for(var i=0; i < this.pagos.length; i++){
                    if( this.pagos[i].id == id){
                        pagos_eliminar = this.pagos[i];
                    }
                }

                swal.fire({

                    title: 'Eliminar pago',
                    text: "¿Estás seguro que quieres eliminar el pago?" ,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',

                }).then((result) => {
                    if (result.value) {

                        axios.delete('api/eliminarPagos/'+id).then((response)=>{
                            
                            //Pequeña alerta que confirma la eliminacion del usuario
                            swal.fire(
                                'Pago eliminado',
                                'El pago ha sido eliminado',
                                'success'
                            )

                            Fire.$emit('despuesEliminar');

                        }).catch(function (error) {
                            // Maneja el error si la peticion no se llevo a cabo correctamente
                            swal.fire(
                                'Error al eliminar',
                                'El pago no se ha podido eliminar',
                                'error'
                            )
                        })
                    }
                })
            },

            //Metodo que permite obtener los datos de los pagos registrados
            cargarPagos(){

                // Hace una peticion a la tabla pacientes a traves del controllador de PacientesController
                axios.get('api/obtenerpagos').then(({data}) => {
                    this.pagos = data
                })

                axios.get('api/obtenerDoctores').then(({data}) => {
                    this.doctores = data
                })

                axios.get('api/cita').then(({data}) => {
                    this.citas = data.data;
                    console.log("datos de citas");
                    console.log(data);
                })

            },

            crearPago(){
                

                //Realiza una peticion de tipo post a la ruta registrarUsuarios que se encarga de guardar los datos pasados por medio del formulario del modal

                //Se obtienen los campos del formulario
                var fecha = document.getElementById("fecha");
                var total = document.getElementById("total");
                var detalles = document.getElementById("detalles");
                var tipo = document.getElementById("tipo");
                var cita = document.getElementById("cita");
                

                //Valida que el formulario tenga todos los datos
                if( fecha.value == "" || total.value == "" || detalles.value == "" || tipo.value == "" || cita.value == ""){
                    //Si no es asi aparece un pequeño mensaje de error
                    toast.fire({
                            type: 'error',
                            title: 'Llene todos los datos'
                        });
                }else{
                    this.$Progress.start();
                    axios.post('api/registrarPagos', {fecha: fecha.value, total: total.value, 
                        detalles: detalles.value , tipo: tipo.value, cita: cita.value})
                    .then((response)=>{
                        
                        //Si la respuesta responde todo bien
                        //Se ejecuta la animacion de la barrita
                        Fire.$emit('despuesCrear');

                        //Una pequeña alerta en la esquina
                        toast.fire({
                            type: 'success',
                            title: 'Pago creado correctamente'
                        });
                        this.$Progress.finish();

                        //El modal que contiene el formulario desaparece
                        $('#modalPago').modal('hide');

                        fecha.value = "";
                        total.value = "";
                        detalles.value = "";
                        tipo.value = "";

                    }).catch(function (error) {
                        // Maneja el error si la peticion no se llevo a cabo correctamente
                        this.$Progress.fail();
                        console.log(error);
                    })

                }

            }
        },
        props: {
            tipo: String
        },
        created(){
            
            if(this.$props.tipo == '2' || this.$props.tipo == '3' ){
                this.$router.push('noacceso') 
            }

            this.cargarPagos();
            Fire.$on('despuesCrear',() => this.cargarPagos());
            Fire.$on('despuesEliminar',() => this.cargarPagos());
            Fire.$on('despuesActualizar',() => this.cargarPagos());
        }
    }
</script>

<style scoped>

</style>

