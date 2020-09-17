<template>
    <div class="container mt-6">
        <h1>Add new Platform</h1>
        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        <VDivider></VDivider>
        <VRow>
            <VCol cols="12" md="9">
                <div class="mt-6">
                    <h2>General Information</h2>
                    <VRow>
                        <VCol cols="12" md="5">
                            <VTextField
                                outlined
                                label="Website URL"
                                prepend-inner-icon="mdi-earth"
                                v-model="websiteUrl"
                                :error-messages="websiteUrlErrors"
                            ></VTextField>
                        </VCol>
                        <VCol cols="12" md="4">
                            <v-combobox
                                outlined
                                :items="topics"
                                label="Topics"
                                multiple
                                chips
                                :error-messages="topicsErrors"
                                v-model="topics"
                            ></v-combobox>
                        </VCol>
                        <VCol cols="12" md="3">
                            <VTextField
                                outlined
                                label="Price"
                                prepend-inner-icon="mdi-currency-usd"
                                v-model="price"
                                :error-messages="priceErrors"
                            ></VTextField>
                        </VCol>
                    </VRow>

                    <VSpacer></VSpacer>

                    <h2>Features</h2>
                    <VRow>
                        <VCol cols="12" md="3">
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
                        <VCol cols="12" md="3">
                            <div class="d-flex justify-space-between">
                                <span class="d-flex align-center">Niche Edit Link</span>
                                <VSwitch inset v-model="nicheEditLink"></VSwitch>
                            </div>
                        </VCol>
                    </VRow>

                    <h2>Feature Prices</h2>
                    <VRow>
                        <VCol cols="12" md="3">
                            <VTextField
                                outlined
                                label="Article Writing Price"
                                append-icon="mdi-currency-usd"
                                v-model="articleWritingPrice"
                            >
                            </VTextField>
                        </VCol>
                        <VCol cols="12" md="3">
                            <VTextField
                                outlined
                                label="Niche Edit Link Price"
                                append-icon="mdi-currency-usd"
                                :disabled="!nicheEditLink"
                                v-model="nicheEditLinkPrice"
                            >
                            </VTextField>
                        </VCol>
                    </VRow>

                    <VSpacer></VSpacer>

                    <h2>Technical characteristics</h2>
                    <VRow>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label
                                        v-bind="attrs"
                                        v-on="on"
                                    >A. DR</label>
                                    <VTextField
                                        outlined
                                        v-model="dr"
                                        :error-messages="drErrors"
                                    ></VTextField>
                                </template>
                                <span>Tooltip</span>
                            </VTooltip>
                        </VCol>
                        <VCol cols="12" md="2">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label
                                        v-bind="attrs"
                                        v-on="on"
                                    >D. MA</label>
                                    <VTextField
                                        outlined
                                        v-model="ma"
                                        :error-messages="maErrors"
                                    ></VTextField>
                                </template>
                                <span>Tooltip</span>
                            </VTooltip>
                        </VCol>
                        <VCol cols="12" md="3">
                            <VTooltip right>
                                <template v-slot:activator="{ on, attrs }">
                                    <label
                                        v-bind="attrs"
                                        v-on="on"
                                    >Organic Traffic</label>
                                    <VTextField
                                        outlined
                                        v-model="organicTraffic"
                                        :error-messages="organicTrafficErrors"
                                    ></VTextField>
                                </template>
                                <span>Tooltip</span>
                            </VTooltip>
                        </VCol>
                    </VRow>

                    <VSpacer></VSpacer>

                    <h2>Contacts</h2>
                    <VRow>
                        <VCol cols="12" md="6">
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
                                v-model="contacts"
                                :error-messages="contactsErrors"
                            ></VTextarea>
                        </VCol>
                        <VCol cols="12" md="6">
                            <VTextarea
                                outlined
                                label="Comment"
                                no-resize
                                v-model="comment"
                                :error-messages="commentErrors"
                            ></VTextarea>
                        </VCol>
                    </VRow>
                </div>
            </VCol>
            <VCol cols="12" md="3" class="text-center">
                <VBtn color="primary" outlined>
                    Fill Characteristics
                </VBtn>
                <br />
                <br />
                <VBtn color="green" @click="onSave">
                    <VIcon left>mdi-plus</VIcon>
                    Add Platform
                </VBtn>
            </VCol>
        </VRow>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import * as notifyActions from '@/store/modules/notification/types/actions';
