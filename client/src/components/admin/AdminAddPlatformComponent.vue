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
                                @input="onSetWebsite"
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
                        <VCol cols="12" md="2">
                            <div class="d-flex justify-space-between">
                                <span class="d-flex align-center">Money Anchor</span>
                                <VSwitch inset v-model="moneyAnchor"></VSwitch>
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
                                prepend-inner-icon="mdi-currency-usd"
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
                                append-icon="mdi-currency-usd"
                                :disabled="!nicheEditLink"
                                v-model="nicheEditLinkDifference"
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
                            >
                            </VTextField>
                        </VCol>
                    </VRow>
                    <VSpacer></VSpacer>

                    <h2>SEO characteristics</h2>
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Trust</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Trust</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Trust"
                                v-model="trust"
                                :error-messages="trustErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Spam</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Spam</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Spam"
                                v-model="spam"
                                :error-messages="spamErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>LRT PowerTrust</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip LRT PowerTrust</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="PowerTrust"
                                v-model="lrtPowerTrust"
                                :error-messages="lrtPowerTrustErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <VBtn
                        @click="onFillBasicData"
                        color="primary"
                        depressed
                        :disabled="!websiteUrl"
                        :loading="checkTrustLoading"
                    >
                        Fill data
                    </VBtn>

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
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Equity</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Equity</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Equity"
                                v-model="moz.equity"
                                :error-messages="mozEquityErrors"
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
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Country Rank</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Country Rank</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Country Rank"
                                v-model="alexa.country_rank"
                                :error-messages="alexaCountryRankErrors"
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

                    <h4 class="mt-4">Facebook</h4>
                    <VDivider />
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Comments</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>FB Comments</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="FB Comments"
                                v-model="fb.fb_comments"
                                :error-messages="fbCommentsErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Reactions</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>FB Reactions</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="FB Reactions"
                                v-model="fb.fb_reac"
                                :error-messages="fbReacErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>Shares</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>FB Shares</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="FB Shares"
                                v-model="fb.fb_shares"
                                :error-messages="fbSharesErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>
                    <VBtn
                        @click="fillMozAlexaSrFb"
                        color="primary"
                        :loading="fillMozAlexaSrFbLoading"
                        :disabled="!websiteUrl"
                    >
                        Fill Fields
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
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>RefD</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Referring Domains (RefD)</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="RFD"
                                v-model="majestic.refd"
                                :error-messages="majesticRefDErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>RefD EDU</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Referring Domains EDU (RefD_EDU)</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="RefD_EDU"
                                v-model="majestic.refd_edu"
                                :error-messages="majesticRefDEduErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label>RefD GOV</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Referring Domains GOV (RefD_GOV)</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="RefD_GOV"
                                v-model="majestic.refd_gov"
                                :error-messages="majesticRefDGovErrors"
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
    required,
    maxLength, email,
    minValue, maxValue,
    url
} from 'vuelidate/lib/validators';
import requestExternalService from '@/services/requestExternalService';
import { ErrorStatus, PropertyNotFound } from '@/services/requestExternalService';

const min_value = function(value) {
    const regex = new RegExp(/[-0-9]+/);
    if (regex.test(value) && Number(value) >= 0) {
        return true;
    } else if(value === 'N/A'){
        return true
    }
    return false;
};

