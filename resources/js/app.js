/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../sass/app.scss'
import Router from '@/router';
import Maska from 'maska';

import { createApp } from 'vue';

const app = createApp({})
app.use(Router)
app.use(Maska)

app.mount('#app')
