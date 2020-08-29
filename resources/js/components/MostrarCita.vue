<template>
    <!-- Componente que muestra un formulario para llenar los datos de la cita
    LA ENFERMEDAD QUE PRESENTA EL PACIENTE, LAS ALERGIAS Y LOS MEDICAMENTOS QUE SE LE RESETARON
    esta informacion es llenada unicamente por el medico principal -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <!-- Muestra los propiedades que son pasadas al componente cuando este es creado-->
                        <!-- Muestra el id de la cita seleccionada -->
                        <h1 class="m-0 text-dark">Cita {{ this.$props.id }} </h1>

                        <!--Boton que regresa al listado de las citas, para tener la habilidad de seleccionar otra cita para llenar sus datos  -->
                        <button class="btn btn-primary" @click="regresar"> <i class="fas fa-arrow-left"></i> Regresar </button>
                    </div>
                
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Citas</a></li>
                            <li class="breadcrumb-item active">Mostrar cita</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--VISTA DEL ANALISIS CLINICO-->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <!-- general form elements -->
                        <div class="card card-secondary">
                            <div class="card-header card bg-secondary">
                            <h3 class="card-title"><span class="info-box-icon bg-red"><i class="fas fa-user"></i></span><b> Paciente</b></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form">
                            <div class="card-body">
                                <!--permitira mostrar el nombre del paciente en la vista-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Nombre: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ this.cita.nombre }} </h5>
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
                                            <h5> {{ this.cita.apellido }} </h5>
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
                                            <h5> {{ this.cita.edad }}  </h5>
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
                                            <h5> {{ this.cita.altura }}  </h5>
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
                                            <h5> {{ this.cita.peso }}  </h5>
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
                                            <h5> {{ this.cita.sexo }} </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">IMC: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <h5> {{ (this.cita.peso / (this.cita.altura * this.cita.altura)).toFixed(2) }} </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <label for="exampleInputEmail1">Condición: </label>
                                        </div>
                                        <div class="col-md-6">

                                            <span v-if="this.cita.peso / (this.cita.altura * this.cita.altura) < 18.5" class="tag tag-success">
                                                <h5> Peso inferior </h5>
                                            </span>
                                            <span v-else-if="this.cita.peso / (this.cita.altura * this.cita.altura) > 18.5 && this.cita.peso / (this.cita.altura * this.cita.altura) < 24.9 " class="tag tag-success"> 
                                                <h5> Normal </h5>
                                            </span>
                                            <span v-else-if="this.cita.peso / (this.cita.altura * this.cita.altura) > 25.0 && this.cita.peso / (this.cita.altura * this.cita.altura) <  29.9" class="tag tag-success"> 
                                               <h5> Sobrepeso </h5>
                                            </span>
                                            <span v-else-if="this.cita.peso / (this.cita.altura * this.cita.altura) > 30.0" class="tag tag-success"> 
                                                <h5> Obesidad </h5>
                                            </span>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->
                            </form>
                        </div>
                    </div>


                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-secondary">
                            <div class="card-header card bg-secondary">
                            <h3 class="card-title"><span class="info-box-icon bg-red"><i class="fas fa-user-md"></i></span><b> Análisis clínico</b></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form">
                            <div class="card-body">
                                <!--SELECCION DE ALERGIS DE LA CITA-->
                                <div class="form-group">
                                    <label>Alergias</label>
                                    <v-select multiple @input="hola" :value="selected" :options="opciones" />
                                </div>

                                <!--SELECCION DE PADECIMIENTO DE LA CITA-->
                                <div class="form-group">
                                    <label>Padecimiento</label>
                                    <v-select  @input="agregarPadecimiento" :value="selectedPadecimiento" :options="opcionesPadecimiento" />
                                </div>

                                <!--OBSERVACIONES APARTADO-->
                                <div class="form-group">
                                    <label>Observaciones</label>
                                   <textarea :value="observaciones" id="observaciones_ta" class="form-control" rows='3'> </textarea>
                                </div>

                                <div class="form-group">
                                   <a @click="guardarDetalles" class="btn btn-success" > Guardar </a>
                                </div>

                                <!--SELECCION DE MEDICAMENTO DE LA CITA-->
                                <div class="form-group">
                                    <label>Medicamento</label>
                                    <v-select multiple @input="agregarMedicamento" :value="selectedMedicamento" :options="opcionesMedicamento" />

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Medicamento</th>
                                                <th scope="col">Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="selectedM in medicamentosCita" >
                                                <td>{{ selectedM.id }}</td>
                                                <td>{{ selectedM.nombre}} </td>
                                                <td>{{ selectedM.observaciones}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                
                            </div>
                            <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    

    export default {
        name: "mostrarcita",
        data(){
            return {
                //propiedades del componente
                selected: [],
                opciones: [],
                selectedPadecimiento: "",
                opcionesPadecimiento: [],
                selectedMedicamento: [],
                opcionesMedicamento: [],
                medicamentosCita : [],
                cita: {},
                citashoy: {},
                paciente:{},
                alergias:{},
                enfermedades: {},
                medicamentos: {},
                observaciones : ''
            }
        },
        methods:{
            regresar(){
                window.history.back();
            },
            hola(args){
                //selección de una alergia de la lista

                //guardado de la seleccion
                this.selected = args;
                //inserta la alergia seleccionada a la bd
                var alergiaId=[];
                for(var i=0;i<this.selected.length;i++){
                    //comparando el nombre con el id de la alergia 
                    for(var j=0;j<this.alergias.length;j++){
                        if(this.selected[i]==this.alergias[j].nombre){
                            alergiaId.push(this.alergias[j].id);
                            break;
                        }
                    }
                }
                //pasar el id
                var alergiaInsert={id:this.cita.paciente_id, ids:alergiaId};

                axios.post('api/guardarAlergia', alergiaInsert)
                .then((response)=>{ 
                    toast.fire({
                        type: 'success',
                        title: 'Alergia guardada'
                    });
                })
                .catch(() => {
                    toast.fire({
                        type: 'success',
                        title: 'Error al guardar alergía'
                    });
                });
            },

            guardarDetalles(){
                var observaciones = document.getElementById("observaciones_ta");
                var padecimientoid;


                //comparando el nombre con el id de la enfermedad 
                for(var j=0;j<this.enfermedades.length;j++){
                    if(this.selectedPadecimiento == this.enfermedades[j].nombre){
                        padecimientoid = this.enfermedades[j].id;
                        break;
                    }
                }
                

                //pasar el id
                var enfermedadInsert={id: this.$props.id, idpadecimiento:padecimientoid, observaciones: observaciones.value };

                axios.post('api/guardarPadecimiento', enfermedadInsert)
                .then((response)=>{ 
                    toast.fire({
                        type: 'success',
                        title: 'Padecimiento guardado'
                    });
                })
                .catch(() => {
                    toast.fire({
                        type: 'success',
                        title: 'Error al guardar el padecimiento'
                    });
                });

            },

            agregarPadecimiento(args){
                this.selectedPadecimiento = args;
            },

            //Metodo para guardar un medicamento muestra una alerta para colocar la cantidad de medicamento que se esta recetaando
            async agregarMedicamento(args){


                if( (this.medicamentosCita.length-1) == args.length){
                    var elmts = this.selectedMedicamento.filter( 
                        function(i) { 
                            return this.indexOf(i) < 0; 
                        }, 
                        args 
                    );
                    this.selectedMedicamento = args;

                    var ultimo_medicamento = elmts[0];
                    
                    for(var i=0; i < this.medicamentosCita.length; i++){
                        if( this.medicamentosCita[i].nombre ==  ultimo_medicamento ){
                            this.medicamentosCita.splice(i, 1);
                        }
                    }

                    axios.post('api/guardarMedicamento', {id_cita: this.$props.id , medicamentos: this.medicamentosCita } )
                    .then((response)=>{ 
                        toast.fire({
                            type: 'success',
                            title: 'Medicamento guardado con exito'
                        });
                    })
                    .catch(() => {
                        toast.fire({
                            type: 'success',
                            title: 'Error al guardar el medicamento'
                        });
                    });
                }else{

                    var salida = false;
                    var ultimo_medicamento = args.slice(-1).pop();
                    var medicamento_id;
                    var observaciones = "";
                    
                    for(var j=0;j<this.medicamentos.length;j++){
                        if( ultimo_medicamento == this.medicamentos[j].nombre){
                            medicamento_id = this.medicamentos[j].id;                            
                            break;
                        }
                    }

                    await swal.fire({
                        title: 'Detalles:',
                        html: '<input id="swal-input2" class="swal2-input">',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cacelar',
                    }).then(function (result) {
                        if(result.value){
                            salida = true;
                        }
                    })

                    if( salida ){
                        this.selectedMedicamento = args;
                        observaciones = $('#swal-input2').val();
                        this.medicamentosCita.push({id: medicamento_id, nombre: ultimo_medicamento, observaciones: observaciones });


                        axios.post('api/guardarMedicamento', {id_cita: this.$props.id , medicamentos: this.medicamentosCita } )
                        .then((response)=>{ 
                            toast.fire({
                                type: 'success',
                                title: 'Medicamento guardado con exito'
                            });
                        })
                        .catch(() => {
                            toast.fire({
                                type: 'success',
                                title: 'Error al guardar el medicamento'
                            });
                        });

                    }


                    

                }

                

            },


            obtenerDatosCita(){
                

                //Obtener los medicamentos asociados a la cita
                axios.get('api/obtenermedicamentosCita/'+this.$props.id)
                .then(({data}) => {

                    for(var i = 0; i < data.length; i++)
                    {
                        this.medicamentosCita.push({id: data[i].id_medicina, nombre: data[i].nombre, observaciones: data[i].observaciones });
                        this.selectedMedicamento.push( data[i].nombre );
                    }
                });

                axios.get('api/obtenerDatosCita/'+this.$props.id)
                .then(({data}) => {
                    this.cita = data[0];
                    
                    //observaciones.value = data[0].observaciones;

                    this.observaciones = data[0].observaciones;

                    axios.get('api/obteneralergiasPaciente/'+this.cita.paciente_id)
                    .then(({data}) => { 
                        for(var i=0; i < data.length; i++){
                            this.selected.push(data[i].nombre);
                        }
                    });

                });
                //obtener los datos de la tabla en este caso el nombre de alergias
                axios.get('api/obteneralergias')
                .then(({data}) => {
                    this.alergias = data;
                    for(var i=0; i < data.length; i++){
                        this.opciones.push(data[i].nombre);
                    }
                });
                
                //obtener los datos de la tabla en este caso el nmbre del padecimiento
                axios.get('api/obtenerEnfermedades')
                .then(({data}) => {
                    this.enfermedades = data;
                    for(var i=0; i < data.length; i++){
                        this.opcionesPadecimiento.push(data[i].nombre);

                        if(this.cita.id_enfermedad == data[i].id){
                            this.selectedPadecimiento =  data[i].nombre
                        }
                    }

                    
                });

                //obtener los datos de la tabla en este caso el nmbre del medicamento
                axios.get('api/obtenermedicamentos')
                .then(({data}) => {
                    this.medicamentos = data;
                    for(var i=0; i < data.length; i++){
                        this.opcionesMedicamento.push(data[i].nombre);
                    }
                });

            }
        },
        //Propiedades que son pasadas al componente cuando es creado
        props: {
            id: Number
        },
        //Muestra los datos de la cia
        created(){
            this.obtenerDatosCita();
        }
    }
</script>


<style scoped>
  
</style>
