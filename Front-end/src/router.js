import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
    {
    // ======================
    // Full Layout
    // ======================
			path: '',
            component: () => import('./layout/full/MainContainer.vue'),
            // ======================
            // Theme routes / pages
            // ======================

            children: [
                {
                    path: '/',
                    redirect: '/Products'
                },
                {
                    path: '/Products',
                    name: 'Products',
                    index: 1,
                    component: () => import('./views/StarterPage.vue')
                }
            ]
		},
        {
            path: '*',
            redirect: '/Products'
        }
	]
})