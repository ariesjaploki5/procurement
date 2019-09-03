

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

import users from './components/pages/users/main';
import user_list from './components/pages/users/list';

import links from './components/pages/links/main';
import link_list from './components/pages/links/list';

import adjustments from './components/pages/adjustments/main';
import adjustment_list from './components/pages/adjustments/list';

import purchase_request2 from './components/pharmacy/purchase_request.vue';
import purchase_order2 from './components/pharmacy/purchase_order.vue';


import request_for_quotation from './components/pages/rfq/main.vue';
import request_for_quotation_list from './components/pages/rfq/list.vue';
import request_for_quotation_show from './components/pages/rfq/show.vue';

import drugs_and_medicines from './components/pharmacy/drugs_and_medicines.vue';
import pr_dmd from './components/pharmacy/pr_dmd.vue';

import verified_reports from './components/mmo/verified_reports.vue';

import suppliers from './components/pages/supplier/main';
import supplier_list from './components/pages/supplier/list';

import accounting_po from './components/accounting/all_po.vue';
import accounting_dmd from './components/accounting/drugs_and_medicines.vue';

import budget_po from './components/budget/all_po.vue';
import budget_dmd from './components/budget/drugs_and_medicines.vue';

import div_head_po from './components/div_head/all_po.vue';

import fmo_po from './components/fmo/all_po.vue';
import mcc_po from './components/mcc/all_po.vue';

import pmo_po from './components/pmo/all_po.vue';
import pmo_pr from './components/pmo/all_pr.vue';
import pmo_rfq from './components/pmo/request_for_quotation.vue';

import cmps_pr from './components/div_head/all_pr.vue';
import cmps_po from './components/div_head/all_po.vue';
import cmps_dmd from './components/div_head/dmds.vue';

import mmo_po from './components/mmo/all_po.vue';
import mmo_dmd from './components/mmo/drugs_and_medicines.vue';
import dmd_po from './components/mmo/dmd_po.vue';
import mmo_dvs from './components/mmo/dv.vue';
import mmo_iar from './components/mmo/iar.vue';

import aoq from './components/print/aoq';
import app from './components/print/app';
import obrs from './components/print/obrs';
import po from './components/print/po';
import ppmp from './components/print/ppmp';
import pr from './components/print/pr';
import rfq from './components/print/rfq';
import sps from './components/print/sps';
import ntt from './components/print/ntt';
import na from './components/print/na';
import dv from './components/print/dv';

import cpr from './components/print/cpr';

import consignments from './components/pages/consignments/main.vue';

import mds_consignments from './components/pharmacy/mds_consignment.vue';
import consignment_requests from './components/pharmacy/consignment_request.vue';

import others from './components/others/main.vue';

