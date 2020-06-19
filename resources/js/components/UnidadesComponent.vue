<template>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Unidades de medida</h3>

          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body table-responsive">
                <form method="POST" v-on:submit.prevent="guardar()">
                    <div class="form-row">
                    <div class="col">
                        <div v-if="nuevo">
                            Nombre: <input type="text" placeholder="Ingrese nombre de unidad" class="form-control" v-model="nombre" autofocus>
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
                            Abreviatura: <input type="text" placeholder="Ingrese abreviatura de unidad" class="form-control" v-model="abreviatura" autofocus>
                        </div>
                    </div>
                    <div class="col-md-auto my-auto" v-if="nuevo">
                        <div v-if="nuevo">
                            <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Guardar"><i class="fas fa-check-circle"></i></button>
                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancelar" @click="nuevo=!nuevo,nombre='',abreviatura='',errores=[]"><i class="fas fa-times-circle"></i></button>
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
                    <th>Abreviatura</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody v-if="unidades.length>0">
                  <tr v-for="(unidad,index) in unidades" :key="unidad.id">
                    <td>{{index+1}}</td>
                    <td>
                        <input v-if="actualizar" type="text" class="form-control" v-model="unidad.nombre">
                        <span v-else>{{unidad.nombre}}</span>
                    </td>
                    <td>
                        <input v-if="actualizar" type="text" class="form-control" v-model="unidad.abreviatura">
                        <span v-else-if="!unidad.abreviatura"><strong>No asignada</strong></span>
                        <span v-else>{{unidad.abreviatura}}</span>
                    </td>
                    <td>
                        <button v-if="actualizar" class="btn btn-success" v-on:click="editar(index,unidad.id)"><i class="fas fa-check-circle"></i></button>
                        <button v-else class="btn btn-warning" v-on:click.prevent="actualizar=!actualizar"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" v-on:click.prevent="borrar(unidad.id)"><i class="fas fa-trash"></i></button>
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
          nombre:'',
          abreviatura:'',
          errores:[],
          nuevo:false,
          actualizar:false,
        }
      },
        mounted() {
            this.ver();
        },
        methods: {
            guardar: function () {
                this.errores = [];
                if(!this.nombre){
                    this.errores.push('El nombre es obligatorio.');
                }else{
                    axios.post('api/unidades/',{ nombre:this.nombre,abreviatura:this.abreviatura})
                    .then((response)=>{
                        toastr.success("Guardado");
                        this.ver();
                        this.nombre='';
                        this.abreviatura='';
                        this.errores = [];
                        this.nuevo=false;
                    }).catch(e => {
                        let esto=this;
                        $.each(e.response.data.errors, function(key, value) {
                            esto.errores.push(value);
                            });
                        this.nombre='';
                        this.abreviatura='';
                    });
                }
            },
            ver: function (){
                axios.get('api/unidades')
                .then((response)=>{
                    this.unidades=response.data
                }).catch(e => {
                    console.log("Error:"+e);
                });
            },
            editar: function(index,id){
                let datos={
                    nombre:this.unidades[index].nombre,
                    abreviatura:this.unidades[index].abreviatura,
                };
                axios.put('api/unidades/'+id,datos)
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
                       axios.delete('api/unidades/'+id)
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
            }
        }
    }
</script>
