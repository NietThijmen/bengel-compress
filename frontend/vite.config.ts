import {defineConfig} from 'vite'
import {svelte} from '@sveltejs/vite-plugin-svelte'
import devManifest from 'vite-plugin-dev-manifest';
import TurboConsole from 'unplugin-turbo-console/vite'
import tailwindcss from '@tailwindcss/vite'
// https://vite.dev/config/
export default defineConfig({
  plugins: [
    devManifest(),
    TurboConsole(),
    tailwindcss(),
    svelte({
      compilerOptions: {
        customElement: true,
        css: "injected"
      }
    })
  ],
  build: {
    manifest: true,
    sourcemap: false, // Set to true if you need sourcemaps (useful for debugging)

    rollupOptions: {
      input: {
        frontend: 'src/main.ts'
      },
      output: {
        format: "iife"
      }
    }
  },
  server: {
    cors: true,
  },

  resolve: {
    alias: {
      '@': '/src',
      '@components': '/src/Components',
      '@api': '/src/Api',
      '@interfaces': '/src/Interfaces',
    }
  }
})