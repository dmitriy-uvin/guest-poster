<template>
    <div class="container mt-6">
        <VBtn depressed @click="backToPlatforms" color="#eaf3ff" class="my-4">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO PLATFORMS LIST</span>
        </VBtn>
        <h1>Edit Platform <u>{{ platform.websiteUrl | formatDomainFilter }}</u></h1>
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
                                label="Topics"
                                multiple
                                deletable-chips
                                small-chips
                                v-model="topics"
                                :items="Object.keys(allTopics)"
                                :error-messages="topicsErrors"
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
                                @keydown="onSetPriceKeydown"
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
                                @keydown="onSetPriceKeydown"
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
                                    <label>PowerTrust</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip PowerTrust</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="PowerTrust"
                                v-model="powerTrust"
                                :error-messages="powerTrustErrors"
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
                                    <label>Rank</label>
                                    <VIcon
                                        class="ml-1 align-center"
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                    >mdi-information</VIcon>
                                </template>
                                <span>Tooltip Moz Rank</span>
                            </VTooltip>
                            <VTextField
                                outlined
                                placeholder="Rank"
                                v-model="moz.rank"
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
                                v-model="semRush.rank"
                                :error-messages="semRushRankErrors"
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
                                v-model="semRush.keyword_num"
                                :error-messages="semRushKeywordNumErrors"
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
                                v-model="semRush.traffic_costs"
                                :error-messages="semRushTrafficCostsErrors"
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
                                v-model="facebook.comments"
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
                                v-model="facebook.reactions"
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
                                v-model="facebook.shares"
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
                    <VBtn color="green" dark @click="onUpdate">
                        <VIcon left>mdi-plus</VIcon>
                        Update Platform
                    </VBtn>
                </VCol>
            </VCol>
        </VRow>
        <VBtn depressed @click="backToPlatforms" color="#eaf3ff" class="my-3">
            <VIcon left color="#408bef">mdi-chevron-left</VIcon>
            <span style="color: #408bef;">BACK TO PLATFORMS LIST</span>
        </VBtn>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as getters from '@/store/modules/platforms/types/getters';
import { validationMixin } from 'vuelidate';
import notificationMixin from '@/mixins/notificationMixin';