export default {
    name: 'AdminAddPlatformComponent',
    mixins: [validationMixin],
    validations: {
        websiteUrl: { required, url },
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
                required, minValue: min_value
            },
            pa: {
                required, minValue: min_value
            },
            links_in: {
                required, minValue: min_value
            },
            mozrank: {
                required, minValue: min_value
            },
            equity: {
                required, minValue: min_value
            }
        },
        alexa: {
            rank: {
                required, minValue: min_value
            },
            country: {
                required
            },
            country_rank: {
                required, minValue: min_value
            }
        },
        semrush: {
            rank: {
                required, minValue: min_value
            },
            keyword_num: {
                required, minValue: min_value
            },
            traffic_costs: {
                required, minValue: min_value
            },
        },
        fb: {
            fb_comments: { required, minValue: min_value },
            fb_reac: { required, minValue: min_value },
            fb_shares: { required, minValue: min_value },
        },
        majestic: {
            external_backlinks: {
                required, minValue: min_value
            },
            external_gov: {
                required, minValue: min_value
            },
            external_edu: {
                required, minValue: min_value
            },
            tf: {
                required, maxValue: maxValue(100), minValue: min_value
            },
            cf: {
                required, maxValue: maxValue(100), minValue: min_value
            },
            refd: { required, minValue: min_value },
            refd_edu: { required, minValue: min_value },
            refd_gov: { required, minValue: min_value },
        },
        email: { email },
        contacts: { maxLength: maxLength(255) },
        comment: { maxLength: maxLength(255) },
        trust: { required, minValue: min_value },
        spam: { required, minValue: min_value },
        lrtPowerTrust: { required, minValue: min_value }
    },
    data: () => ({
        checkTrustLoading: false,
        fillMozAlexaSrFbLoading: false,
        fillMajesticLoading: false,
        websiteUrl: '',
        organicTraffic: '',
        topics: [],
        price: '',
        description: '',
        articleRequirements: '',
        deadLine: 1,
        wherePosted: '',
        doFollow: false,
        moneyAnchor: false,
        freeHomeFeatured: false,
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
            equity: ''
        },
        alexa: {
            rank: '',
            country: '',
            country_rank: ''
        },
        semrush: {
            rank: '',
            keyword_num: '',
            traffic_costs: '',
        },
        fb: {
            fb_comments: '',
            fb_reac: '',
            fb_shares: ''
        },
        majestic: {
            external_backlinks: '',
            external_gov: '',
            external_edu: '',
            tf: '',
            cf: '',
            refd: '',
            refd_edu: '',
            refd_gov: '',
        },
        trust: '',
        spam: '',
        lrtPowerTrust: ''
    }),
    methods: {
        ...mapActions('platforms', {
            createPlatform: actions.CREATE_PLATFORM,
            fetchTopics: actions.FETCH_TOPICS
        }),
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        onSetWebsite() {
            this.$v.websiteUrl.$touch();
        },
        async onFillBasicData() {
            if (this.websiteUrl && !this.$v.websiteUrl.$invalid) {
                this.checkTrustLoading = true;
                try {
                    let response = await requestExternalService.fetchCheckTrustData(this.websiteUrl);
                    let responseData = response?.data;
                    if (!responseData.success) {
                        this.setNotification({
                            type: 'error',
                            message: responseData.message
                        });
                        this.trust = this.spam = this.lrtPowerTrust = 'N/A';
                        this.checkTrustLoading = false;
                        return;
                    } else {
                        this.trust = responseData?.summary?.trust;
                        this.spam = responseData?.summary?.spam;
                        this.lrtPowerTrust = responseData?.summary?.lrtPowerTrust;
                    }
                    this.checkTrustLoading = false;
                    this.setNotification({
                        type: 'success',
                        message: 'CheckTrust data was set!'
                    });
                } catch (error) {
                    this.checkTrustLoading = false;
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        },
        async fillMajestic() {
            if (this.websiteUrl && !this.$v.websiteUrl.$invalid) {
                try {
                    this.fillMajesticLoading = true;
                    const response = await requestExternalService.fetchSeoRankInfoForDomainMajestic(this.websiteUrl);
                    const responseData = response?.data;
                    if (ErrorStatus.includes(responseData)) {
                        this.setNotification({
                            message: "Status: " + responseData,
                            type: 'error'
                        });
                        this.majestic.external_backlinks = 'N/A';
                        this.majestic.external_gov = 'N/A';
                        this.majestic.external_edu = 'N/A';
                        this.majestic.refd = 'N/A';
                        this.majestic.refd_edu = 'N/A';
                        this.majestic.refd_gov = 'N/A';
                        this.majestic.tf = 'N/A';
                        this.majestic.cf = 'N/A';
                        this.fillMajesticLoading = false;
                        return;
                    }
                    this.majestic.external_backlinks =
                        !PropertyNotFound.includes(responseData.ExtBackLinks) ? responseData.ExtBackLinks : 'N/A';
                    this.majestic.external_gov =
                        !PropertyNotFound.includes(responseData.ExtBackLinksGOV) ? responseData.ExtBackLinksGOV : 'N/A';
                    this.majestic.external_edu =
                        !PropertyNotFound.includes(responseData.ExtBackLinksEDU) ? responseData.ExtBackLinksEDU : 'N/A';
                    this.majestic.refd =
                        !PropertyNotFound.includes(responseData.RefDomains) ? responseData.RefDomains : 'N/A';
                    this.majestic.refd_edu =
                        !PropertyNotFound.includes(responseData.RefDomainsEDU) ? responseData.RefDomainsEDU : 'N/A';
                    this.majestic.refd_gov =
                        !PropertyNotFound.includes(responseData.RefDomainsGOV) ? responseData.RefDomainsGOV : 'N/A';
                    this.majestic.tf =
                        !PropertyNotFound.includes(responseData.TrustFlow) ? responseData.TrustFlow : 'N/A';
                    this.majestic.cf =
                        !PropertyNotFound.includes(responseData.CitationFlow) ? responseData.CitationFlow : 'N/A';
                    this.fillMajesticLoading = false;
                    this.setNotification({
                        type: 'success',
                        message: 'Majestic data was set!'
                    });
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                    this.fillMajesticLoading = false;
                }
            }
        },
        async fillMozAlexaSrFb() {
            if (this.websiteUrl && !this.$v.websiteUrl.$invalid) {
                try {
                    this.fillMozAlexaSrFbLoading = true;
                    const response = await requestExternalService.fetchSeoRankInfoForDomainMozAlexaSr(this.websiteUrl);
                    const responseData = response?.data;
                    if (ErrorStatus.includes(responseData)) {
                        this.setNotification({
                            message: "Status: " + responseData,
                            type: 'error'
                        });
                        Object.keys(this.moz).map(key => {
                            this.moz[key] = 'N/A';
                        });
                        Object.keys(this.alexa).map(key => {
                            this.alexa[key] = 'N/A';
                        });
                        Object.keys(this.semrush).map(key => {
                            this.semrush[key] = 'N/A';
                        });
                        this.organicTraffic = 'N/A';
                        Object.keys(this.fb).map(key => {
                            this.fb[key] = 'N/A';
                        });
                        this.fillMozAlexaSrFbLoading = false;
                        return;
                    }
                    this.moz.pa = !PropertyNotFound.includes(responseData.pa) ? responseData.pa : 'N/A';
                    this.moz.da = !PropertyNotFound.includes(responseData.da) ? responseData.da : 'N/A';
                    this.moz.mozrank = !PropertyNotFound.includes(responseData.mozrank) ? responseData.mozrank : 'N/A';
                    this.moz.links_in = !PropertyNotFound.includes(responseData.links) ? responseData.links : 'N/A';
                    this.moz.equity = !PropertyNotFound.includes(responseData.equity) ? responseData.equity : 'N/A';

                    this.alexa.rank = !PropertyNotFound.includes(responseData.a_rank) ? responseData.a_rank : 'N/A';
                    this.alexa.country = !PropertyNotFound.includes(responseData.a_cnt) ? responseData.a_cnt : 'N/A';
                    this.alexa.country_rank = !PropertyNotFound.includes(responseData.a_cnt_r) ? responseData.a_cnt_r : 'N/A';

                    this.semrush.rank = !PropertyNotFound.includes(responseData.sr_rank) ? responseData.sr_rank : 'N/A';
                    this.semrush.keyword_num = !PropertyNotFound.includes(responseData.sr_kwords) ? responseData.sr_kwords : 'N/A';
                    this.organicTraffic =
                        !PropertyNotFound.includes(responseData.sr_traffic) ? responseData.sr_traffic : 'N/A';
                    this.semrush.traffic_costs =
                        !PropertyNotFound.includes(responseData.sr_costs) ? responseData.sr_costs : 'N/A';

                    this.fb.fb_comments = !PropertyNotFound.includes(responseData.fb_comments) ? responseData.fb_comments : 'N/A';
                    this.fb.fb_reac = !PropertyNotFound.includes(responseData.fb_reac) ? responseData.fb_reac : 'N/A';
                    this.fb.fb_shares = !PropertyNotFound.includes(responseData.fb_shares) ? responseData.fb_shares : 'N/A';
                    this.fillMozAlexaSrFbLoading = false;
                    this.setNotification({
                        type: 'success',
                        message: 'SeoRank data was set!'
                    });
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                    this.fillMozAlexaSrFbLoading = false;
                }
            }
        },
        async onSave() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.createPlatform({
                        website_url: this.websiteUrl,
                        organic_traffic: this.organicTraffic,
                        dofollow_active: this.doFollow,
                        free_home_featured_active: this.freeHomeFeatured,
                        niche_edit_link_active: this.nicheEditLink ,
                        article_writing_price: this.articleWritingPrice ? this.articleWritingPrice : null,
                        niche_edit_link_price: this.nicheEditLinkPrice ? this.nicheEditLinkPrice : null,
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
                        majestic: this.majestic,
                        fb: this.fb,
                        trust: this.trust,
                        spam: this.spam,
                        lrt_power_trust: this.lrtPowerTrust,
                        money_anchor: this.moneyAnchor
                    });
                    this.setNotification({
                        message: 'Website was added!',
                        type: 'success'
                    });
                    this.organicTraffic = '';
                    this.websiteUrl = this.description = this.wherePosted = '';
                    this.topics = [];
                    this.deadLine = 1;
                    this.doFollow = false;
                    this.moneyAnchor = false;
                    this.freeHomeFeatured = false;
                    this.nicheEditLink = false;
                    this.articleWritingPrice =
                        this.price =
                        this.nicheEditLinkPrice =
                        this.articleRequirements = '';
                    this.email = this.contacts = this.comment = '';
                    this.moz.da =
                        this.moz.pa =
                        this.moz.mozrank =
                        this.moz.links_in =
                        this.moz.equity = '';
                    this.alexa.rank =
                        this.alexa.country =
                        this.alexa.country_rank = '';
                    this.semrush.traffic =
                        this.semrush.traffic_costs =
                        this.semrush.rank =
                        this.semrush.keyword_num = '';
                    this.majestic.cf =
                        this.majestic.tf =
                        this.majestic.external_backlinks =
                        this.majestic.external_edu =
                        this.majestic.external_gov =
                        this.majestic.refd =
                        this.majestic.refd_edu =
                        this.majestic.refd_gov = '';
                    this.fb.fb_comments =
                        this.fb.fb_reac =
                        this.fb.fb_shares = '';
                    this.trust = this.spam = this.lrtPowerTrust = '';
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
        organicTrafficErrors() {
            const errors = [];
            if (!this.$v.organicTraffic.$dirty) {
                return errors;
            }
            !this.$v.organicTraffic.required &&
                errors.push('Organic Traffic is required!');
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

        // MOZErrors
        mozDaErrors() {
            const errors = [];
            if (!this.$v.moz.da.$dirty) {
                return errors;
            }
            !this.$v.moz.da.required &&
                errors.push('DA is required!');
            !this.$v.moz.da.minValue &&
                errors.push('DA must be more than 0!');
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
                errors.push('Links In must be more than 0!');
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
                errors.push('Links In must be more than 0!');
            return errors;
        },
        mozEquityErrors() {
            const errors = [];
            if (!this.$v.moz.equity.$dirty) {
                return errors;
            }
            !this.$v.moz.equity.required &&
                errors.push('Equity is required!');
            !this.$v.moz.equity.minValue &&
                errors.push('Equity must be more than 0!');
            return errors;
        },

        // AlexaErrors
        alexaRankErrors() {
            const errors = [];
            if (!this.$v.alexa.rank.$dirty) {
                return errors;
            }
            !this.$v.alexa.rank.required &&
                errors.push('Rank is required!');
            !this.$v.alexa.rank.minValue &&
                errors.push('Rank must be more than 0!');
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
        alexaCountryRankErrors() {
            const errors = [];
            if (!this.$v.alexa.country_rank.$dirty) {
                return errors;
            }
            !this.$v.alexa.country_rank.required &&
                errors.push('Country Rank is required!');
            !this.$v.alexa.country_rank.minValue &&
                errors.push('Country Rank must be more than 0!');
            return errors;
        },

        // SemRushErrors
        semrushRankErrors() {
            const errors = [];
            if (!this.$v.semrush.rank.$dirty) {
                return errors;
            }
            !this.$v.semrush.rank.required &&
                errors.push('Rank is required!');
            !this.$v.semrush.rank.minValue &&
                errors.push('Rank must be more than 0!');
            return errors;
        },
        semrushKeywordNumErrors() {
            const errors = [];
            if (!this.$v.semrush.keyword_num.$dirty) {
                return errors;
            }
            !this.$v.semrush.keyword_num.required &&
                errors.push('Keyword Num is required!');
            !this.$v.semrush.keyword_num.minValue &&
                errors.push('Keyword Num must be more than 0!');
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

        // MajesticErrors
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
        },
        majesticRefDErrors() {
            const errors = [];
            if (!this.$v.majestic.refd.$dirty) {
                return errors;
            }
            !this.$v.majestic.refd.required &&
                errors.push('RefD is required!');
            !this.$v.majestic.refd.minValue &&
                errors.push('RefD must be more than 0!');
            return errors;
        },
        majesticRefDEduErrors() {
            const errors = [];
            if (!this.$v.majestic.refd_edu.$dirty) {
                return errors;
            }
            !this.$v.majestic.refd_edu.required &&
                errors.push('RefD_EDU is required!');
            !this.$v.majestic.refd_edu.minValue &&
                errors.push('RefD_EDU must be more than 0!');
            return errors;
        },
        majesticRefDGovErrors() {
            const errors = [];
            if (!this.$v.majestic.refd_gov.$dirty) {
                return errors;
            }
            !this.$v.majestic.refd_gov.required &&
                errors.push('RefD_GOV is required!');
            !this.$v.majestic.refd_gov.minValue &&
                errors.push('RefD_GOV must be more than 0!');
            return errors;
        },
        fbCommentsErrors() {
            const errors = [];
            if (!this.$v.fb.fb_comments.$dirty) {
                return errors;
            }
            !this.$v.fb.fb_comments.required &&
                errors.push('FB Comments are required!');
            !this.$v.fb.fb_comments.minValue &&
                errors.push('FB Comments must be more than 0!');
            return errors;
        },
        fbReacErrors() {
            const errors = [];
            if (!this.$v.fb.fb_reac.$dirty) {
                return errors;
            }
            !this.$v.fb.fb_reac.required &&
                errors.push('FB Reac are required!');
            !this.$v.fb.fb_reac.minValue &&
                errors.push('FB Reac must be more than 0!');
            return errors;
        },
        fbSharesErrors() {
            const errors = [];
            if (!this.$v.fb.fb_shares.$dirty) {
                return errors;
            }
            !this.$v.fb.fb_shares.required &&
            errors.push('FB Shares are required!');
            !this.$v.fb.fb_shares.minValue &&
            errors.push('FB Shares must be more than 0!');
            return errors;
        },

        trustErrors() {
            const errors = [];
            if (!this.$v.trust.$dirty) {
                return errors;
            }
            !this.$v.trust.required &&
                errors.push('Trust is required!');
            !this.$v.trust.minValue &&
                errors.push('Trust must be more than 0!');
            return errors;
        },
        spamErrors() {
            const errors = [];
            if (!this.$v.spam.$dirty) {
                return errors;
            }
            !this.$v.spam.required &&
            errors.push('Spam is required!');
            !this.$v.spam.minValue &&
            errors.push('Spam must be more than 0!');
            return errors;
        },
        lrtPowerTrustErrors() {
            const errors = [];
            if (!this.$v.lrtPowerTrust.$dirty) {
                return errors;
            }
            !this.$v.lrtPowerTrust.required &&
                errors.push('LRT PowerTrust is required!');
            !this.$v.lrtPowerTrust.minValue &&
                errors.push('LRT PowerTrust must be more than 0!');
            return errors;
        }
    }
}
</script>

<style scoped>

</style>