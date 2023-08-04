import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import GameView from '../views/GameView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      children: [
        {
          path: '',
          name: 'homePage',
          component: () => import('../views/home/HomePage.vue'),
        },
        {
          path: 'about',
          name: 'aboutPage',
          component: () => import('../views/home/AboutPage.vue'),
          children: [
            {
              path: '',
              name: 'aboutContent',
              component: () => import('../views/home/about/AboutContent.vue'),
            },
            {
              path: 'intro',
              name: 'aboutIntroContent',
              component: () => import('../views/home/about/IntroContent.vue'),
            },
            {
              path: 'key-visual',
              name: 'aboutKeyVisualContent',
              component: () => import('../views/home/about/KeyVisualContent.vue'),
            },
            {
              path: 'theme',
              name: 'aboutThemeContent',
              component: () => import('../views/home/about/ThemeContent.vue'),
            },
            {
              path: 'contact',
              name: 'aboutContactContent',
              component: () => import('../views/home/about/ContactContent.vue'),
            }
          ]
        },
        {
          path: 'news',
          name: 'newsPage',
          component: () => import('../views/home/NewsPage.vue'),
          children: [
            {
              path: '',
              name: 'newsContet',
              component: () => import('../views/home/news/NewsContent.vue'),
            },
          ],
        },
        {
          path: 'visitor',
          name: 'visitorPage',
          component: () => import('../views/home/VisitorPage.vue'),
          children: [
            {
              path: '',
              name: 'visitorContet',
              component: () => import('../views/home/visitor/VisitorContent.vue'),
            },
            {
              path: 'schedule',
              name: 'visitorScheduleContet',
              component: () => import('../views/home/visitor/ScheduleContent.vue'),
            },
            {
              path: 'site-map',
              name: 'visitorSiteMapContet',
              component: () => import('../views/home/visitor/SiteMapContent.vue'),
            },
            {
              path: 'stand-map',
              name: 'visitorStandMapContet',
              component: () => import('../views/home/visitor/StandMapContent.vue'),
            },
            {
              path: 'market-stand-map',
              name: 'visitorMarketStandContet',
              component: () => import('../views/home/visitor/MarketStandContent.vue'),
            },
            {
              path: 'program',
              name: 'visitorProgramContet',
              component: () => import('../views/home/visitor/ProgramContent.vue'),
            },
            {
              path: 'club-list',
              name: 'visitorClubListContet',
              component: () => import('../views/home/visitor/ClubListContent.vue'),
            },
          ],
        },
        {
          path: 'links',
          name: 'linksPage',
          component: () => import('../views/home/LinksPage.vue'),
          children: [
            {
              path: '',
              name: 'linksContet',
              component: () => import('../views/home/links/LinksContent.vue'),
            },
          ],
        },
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/LoginView.vue'),
      children: [
        {
          path: '',
          name: 'userLogin',
          component: () => import('../views/login/UserLogin.vue'),
          children: [
            {
              path: '',
              name: 'userLoginContent',
              component: () => import('../views/login/user/LoginContent.vue'),
            },
            {
              path: 'register',
              name: 'userRegisterContent',
              component: () => import('../views/login/user/RegisterContent.vue'),
            },
          ],
        },
        {
          path: 'admin',
          name: 'adminLogin',
          component: () => import('../views/login/AdminLogin.vue'),
        },
      ],
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('../views/AdminView.vue'),
    },
    {
      path: '/game',
      name: 'game',
      component: GameView,
      children: [
        {
          path: '',
          name: 'gamePage',
          component: () => import('../views/game/GamePage.vue'),
        },
      ]
    },
  ],
});

export default router;
