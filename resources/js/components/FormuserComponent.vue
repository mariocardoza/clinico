<template>
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<form action="" v-on:submit.prevent="newUser()">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="row">
        		<div class="col-md-12">
        			<div class="form-group">
        				<label for="">Nombre</label>
        				<input type="text" v-model="name" name="name" class="form-control">
        			</div>

        			<div class="form-group">
        				<label for="">Email</label>
        				<input type="text" v-model="email" name="email" class="form-control">
        			</div>
        		</div>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" >Guardar</button>
      </div>
    </div>
    </form>
  </div>
</div>
</template>
<script>
	export default {
		data(){
			 return{
               name:'',
               email:''
            }
		},
		methods:{
			newUser(){
				const params ={
                    name:this.name,
                    email:this.email
                };
                axios.post('api/usuarios',params)
                .then((response)=>{
                    const thought=response.data
                    this.name="";
                    this.email="";
                })
                .catch((error)=>{
                	console.log(error.errors);
                });
			}
		}
	}
</script>