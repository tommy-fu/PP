<template>
	<div class="preview-container" v-if="getShowPreviewImage">
		<div class="preview-img-container">
<!--			<img src="/dashboard/images/Beanpanda.png"-->
<!--			     srcset="/dashboard/images/Beanpanda-p-500.png 500w,-->
<!--			                                        /dashboard/images/Beanpanda-p-800.png 800w,-->
<!--			                                        /dashboard/images/Beanpanda-p-1080.png 1080w,-->
<!--			                                        /dashboard/images/Beanpanda.png 1474w"-->
<!--			     sizes="100vw" alt="" class="preview-img">-->
			
			<img :src="getPreviewImageUrl"
			     sizes="100vw" alt="" class="preview-img" style="object-fit: contain; width: 100%;">
		</div>
		<img src="/dashboard/images/X-16.svg" alt=""
		     class="exit-button" @click="setShowPreviewImage(null)"></div>
</template>

<script>
    import {mapGetters, mapMutations} from "vuex";

    export default {
        name: "image-preview",
        props: {
            show: {
                type: Boolean,
                default: false
            },
            image: {
                type: String,
                default: ''
            },

        },
        computed: {
            ...mapGetters(['getShowPreviewImage', 'getPreviewImageUrl']),
        },
        methods: {
            ...mapMutations(['setShowPreviewImage']),
        },
    }
</script>

<style scoped>

</style>
