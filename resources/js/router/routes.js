function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

let routes = [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },

  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  // Tasks
  { path: '/tasks', name: 'tasks.index', component: page('tasks/index') },
  { path: '/tasks/create', name: 'tasks.create', component: page('tasks/create') },
  { path: '/tasks/:id/edit', name: 'tasks.edit', component: page('tasks/edit') },

];

/**
 * Calling pageModulesCRUD('properties', 'properties', 'properties/pages')
 * @example  will return data as showed belown
*/
// { path: '/properties', name: 'properties', component: pageModules('properties/pages/index.vue') },
// { path: '/properties/:id', name: 'properties.show', component: pageModules('properties/pages/show.vue') },
// { path: '/properties/create', name: 'properties.create', component: pageModules('properties/pages/create.vue') },
// { path: '/properties/:id/edit', name: 'properties.edit', component: pageModules('properties/pages/edit.vue') },


routes.push({ path: '*', component: page('errors/404.vue') });

export default routes
