<template>
    <div class="container mt-6">
        <h1>Add new Platform</h1>
        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <VDivider></VDivider>
        <VRow>
            <VCol cols="12" md="12">
                <div class="mt-6">
                    <h2>General Information</h2>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextField
                                outlined
                                label="Website URL"
                                prepend-inner-icon="mdi-earth"
                                v-model="websiteUrl"
                                @keydown="onWebsiteUrlKeydown"
                                :error-messages="websiteUrlErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VSelect
                                id="custom-combobox"
                                outlined
                                :items="Object.keys(allTopics)"
                                label="Topics"
                                multiple
                                deletable-chips
                                small-chips
                                :error-messages="topicsErrors"
                                v-model="topics"
                            ></VSelect>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                no-resize
                                rows="3"
                                label="Description"
                                v-model="description"
                                :error-messages="descriptionErrors"
                            ></VTextarea>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                no-resize
                                rows="3"
                                label="Article Requirements"
                                v-model="articleRequirements"
                                :error-messages="articleRequirementsErrors"
                            ></VTextarea>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                no-resize
                                rows="3"
                                label="Where Posted"
                                v-model="wherePosted"
                                :error-messages="wherePostedErrors"
                            ></VTextarea>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTextField
                                outlined
                                label="DeadLine"
                                prepend-inner-icon="mdi-calendar"
                                v-model="deadLine"
                                :error-messages="deadLineErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <h2>Tech characteristics</h2>
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>MA</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip MA</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="MA"
                                v-model="ma"
                                :error-messages="maErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>DR</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip DR</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="DR"
                                v-model="dr"
                                :error-messages="drErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Organic Traffic</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Organic Traffic</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Organic Traffic"
                                v-model="organicTraffic"
                                :error-messages="organicTrafficErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>

                    <h2>Features</h2>
                    <VRow>
                        <VCol cols="12" md="2">
                            <div class="d-flex justify-space-between">
                                <span class="d-flex align-center">Dofollow</span>
                                <VSwitch inset v-model="doFollow"></VSwitch>
                            </div>
                        </VCol>
                        <VCol cols="12" md="3">
                            <div class="d-flex justify-space-between">
                                <span class="d-flex align-center">Free Home Featured</span>
                                <VSwitch inset v-model="freeHomeFeatured"></VSwitch>
                            </div>
                        </VCol>
                        <VCol cols="12" md="2">
                            <div class="d-flex justify-space-between">
                                <span class="d-flex align-center">Niche Edit Link</span>
                                <VSwitch inset v-model="nicheEditLink"></VSwitch>
                            </div>
                        </VCol>
                    </VRow>

                    <h2>Feature Prices</h2>
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTextField
                                outlined
                                label="Price"
                                prepend-inner-icon="mdi-currency-usd"
                                v-model="price"
                                :error-messages="priceErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTextField
                                outlined
                                label="Article Writing Price"
                                append-icon="mdi-currency-usd"
                                readonly
                                v-model="articleWritingPrice"
                                :error-messages="articleWritingPriceErrors"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTextField
                                outlined
                                label="Niche Edit Link Difference"
                                :disabled="!nicheEditLink"
                                v-model="nicheEditLinkDifference"
                                :error-messages="nicheEditLinkDifferenceErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTextField
                                outlined
                                label="Niche Edit Link Price"
                                append-icon="mdi-currency-usd"
                                :disabled="!nicheEditLink"
                                readonly
                                v-model="nicheEditLinkPrice"
                                :error-messages="nicheEditLinkPriceErrors"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                    <VSpacer></VSpacer>

                    <h2>SEO characteristics</h2>
                    <h4 class="mt-4">MOZ</h4>
                    <VDivider />
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>DA</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip DA</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="DA"
                                v-model="moz.da"
                                :error-messages="mozDaErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>PA</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip PA</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="PA"
                                v-model="moz.pa"
                                :error-messages="mozPaErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Links In</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Links In</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Links In"
                                v-model="moz.links_in"
                                :error-messages="mozLinksInErrors"
                            ></VTextField>

                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>MozRank</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip MozRank</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="MozRank"
                                v-model="moz.mozrank"
                                :error-messages="mozRankErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>

                    <h4 class="mt-4">Alexa</h4>
                    <VDivider />
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Rank</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Rank</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Rank"
                                v-model="alexa.rank"
                                :error-messages="alexaRankErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Country</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Country</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Country"
                                v-model="alexa.country"
                                :error-messages="alexaCountryErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>

                    <h4 class="mt-4">SemRush</h4>
                    <VDivider />
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Rank</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Rank</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Rank"
                                v-model="semrush.rank"
                                :error-messages="semrushRankErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Keyword number</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Keyword number</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Keyword Number"
                                v-model="semrush.keyword_num"
                                :error-messages="semrushKeywordNumErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Traffic</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Traffic</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Traffic"
                                v-model="semrush.traffic"
                                :error-messages="semrushTrafficErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Traffic costs</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Traffic costs</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Traffic costs"
                                v-model="semrush.traffic_costs"
                                :error-messages="semrushTrafficCostsErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <VBtn
                        @click="fillMozAlexaSr"
                        color="primary"
                        :loading="fillMozAlexaSrLoading"
                        :disabled="!websiteUrl"
                    >
                        Fill Moz, Alexa, Sr
                    </VBtn>

                    <h4 class="mt-4">Majestic</h4>
                    <VDivider />
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>External Backlinks</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>External Backlinks</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="External Backlink"
                                v-model="majestic.external_backlinks"
                                :error-messages="majesticExternalBacklinksErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>External gov</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip External gov</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="External gov"
                                v-model="majestic.external_gov"
                                :error-messages="majesticExternalGovErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>External Edu</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip External Edu</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="External Edu"
                                v-model="majestic.external_edu"
                                :error-messages="majesticExternalEduErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>TF</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip TF</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="TF"
                                v-model="majestic.tf"
                                :error-messages="majesticTfErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>CF</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip CF</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="CF"
                                v-model="majestic.cf"
                                :error-messages="majesticCfErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <VBtn
                        @click="fillMajestic"
                        color="orange"
                        :loading="fillMajesticLoading"
                        :disabled="!websiteUrl"
                        class="text-white"
                    >
                        Fill Majestic
                    </VBtn>
                    <VDivider class="my-6"></VDivider>

                    <h2>Additional information</h2>
                    <VRow>
                        <VCol cols="12" md="5">
                            <VTextField
                                outlined
                                label="Email"
                                prepend-inner-icon="mdi-email"
                                v-model="email"
                                :error-messages="emailErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                label="Contacts"
                                no-resize
                                rows="3"
                                v-model="contacts"
                                :error-messages="contactsErrors"
                            ></VTextarea>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                label="Comment"
                                no-resize
                                rows="3"
                                v-model="comment"
                                :error-messages="commentErrors"
                            ></VTextarea>
                        </VCol>
                    </VRow>
                </div>
                <VCol cols="12" class="text-center">
                    <VBtn color="green" @click="onSave" dark>
                        <VIcon left>mdi-plus</VIcon>
                        Add Platform
                    </VBtn>
                </VCol>
            </VCol>
        </VRow>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as getters from '@/store/modules/platforms/types/getters';
