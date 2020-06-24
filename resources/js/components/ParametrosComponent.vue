<template>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Parametros de exámenes</h3>

          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body table-responsive">
                <form method="POST" v-on:submit.prevent="guardar()">
                    <div class="form-row">
                    <div class="col">
                        <div v-if="nuevo">
                            Nombre: <input type="text" placeholder="Ingrese nombre de parametro" class="form-control" v-model="nombre" autofocus>
                        </div>
                        <div v-if="nuevo">
                            <ul v-if="errores.length" class="list-group">
                                <li class="list-group-item list-group-item-danger">Por favor, corrija los siguientes errores:</li>
                                <li class="list-group-item" v-for="error in errores">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                     <div class="col">
                        <div v-if="nuevo">
                            Unidad de medida:
                            <select class="form-control" v-model="unidad">
                            <option disabled value="">Seleccione unidad de medida</option>
                                <option v-for="unidad in unidades" v-bind:value="unidad.id">
                                    {{ unidad.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div v-if="nuevo">
                            Valor predeterminado: <input type="text" placeholder="Ingrese valor predeterminado (Opcional)" class="form-control" v-model="predeterminado">
                        </div>
                    </div>
                    <div class="col-md-auto my-auto" v-if="nuevo">
                        <div v-if="nuevo">
                            <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Guardar"><i class="fas fa-check-circle"></i></button>
                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancelar" @click="nuevo=!nuevo,nombre='',predeterminado='',errores=[]"><i class="fas fa-times-circle"></i></button>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div v-if="!nuevo">
                            <button class="btn btn-primary float-right" @click="nuevo=!nuevo">Nuevo</button>
                        </div>
                    </div>
                </div>
                </form>
                <hr v-if="nuevo">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Unidad de medida</th>
                    <th>Valor predeterminado</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="parametros.length>0">
                  <tr v-for="(parametro,index) in parametros" :key="parametro.id">
                    <td>{{index+1}}</td>
                    <td>
                        <input v-if="actualizar" type="text" class="form-control" v-model="parametro.nombre">
                        <span v-else>{{parametro.nombre}}</span>
                    </td>
                    <td>
                        <select v-if="actualizar" class="form-control" @change="cambioUnidad(index,$event)">
                            <option disabled value="">Seleccione unidad de medida</option>
                                <option v-for="unidad in unidades" v-bind:value="unidad.id" :selected="unidad.id==parametro.idUnidad">
                                    {{unidad.nombre }}
                                </option>
                            </select>
                        <span v-else-if="!parametro.idUnidad"><strong>No asignado</strong></span>
                        <span v-else>{{nombreUnidad(parametro.idUnidad)}}</span>
                    </td>
                    <td>
                        <input v-if="actualizar" type="text" class="form-control" v-model="parametro.predeterminado">
                        <span v-else-if="!parametro.predeterminado"><strong>No asignado</strong></span>
                        <span v-else>{{parametro.predeterminado}}</span>
                    </td>
                    <td>
                        <button v-if="actualizar" class="btn btn-success" v-on:click="editar(index,parametro.id)"><i class="fas fa-check-circle"></i></button>
                        <button v-if="actualizar" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancelar" @click="actualizar=!actualizar,ver()"><i class="fas fa-times-circle"></i></button>
                        <button v-else class="btn btn-warning" v-on:click.prevent="actualizar=!actualizar"><i class="fas fa-edit"></i></button>
                        <button v-if="!actualizar" class="btn btn-danger" v-on:click.prevent="borrar(parametro.id)"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
                <div v-else class="row">
                    <div class="col-md-auto">
                        <strong>No existen registros</strong>
                    </div>
                </div>
              </table>
            </div>
        </div>
        <!-- /.card -->
          </div>
        </div>
    </div><!-- /.container-fluid -->
</template>

<script>
    export default {
        data(){
        return {
          unidades:[],
          parametros:[],
          nombre:'',
          unidad:'',
          unidadesCambiadas:[],
          predeterminado:'',
          errores:[],
          nuevo:false,
          actualizar:false,
        }
      },
        mounted() {
            this.ver();
            this.verUnidades();
        },
        methods: {
            guardar: function () {
                this.errores = [];
                if(!this.nombre){
                    this.errores.push('El nombre es obligatorio.');
                    let esto=this;
                    setTimeout(function () {
                            esto.errores = [];
                        }, 5000);
                }else{
                    axios.post('api/parametros/',{ nombre:this.nombre,idUnidad:this.unidad,predeterminado:this.predeterminado})
                    .then((response)=>{
                        toastr.success("Guardado");
                        this.ver();
                        this.nombre='';
                        this.unidad='';
                        this.predeterminado='';
                        this.errores = [];
                        this.nuevo=false;
                    }).catch(e => {
                        let esto=this;
                        $.each(e.response.data.errors, function(key, value) {
                            esto.errores.push(value);
                            });
                        this.nombre='';
                        this.unidad='';
                        this.predeterminado='';
                        setTimeout(function () {
                            esto.errores = [];
                        }, 5000);
                    });
                }
            },
            ver: function (){
                axios.get('api/parametros')
                .then((response)=>{
                    this.parametros=response.data
                }).catch(e => {
                    console.log("Error:"+e);
                });
            },
            editar: function(index,id){
                let datos={
                    nombre:this.parametros[index].nombre,
                    idUnidad:this.unidadesCambiadas[index],
                    predeterminado:this.parametros[index].predeterminado,
                };
                axios.put('api/parametros/'+id,datos)
                .then((response)=>{
                    toastr.success("Editado");
                    this.ver();
                    this.actualizar=false;
                });
            },
            borrar: function(id){
                this.$swal.fire({
                    title: '¿Está seguro de borrar?',
                    text: "¡Ya no estará disponible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.value) {
                       axios.delete('api/parametros/'+id)
                        .then(response => {
                            this.$swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Eliminado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.ver();
                        }).catch(error => {
                            console.log(error);
                        });

                    }else{
                        this.$swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cancelado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                    }
                    });
            },
            verUnidades: function(){
                axios.get('api/unidades')
                .then((response)=>{
                    this.unidades=response.data
                }).catch(e => {
                    console.log("Error:"+e);
                });
            },
            nombreUnidad: function(id){
                let units=this.unidades;
                let i;
                for (i = 0; i < units.length; i++) {
                if(units[i].id===id){
                    return units[i].nombre;
                }
                }
            },
            cambioUnidad: function(index,event){
                this.unidadesCambiadas[index]=event.target.value;
            },
        }//Fin metodos
    }
</script>
