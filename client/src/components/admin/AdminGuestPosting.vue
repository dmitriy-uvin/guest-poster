<template>
    <div class="container">
        <h1>Guest Posting and Niche edits list</h1>
        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <VDivider></VDivider>
        <VSpacer></VSpacer>
<!--        <VBtn @click="test"></VBtn>-->
        <table class="guest__table">
            <thead class="guest__head">
                <tr>
                    <th class="guest__col">
                        <VCheckbox @click="selectAll"></VCheckbox>
                    </th>
                    <th class="guest__col">
                        Website
                    </th>
                    <th class="guest__col">
                        Topic
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            A. DR
                        </div>
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            M. DA
                        </div>
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            Organic traffic
                        </div>
                    </th>
                    <th class="guest__col">
                        Features
                    </th>
                    <th class="guest__col">
                        <div class="guest__col-wrap">
                            Editorial fee
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="(platform, id) in platforms" :key="id">
                <td>
                    <VCheckbox :value="!!id" v-model="chosen[id]"></VCheckbox>
                </td>
                <td>
                    <div class="guest__col-wrap">
                        {{ platform.websiteUrl }}
                        <a href="#" class="guest__web">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" xmlns:v="https://vecta.io/nano"><path d="M7.333 0v1.333h2.393L3.173 7.887l.94.94 6.553-6.553v2.393H12V0H7.333zm3.333 10.667H1.333V1.333H6V0H1.333C.98 0 .64.14.39.39S0 .98 0 1.333v9.333c0 .354.14.693.39.943s.59.4.943.4h9.333c.354 0 .693-.14.943-.4s.4-.59.4-.943V6h-1.333v4.667z" fill="#bdbdbd"/></svg>
                        </a>
                    </div>
                </td>
                <td>
                    <VChip v-for="(topic, id) in platform.topics" :key="id">
                        {{ topic.name }}
                    </VChip>
                </td>
                <td>
                    {{ platform.dr }}
                </td>
                <td>
                    {{ platform.ma }}
                </td>
                <td>
                    {{ platform.organicTraffic }}
                </td>
                <td>
                    <ul style="list-style: none" class="pl-0">
                        <li
                            :class="{
                            'available' : platform.doFollowActive,
                            'not-available': !platform.doFollowActive}
                            "
                        >
                            Do Follow
                        </li>
                        <li
                            :class="{
                            'available' : platform.freeHomeFeaturedActive,
                            'not-available': !platform.freeHomeFeaturedActive}
                            "
                        >
                            Free Home Featured
                        </li>
                        <li
                            :class="{
                            'available' : platform.nicheEditLinkActive,
                            'not-available': !platform.nicheEditLinkActive}
                            "
                        >
                           Niche Edit Link
                        </li>
                    </ul>
                </td>
                <td>
                    <span class="guest__price">
                        {{ platform.price }} $
                    </span>
                    <span class="guest__wrap mb-1 d-block">
                        <span>
                            Article writing:
                        </span>
                        <span v-if="platform.articleWritingPrice > 0" class="text-orange">
                            + {{ platform.articleWritingPrice.toFixed(2) }} $
                        </span>
                        <span v-else class="text-green">
                            - {{ Math.abs(platform.articleWritingPrice).toFixed(2) }} $
                        </span>
                    </span>
                    <span class="guest__wrap" v-if="platform.nicheEditLinkActive">
                        <span>
                            Existing article:
                        </span>
                        <span v-if="platform.nicheEditLinkPrice > 0" class="text-orange">
                            + {{ platform.nicheEditLinkPrice.toFixed(2) }} $
                        </span>
                        <span v-else class="text-green">
                            - {{ Math.abs(platform.nicheEditLinkPrice).toFixed(2) }} $
                        </span>
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
        <VBtn color="red" fab class="float-btn-action" @click="onAddPlatform">
            <VIcon color="white">mdi-plus</VIcon>
        </VBtn>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as getters from '@/store/modules/platforms/types/getters';

export default {
    name: 'AdminGuestPosting',
    data: () => ({
        chosen: {}
    }),
    methods: {
        onAddPlatform() {
            this.$router.push({ name: 'AddPlatform' })
        },
        ...mapActions('platforms', {
            fetchPlatforms: actions.FETCH_PLATFORMS
        }),
        test() {
            console.log(this.chosen);
        },
        selectAll() {
            const newChosen = {};
            Object.keys(this.platforms).map(key => {
                newChosen[key] = !this.chosen[key];
            });
            this.chosen = newChosen;
        },
        selectOne(id) {
            this.chosen[id] = !this.chosen[id];
        }
    },
    async mounted() {
        await this.fetchPlatforms();
        Object.keys(this.platforms).map(key => {
            this.chosen[key] = null;
        });
    },
    computed: {
        ...mapGetters('platforms', {
            platforms: getters.GET_PLATFORMS
        })
    }
}
</script>

<style scoped>
@import "../../assets/styles/main.css";
/*@import "../../assets/styles/mobile.css";*/
.float-btn-action {
    position: absolute;
    bottom: 20px;
    right: 20px;
}
.guest__table {
    width: 100%;
}
.v-chip {
    height: 24px;
}
.guest__table tr {
    border: 1px solid #000;
}
.v-application--is-ltr .v-input--selection-controls__input {
     margin-right: 0;
}
.v-input--selection-controls {
     margin-top: 0;
     padding-top: 0;
}
</style>