import * as notifyActions from '@/store/modules/notification/types/actions';
import { validationMixin } from 'vuelidate';
import {
    required, minLength,
    maxLength, email,
    minValue, maxValue,
    url, requiredIf
} from 'vuelidate/lib/validators';
import requestExternalService from '@/services/requestExternalService';
import { ErrorStatus } from '@/services/requestExternalService';


export default {
    name: 'AdminAddPlatformComponent',
    mixins: [validationMixin],
    validations: {
        websiteUrl: { required, minLength: minLength(5), url },
        dr: { required },
        ma: { required },
        organicTraffic: { required },
        topics: { required },
        price: { minValue: minValue(0), required },
        description: { required, maxLength: maxLength(255) },
        articleRequirements: { required, maxLength: maxLength(255) },
        wherePosted: { required, maxLength: maxLength(255) },
        deadLine: { required, minValue: minValue(1), maxValue: maxValue(60) },
        articleWritingPrice: { required },
        moz: {
            da: {
                required, minValue: minValue(0), maxValue: maxValue(100)
            },
            pa: {
                required, minValue: minValue(0), maxValue: maxValue(100)
            },
            links_in: {
                required, minValue: minValue(1)
            },
            mozrank: {
                required, minValue: minValue(1)
            },
        },
        alexa: {
            rank: {
                required, minValue: minValue(1)
            },
            country: {
                required
            }
        },
        semrush: {
            rank: {
                required, minValue: minValue(1)
            },
            keyword_num: {
                required, minValue: minValue(0)
            },
            traffic: {
                required, minValue: minValue(0)
            },
            traffic_costs: {
                required, minValue: minValue(0)
            },
        },
        majestic: {
            external_backlinks: {
                required, minValue: minValue(0)
            },
            external_gov: {
                required, minValue: minValue(0)
            },
            external_edu: {
                required, minValue: minValue(0)
            },
            tf: {
                required, minValue: minValue(0), maxValue: maxValue(100)
            },
            cf: {
                required, minValue: minValue(0), maxValue: maxValue(100)
            },
        },
        email: { required, email },
        contacts: { maxLength: maxLength(255) },
        comment: { maxLength: maxLength(255) },
        nicheEditLinkPrice: {
            required: requiredIf(function(){
                return this.nicheEditLink;
            })
        },
        nicheEditLinkDifference: {
            required: requiredIf(function(){
                return this.nicheEditLink;
            })
        }
    },
    data: () => ({
        fillMozAlexaSrLoading: false,
        fillMajesticLoading: false,
        websiteUrl: '',
        dr: '',
        ma: '',
        organicTraffic: '',
        topics: [],
        price: '',
        description: '',
        articleRequirements: '',
        deadLine: 1,
        wherePosted: '',
        doFollow: false,
        freeHomeFeatured: true,
        nicheEditLink: false,
        articleWritingPrice: '',
        nicheEditLinkPrice: '',
        nicheEditLinkDifference: '',
        email: '',
        contacts: '',
        comment: '',
        moz: {
            da: '',
            pa: '',
            links_in: '',
            mozrank: '',
        },
        alexa: {
            rank: '',
            country: ''
        },
        semrush: {
            rank: '',
            keyword_num: '',
            traffic: '',
            traffic_costs: '',
        },
        majestic: {
            external_backlinks: '',
            external_gov: '',
            external_edu: '',
            tf: '',
            cf: '',
        },

    }),
    methods: {
        ...mapActions('platforms', {
            createPlatform: actions.CREATE_PLATFORM,
            fetchTopics: actions.FETCH_TOPICS
        }),
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        async fillMajestic() {
            try {
                if (this.websiteUrl) {
                    this.fillMajesticLoading = true;
                    const response = await requestExternalService.fetchSeoRankInfoForDomainMajestic(this.websiteUrl);
                    const responseData = response?.data;
                    if (ErrorStatus.includes(responseData)) {
                        this.setNotification({
                            message: "Status: " + responseData,
                            type: 'error'
                        });
                    }
                    this.majestic.external_backlinks = responseData.ExtBackLinks;
                    this.majestic.external_gov = responseData.ExtBackLinksGOV;
                    this.majestic.external_edu = responseData.ExtBackLinksEDU;
                    this.majestic.tf = responseData.TrustFlow;
                    this.majestic.cf = responseData.CitationFlow;
                    this.fillMajesticLoading = false;
                }
            } catch (error) {
                this.setNotification({
                    message: error,
                    type: 'error'
                });
                this.fillMajesticLoading = false;
            }
        },
        async fillMozAlexaSr() {
            try {
                if (this.websiteUrl) {
                    this.fillMozAlexaSrLoading = true;
                    const response = await requestExternalService.fetchSeoRankInfoForDomainMozAlexaSr(this.websiteUrl);
                    const responseData = response?.data;
                    if (ErrorStatus.includes(responseData)) {
                        this.setNotification({
                            message: "Status: " + responseData,
                            type: 'error'
                        });
                    }
                    this.moz.pa = responseData.pa !== 'notfound' ? responseData.pa : '';
                    this.moz.da = responseData.da !== 'notfound' ? responseData.da : '';
                    this.moz.mozrank = responseData.mozrank !== 'notfound' ? responseData.mozrank : '';
                    this.moz.links_in = responseData.links !== 'notfound' ? responseData.links : '';

                    this.alexa.rank = responseData.a_rank !== 'N/A' ? responseData.a_rank : '';
                    this.alexa.country = responseData.a_cnt !== 'N/A' ? responseData.a_cnt : '';

                    this.semrush.rank = responseData.sr_rank !== 'notfound' ? responseData.sr_rank : '';
                    this.semrush.keyword_num = responseData.sr_kwords !== 'notfound' ? responseData.sr_kwords : '';
                    this.semrush.traffic = responseData.sr_traffic !== 'notfound' ? responseData.sr_traffic : '';
                    this.semrush.traffic_costs = responseData.sr_costs !== 'notfound' ? responseData.sr_costs : '';
                    this.fillMozAlexaSrLoading = false;
                }
            } catch (error) {
                this.setNotification({
                    message: error,
                    type: 'error'
                });
                this.fillMozAlexaSrLoading = false;
            }
        },
        async onSave() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.createPlatform({
                        website_url: this.websiteUrl,
                        dr: this.dr,
                        ma: this.ma,
                        organic_traffic: this.organicTraffic,
                        dofollow_active: this.doFollow,
                        free_home_featured_active: this.freeHomeFeatured,
                        niche_edit_link_active: this.nicheEditLink,
                        article_writing_price: this.articleWritingPrice,
                        niche_edit_link_price: this.nicheEditLinkPrice,
                        contacts: this.contacts,
                        price: this.price,
                        description: this.description,
                        article_requirements: this.articleRequirements,
                        deadline: this.deadLine,
                        where_posted: this.wherePosted,
                        email: this.email,
                        comment: this.comment,
                        topics: this.topics.map(topic => this.allTopics[topic]),
                        moz: this.moz,
                        alexa: this.alexa,
                        semrush: this.semrush,
                        majestic: this.majestic
                    });
                    this.setNotification({
                        message: 'Website was added!',
                        type: 'success'
                    });
                    this.websiteUrl = this.description = this.wherePosted = '';
                    this.topics = [];
                    this.price = 0;
                    this.deadLine = 1;
                    this.doFollow = false;
                    this.freeHomeFeatured = true;
                    this.nicheEditLink = false;
                    this.articleWritingPrice = 0;
                    this.nicheEditLinkPrice = 0;
                    this.email = this.contacts = this.comment = '';
                    this.moz.da =
                        this.moz.pa =
                        this.moz.mozrank =
                        this.moz.links_in = '';
                    this.alexa.rank =
                        this.alexa.country = '';
                    this.semrush.traffic =
                        this.semrush.traffic_costs =
                        this.semrush.rank =
                        this.semrush.keyword_num = '';
                    this.majestic.cf =
                        this.majestic.tf =
                        this.majestic.external_backlinks =
                        this.majestic.external_edu =
                        this.majestic.external_gov = '';
                    this.$v.$reset();
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                }
            }
        },
        onWebsiteUrlKeydown(e) {
            if (/[^0-9a-zA-Z:.\\/_-]/.test(e.key)) {
                e.preventDefault();
            }
        }
    },
    watch: {
        websiteUrl(newValue) {
            this.websiteUrl = newValue.replace(/[^0-9a-zA-Z:.\\/_-]/, '');
        },
        price(newPrice) {
            if (Number(this.price) * 0.2 < 30) {
                this.articleWritingPrice = Number(this.price) + 30;
            } else {
                this.articleWritingPrice = Number(this.price) * 1.2;
            }
            if (newPrice === '') this.articleWritingPrice = '';

            if (this.nicheEditLink) {
                this.nicheEditLinkPrice = Number(this.price) + Number(this.nicheEditLinkDifference);
                if (newPrice === '') this.nicheEditLinkPrice = '';
            }
        },
        nicheEditLinkDifference() {
            if (this.nicheEditLink && this.price) {
                this.nicheEditLinkPrice = Number(this.price) + Number(this.nicheEditLinkDifference);
            }
        },
        nicheEditLink() {
            if (this.nicheEditLink) {
                this.nicheEditLinkPrice = Number(this.price) + Number(this.nicheEditLinkDifference);
            } else {
                this.nicheEditLinkPrice = '';
            }
        }
    },
    async mounted() {
        await this.fetchTopics();
    },
    computed: {
        ...mapGetters('platforms', {
            allTopics: getters.GET_TOPICS
        }),
        websiteUrlErrors() {
            const errors = [];
            if (!this.$v.websiteUrl.$dirty) {
                return errors;
            }
            !this.$v.websiteUrl.required &&
                errors.push('Website URL is required!');
            !this.$v.websiteUrl.url &&
                errors.push('Website URL must be valid URL!');
            return errors;
        },
        topicsErrors() {
            const errors = [];
            if (!this.$v.topics.$dirty) {
                return errors;
            }
            !this.$v.topics.required &&
                errors.push('Topics are required!');
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.email.$dirty) {
                return errors;
            }
            !this.$v.email.required &&
                errors.push('Email is required!');
            !this.$v.email.email &&
                errors.push('Email must be valid!');
            return errors;
        },
        priceErrors() {
            const errors = [];
            if (!this.$v.price.$dirty) {
                return errors;
            }
            !this.$v.price.minValue &&
                errors.push('Price cannot be less then 0!');
            !this.$v.price.required &&
                errors.push('Price is required!');
            return errors;
        },
        descriptionErrors() {
            const errors = [];
            if (!this.$v.description.$dirty) {
                return errors;
            }
            !this.$v.description.maxLength &&
                errors.push('Description must be less 255 characters length!');
            !this.$v.description.required &&
                errors.push('Description field is required!');
            return errors;
        },
        contactsErrors() {
            const errors = [];
            if (!this.$v.contacts.$dirty) {
                return errors;
            }
            !this.$v.contacts.maxLength &&
                errors.push('Contacts must be less 255 characters length!');
            return errors;
        },
        commentErrors() {
            const errors = [];
            if (!this.$v.comment.$dirty) {
                return errors;
            }
            !this.$v.comment.maxLength &&
                errors.push('Comment must be less 255 characters length!');
            return errors;
        },
        articleRequirementsErrors() {
            const errors = [];
            if (!this.$v.comment.$dirty) {
                return errors;
            }
            !this.$v.articleRequirements.required &&
                errors.push('Article Requirements are required!');
            !this.$v.articleRequirements.maxLength &&
                errors.push('Article Requirements must be less 255 characters length!');
            return errors;
        },
        wherePostedErrors() {
            const errors = [];
            if (!this.$v.wherePosted.$dirty) {
                return errors;
            }
            !this.$v.wherePosted.required &&
            errors.push('Where Posted is required!');
            !this.$v.wherePosted.maxLength &&
            errors.push('Where Posted must be less 255 characters length!');
            return errors;
        },
        deadLineErrors() {
            const errors = [];
            if (!this.$v.deadLine.$dirty) {
                return errors;
            }
            !this.$v.deadLine.required &&
                errors.push('DeadLine field is required!');
            !this.$v.deadLine.minValue &&
                errors.push('DeadLine must be minimum 1 day!');
            !this.$v.deadLine.maxValue &&
                errors.push('DeadLine can be maximum 60 days!');
            return errors;
        },
        maErrors() {
            const errors = [];
            if (!this.$v.ma.$dirty) {
                return errors;
            }
            !this.$v.ma.required &&
                errors.push('MA is required!');
            return errors;
        },
        drErrors() {
            const errors = [];
            if (!this.$v.dr.$dirty) {
                return errors;
            }
            !this.$v.dr.required &&
                errors.push('DR is required!');
            return errors;
        },
        organicTrafficErrors() {
            const errors = [];
            if (!this.$v.organicTraffic.$dirty) {
                return errors;
            }
            !this.$v.organicTraffic.required &&
                errors.push('Organic Traffic is required!');
            return errors;
        },
        nicheEditLinkPriceErrors() {
            const errors = [];
            if (!this.$v.nicheEditLinkPrice.$dirty) {
                return errors;
            }
            !this.$v.nicheEditLinkPrice.required &&
            errors.push('Niche Edit Link Price is required!');
            return errors;
        },
        nicheEditLinkDifferenceErrors() {
            const errors = [];
            if (!this.$v.nicheEditLinkDifference.$dirty) {
                return errors;
            }
            !this.$v.nicheEditLinkDifference.required &&
                errors.push('Niche Edit Link Difference is required!');
            return errors;
        },
        articleWritingPriceErrors() {
            const errors = [];
            if (!this.$v.articleWritingPrice.$dirty) {
                return errors;
            }
            !this.$v.articleWritingPrice.required &&
                errors.push('Article Writing Price is required!');
            return errors;
        },

        // mozErrors
        mozDaErrors() {
            const errors = [];
            if (!this.$v.moz.da.$dirty) {
                return errors;
            }
            !this.$v.moz.da.required &&
                errors.push('DA is required!');
            !this.$v.moz.da.minValue &&
                errors.push('DA must be more than 0!');
            !this.$v.moz.da.maxValue &&
                errors.push('DA must be less than 100!');
            return errors;
        },
        mozPaErrors() {
            const errors = [];
            if (!this.$v.moz.pa.$dirty) {
                return errors;
            }
            !this.$v.moz.pa.required &&
                errors.push('PA is required!');
            !this.$v.moz.pa.minValue &&
                errors.push('PA must be more than 0!');
            !this.$v.moz.pa.maxValue &&
                errors.push('PA must be less than 100!');
            return errors;
        },
        mozLinksInErrors() {
            const errors = [];
            if (!this.$v.moz.links_in.$dirty) {
                return errors;
            }
            !this.$v.moz.links_in.required &&
                errors.push('Links In is required!');
            !this.$v.moz.links_in.minValue &&
                errors.push('Links In must be more than 1!');
            return errors;
        },
        mozRankErrors() {
            const errors = [];
            if (!this.$v.moz.mozrank.$dirty) {
                return errors;
            }
            !this.$v.moz.mozrank.required &&
                errors.push('MozRank is required!');
            !this.$v.moz.mozrank.minValue &&
                errors.push('Links In must be more than 1!');
            return errors;
        },

        // alexaErrors
        alexaRankErrors() {
            const errors = [];
            if (!this.$v.alexa.rank.$dirty) {
                return errors;
            }
            !this.$v.alexa.rank.required &&
                errors.push('Rank is required!');
            !this.$v.alexa.rank.minValue &&
                errors.push('Rank must be more than 1!');
            return errors;
        },
        alexaCountryErrors() {
            const errors = [];
            if (!this.$v.alexa.country.$dirty) {
                return errors;
            }
            !this.$v.alexa.country.required &&
                errors.push('Country is required!');
            return errors;
        },

        // semrushErrors
        semrushRankErrors() {
            const errors = [];
            if (!this.$v.semrush.rank.$dirty) {
                return errors;
            }
            !this.$v.semrush.rank.required &&
                errors.push('Rank is required!');
            !this.$v.semrush.rank.minValue &&
                errors.push('Rank must be more than 1!');
            return errors;
        },
        semrushKeywordNumErrors() {
            const errors = [];
            if (!this.$v.semrush.keyword_num.$dirty) {
                return errors;
            }
            !this.$v.semrush.keyword_num.required &&
                errors.push('Rank is required!');
            !this.$v.semrush.keyword_num.minValue &&
                errors.push('Rank must be more than 0!');
            return errors;
        },
        semrushTrafficErrors() {
            const errors = [];
            if (!this.$v.semrush.traffic.$dirty) {
                return errors;
            }
            !this.$v.semrush.traffic.required &&
                errors.push('Traffic is required!');
            !this.$v.semrush.traffic.minValue &&
                errors.push('Traffic must be more than 0!');
            return errors;
        },
        semrushTrafficCostsErrors() {
            const errors = [];
            if (!this.$v.semrush.traffic_costs.$dirty) {
                return errors;
            }
            !this.$v.semrush.traffic_costs.required &&
                errors.push('Traffic Costs is required!');
            !this.$v.semrush.traffic_costs.minValue &&
                errors.push('Traffic Cost must be more than 0!');
            return errors;
        },

        // majesticErrors
        majesticExternalBacklinksErrors() {
            const errors = [];
            if (!this.$v.majestic.external_backlinks.$dirty) {
                return errors;
            }
            !this.$v.majestic.external_backlinks.required &&
                errors.push('External Backlinks is required!');
            !this.$v.majestic.external_backlinks.minValue &&
                errors.push('External Backlinks must be more than 0!');
            return errors;
        },
        majesticExternalGovErrors() {
            const errors = [];
            if (!this.$v.majestic.external_gov.$dirty) {
                return errors;
            }
            !this.$v.majestic.external_gov.required &&
            errors.push('External Gov is required!');
            !this.$v.majestic.external_gov.minValue &&
            errors.push('External Gov must be more than 0!');
            return errors;
        },
        majesticExternalEduErrors() {
            const errors = [];
            if (!this.$v.majestic.external_edu.$dirty) {
                return errors;
            }
            !this.$v.majestic.external_edu.required &&
                errors.push('External Edu is required!');
            !this.$v.majestic.external_edu.minValue &&
                errors.push('External Edu must be more than 0!');
            return errors;
        },
        majesticTfErrors() {
            const errors = [];
            if (!this.$v.majestic.tf.$dirty) {
                return errors;
            }
            !this.$v.majestic.tf.required &&
                errors.push('TF is required!');
            !this.$v.majestic.tf.minValue &&
                errors.push('TF must be more than 0!');
            !this.$v.majestic.tf.maxValue &&
                errors.push('TF must be less than 100!');
            return errors;
        },
        majesticCfErrors() {
            const errors = [];
            if (!this.$v.majestic.cf.$dirty) {
                return errors;
            }
            !this.$v.majestic.cf.required &&
            errors.push('CF is required!');
            !this.$v.majestic.cf.minValue &&
            errors.push('CF must be more than 0!');
            !this.$v.majestic.cf.maxValue &&
            errors.push('CF must be less than 100!');
            return errors;
        }
    }
}
</script>

<style scoped>

</style>