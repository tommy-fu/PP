<template>
   <div class="mt-16">
      <InertiaLink :href="getSectionsUrl(section.slug)" :key="section.slug" v-for="(section, key) in getCategories"
                   class="section-item"
                   :class="{'section-item--active' : getActiveCategory === section.slug}">
         <span class="body-sm section-item-category noselect">{{section.name}}</span>
         <span class="body-xs section-item-number noselect">{{section.sections_count}}</span>
      </InertiaLink>
   </div>
</template>

<style scoped lang="scss">
   .section-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-direction: row;
      height: 24px;
      padding: 4px 12px;
      margin: 4px 0px;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      
      .section-item-category {
         color: #8C8C8C;
      }
      .section-item-number {
         color: #636363;
      }
      &:hover {
         background: #2B2B2B;
         .section-item-category {
            color: #fff;
         }
         .section-item-number {
            color: #d1d1d1;
         }
      }
   }
   .section-item--active {
      background: #1B2E3E;
      .section-item-category {
         color: #1592FF;
      }
      .section-item-number {
         color: #1592FF;
      }
      &:hover {
         .section-item-category {
            color: #1592FF;
         }
         .section-item-number {
            color: #1592FF;
         }
      }
   }
   .section-item--active:hover {
        background: #1B2E3E !important;
        cursor: default;
   }
</style>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: 'section-item',
        data() {
            return {}
        },
       computed: {
          // ...mapGetters(['getCategories', 'getActiveCategory'])
       },
       methods: {
          getSectionsUrl(slug) {
             if (slug) return '/sections?category=' + slug;
             else return '/sections';
          },
       }
       
    }
</script>
