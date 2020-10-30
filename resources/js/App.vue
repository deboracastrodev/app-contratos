<template>
    <div id="home-page">
        <header-component></header-component>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">

                    <router-view></router-view>

                </div>
            </div>
        </main>

        <footer-component></footer-component>

    </div>
</template>
<script>
  import HeaderComponent from './components/layout/HeaderComponent.vue';
  import FooterComponent from './components/layout/FooterComponent.vue';

  export default {
    components: {
      HeaderComponent,
      FooterComponent
    }
  }
</script>
