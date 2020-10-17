<template>
    <div>
        <span class="feature"
              :class="{ 'gray-text' : !platform.nicheEditLinkActive }"
        >
            <img :src="require('@/assets/svg/tick.svg')" alt=""
                 v-if="platform.nicheEditLinkActive">
            <img :src="require('@/assets/svg/cross.svg')" alt="" v-else>
            Niche Edit Link
        </span>
        <span class="feature"
              :class="{ 'gray-text' : !platform.freeHomeFeaturedActive }"
        >
            <img :src="require('@/assets/svg/tick.svg')" alt=""
                 v-if="platform.freeHomeFeaturedActive">
            <img :src="require('@/assets/svg/cross.svg')" alt="" v-else>
            Home featured
        </span>
        <span class="feature"
              :class="{ 'gray-text' : !platform.doFollowActive }"
        >
            <img :src="require('@/assets/svg/tick.svg')" alt=""
                 v-if="platform.doFollowActive">
            <img :src="require('@/assets/svg/cross.svg')" alt="" v-else>
            Dofollow
        </span>
    </div>
</template>

<script>
export default {
    name: 'PlatformFeatures',
    props: ['platform']
}
</script>

<style scoped>
.gray-text {
    color: #BDBDBD;
}

.feature {
    display: block;
    margin-bottom: 10px;
    font-weight: normal;
}

.feature img {
    margin-right: 4px;
}
</style>