export const routes = [
    {
        path: '/mmo_dvs',
        component: mmo_dvs,
        name: 'mmo_dvs',
        meta: { requiresAuth: true }
    },
    {
        path: '/mmo_iar',
        component: mmo_iar,
        name: 'mmo_iar',
        meta: { requiresAuth: true }
    },
    {
        path: '/cmps_dmd',
        component: cmps_dmd,
        name: 'cmps_dmd',
        meta: { requiresAuth: true }
    },
    {
        path: '/dmd_po',
        component: dmd_po,
        name: 'dmd_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/others',
        component: others,
        name: 'others',
        meta: { requiresAuth: true }
    },
    {
        path: '/consignment_requests',
        component: consignment_requests,
        name: 'consignment_requests',
        meta: { requiresAuth: true }
    },
    {
        path: '/consignments',
        component: consignments,
        name: 'consignments',
        meta: { requiresAuth: true }
    },

    {
        path: '/mds_consignments',
        component: mds_consignments,
        name: 'mds_consignments',
        meta: { requiresAuth: true }
    },

    {
        path: '/accounting_dmd',
        component: accounting_dmd,
        name: 'accounting_dmd',
        meta: { requiresAuth: true }
    },
    {
        path: '/accounting_po',
        component: accounting_po,
        name: 'accounting_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/budget_po',
        component: budget_po,
        name: 'budget_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/cmps_po',
        component: cmps_po,
        name: 'cmps_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/pmo_po',
        component: pmo_po,
        name: 'pmo_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/pmo_pr',
        component: pmo_pr,
        name: 'pmo_pr',
        meta: { requiresAuth: true }
    },
    {
        path: '/pmo_rfq',
        component: pmo_rfq,
        name: 'pmo_rfq',
        meta: { requiresAuth: true }
    },
    {
        path: '/fmo_po',
        component: fmo_po,
        name: 'fmo_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/mcc_po',
        component: mcc_po,
        name: 'mcc_po',
        meta: { requiresAuth: true }
    },
    {
        path: '/mmo_po',
        component: mmo_po,
        name: 'mmo_po',
        meta: { requiresAuth: true }
    },
    {    
        path: '/cmps_pr',
        component: cmps_pr,
        name: 'cmps_pr',
        meta: { requiresAuth: true }
    },
    {
        path: '/mmo_dmd',
        component: mmo_dmd,
        name: 'mmo_dmd',
        meta: { requiresAuth: true }
    },
    {
        path: '/aoq/:id/:rfq_id',
        component: aoq,
        name: 'aoq',
        meta: { requiresAuth: true }
    },
    {
        path: '/app/:id',
        component: app,
        name: 'app',
        meta: { requiresAuth: true }
    },
    {
        path: '/dv/:id',
        component: dv,
        name: 'dv',
        meta: { requiresAuth: true }
    },
    {
        path: '/obrs/:id',
        component: obrs,
        name: 'obrs',
        meta: { requiresAuth: true }
    },
    {
        path: '/po/:id',
        component: po,
        name: 'po',
        meta: { requiresAuth: true }
    },
    {
        path: '/ppmp/:id',
        component: ppmp,
        name: 'ppmp',
        meta: { requiresAuth: true }
    },
    {
        path: '/pr/:id',
        component: pr,
        name: 'pr',
        meta: { requiresAuth: true }
    },
    {
        path: '/cpr/:id',
        component: cpr,
        name: 'cpr',
        meta: { requiresAuth: true }
    },
    {
        path: '/na/:id',
        component: na,
        name: 'na',
        meta: { requiresAuth: true }
    },
    {
        path: '/rfq/:id',
        component: rfq,
        name: 'rfq',
        meta: { requiresAuth: true }
    },
    {
        path: '/sps/:id',
        component: sps,
        name: 'sps',
        meta: { requiresAuth: true }
    },
    {
        path: '/ntt/:id',
        component: ntt,
        name: 'ntt',
        meta: { requiresAuth: true }
    },
    {
        path: '/suppliers',
        component: suppliers,
        children: [
            {
                path: '',
                component: supplier_list
            },
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/',
        component: login
    },
    {
        path: '/purchase_request2',
        component: purchase_request2,
        meta: { requiresAuth: true }
    },
    {
        path: '/purchase_order2',
        component: purchase_order2,
        meta: { requiresAuth: true }
    },
    {
        path: '/verified_reports',
        component: verified_reports,
        meta: { requiresAuth: true }
    },
    {
        path: '/drugs_and_medicines',
        component: drugs_and_medicines,
        meta: { requiresAuth: true }
    },
    {
        path: '/pr_dmd',
        component: pr_dmd,
        meta: { requiresAuth: true }
    },
    {
        path: '/budget_dmd',
        component: budget_dmd,
        meta: { requiresAuth: true }
    },

    {
        path: '/home',
        component: home,
        meta: { requiresAuth: true }
    },
    {
        path: '/categories',
        component: categories,
        children: [
            {
                path: '',
                component: category_list
            },
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/inventory',
        component: inventory,
        children: [
            {
                path: '',
                component: inventory_list
            },
        ],
        meta: { requiresAuth: true }
    },    {
        path: '/request_for_quotation',
        component: request_for_quotation,
        children: [
            {
                path: '',
                component: request_for_quotation_list
            },
            {
                path: 'show/:id',
                component: request_for_quotation_show,
                name: 'request_for_quotation_show'
            },
        ],
        meta: { requiresAuth: true }
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
        ],
        meta: { requiresAuth: true }
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
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/purchase_orders',
        component: purchase_orders,
        children: [
            {
                path: '',
                component: purchase_order_list
            },
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/purchase_requests',
        component: purchase_requests,
        meta: { requiresAuth: true }
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
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/users',
        component: users,
        children: [
            {
                path: '',
                component: user_list
            },
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/links',
        component: links,
        children: [
            {
                path: '',
                component: link_list
            },
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/adjustments',
        component: adjustments,
        children: [
            {
                path: '',
                component: adjustment_list
            },
        ],
        meta: { requiresAuth: true }
    },
];