import {
    email, maxLength,
    maxValue, minValue,
    required, requiredIf,
    url
} from "vuelidate/lib/validators";
import requestExternalService, {ErrorStatus, PropertyNotFound} from "@/services/requestExternalService";

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
    name: 'EditPlatform',
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
            rank: {
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
        semRush: {
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
        facebook: {
            comments: { required, minValue: min_value },
            reactions: { required, minValue: min_value },
            shares: { required, minValue: min_value },
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
                required, minValue: min_value
            },
            cf: {
                required, minValue: min_value
            },
            refd: { required, minValue: min_value },
            refd_edu: { required, minValue: min_value },
            refd_gov: { required, minValue: min_value },
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
        },
        trust: { required, minValue: min_value },
        spam: { required, minValue: min_value },
        powerTrust: { required, minValue: min_value }
    },
    mixins: [validationMixin, notificationMixin],
    data: () => ({
        platformId: '',
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
            rank: '',
            equity: ''
        },
        alexa: {
            rank: '',
            country: '',
            country_rank: ''
        },
        semRush: {
            rank: '',
            keyword_num: '',
            traffic_costs: '',
        },
        facebook: {
            comments: '',
            reactions: '',
            shares: ''
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
        powerTrust: ''
    }),
    methods: {
        ...mapActions('platforms', {
            fetchPlatformById: actions.FETCH_PLATFORM_BY_ID,
            fetchTopics: actions.FETCH_TOPICS,
            updatePlatformById: actions.UPDATE_PLATFORM_BY_ID
        }),
        backToPlatforms() {
            this.$router.push({ path: '/' });
        },
        async fillMajestic() {
            this.$v.websiteUrl.$touch();
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
                    this.fillMajesticLoading = false;
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        },
        async onUpdate() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.updatePlatformById({
                        id: this.platformId,
                        data: {
                            website_url: this.websiteUrl,
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
                            semrush: this.semRush,
                            majestic: this.majestic,
                            facebook: this.facebook,
                            trust: this.trust,
                            spam: this.spam,
                            power_trust: this.powerTrust,
                            money_anchor: this.moneyAnchor
                        }
                    });
                    this.setNotification({
                        type: 'success',
                        message: 'Platform was updated!'
                    });
                } catch (error) {
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        },
        async fillMozAlexaSrFb() {
            this.$v.websiteUrl.$touch();
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
                    this.fillMozAlexaSrFbLoading = false;
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        },
        async onFillBasicData() {
            this.$v.websiteUrl.$touch();
            if (this.websiteUrl && !this.$v.websiteUrl.$invalid) {
                try {
                    this.checkTrustLoading = true;
                    let response = await requestExternalService.fetchCheckTrustData(this.websiteUrl);
                    let responseData = response?.data;
                    if (!responseData.success) {
                        this.setNotification({
                            type: 'error',
                            message: responseData.message + ' Try a little bit later!'
                        });
                        this.trust = this.spam = this.powerTrust = 'N/A';
                        this.checkTrustLoading = false;
                        return;
                    } else {
                        this.trust = responseData?.summary?.trust;
                        this.spam = responseData?.summary?.spam;
                        this.powerTrust = responseData?.summary?.lrtPowerTrust;
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
        onSetWebsite() {
            this.$v.websiteUrl.$touch();
        },
        onWebsiteUrlKeydown(e) {
            if (/[^0-9a-zA-Z:.\\/_-]/.test(e.key)) {
                e.preventDefault();
            }
        },
        onSetPriceKeydown(e) {
            if (/[^0-9.]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete') {
                e.preventDefault();
            }
        }
    },
    async mounted() {
        this.platformId = this.$route.params.id;
        await this.fetchPlatformById(this.platformId);
        await this.fetchTopics();
        this.websiteUrl = this.platform.protocol + this.platform.websiteUrl;
        this.description = this.platform.description;
        this.articleRequirements = this.platform.articleRequirements;
        this.wherePosted = this.platform.wherePosted;
        this.deadLine = this.platform.deadLine;
        this.doFollow = this.platform.doFollowActive;
        this.moneyAnchor = this.platform.moneyAnchor;
        this.freeHomeFeatured = this.platform.freeHomeFeaturedActive;
        this.nicheEditLink = this.platform.nicheEditLinkActive;
        this.price = this.platform.price;
        this.articleWritingPrice = this.platform.articleWritingPrice;
        this.nicheEditLinkPrice = this.platform.nicheEditLinkPrice;
        this.nicheEditLinkDifference =
            this.nicheEditLinkPrice !== null ? (this.platform.nicheEditLinkPrice - this.platform.price).toFixed(2) : null;
        this.topics = this.platform.topics.map(topic => topic.name);

        this.trust = this.platform.checktrust === null ? 'N/A' : this.platform.checktrust;
        this.spam = this.platform.spam === null ? 'N/A' : this.platform.spam;
        this.powerTrust = this.platform.powertrust === null ? 'N/A' : this.platform.powertrust;

        this.moz.da = this.platform.moz.da === null ? 'N/A' : this.platform.moz.da;
        this.moz.pa = this.platform.moz.pa === null ? 'N/A' : this.platform.moz.pa;
        this.moz.links_in = this.platform.moz.links_in === null ? 'N/A' : this.platform.moz.links_in;
        this.moz.rank = this.platform.moz.rank === null ? 'N/A' : this.platform.moz.rank;
        this.moz.equity = this.platform.moz.equity === null ? 'N/A' : this.platform.moz.equity;

        this.alexa.rank = this.platform.alexa.rank === null ? 'N/A' : this.platform.alexa.rank;
        this.alexa.country = this.platform.alexa.country === null ? 'N/A' : this.platform.alexa.country;
        this.alexa.country_rank = this.platform.alexa.country_rank === null ? 'N/A' : this.platform.alexa.country_rank;

        this.semRush.rank = this.platform.semRush.rank === null ? 'N/A' : this.platform.semRush.rank;
        this.semRush.keyword_num = this.platform.semRush.keyword_num === null ? 'N/A' : this.platform.semRush.keyword_num;
        this.organicTraffic = this.platform.organicTraffic === null ? 'N/A' : this.platform.organicTraffic;
        this.semRush.traffic_costs = this.platform.semRush.trafficCosts === null ? 'N/A' : this.platform.semRush.trafficCosts;

        this.facebook.comments = this.platform.facebook.comments === null ? 'N/A' : this.platform.facebook.comments;
        this.facebook.reactions = this.platform.facebook.reactions === null ? 'N/A' : this.platform.facebook.reactions;
        this.facebook.shares = this.platform.facebook.shares === null ? 'N/A' : this.platform.facebook.shares;

        this.majestic.external_backlinks = this.platform.majestic.external_backlinks === null ? 'N/A' : this.platform.majestic.external_backlinks;
        this.majestic.external_edu = this.platform.majestic.external_edu === null ? 'N/A' : this.platform.majestic.external_edu;
        this.majestic.external_gov = this.platform.majestic.external_gov === null ? 'N/A' : this.platform.majestic.external_gov;
        this.majestic.refd = this.platform.majestic.refd === null ? 'N/A' : this.platform.majestic.refd;
        this.majestic.refd_edu = this.platform.majestic.refd_edu === null ? 'N/A' : this.platform.majestic.refd_edu;
        this.majestic.refd_gov = this.platform.majestic.refd_gov === null ? 'N/A' : this.platform.majestic.refd_gov;
        this.majestic.tf = this.platform.majestic.tf === null ? 'N/A' : this.platform.majestic.tf;
        this.majestic.cf = this.platform.majestic.cf === null ? 'N/A' : this.platform.majestic.cf;

        this.email = this.platform.email;
        this.comment = this.platform.comment;
        this.contacts = this.platform.contacts;
    },
    computed: {
        ...mapGetters('platforms', {
            platform: getters.GET_PLATFORM_BY_ID
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
            if (!this.$v.moz.rank.$dirty) {
                return errors;
            }
            !this.$v.moz.rank.required &&
            errors.push('MozRank is required!');
            !this.$v.moz.rank.minValue &&
            errors.push('MozRank must be more than 0!');
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
        semRushRankErrors() {
            const errors = [];
            if (!this.$v.semRush.rank.$dirty) {
                return errors;
            }
            !this.$v.semRush.rank.required &&
            errors.push('Rank is required!');
            !this.$v.semRush.rank.minValue &&
            errors.push('Rank must be more than 0!');
            return errors;
        },
        semRushKeywordNumErrors() {
            const errors = [];
            if (!this.$v.semRush.keyword_num.$dirty) {
                return errors;
            }
            !this.$v.semRush.keyword_num.required &&
            errors.push('Keyword Num is required!');
            !this.$v.semRush.keyword_num.minValue &&
            errors.push('Keyword Num must be more than 0!');
            return errors;
        },
        semRushTrafficCostsErrors() {
            const errors = [];
            if (!this.$v.semRush.traffic_costs.$dirty) {
                return errors;
            }
            !this.$v.semRush.traffic_costs.required &&
            errors.push('Traffic Costs is required!');
            !this.$v.semRush.traffic_costs.minValue &&
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

        // Facebook
        fbCommentsErrors() {
            const errors = [];
            if (!this.$v.facebook.comments.$dirty) {
                return errors;
            }
            !this.$v.facebook.comments.required &&
            errors.push('FB Comments are required!');
            !this.$v.facebook.comments.minValue &&
            errors.push('FB Comments must be more than 0!');
            return errors;
        },
        fbReacErrors() {
            const errors = [];
            if (!this.$v.facebook.reactions.$dirty) {
                return errors;
            }
            !this.$v.facebook.reactions.required &&
            errors.push('FB Reactions are required!');
            !this.$v.facebook.reactions.minValue &&
            errors.push('FB Reactions must be more than 0!');
            return errors;
        },
        fbSharesErrors() {
            const errors = [];
            if (!this.$v.facebook.shares.$dirty) {
                return errors;
            }
            !this.$v.facebook.shares.required &&
            errors.push('FB Shares are required!');
            !this.$v.facebook.shares.minValue &&
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
        powerTrustErrors() {
            const errors = [];
            if (!this.$v.powerTrust.$dirty) {
                return errors;
            }
            !this.$v.powerTrust.required &&
                errors.push('PowerTrust is required!');
            !this.$v.powerTrust.minValue &&
                errors.push('PowerTrust must be more than 0!');
            return errors;
        },
        ...mapGetters('platforms', {
            allTopics: getters.GET_TOPICS
        }),
    },
    watch: {
        websiteUrl(newValue) {
            this.websiteUrl = newValue.replace(/[^0-9a-zA-Z:.\\/_-]/, '');
        },
        price(newPrice) {
            if (this.platform.articleWritingPrice === null) {
                if (Number(this.price) * 0.2 < 30) {
                    this.articleWritingPrice = Number(this.price) + 30;
                } else {
                    this.articleWritingPrice = Number(this.price) * 1.2;
                }
                if (newPrice === '') this.articleWritingPrice = '';
            }

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
}
</script>

<style scoped>

</style>