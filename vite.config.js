import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";
import vue from '@vitejs/plugin-vue';
import vueDevtools from 'vite-plugin-vue-devtools';
import { fileURLToPath, URL } from 'url';


export default defineConfig({
  plugins: [
    vue(),
    vueDevtools(),
    symfonyPlugin(),
  ],
  resolve: {
    alias: {
      '~': fileURLToPath(new URL('./assets', import.meta.url)),
    }
  },
  server: {
    cors: true,
  },
  build: {
    rollupOptions: {
      input: {
        app: "./assets/app.js"
      },
    }
  },
});
