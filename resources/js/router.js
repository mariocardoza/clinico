import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './components/InicioComponent';
import UsersComponent from './components/UsersComponent';
import UserComponent from './components/UserComponent';
import ErrorComponent from './components/ErrorComponent';

const router = new VueRouter({
	mode: 'history',
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
			path:'/users/:id',
			name:'user_detail',
			component:UserComponent
		},
		{
            path: '*',
            component: ErrorComponent
        }
	]
});

export default router;