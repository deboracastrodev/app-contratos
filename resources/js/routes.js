import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home';
import Contract from './pages/Contract';
import Property from './pages/Property';
import About from './pages/About';

import AddProperty from './components/addProperty.vue';
import EditProperty from './components/editProperty.vue';

export const routes = [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/contract',
            name: 'contract',
            component: Contract,
            title: 'teste'
        },
        {
            path: '/property',
            name: 'property',
            component: Property
        },
        {
            path: '/property/edit/:id',
            name: 'property_edit',
            component: EditProperty
        },
        {
            path: '/property/add',
            name: 'property_add',
            component: AddProperty
        },
        {
            path: '/about',
            name: 'about',
            component: About
        }
]