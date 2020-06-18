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
                            <input type="text" placeholder="Ingrese nombre de unidad" class="form-control" v-model="nombre" autofocus>
                        </div>
                    </div>
                    <div class="col-md-auto" v-if="nuevo">
                        <div v-if="nuevo">
                            <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Guardar"><i class="fas fa-check-circle"></i></button>
                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Cancelar" @click="nuevo=!nuevo,nombre=''"><i class="fas fa-times-circle"></i></button>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div v-if="!nuevo">
                            <button class="btn btn-primary float-right" @click="nuevo=!nuevo">Nuevo</button>
                        </div>
                    </div>
                </div>
                </form>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
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
          nuevo:false,
          actualizar:false,
        }
      },
        mounted() {
            this.ver();
        },
        methods: {
            guardar: function () {
                this.nuevo=false;
                axios.post('api/unidades/',{ nombre:this.nombre})
                .then((response)=>{
                    toastr.success("Guardado");
                    this.ver();
                    this.nombre='';
                }).catch(e => {
                    console.log("Error:"+e);
                });
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
                };
                axios.put('api/unidades/'+id,datos)
                .then((response)=>{
                    toastr.success("Editado");
                    this.ver();
                    this.actualizar=false;
                });
            },
            borrar: function(id){
                axios.delete('api/unidades/'+id).then(response => {
                    toastr.success("Eliminado");
                    this.ver();
                });
            }
        }
    }
</script>
