<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Registrar persona</h3>
            
          </div>
          <div class="card-body">
            <form action="" v-on:submit.prevent="guardar" >
              <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" v-model="nombre" class="form-control">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">DUI</label>
                    <input type="text" v-model="dui" v-mask="'########-#'" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">NIT</label>
                    <input type="text" v-model="nit" v-mask="'####-######-###-#'" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Dirección</label>
                    <input type="text" v-model="direccion" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" v-model="telefono" v-mask="'####-####'" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="button" v-on:click.prevent="volver" class="btn btn-secondary">Atras</button>
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
      data(){
        return {
          nombre:'',
          dui:'',
          nit:'',
          direccion:'',
          telefono:'',
          errores:[],
        }
      },
      mounted() {
      },

      methods:{
        guardar(){
        axios.post('/api/personas/',{ nombre:this.nombre,dui:this.dui,nit:this.nit,direccion:this.direccion,telefono:this.telefono})
          .then((response)=>{
                toastr.success("Guardado");
              this.nombre='';
              this.dui='';
              this.nit='';
              this.direccion='';
              this.telefono='';
              this.$router.push('/personas');

          }).catch(e => {
            let esto=this;
              $.each(e.response.data.errors, function(key, value) {
                toastr.error(value);
              });
              
          });
      },
      volver(){
        this.$router.push('/personas');
      },
      }
    }
</script>