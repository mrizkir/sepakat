<template>
  <FrontLayout>
    <v-container fluid>
      <v-row>
        <v-col cols="12" class="pa-0">
          <v-carousel cycle show-arrows-on-hover height="auto">
            <v-carousel-item
              v-for="(slide, i) in slides"
              :key="i"
              :src="$api.storageURL + '/' + slide.src">
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
    </v-container>
  </FrontLayout>
</template>
<script>
  import FrontLayout from '@/views/layouts/FrontLayout'
  export default {
    name: 'Home',
    data: () => ({
      slides: [
        {
          src: 'storage/images/sliders/slider1.jpg',
        },
        {
          src: 'storage/images/sliders/slider2.jpg',
        },
        {
          src: 'storage/images/sliders/slider3.jpg',
        },
        {
          src: 'storage/images/sliders/slider4.jpg',
        },
      ],
    }),
    components: {
      FrontLayout,
    },
  }
</script>