import { validationMixin } from 'vuelidate';
import { required, minLength, email, minValue } from 'vuelidate/lib/validators';
export default {
    name: 'AdminAddPlatformComponent',
    mixins: [validationMixin],
    validations: {
        websiteUrl: { required, minLength: minLength(5) },
        topics: { required },
        price: { minValue: minValue(0), required },
        dr: { required },
        ma: { required },
        organicTraffic: { required },
        email: { required, email },
        contacts: { required },
        comment: { required }
    },
    data: () => ({
        websiteUrl: '',
        topics: [],
        price: 0,
        doFollow: false,
        freeHomeFeatured: true,
        nicheEditLink: false,
        articleWritingPrice: 0,
        nicheEditLinkPrice: 0,
        dr: 0,
        ma: 0,
        organicTraffic: 0,
        email: '',
        contacts: '',
        comment: ''
    }),
    methods: {
        ...mapActions('platforms', {
            createPlatform: actions.CREATE_PLATFORM
        }),
        ...mapActions('notification', {
            setNotification: notifyActions.SET_NOTIFICATION
        }),
        async onSave() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.createPlatform({
                        website_url: this.websiteUrl,
                        dr: this.dr,
                        ma: this.ma,
                        organic_traffic: this.organicTraffic,
                        do_follow_active: this.doFollow,
                        free_home_featured_active: this.freeHomeFeatured,
                        niche_edit_link_active: this.nicheEditLink,
                        article_writing_price: this.articleWritingPrice,
                        niche_edit_link_price: this.nicheEditLinkPrice,
                        contacts: this.contacts,
                        price: this.price,
                        email: this.email,
                        comment: this.comment,
                        topics: this.topics
                    });
                    this.setNotification({
                        message: 'Website was added!',
                        type: 'success'
                    });
                    this.websiteUrl = '';
                    this.topics = [];
                    this.price = 0;
                    this.doFollow = false;
                    this.freeHomeFeatured = true;
                    this.nicheEditLink = false;
                    this.articleWritingPrice = 0;
                    this.nicheEditLinkPrice = 0;
                    this.dr = 0;
                    this.ma = 0;
                    this.organicTraffic = 0;
                    this.email = '';
                    this.contacts = '';
                    this.comment = '';
                    this.$v.$reset();
                } catch (error) {
                    this.setNotification({
                        message: error,
                        type: 'error'
                    });
                }
            }
        }
    },
    computed: {
        websiteUrlErrors() {
            const errors = [];
            if (!this.$v.websiteUrl.$dirty) {
                return errors;
            }
            !this.$v.websiteUrl.required &&
                errors.push('Website URL is required!');
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
        drErrors() {
            const errors = [];
            if (!this.$v.dr.$dirty) {
                return errors;
            }
            !this.$v.dr.required &&
                errors.push('DR is required!');
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
        organicTrafficErrors() {
            const errors = [];
            if (!this.$v.organicTraffic.$dirty) {
                return errors;
            }
            !this.$v.organicTraffic.required &&
                errors.push('Organic Traffic is required!');
            return errors;
        },
        contactsErrors() {
            const errors = [];
            if (!this.$v.contacts.$dirty) {
                return errors;
            }
            !this.$v.contacts.required &&
                errors.push('Contacts is required!');
            return errors;
        },
        commentErrors() {
            const errors = [];
            if (!this.$v.comment.$dirty) {
                return errors;
            }
            !this.$v.comment.required &&
                errors.push('Comment is required!');
            return errors;
        }
    }
}
</script>

<style scoped>

</style>