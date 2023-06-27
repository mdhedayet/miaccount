import { createRouter, createWebHistory } from "vue-router";
import NotFound from '@/js/pages/NotFound'
import Dashboard from '@/js/layouts/Dashboard'
import AccountHierarchical from '@/js/pages/AccountHierarchical'
import AccountReport from '@/js/pages/AccountReportTable'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Dashboard,
            meta: { requiresAuth: true },
            children: [
                { path: "/", name: 'AccountHierarchical', component: AccountHierarchical },
                { path: "/account-report-table", name: 'AccountReport', component: AccountReport},
            ]
        },
        {
            path: '/:pathMatch(.*)*',
            name: '404',
            component: NotFound,
        }
    ],
});

export default router;
