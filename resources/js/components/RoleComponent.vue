<template>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Roles</h3>

          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body table-responsive">
                <form method="POST" v-on:submit.prevent="guardar" >
                    <div class="form-row">
                    <div class="col">
                        <div v-if="nuevo">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" placeholder="Ingrese nombre del rol" class="form-control" v-model="name" autofocus>
                            </div>
                        </div>
                    </div>
                     <div class="col">
                        <div v-if="nuevo">
                            <div class="form-group">
                                <label for="">Permisos</label>
                                <select v-model="permissions" multiple="multiple" class="form-control">
                                    <option v-for="permiso in permisos">{{permiso.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto my-auto">
                        <div v-if="nuevo" >
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button class="btn btn-danger" v-on:click.prevent="cancelar">Cancelar</button>
                        </div>
                    </div>
                    
                    </div>
                    <div class="col-md-auto">
                        <div v-if="!nuevo">
                            <button class="btn btn-info float-right" v-on:click.prevent="nuevo_rol">Nuevo</button>
                            <button class="btn btn-info float-left" v-on:click.prevent="ver_permisos">Permisos</button>
                        </div>
                    </div>
                </form>
                <hr>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Permisos</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody >
                  <tr v-for="(rol, index) in roles">
                      <td>{{index+1}}</td>
                      <td>{{rol.name}}</td>
                      <td><span v-for="per in rol.permissions">{{per.name}}, </span> </td>
                      <td></td>
                  </tr>
                </tbody>
      
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
          roles:[],
          permisos:[],
          nuevo:false,
          name:'',
          permissions:[],
        }
      },
        mounted() {
            this.cargar_roles();
        },

        methods:{
            cargar_roles(){
                axios.get('api/roles')
                .then((response)=>{
                    this.roles=response.data[0];
                    this.permisos=response.data[1];
                    console.log(response);
                });
            },
            nuevo_rol(){
            this.nuevo=true;
            },
            guardar(){
                axios.post('api/roles/',{ name:this.name,permissions:this.permissions})
                    .then((response)=>{
                        toastr.success("Guardado");
                        this.name='';
                        this.permissions=[];
                        this.nuevo=false;
                    }).catch(e => {
                        
                        
                    });
            },
            cancelar(){
                this.nuevo=false;
            },
            ver_permisos(){
              this.$router.push('permisos');
            }
        },

    }
</script>
