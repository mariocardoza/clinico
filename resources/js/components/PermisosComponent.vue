<template>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Permisos</h3>

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
                                <input type="text" placeholder="Ingrese nombre del permiso" class="form-control" v-model="name" autofocus>
                            </div>
                        </div>
                    </div>
                     
                    
                    </div>
                    <div class="col-md-auto">
                        <div v-if="!nuevo">
                            <button class="btn btn-info float-right" v-on:click.prevent="nuevo_permiso">Nuevo</button>
                        </div>
                        <button class="btn btn-info float-left" v-on:click.prevent="ver_roles">Roles</button>
                    </div>
                </form>
                <hr>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody >
                  <tr v-for="(permiso, index) in permisos.data">
                      <td>{{index+1}}</td>
                      <td>{{permiso.name}}</td>
                      <td></td>
                  </tr>
                </tbody>
      
              </table>
              <nav>
                    <ul class="pagination float-right">
                        <li class="page-item" v-show="permisos['prev_page_url']">
                            <a href="#" class="page-link" @click.prevent="getPreviousPage">
                                <span>
                                  <span aria-hidden="true">«</span>
                                </span>
                            </a>
                        </li>
                        <li class="page-item" :class="{ 'active': (permisos['current_page']=== n) }" v-for="n in permisos['last_page']">
                            <a href="#" class="page-link" @click.prevent="getPage(n)">
                                <span >
                                    {{ n }}
                                </span>
                            </a>
                        </li>
                        <li class="page-item" v-show="permisos['next_page_url']">
                            <a href="#" class="page-link" @click.prevent="getNextPage">
                                <span>
                                  <span aria-hidden="true">»</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
          permisos:[],
          nuevo:false,
          name:'',
        }
      },
        mounted() {
            this.cargar_permisos();
        },

        methods:{
            cargar_permisos(){
                axios.get('api/permisos')
                .then((response)=>{
                    this.permisos=response.data;
                    console.log(response);
                });
            },
            ver_roles(){
              this.$router.push('roles');
            },
            nuevo_permiso(){
            this.nuevo=true;
            },
            guardar(){
                axios.post('api/permisos/',{ name:this.name})
                    .then((response)=>{
                        toastr.success("Guardado");
                        this.name='';
                        this.nuevo=false;
                    }).catch(e => {
                        
                        
                    });
            },
            cancelar(){
                this.nuevo=false;
            },

            //mettodos para la paginacion
            getPage(page){
                axios.get('/api/permisos?page='+page).then((response)=>{
                    this.$set(this.$data, 'permisos', response.data);
                },(response)=>{
                });
            },
            getPreviousPage(){
                axios.get(this.permisos['prev_page_url']).then((response)=>{
                    this.$set(this.$data, 'permisos', response.data);
                },(response)=>{
                });
            },
            getNextPage(){
                axios.get(this.permisos['next_page_url']).then((response)=>{
                    this.$set(this.$data, 'permisos', response.data);
                },(response)=>{
                });
            },

        },

    }
</script>
