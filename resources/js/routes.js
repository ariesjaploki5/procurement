

//auth
import login from './components/pages/login.vue';
//home
import home from './components/pages/dashboard.vue';

import categories from './components/pages/categories/main';
import category_list from './components/pages/categories/list';

import inventory from './components/pages/inventory/main';
import inventory_list from './components/pages/inventory/list';

import ppmps from './components/pages/ppmps/main';
import ppmp_list from './components/pages/ppmps/list';

import price_schedules from './components/pages/price_schedules/main';
import price_schedule_list from './components/pages/price_schedules/list';

import purchase_orders from './components/pages/purchase_orders/main';
import purchase_order_list from './components/pages/purchase_orders/list';

import purchase_requests from './components/pages/purchase_requests/main';
import purchase_request_list from './components/pages/purchase_requests/list';

import users from './components/pages/users/main';
import user_list from './components/pages/users/list';

export const routes = [

    {
        path: '/',
        component: login
    },
    {
        path: '/home',
        component: home
    },
    {
        path: '/categories',
        component: categories,
        children: [
            {
                path: '',
                component: category_list
            },
        ]
    },
    {
        path: '/inventory',
        component: inventory,
        children: [
            {
                path: '',
                component: inventory_list
            },
        ]
    },
    {
        path: '/ppmps',
        component: ppmps,
        children: [
            {
                path: '',
                component: ppmp_list
            },
        ]
    },
    {
        path: '/price_schedules',
        component: price_schedules,
        children: [
            {
                path: '',
                component: price_schedule_list
            },
        ]
    },
    {
        path: '/purchase_orders',
        component: purchase_orders,
        children: [
            {
                path: '',
                component: purchase_order_list
            },
        ]
    },
    {
        path: '/purchase_requests',
        component: purchase_requests,
        children: [
            {
                path: '',
                component: purchase_request_list
            },
        ]
    },
    {
        path: '/users',
        component: users,
        children: [
            {
                path: '',
                component: user_list
            },
        ]
    },
];