

//auth
import login from './components/pages/login.vue';
//home
import home from './components/pages/dashboard.vue';

import categories from './components/pages/categories/main';
import category_list from './components/pages/categories/list';

import apps from './components/pages/apps/main';
import app_list from './components/pages/apps/list';
import app_show from './components/pages/apps/show';

import inventory from './components/pages/inventory/main';
import inventory_list from './components/pages/inventory/list';

import ppmps from './components/pages/ppmps/main';
import ppmp_list from './components/pages/ppmps/list';
import ppmp_show from './components/pages/ppmps/show';

import price_schedules from './components/pages/price_schedules/main';
import price_schedule_list from './components/pages/price_schedules/list';
import price_schedule_show from './components/pages/price_schedules/show';

import purchase_orders from './components/pages/purchase_orders/main';
import purchase_order_list from './components/pages/purchase_orders/list';

import purchase_requests from './components/pages/purchase_requests/main';
import purchase_request_list from './components/pages/purchase_requests/list';

import users from './components/pages/users/main';
import user_list from './components/pages/users/list';

import links from './components/pages/links/main';
import link_list from './components/pages/links/list';

import adjustments from './components/pages/adjustments/main';
import adjustment_list from './components/pages/adjustments/list';

import purchase_request2 from './components/pharmacy/purchase_request.vue';
import purchase_order2 from './components/pharmacy/purchase_order.vue';

import drugs_and_medicines from './components/pharmacy/drugs_and_medicines.vue';

import suppliers from './components/pages/supplier/main';
import supplier_list from './components/pages/supplier/list';

import accounting_po from './components/accounting/purchase_order.vue';
import budget_po from './components/budget/purchase_order.vue';
import div_head_po from './components/div_head/purchase_order.vue';
import fmo_po from './components/fmo/purchase_order.vue';
import pmo_po from './components/pmo/purchase_order.vue';
import mmo_po from './components/mmo/purchase_order.vue';

import aoq from './components/print/aoq';
import app from './components/print/app';
import ors from './components/print/ors';
import po from './components/print/po';
import ppmp from './components/print/ppmp';
import pr from './components/print/pr';
import rfq from './components/print/rfq';
import sps from './components/print/sps';

export const routes = [
    {
        path: '/accounting_po',
        component: accounting_po,
        name: 'accounting_po'
    },
    {
        path: '/budget_po',
        component: budget_po,
        name: 'budget_po'
    },
    {
        path: '/div_head_po',
        component: div_head_po,
        name: 'div_head_po'
    },
    {
        path: '/pmo_po',
        component: pmo_po,
        name: 'pmo_po'
    },
    {
        path: '/fmo_po',
        component: fmo_po,
        name: 'fmo_po'
    },
    {
        path: '/mmo_po',
        component: mmo_po,
        name: 'mmo_po'
    },
    {
        path: '/aoq/:id',
        component: aoq,
        name: 'aoq'
    },
    {
        path: '/app/:id',
        component: app,
        name: 'app'
    },
    {
        path: '/ors/:id',
        component: ors,
        name: 'ors'
    },
    {
        path: '/po/:id',
        component: po,
        name: 'po'
    },
    {
        path: '/ppmp/:id',
        component: ppmp,
        name: 'ppmp'
    },
    {
        path: '/pr/:id',
        component: pr,
        name: 'pr'
    },
    {
        path: '/rfq/:id',
        component: rfq,
        name: 'rfq'
    },
    {
        path: '/sps/:id',
        component: sps,
        name: 'sps'
    },
    {
        path: '/suppliers',
        component: suppliers,
        children: [
            {
                path: '',
                component: supplier_list
            },
        ]
    },
    {
        path: '/',
        component: login
    },
    {
        path: '/purchase_request2',
        component: purchase_request2
    },
    {
        path: '/purchase_order2',
        component: purchase_order2
    },
    {
        path: '/drugs_and_medicines',
        component: drugs_and_medicines
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
            {
                path: 'show/:id',
                component: ppmp_show,
                name: 'ppmp_show',
            }
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
            {
                path: 'show/:id',
                component: price_schedule_show,
                name: 'price_schedule_show',
            }
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
        path: '/apps',
        component: apps,
        children: [
            {
                path: '',
                component: app_list
            },
            {
                path: 'show/:id',
                component: app_show,
                name: 'app_show'
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
    {
        path: '/links',
        component: links,
        children: [
            {
                path: '',
                component: link_list
            },
        ]
    },
    {
        path: '/adjustments',
        component: adjustments,
        children: [
            {
                path: '',
                component: adjustment_list
            },
        ]
    },
];