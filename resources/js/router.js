import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './components/InicioComponent';
//users
import UsersComponent from './components/UsersComponent';
import UserComponent from './components/UserComponent';
import UserCreateComponent from './components/UserCreateComponent';

//componente de error 404
import ErrorComponent from './components/ErrorComponent';
import UnidadesComponent from './components/UnidadesComponent';

const router = new VueRouter({
	routes:[
		{
			path:'/home',
			name:'home',
			component:HomeComponent
		},
		{
			path:'/users',
			name:'users',
			component:UsersComponent
		},
		{
			path:'/users/create',
			name:'user_create',
			component:UserCreateComponent
		},
		{
			path:'/users/:id',
			name:'user_detail',
			component:UserComponent
        },
        {
			path:'/unidades',
			name:'unidades',
            component:UnidadesComponent,
            props:true
		},
		{
            path: '*',
            component: ErrorComponent
        }
    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior(){
        return {x:0, y:0}
    }
});

export default router;
