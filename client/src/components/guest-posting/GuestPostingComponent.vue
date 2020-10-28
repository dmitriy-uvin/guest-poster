<template>
    <div class="container">
        <div class="">
            <div class="left">
                <h1>Guest Posting</h1>
                <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <div class="mb-8">
            <div class="d-inline-block">
                <VBtn color="primary" depressed @click="openFilters" v-if="!filtersOpened">
                    <VIcon left>mdi-filter-variant</VIcon>
                    Filters
                </VBtn>
                <VBtn color="#eaf3ff" depressed @click="openFilters" v-else>
                    <VIcon left color="#2f80ed">mdi-filter-variant</VIcon>
                    <span style="color: #2f80ed">Hide Filters</span>
                </VBtn>
            </div>
            <UserFiltersBlock />
        </div>
        <VCol cols="12" md="12" class="filters mb-4" v-if="filtersOpened">
            <VRow class="pr-2">
                <VCol cols="12" md="9" class="px-4">
                    <h3 class="text-uppercase mt-4 mb-4">General Filters</h3>
                    <VRow>
                        <VCol cols="12" md="8" class="">
                            <label>Topics</label>
                            <VSelect
                                multiple
                                small-chips
                                dense
                                outlined
                                placeholder="Topics"
                                hide-details
                                deletable-chips
                                :items="Object.keys(topics)"
                                clearable
                                v-model="filter.platform.topics"
                                @change="onInputFilter(
                                    $event,
                                    'general',
                                    'Topics',
                                    'platform.topics'
                                )"
                            >
                            </VSelect>
                        </VCol>
                        <VCol cols="12" md="4">
                            <label>
                                Publishing deadline
                                <CustomTooltip
                                    message="Publishing Deadline"
                                    icon="mdi-information-outline"
                                />
                            </label>
                            <VSelect
                                small-chips
                                hide-details
                                :items="Object.keys(deadlineList)"
                                v-model="filter.platform.deadline"
                                outlined
                                dense
                                clearable
                                placeholder="Any deadline"
                                @change="onInputFilter(
                                        $event,
                                        'general',
                                        'Deadline',
                                        'platform.deadline'
                                        )"
                            >
                            </VSelect>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="8" class="">
                            <label>
                                Domains
                                <CustomTooltip
                                    message="Domain Zone"
                                    icon="mdi-information-outline"
                                />
                            </label>
                            <VSelect
                                hide-details
                                multiple
                                small-chips
                                deletable-chips
                                :items="domainZonesList"
                                v-model="filter.platform.domainZones"
                                outlined
                                dense
                                clearable
                                placeholder="Domains"
                                @change="onInputFilter(
                                    $event,
                                    'general',
                                    'Domains',
                                    'platform.domainZones'
                                )"
                            >
                            </VSelect>
                        </VCol>
                        <VCol cols="12" md="4">
                            <label>
                                Country
                            </label>
                            <VSelect
                                outlined dense
                                small-chips
                                multiple
                                deletable-chips
                                clearable
                                :items="Object.keys(countries)"
                                placeholder="Any Country"
                                v-model="filter.alexa.country"
                                @change="onInputFilter(
                                    $event,
                                    'general',
                                    'Country',
                                    'alexa.country'
                                )"
                            ></VSelect>
                        </VCol>
                    </VRow>
                    <VRow>
                        <VCol cols="12" md="4">
                            <span class="subtitle-2">Price $</span>
                            <VRow>
                                <VCol cols="12" md="6">
                                    <VTextField
                                        placeholder="0"
                                        outlined
                                        dense
                                        v-model="filter.platform.price_from"
                                        :error-messages="priceFromErrors"
                                        @input="onInputFilter(
                                        $event,
                                        'general',
                                        'Price',
                                        'platform.price',
                                        'from'
                                        )"
                                    >
                                    </VTextField>
                                </VCol>
                                <VCol cols="12" md="6">
                                    <VTextField
                                        placeholder="1000000"
                                        outlined
                                        dense
                                        v-model="filter.platform.price_to"
                                        @input="onInputFilter(
                                        $event,
                                        'general',
                                        'Price',
                                        'platform.price',
                                        'to'
                                        )"
                                    >
                                    </VTextField>
                                </VCol>
                            </VRow>
                        </VCol>
                        <VCol cols="12" md="4">
                            <span class="subtitle-2">
                                Organic Traffic
                                <CustomTooltip
                                    message="Organic Traffic"
                                    icon="mdi-information-outline"
                                />
                            </span>
                            <VRow>
                                <VCol cols="12" md="6">
                                    <VTextField
                                        placeholder="0"
                                        outlined
                                        dense
                                        :hide-details="!organicTrafficFromErrors.length"
                                        v-model="filter.platform.organic_traffic_from"
                                        :error-messages="organicTrafficFromErrors"
                                        @input="onInputFilter(
                                        $event,
                                        'general',
                                        'Organic Traffic',
                                        'platform.organic_traffic',
                                        'from'
                                        )"
                                    >
                                    </VTextField>
                                </VCol>
                                <VCol cols="12" md="6">
                                    <VTextField
                                        placeholder="10000000"
                                        outlined
                                        dense
                                        hide-details
                                        v-model="filter.platform.organic_traffic_to"
                                        @input="onInputFilter(
                                        $event,
                                        'general',
                                        'Organic Traffic',
                                        'platform.organic_traffic',
                                        'to'
                                        )"
                                    >
                                    </VTextField>
                                </VCol>
                            </VRow>
                        </VCol>
                    </VRow>

                    <h3 class="text-uppercase mb-6">Options</h3>
                    <VRow>
                        <VCol cols="12" md="4">
                            <label>DoFollow</label>
                            <VRadioGroup
                                row
                                class="mt-3"
                                v-model="filter.platform.dofollow"
                                @change="onInputFilter(
                                        $event,
                                        'general',
                                        'Dofollow',
                                        'platform.dofollow'
                                        )"
                            >
                                <VRadio label="Any" value="any"></VRadio>
                                <VRadio label="Yes" color="green" value="yes"></VRadio>
                                <VRadio label="No" color="red" value="no"></VRadio>
                            </VRadioGroup>
                        </VCol>
                        <VCol cols="12" md="4">
                            <label>Niche Edit Link</label>
                            <VRadioGroup
                                row
                                class="mt-3"
                                v-model="filter.platform.niche_edit_link"
                                @change="onInputFilter(
                                        $event,
                                        'general',
                                        'Niche Edit Link',
                                        'platform.niche_edit_link'
                                        )"
                            >
                                <VRadio label="Any" value="any"></VRadio>
                                <VRadio label="Yes" color="green" value="yes"></VRadio>
                                <VRadio label="No" color="red" value="no"></VRadio>
                            </VRadioGroup>
                        </VCol>
                        <VCol cols="12" md="4">
                            <label>Home Featured</label>
                            <VRadioGroup
                                row
                                class="mt-3"
                                v-model="filter.platform.home_featured"
                                @change="onInputFilter(
                                        $event,
                                        'general',
                                        'Home Featured',
                                        'platform.home_featured'
                                        )"
                            >
                                <VRadio label="Any" value="any"></VRadio>
                                <VRadio label="Yes" color="green" value="yes"></VRadio>
                                <VRadio label="No" color="red" value="no"></VRadio>
                            </VRadioGroup>
                        </VCol>
                        <VCol cols="12" md="4">
                            <label>Money Anchor</label>
                            <VRadioGroup
                                row
                                class="mt-3"
                                v-model="filter.platform.money_anchor"
                                @change="onInputFilter(
                                        $event,
                                        'general',
                                        'Money Anchor',
                                        'platform.money_anchor'
                                        )"
                            >
                                <VRadio label="Any" value="any"></VRadio>
                                <VRadio label="Yes" color="green" value="yes"></VRadio>
                                <VRadio label="No" color="red" value="no"></VRadio>
                            </VRadioGroup>
                        </VCol>
                    </VRow>

                    <VBtn
                        color="#eaf3ff"
                        depressed
                        @click="openAdditionalFilters"
                        v-if="additionalFiltersOpened"
                    >
                        <VIcon left color="#2f80ed">mdi-chevron-up</VIcon>
                        <span style="color: #2f80ed">Hide</span>
                    </VBtn>
                    <VBtn
                        color="#eaf3ff"
                        depressed
                        @click="openAdditionalFilters"
                        v-else
                    >
                        <VIcon left color="#2f80ed">mdi-chevron-down</VIcon>
                        <span style="color: #2f80ed">Additional Filters</span>
                    </VBtn>
                    <VRow v-if="additionalFiltersOpened" class="mt-4">
                        <VTabs fixed-tabs v-model="tab">
                            <VTab key="Trust">
                                <VBadge
                                    color="green"
                                    :content="trustFilterCounter"
                                    v-if="trustFilterCounter"
                                >
                                    Trust
                                </VBadge>
                                <span v-else>Trust</span>
                            </VTab>
                            <VTab key="Moz">
                                <VBadge
                                    color="green"
                                    :content="mozFilterCounter"
                                    v-if="mozFilterCounter"
                                >
                                    Moz
                                </VBadge>
                                <span v-else>Moz</span>
                            </VTab>
                            <VTab key="Alexa">
                                <VBadge
                                    color="green"
                                    :content="alexaFilterCounter"
                                    v-if="alexaFilterCounter"
                                >
                                    Alexa
                                </VBadge>
                                <span v-else>Alexa</span>
                            </VTab>
                            <VTab key="Ahrefs">
                                <VBadge
                                    color="green"
                                    :content="ahrefsFilterCounter"
                                    v-if="ahrefsFilterCounter"
                                >
                                    Ahrefs
                                </VBadge>
                                <span v-else>Ahrefs</span>
                            </VTab>
                            <VTab key="Majestic">
                                <VBadge
                                    color="green"
                                    :content="majesticFilterCounter"
                                    v-if="majesticFilterCounter"
                                >
                                    Majestic
                                </VBadge>
                                <span v-else>Majestic</span>
                            </VTab>
                            <VTab key="SemRush">
                                <VBadge
                                    color="green"
                                    :content="semRushFilterCounter"
                                    v-if="semRushFilterCounter"
                                >
                                    SemRush
                                </VBadge>
                                <span v-else>SemRush</span>
                            </VTab>
                            <VTab key="Facebook">
                                <VBadge
                                    color="green"
                                    :content="facebookFilterCounter"
                                    v-if="facebookFilterCounter"
                                >
                                    Facebook
                                </VBadge>
                                <span v-else>Facebook</span>
                            </VTab>
                        </VTabs>
                        <VTabsItems v-model="tab" >
                            <VTabItem key="Trust">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Summary
                                            <CustomTooltip
                                                message="Summary"
                                            />
                                            <VRow class="mb-0">
                                                <VCol cols="12" class="mb-0">
                                                    <VSelect
                                                        outlined
                                                        dense
                                                        hide-details
                                                        small-chips
                                                        multiple
                                                        deletable-chips
                                                        clearable
                                                        :items="Object.keys(trustSummaryList)"
                                                        placeholder="Any"
                                                        v-model="filter.trust.summary"
                                                    ></VSelect>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            CheckTrust
                                            <CustomTooltip
                                                message="CheckTrust"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustCheckTrustFromErrors.length"
                                                        v-model="filter.trust.checktrust_from"
                                                        :error-messages="trustCheckTrustFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'CheckTrust',
                                                        'trust.checktrust',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustCheckTrustToErrors.length"
                                                        v-model="filter.trust.checktrust_to"
                                                        :error-messages="trustCheckTrustToErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'CheckTrust',
                                                        'trust.checktrust',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Spam
                                            <CustomTooltip
                                                message="Spam"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustSpamFromErrors.length"
                                                        v-model="filter.trust.spam_from"
                                                        :error-messages="trustSpamFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Spam',
                                                        'trust.spam',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustSpamToErrors.length"
                                                        v-model="filter.trust.spam_to"
                                                        :error-messages="trustSpamToErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Spam',
                                                        'trust.spam',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            PowerTrust
                                            <CustomTooltip
                                                message="PowerTrust"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustPowerTrustFromErrors.length"
                                                        v-model="filter.trust.powertrust_from"
                                                        :error-messages="trustPowerTrustFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'PowerTrust',
                                                        'trust.powertrust',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100"
                                                        outlined
                                                        dense
                                                        :hide-details="!trustPowerTrustToErrors.length"
                                                        v-model="filter.trust.powertrust_to"
                                                        :error-messages="trustPowerTrustToErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'PowerTrust',
                                                        'trust.powertrust',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="Moz">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Domain Authority
                                            <CustomTooltip
                                                message="Domain Authority (DA)"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.da_from"
                                                        :hide-details="!mozDaFromErrors.length"
                                                        v-model="filter.moz.da_from"
                                                        :error-messages="mozDaFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz DA',
                                                        'moz.da',
                                                        'from',
                                                        'DA',
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.moz.da_to"
                                                        v-model="filter.moz.da_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz DA',
                                                        'moz.da',
                                                        'to',
                                                        'Moz.DA',
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Page Authority
                                            <CustomTooltip
                                                message="Page Authority (PA)"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.pa_from"
                                                        v-model="filter.moz.pa_from"
                                                        :error-messages="mozPaFromErrors"
                                                        :hide-details="!mozPaFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz PA',
                                                        'moz.pa',
                                                        'from',
                                                        'PA',
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.moz.pa_to"
                                                        v-model="filter.moz.pa_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz PA',
                                                        'moz.pa',
                                                        'to',
                                                        'Moz.PA',
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Moz Rank
                                            <CustomTooltip
                                                message="Moz Rank"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.rank_from"
                                                        v-model="filter.moz.rank_from"
                                                        :error-messages="mozRankFromErrors"
                                                        :hide-details="!mozRankFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Rank',
                                                        'moz.rank',
                                                        'from',
                                                        'Moz.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.moz.rank_to"
                                                        v-model="filter.moz.rank_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Rank',
                                                        'moz.rank',
                                                        'to',
                                                        'Moz.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Links In
                                            <CustomTooltip
                                                message="Links In"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.links_in_from"
                                                        v-model="filter.moz.links_in_from"
                                                        :error-messages="mozLinksInFromErrors"
                                                        :hide-details="!mozLinksInFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Links In',
                                                        'moz.links_in',
                                                        'from',
                                                        'LinksIn'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.links_in_to"
                                                        v-model="filter.moz.links_in_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Links In',
                                                        'moz.links_in',
                                                        'to',
                                                        'LinksIn'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ext. Equity Links
                                            <CustomTooltip
                                                message="External Equity Links"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.equity_from"
                                                        v-model="filter.moz.equity_from"
                                                        :error-messages="mozEquityFromErrors"
                                                        :hide-details="!mozEquityFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Equity',
                                                        'moz.equity',
                                                        'from',
                                                        'Equity'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.moz.equity_to"
                                                        v-model="filter.moz.equity_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Moz Equity',
                                                        'moz.equity',
                                                        'to',
                                                         'Equity'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="Alexa">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Rank
                                            <CustomTooltip
                                                message="Rank"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.alexa.rank_from"
                                                        v-model="filter.alexa.rank_from"
                                                        :error-messages="alexaRankFromErrors"
                                                        :hide-details="!alexaRankFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Alexa Rank',
                                                        'alexa.rank',
                                                        'from',
                                                        'Al.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.alexa.rank_to"
                                                        v-model="filter.alexa.rank_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Alexa Rank',
                                                        'alexa.rank',
                                                        'to',
                                                        'Al.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Country Rank
                                            <CustomTooltip
                                                message="Country Rank"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.alexa.country_rank_from"
                                                        v-model="filter.alexa.country_rank_from"
                                                        :error-messages="alexaCountryRankFromErrors"
                                                        :hide-details="!alexaCountryRankFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Alexa CountryRank',
                                                        'alexa.country_rank',
                                                        'from',
                                                        'Cnt.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.alexa.country_rank_to"
                                                        v-model="filter.alexa.country_rank_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Alexa CountryRank',
                                                        'alexa.country_rank',
                                                        'to',
                                                        'Cnt.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="Ahrefs">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Rank
                                            <CustomTooltip
                                                message="Rank"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.rank_from"
                                                        :hide-details="!ahrefsRankFromErrors.length"
                                                        v-model="filter.ahrefs.rank_from"
                                                        :error-messages="ahrefsRankFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Rank',
                                                        'ahrefs.rank',
                                                        'from',
                                                        'Ahr.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.ahrefs.rank_to"
                                                        v-model="filter.ahrefs.rank_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Rank',
                                                        'ahrefs.rank',
                                                        'to',
                                                        'Ahr.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Domain Rating
                                            <CustomTooltip
                                                message="Domain Rating"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!ahrefsDomainRatingFromErrors.length"
                                                        v-model="filter.ahrefs.dr_from"
                                                        :error-messages="ahrefsDomainRatingFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs DR',
                                                        'ahrefs.dr',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        v-model="filter.ahrefs.dr_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs DR',
                                                        'ahrefs.dr',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            External Backlinks
                                            <CustomTooltip
                                                message="External Backlinks"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.ext_backlinks_from"
                                                        v-model="filter.ahrefs.ext_backlinks_from"
                                                        :error-messages="ahrefsExtBacklinksFromErrors"
                                                        :hide-details="!ahrefsExtBacklinksFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Ext. Backlinks',
                                                        'ahrefs.ext_backlinks',
                                                        'from',
                                                        'Ahr.Ext'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1000000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.ext_backlinks_to"
                                                        v-model="filter.ahrefs.ext_backlinks_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Ext. Backlinks',
                                                        'ahrefs.ext_backlinks',
                                                        'to',
                                                        'Ahr.Ext'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Referring Domains
                                            <CustomTooltip
                                                message="Referring Domains"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.refd_from"
                                                        :hide-details="!ahrefsRefDFromErrors.length"
                                                        v-model="filter.ahrefs.refd_from"
                                                        :error-messages="ahrefsRefDFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Ref. Domains',
                                                        'ahrefs.refd',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.ahrefs.refd_to"
                                                        v-model="filter.ahrefs.refd_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Ref. Domains',
                                                        'ahrefs.refd',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Dofollow Backlinks
                                            <CustomTooltip
                                                message="Dofollow Backlinks"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.dofollow_from"
                                                        v-model="filter.ahrefs.dofollow_from"
                                                        :error-messages="ahrefsDofollowFromErrors"
                                                        :hide-details="!ahrefsDofollowFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Dofollow',
                                                        'ahrefs.dofollow',
                                                        'from',
                                                        'Ahr.Dofollow'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1000000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.ahrefs.dofollow_to"
                                                        v-model="filter.ahrefs.dofollow_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Ahrefs Dofollow',
                                                        'ahrefs.dofollow',
                                                        'to',
                                                        'Ahr.Dofollow'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="Majestic">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ext. Backlinks
                                            <CustomTooltip
                                                message="External Backlinks"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.external_backlinks_from"
                                                        :hide-details="!majesticExtBacklinksFromErrors.length"
                                                        v-model="filter.majestic.external_backlinks_from"
                                                        :error-messages="majesticExtBacklinksFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext.',
                                                        'majestic.external_backlinks',
                                                        'from',
                                                        'Ext.'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.majestic.external_backlinks_to"
                                                        v-model="filter.majestic.external_backlinks_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext.',
                                                        'majestic.external_backlinks',
                                                        'to',
                                                        'Ext.'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ext. Backlinks EDU
                                            <CustomTooltip
                                                message="External Backlinks EDU"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.external_edu_from"
                                                        :hide-details="!majesticExtEduFromErrors.length"
                                                        v-model="filter.majestic.external_edu_from"
                                                        :error-messages="majesticExtEduFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext. Edu',
                                                        'majestic.external_edu',
                                                        'from',
                                                        'Ext. EDU'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.majestic.external_edu_to"
                                                        v-model="filter.majestic.external_edu_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext. Edu',
                                                        'majestic.external_edu',
                                                        'to',
                                                        'Ext. EDU'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ext. Backlinks GOV
                                            <CustomTooltip
                                                message="External Backlinks GOV"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.external_gov_from"
                                                        :hide-details="!majesticExtGovFromErrors.length"
                                                        v-model="filter.majestic.external_gov_from"
                                                        :error-messages="majesticExtGovFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext. Gov',
                                                        'majestic.external_gov',
                                                        'from',
                                                        'Ext. GOV'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.majestic.external_gov_to"
                                                        v-model="filter.majestic.external_gov_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic Ext. Gov',
                                                        'majestic.external_gov',
                                                        'to',
                                                        'Ext. GOV'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ref. Domains
                                            <CustomTooltip
                                                message="Referring Domains"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!majesticRefDFromErrors.length"
                                                        v-model="filter.majestic.refd_from"
                                                        :error-messages="majesticRefDFromErrors"
                                                        :disabled="disabledFilterFields.majestic.refd_from"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD.',
                                                        'majestic.refd',
                                                        'from',
                                                        'RefD.'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.majestic.refd_to"
                                                        v-model="filter.majestic.refd_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD.',
                                                        'majestic.refd',
                                                        'to',
                                                        'RefD.'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ref. Domains EDU
                                            <CustomTooltip
                                                message="Referring Domains EDU"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!majesticRefDEduFromErrors.length"
                                                        v-model="filter.majestic.refd_edu_from"
                                                        :error-messages="majesticRefDEduFromErrors"
                                                        :disabled="disabledFilterFields.majestic.refd_edu_from"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD. EDU',
                                                        'majestic.refd_edu',
                                                        'from',
                                                        'RefD. EDU'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.majestic.refd_edu_to"
                                                        v-model="filter.majestic.refd_edu_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD. EDU',
                                                        'majestic.refd_edu',
                                                        'to',
                                                        'RefD. EDU'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Ref. Domains GOV
                                            <CustomTooltip
                                                message="Referring Domains GOV"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        v-model="filter.majestic.refd_gov_from"
                                                        :error-messages="majesticRefDGovFromErrors"
                                                        :hide-details="!majesticRefDGovFromErrors.length"
                                                        :disabled="disabledFilterFields.majestic.refd_gov_from"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD. GOV',
                                                        'majestic.refd_gov',
                                                        'from',
                                                        'RefD. GOV'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.refd_gov_to"
                                                        v-model="filter.majestic.refd_gov_to"
                                                        hide-details
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic RefD. GOV',
                                                        'majestic.refd_gov',
                                                        'to',
                                                        'RefD. GOV'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Trust Flow
                                            <CustomTooltip
                                                message="Trust Flow"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!majesticTfFromErrors.length"
                                                        v-model="filter.majestic.tf_from"
                                                        :error-messages="majesticTfFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic TF',
                                                        'majestic.tf',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100"
                                                        outlined
                                                        dense
                                                        :hide-details="!majesticTfToErrors.length"
                                                        v-model="filter.majestic.tf_to"
                                                        :error-messages="majesticTfToErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic TF',
                                                        'majestic.tf',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Citation Flow
                                            <CustomTooltip
                                                message="Citation Flow"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.cf_from"
                                                        v-model="filter.majestic.cf_from"
                                                        :error-messages="majesticCfFromErrors"
                                                        :hide-details="!majesticCfFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic CF',
                                                        'majestic.cf',
                                                        'from',
                                                        'CF'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.majestic.cf_to"
                                                        v-model="filter.majestic.cf_to"
                                                        :error-messages="majesticCfToErrors"
                                                        :hide-details="!majesticCfToErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Majestic CF',
                                                        'majestic.cf',
                                                        'to',
                                                        'CF'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="SemRush">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Rank
                                            <CustomTooltip
                                                message="Rank"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="1"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.semRush.rank_from"
                                                        :hide-details="!semRushRankFromErrors.length"
                                                        v-model="filter.semRush.rank_from"
                                                        :error-messages="semRushRankFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Rank',
                                                        'semRush.rank',
                                                        'from',
                                                        'SR.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="100000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.semRush.rank_to"
                                                        v-model="filter.semRush.rank_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Rank',
                                                        'semRush.rank',
                                                        'to',
                                                        'SR.Rank'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Keywords number
                                            <CustomTooltip
                                                message="Keywords number"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.semRush.keyword_num_from"
                                                        v-model="filter.semRush.keyword_num_from"
                                                        :error-messages="semRushKeywordNumFromErrors"
                                                        :hide-details="!semRushKeywordNumFromErrors.length"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Keywords Num.',
                                                        'semRush.keyword_num',
                                                        'from',
                                                        'SR.Keywords'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.semRush.keyword_num_to"
                                                        v-model="filter.semRush.keyword_num_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Keywords Num.',
                                                        'semRush.keyword_num',
                                                        'to',
                                                        'SR.Keywords'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Costs
                                            <CustomTooltip
                                                message="Costs"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!semRushTrafficCostsFromErrors.length"
                                                        v-model="filter.semRush.traffic_costs_from"
                                                        :error-messages="semRushTrafficCostsFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Costs',
                                                        'semRush.traffic_costs',
                                                        'from'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        v-model="filter.semRush.traffic_costs_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'SemRush Costs',
                                                        'semRush.traffic_costs',
                                                        'to'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                            <VTabItem key="Facebook">
                                <VRow>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Comments
                                            <CustomTooltip
                                                message="Facebook Comments"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.facebook.comments_from"
                                                        :hide-details="!facebookCommentsFromErrors.length"
                                                        v-model="filter.facebook.comments_from"
                                                        :error-messages="facebookCommentsFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Comments',
                                                        'facebook.comments',
                                                        'from',
                                                        'FB.Comments'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.facebook.comments_to"
                                                        v-model="filter.facebook.comments_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Comments',
                                                        'facebook.comments',
                                                        'to',
                                                        'FB.Comments'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Shares
                                            <CustomTooltip
                                                message="Facebook Shares"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :hide-details="!facebookSharesFromErrors.length"
                                                        v-model="filter.facebook.shares_from"
                                                        :error-messages="facebookSharesFromErrors"
                                                        :disabled="disabledFilterFields.facebook.shares_from"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Shares',
                                                        'facebook.shares',
                                                        'from',
                                                        'FB.Shares'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        v-model="filter.facebook.shares_to"
                                                        :disabled="disabledFilterFields.facebook.shares_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Shares',
                                                        'facebook.shares',
                                                        'to',
                                                        'FB.Shares'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                    <VCol cols="12" md="4">
                                        <label>
                                            Reactions
                                            <CustomTooltip
                                                message="Facebook Reactions"
                                            />
                                            <VRow>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="0"
                                                        outlined
                                                        dense
                                                        :disabled="disabledFilterFields.facebook.reactions_from"
                                                        :hide-details="!facebookReactionsFromErrors.length"
                                                        v-model="filter.facebook.reactions_from"
                                                        :error-messages="facebookReactionsFromErrors"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Reactions',
                                                        'facebook.reactions',
                                                        'from',
                                                        'FB.Reacts'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                                <VCol cols="12" md="6">
                                                    <VTextField
                                                        placeholder="10000000"
                                                        outlined
                                                        dense
                                                        hide-details
                                                        :disabled="disabledFilterFields.facebook.reactions_to"
                                                        v-model="filter.facebook.reactions_to"
                                                        @input="onInputFilter(
                                                        $event,
                                                        'additional',
                                                        'Facebook Reactions',
                                                        'facebook.reactions',
                                                        'to',
                                                        'FB.Reacts'
                                                        )"
                                                    >
                                                    </VTextField>
                                                </VCol>
                                            </VRow>
                                        </label>
                                    </VCol>
                                </VRow>
                            </VTabItem>
                        </VTabsItems>
                    </VRow>
                </VCol>
                <VCol cols="12" md="3" style="background: #f9f9f9" class="px-4">
                    <div style="position: sticky; top: 0">
                        <VRow>
                            <VCol cols="12" md="6">
                                <h4 class="text-uppercase">{{ total }} Sites</h4>
                                <span class="gray-text">Founded</span>
                            </VCol>
                            <VCol cols="12" md="6" class="text-right">
                                <VBtn depressed color="#ebebeb" @click="filtersOpened = false">
                                    <VIcon>mdi-close</VIcon>
                                </VBtn>
                            </VCol>
                        </VRow>
                        <VRow>
                            <VCol cols="12">
                                <VBtn
                                    color="primary"
                                    depressed
                                    block
                                    @click="onShowResults"
                                >
                                    Show Results
                                </VBtn>
                            </VCol>
                            <VCol cols="12" md="6">
                                <VBtn
                                    depressed
                                    color="#ebebeb"
                                    block
                                    @click="onOpenFilterNameDialog"
                                >Save</VBtn>
                            </VCol>
                            <VCol cols="12" md="6">
                                <VBtn
                                    depressed
                                    color="#ebebeb"
                                    block
                                    @click="clearAllFilters"
                                >Clear All</VBtn>
                            </VCol>
                        </VRow>
                    </div>
                </VCol>
            </VRow>
        </VCol>
        <div class="elevation-2 pa-2 rounded-lg mb-4">
            <p class="d-inline-block ma-0 pa-0 mr-6 font-14">
                Founded: <b>{{ total }}</b> sites
            </p>
            <FilterChipsIcons
                @filter-item-deleted="filterItemDeleted"
                @filter-item-deleted-array="filterItemArrayDeleted"
                @clear-all-filters="clearAllFilters('all')"
            />
        </div>
        <table class="guest-poster-table" v-if="Object.keys(platforms).length">
            <thead>
                <tr>
                    <td>
                        <VCheckbox
                            @click="selectAll"
                            hide-details
                            :value="selectedAll"
                        >
                        </VCheckbox>
                    </td>
                    <th @click="changeSortingAndDirection('website')" class="website">
                        <span :class="{ 'underline' : sorting === 'website' }">
                            Website
                        </span>
                    </th>
                    <th @click="changeSortingAndDirection('trust')" class="trust">
                        <span :class="{ 'underline' : sorting === 'trust' }">
                            Trust
                        </span>
                    </th>
                    <th @click="changeSortingAndDirection('semRush.traffic')">
                        <span :class="{ 'underline' : sorting === 'semRush.traffic' }">
                            SR.Trf
                        </span>
                    </th>
                    <th @click="changeSortingAndDirection('ahrefs.dr')">
                        <span :class="{ 'underline' : sorting === 'ahrefs.dr' }">
                            DR
                        </span>
                    </th>
                    <th @click="changeSortingAndDirection('semRush.traffic_costs')">
                        <span :class="{ 'underline' : sorting === 'semRush.traffic_costs' }">
                            SR.Cost
                        </span>
                    </th>
                    <th @click="changeSortingAndDirection('majestic.tf')">
                        <span :class="{ 'underline' : sorting === 'majestic.tf' }">
                            TF
                        </span>
                    </th>
                    <template v-for="(column, index) in columns">
                        <th
                            v-if="column.visible"
                            :key="index"
                            @click="changeSortingAndDirection(column.property)"
                        >
                            <span :class="{ 'underline' : sorting === column.property }">
                                {{ column.name }}
                            </span>
                        </th>
                    </template>
                    <th class="features">Features</th>
                    <th @click="changeSortingAndDirection('price')" class="editorial-fee">
                        <span :class="{ 'underline' : sorting === 'price' }">
                            Editorial Fee
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="platform in platforms" :key="platform.id">
                    <td>
                        <VCheckbox
                            :value="!!chosen[platform.id]"
                            @click="selectPlatform(platform.id)"
                            hide-details
                        ></VCheckbox>
                    </td>
                    <td class="website">
                        <div class="link">
                            <span class="website-link">
                                <img
                                    v-if="platform.alexa.country"
                                    :src="require('../../assets/svg/country-flags/' +
                                     platform.alexa.country.toLowerCase()
                                      + '.svg')"
                                    :alt="platform.alexa.country"
                                    class="platform-country-image"
                                >
                                {{ platform.websiteUrl }}
                            </span>
                        </div>
                        <div class="topics">
                            <VChip small
                                   label
                                   class="pa-0 px-1 mr-1 mb-1 chip"
                                   v-for="(topic, id) in platform.topics"
                                   :key="id"
                            >
                                {{ topic.name }}
                            </VChip>
                        </div>
                    </td>
                    <td class="trust">
                        <PlatformTrust
                            :check-trust="platform.checktrust"
                            :check-trust-spam="platform.spam"
                            :power-trust="platform.powertrust"
                        />
                    </td>
                    <td>
                        <span class="table-value">
                            {{ platform.organicTraffic | notAvailableFilter | formatNumberFilter }}
                        </span>
                    </td>
                    <td>
                        <span class="table-value">
                            {{ (platform.ahrefs ? platform.ahrefs.dr : null) | notAvailableFilter }}
                        </span>
                    </td>
                    <td>
                        <span class="table-value">
                            {{ platform.semRush.trafficCosts | notAvailableFilter | formatNumberFilter }}
                        </span>
                    </td>
                    <td>
                        <span class="table-value">
                            {{ platform.majestic.tf | notAvailableFilter }}
                        </span>
                    </td>
                    <template v-for="(column, index) in columns">
                        <td
                            v-if="column.visible"
                            :key="index"
                        >
                            <span class="table-value">
                                {{ platform[column.property.split('.')[0]][column.property.split('.')[1]] | notAvailableFilter | formatNumberFilter }}
                            </span>
                        </td>
                    </template>
                    <td class="features">
                        <PlatformFeatures :platform="platform" />
                    </td>
                    <td class="editorial-fee">
                        <span class="fee fee-active">
                            <span class="left">{{ totalPrice(platform.price) }} $</span>
                            <span class="right">Guest Post</span>
                        </span>
                        <span class="fee" v-if="platform.freeHomeFeaturedActive">
                            <span class="left">
                                {{ totalPrice(platform.price + platform.articleWritingPrice) }} $
                            </span>
                            <span class="right">GP + Article</span>
                        </span>
                        <span class="fee" v-if="platform.nicheEditLinkActive">
                            <span class="left">
                                {{ totalPrice(platform.price + platform.nicheEditLinkPrice) }} $
                            </span>
                            <span class="right">Niche Edit</span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1 v-else class="text-center">Platforms weren't found:( ...</h1>

        <VRow class="justify-space-between mt-4" v-if="Object.keys(platforms).length">
            <ul class="pagination">
                <li>
                    <VBtn :disabled="page === 1" @click="page -= 1" fab small>
                        <VIcon>mdi-chevron-left</VIcon>
                    </VBtn>
                </li>
                <li v-for="firstPage in firstPages" :key="firstPage">
                    <VBtn
                        small
                        fab
                        @click="onChangePage(firstPage)"
                        :color="firstPage === page ? 'blue' : 'white'">{{ firstPage }}</VBtn>
                </li>
                <li v-if="pages.length > 4">
                    <VBtn small fab>...</VBtn>
                </li>
                <li v-if="pages.length > 4">
                    <ul class="pl-0">
                        <li v-for="lastPage in lastPages" :key="lastPage">
                            <VBtn
                                small
                                fab
                                @click="onChangePage(lastPage)"
                                :color="lastPage === page ? 'blue' : 'white'"
                            >{{ lastPage }}</VBtn>
                        </li>

                    </ul>
                </li>
                <li>
                    <VBtn
                        :disabled="page === lastPage"
                        @click="page += 1"
                        fab
                        small
                    >
                        <VIcon>mdi-chevron-right</VIcon>
                    </VBtn>
                </li>
            </ul>
            <VCol cols="2">
                <VSelect
                    solo
                    dense
                    :items="[5, 10, 15, 20, 25, 30]"
                    label="Per page"
                    @change="onSelectPerPage"
                    v-model="perPage"
                >
                </VSelect>
            </VCol>
        </VRow>

        <SendRequestFooter
            :chosen-platforms-ids="chosenPlatformsIds"
            @unselected="unSelectAll"
            v-if="!isAdmin"
            @request-created="onRequestCreated"
            @platform-removed="onPlatformRemoved"
        />

        <SaveFilterNameDialog
            :visibility="filterNameDialog"
            @close-dialog="filterNameDialog = false"
            @save-name="onSaveFilter"
        />
    </div>
</template>

<script>
import SendRequestFooter from '@/components/guest-posting/SendRequestFooter';
import rolemixin from '@/mixins/rolemixin';
import valueFormatMixin from '@/mixins/valueFormatMixin';
import PlatformTrust from '@/components/platform/PlatformTrust';
import PlatformFeatures from '@/components/platform/PlatformFeatures';
import guestPostingMixin from '@/mixins/guestPostingMixin';
import { mapGetters, mapActions } from 'vuex';
import * as getters from '@/store/modules/platforms/types/getters';
import * as filterActions from '@/store/modules/filter/types/actions';
import * as filterGetters from '@/store/modules/filter/types/getters';
import { countries } from '@/helpers/countries';
import { validationMixin } from 'vuelidate';
import { maxValue, minValue } from 'vuelidate/lib/validators';
import FilterChipsIcons from '@/components/guest-posting/FilterChipsIcons';
import additionalFilterCounterMixin from '@/mixins/additionalFilterCounterMixin';
import notificationMixin from '@/mixins/notificationMixin';
import { maxAdditionalFilters } from '@/constants/constants';
import SaveFilterNameDialog from '@/components/guest-posting/SaveFilterNameDialog';
import UserFiltersBlock from '@/components/user-filter/UserFiltersBlock';

export default {
    name: 'GuestPostingComponent',
    components: {
        UserFiltersBlock,
        SendRequestFooter,
        PlatformTrust,
        PlatformFeatures,
        FilterChipsIcons,
        SaveFilterNameDialog
    },
    validations: {
        filter: {
            platform: {
                price_from: { minValue: minValue(0) },
                organic_traffic_from: { minValue: minValue(0) }
            },
            trust: {
                checktrust_from: { minValue: minValue(0) },
                checktrust_to: { maxValue: maxValue(100) },
                spam_from: { minValue: minValue(0) },
                spam_to: { maxValue: maxValue(100) },
                powertrust_from: { minValue: minValue(0) },
                powertrust_to: { maxValue: maxValue(100) },
            },
            moz: {
                da_from: { minValue: minValue(0) },
                pa_from: { minValue: minValue(0) },
                rank_from: { minValue: minValue(1) },
                links_in_from: { minValue: minValue(1) },
                equity_from: { minValue: minValue(0) }
            },
            alexa: {
                rank_from: { minValue: minValue(1) },
                country_rank_from: { minValue: minValue(1) },
            },
            semRush: {
                rank_from: { minValue: minValue(1) },
                keyword_num_from: { minValue: minValue(0) },
                traffic_costs_from: { minValue: minValue(0) },
            },
            majestic: {
                external_backlinks_from: { minValue: minValue(0) },
                external_gov_from: { minValue: minValue(0) },
                external_edu_from: { minValue: minValue(0) },
                tf_from: { minValue: minValue(0), maxValue: maxValue(100) },
                tf_to: { maxValue: maxValue(100) },
                cf_from: { minValue: minValue(0), maxValue: maxValue(100) },
                cf_to: { maxValue: maxValue(100) },
                refd_from: { minValue: minValue(0) },
                refd_edu_from: { minValue: minValue(0) },
                refd_gov_from: { minValue: minValue(0) },
            },
            ahrefs: {
                rank_from: { minValue: minValue(1) },
                dr_from: { minValue: minValue(0) },
                ext_backlinks_from: { minValue: minValue(0) },
                refd_from: { minValue: minValue(0) },
                dofollow_from: { minValue: minValue(0) },
            },
            facebook: {
                comments_from: { minValue: minValue(0) },
                shares_from: { minValue: minValue(0) },
                reactions_from: { minValue: minValue(0) },
            }
        }
    },
    data: () => ({
        tab: 'Ahrefs',
        filtersOpened: false,
        filtersApplied: false,
        additionalFiltersOpened: false,
        filterNameDialog: false,
        filterData: {},
        filterChips: {},
        countries: countries,
        deadlineList: {
            'Up to 3 days': 3,
            'Up to 10 days': 10,
            'Up to 20 days': 20,
            'Up to 30 days': 30,
        },
        trustSummaryList: {
            'Bad': 'bad',
            'Good': 'good',
            'Perfect': 'perfect',
        },
        filter: {
            platform: {
                dofollow: 'any',
                niche_edit_link: 'any',
                home_featured: 'any',
                money_anchor: 'any',
                deadline: '',
                topics: [],
                domainZones: [],
                price_from: '',
                price_to: '',
                organic_traffic_from: '',
                organic_traffic_to: '',
            },
            trust: {
                summary: [],
                checktrust_from: '',
                checktrust_to: '',
                spam_from: '',
                spam_to: '',
                powertrust_from: '',
                powertrust_to: '',
            },
            moz: {
                da_from: '',
                da_to: '',
                pa_from: '',
                pa_to: '',
                rank_from: '',
                rank_to: '',
                links_in_from: '',
                links_in_to: '',
                equity_from: '',
                equity_to: '',
            },
            alexa: {
                rank_from: '',
                rank_to: '',
                country: [],
                country_rank_from: '',
                country_rank_to: ''
            },
            semRush: {
                rank_from: '',
                rank_to: '',
                keyword_num_from: '',
                keyword_num_to: '',
                traffic_costs_from: '',
                traffic_costs_to: '',
            },
            majestic: {
                external_backlinks_from: '',
                external_backlinks_to: '',
                external_gov_from: '',
                external_gov_to: '',
                external_edu_from: '',
                external_edu_to: '',
                tf_from: '',
                tf_to: '',
                cf_from: '',
                cf_to: '',
                refd_from: '',
                refd_to: '',
                refd_gov_from: '',
                refd_gov_to: '',
                refd_edu_from: '',
                refd_edu_to: '',
            },
            facebook: {
                comments_from: '',
                comments_to: '',
                shares_from: '',
                shares_to: '',
                reactions_from: '',
                reactions_to: ''
            },
            ahrefs: {
                rank_from: '',
                rank_to: '',
                dr_from: '',
                dr_to: '',
                ext_backlinks_from: '',
                ext_backlinks_to: '',
                refd_from: '',
                refd_to: '',
                dofollow_from: '',
                dofollow_to: '',
            }
        },
        filterQuery: {},
    }),
    mixins: [
        rolemixin,
        valueFormatMixin,
        guestPostingMixin,
        validationMixin,
        additionalFilterCounterMixin,
        notificationMixin
    ],
    methods: {
        ...mapActions('filter', {
            setFilterItem: filterActions.SET_FILTER_ITEM,
            showFilterItems: filterActions.SHOW_FILTER_ITEMS,
            clearFilterItems: filterActions.CLEAR_FILTER_ITEMS,
            setColumn: filterActions.SET_COLUMN,
            removeColumnByProperty: filterActions.REMOVE_COLUMN_BY_PROPERTY,
            clearColumns: filterActions.CLEAR_COLUMNS,
            showColumns: filterActions.SHOW_COLUMNS,
            saveUserFilter: filterActions.SAVE_USER_FILTER,
            getUserFilters: filterActions.GET_USER_FILTERS,
            setFilterItemFromAppliedFilter: filterActions.SET_FILTER_ITEM_FROM_APPLIED_FILTER
        }),
        async filterItemArrayDeleted(type, value, property) {
            const subFilterName = property.split('.')[0];
            const filterPropertyName = property.split('.')[1];
            if (this.filter[subFilterName][filterPropertyName]) {
                this.filter[subFilterName][filterPropertyName] =
                    this.filter[subFilterName][filterPropertyName].filter(item => item !== value);
            }
            await this.onShowResults();
        },
        onOpenFilterNameDialog() {
            this.filterNameDialog = true;
        },
        async onSaveFilter(name) {
            try {
                await this.saveUserFilter({
                    name,
                    filter_items: this.filterData
                });
                this.setNotification({
                    type: 'success',
                    message: 'Filter was added!'
                });
            } catch (error) {
                this.setNotification({
                    type: 'error',
                    message: error
                });
            }
        },
        disableFields() {
            const additionalKeys = ['moz', 'alexa', 'semRush', 'majestic', 'facebook', 'ahrefs'];
            Object.keys(this.filter).map(addFilterKey => {
                if (additionalKeys.includes(addFilterKey)) {
                    Object.keys(this.filter[addFilterKey]).map(key => {
                        if (key.includes('_from') || key.includes('_to')) {
                            let keyProperty = '';
                            if (key.includes('_from')) {
                                keyProperty = key.split('_from')[0];
                            }
                            if (key.includes('_to')) {
                                keyProperty = key.split('_to')[0];
                            }
                            if (keyProperty) {
                                if (!this.chosenFiltersProperties.includes(addFilterKey + '.' + keyProperty)) {
                                    this.disabledFilterFields[addFilterKey][key] = true;
                                    this.filter[addFilterKey][key] = '';
                                } else {
                                    this.disabledFilterFields[addFilterKey][key] = false;
                                }
                            }
                        }
                    });
                }
            });
        },
        async filterItemDeleted(name) {
            const subFilterName = name.split('.')[0];
            const filterPropertyName = name.split('.')[1];
            const filterItemNameFrom = filterPropertyName + '_from';
            const filterItemNameTo = filterPropertyName + '_to';
            const flagFilterItems = [
                'dofollow',
                'niche_edit_link',
                'home_featured',
                'money_anchor'
            ];

            if (subFilterName === 'platform' && flagFilterItems.includes(filterPropertyName)) {
                this.filter[subFilterName][filterPropertyName] = 'any';
            } else {
                if (
                    this.filter[subFilterName][filterItemNameFrom]
                    ||
                    this.filter[subFilterName][filterItemNameTo]
                ) {
                    this.filter[subFilterName][filterItemNameFrom] =
                    this.filter[subFilterName][filterItemNameTo] = '';
                } else {
                    this.filter[subFilterName][filterPropertyName] = '';
                }
            }
            await this.onShowResults();
        },
        openFilters() {
            this.filtersOpened = !this.filtersOpened;
        },
        openAdditionalFilters() {
            this.additionalFiltersOpened = !this.additionalFiltersOpened;
        },
        setFilterItemFromInput(value, type, name, property, limit = '', columnName = '') {
            const filterItem = {
                id: name.toLowerCase()
                    .replace(/\s/g, '_')
                    .replace(/\./g, ''),
                name,
                type,
                visible: false,
                property,
                limit,
                columnName
            };
            const radioKeys = [
                'deadline',
                'dofollow',
                'niche_edit_link',
                'home_featured',
                'money_anchor',
            ];
            if (limit === 'from') filterItem.from = value;
            if (limit === 'to') filterItem.to = value;
            if (radioKeys.includes(filterItem.id)) filterItem.value = value;
            if (['Topics', 'Country', 'Domains'].includes(name)) filterItem.items = value;
            this.setFilterItem(filterItem);
        },
        onInputFilter(value, type, name, property, limit = '', columnName = '') {
            if (type === 'additional' && columnName) {
                if (this.chosenFiltersProperties.length < maxAdditionalFilters) {
                    this.setFilterItemFromInput(
                        value,
                        type,
                        name,
                        property,
                        limit,
                        columnName
                    );
                } else {
                    if (this.chosenFiltersProperties.includes(property)) {
                        this.setFilterItemFromInput(
                            value,
                            type,
                            name,
                            property,
                            limit,
                            columnName
                        );
                    } else {
                        this.setNotification({
                            message: 'Sorry, but for filtering are available only ' +
                                maxAdditionalFilters
                                + ' numerical range!'
                        });
                        this.disableFields();
                    }
                }
            } else {
                this.setFilterItemFromInput(
                    value,
                    type,
                    name,
                    property,
                    limit,
                    columnName
                );
            }
        },
        onRequestCreated() {
            this.unSelectAll();
        },
        async clearAllFilters(mode = 'filters') {
            this.$v.$reset();
            this.clearFilterItems(mode);
            this.filterData = {};
            this.sorting = this.direction = '';
            Object.keys(this.filter.majestic).forEach(key => this.filter.majestic[key] = '');
            Object.keys(this.filter.moz).forEach(key => this.filter.moz[key] = '');
            Object.keys(this.filter.alexa).forEach(key => this.filter.alexa[key] = '');
            Object.keys(this.filter.semRush).forEach(key => this.filter.semRush[key] = '');
            Object.keys(this.filter.platform).forEach(key => this.filter.platform[key] = '');
            Object.keys(this.filter.facebook).forEach(key => this.filter.facebook[key] = '');
            Object.keys(this.filter.ahrefs).forEach(key => this.filter.ahrefs[key] = '');
            Object.keys(this.filter.trust).forEach(key => this.filter.trust[key] = '');
            this.filter.platform.topics =
                this.filter.platform.domainZones =
                this.filter.alexa.country =
                this.filter.trust.summary = [];
            this.filter.platform.dofollow =
                this.filter.platform.niche_edit_link =
                this.filter.platform.home_featured =
                this.filter.platform.money_anchor = 'any';
            this.filterQuery = this.filter;
            this.clearColumns();
            const response = await this.loadPlatforms();
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;
            this.total = response.total;
            this.reCalculatePages();
            this.initializeChosenPlatformsState();
        },
        async onShowResults() {
            this.showFilterItems();
            this.showColumns();
            this.filtersOpened = false;
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.filterQuery = {
                    ...this.filter,
                    platform: {
                        ...this.filter.platform,
                        topics: this.filter.platform.topics.length ?
                            this.filter.platform.topics.map(topic => this.topics[topic]) : [],
                        deadline: this.filter.platform.deadline ?
                            this.deadlineList[this.filter.platform.deadline] : '',
                    },
                    trust: {
                        ...this.filter.trust,
                        summary: this.filter.trust.summary.length ?
                            this.filter.trust.summary.map(item => this.trustSummaryList[item]) : []
                    },
                    alexa: {
                        ...this.filter.alexa,
                        country: this.filter.alexa.country.length ?
                            this.filter.alexa.country.map(country => countries[country])
                            : []
                    },
                };
                const response = await this.loadPlatforms();
                this.currentPage = response.current_page;
                this.lastPage = response.last_page;
                this.total = response.total;
                this.reCalculatePages();
                this.initializeChosenPlatformsState();
            }
        }
    },
    watch: {
        chosenFiltersProperties() {
            if (this.chosenFiltersProperties.length < maxAdditionalFilters) {
                this.initializeDisabledFields();
            }
        },
        filterData: {
            handler() {
                Object.keys(this.filterData).map(key => {
                    Object.keys(this.filterData[key]).map(subKey => {
                        if (this.filterData[key][subKey] === undefined) {
                            this.filterData[key][subKey] = '';
                        }
                    });
                });
            },
            deep: true
        },
        filterItems: {
            handler() {
                this.filterData = {};
                Object.keys(this.filterItems).map(key => {
                    if (
                        (this.filterItems[key].to || this.filterItems[key].from)
                        ||
                        (this.filterItems[key].value)
                        ||
                        (this.filterItems[key]?.items?.length)
                    ) {
                        this.filterData = {
                            ...this.filterData,
                            [key]: {
                                name: this.filterItems[key].name,
                                column_name: this.filterItems[key].columnName,
                                property: this.filterItems[key].property,
                                from: this.filterItems[key].from,
                                to: this.filterItems[key].to,
                                value: this.filterItems[key].value,
                                items: this.filterItems[key].items,
                                type: this.filterItems[key].type,
                                ...this.filterItems[key],
                            }
                        }
                    }
                });
            },
            deep:true
        },
        async appliedFilter() {
            if (Object.keys(this.appliedFilter).length) {
                await this.clearAllFilters();
                Object.keys(this.appliedFilter.filter_items).map(key => {
                    const subFilter = this.appliedFilter.filter_items[key].property.split('.')[0];
                    const property = this.appliedFilter.filter_items[key].property.split('.')[1];
                    if (this.appliedFilter.filter_items[key].from || this.appliedFilter.filter_items[key].to) {
                        const propertyFrom = property + '_from';
                        const propertyTo = property + '_to';
                        this.filter[subFilter][propertyFrom] = this.appliedFilter.filter_items[key].from;
                        this.filter[subFilter][propertyTo] = this.appliedFilter.filter_items[key].to;
                    }
                    if (this.appliedFilter.filter_items[key].value) {
                        this.filter[subFilter][property] = this.appliedFilter.filter_items[key].value;
                    }
                    if (this.appliedFilter.filter_items[key].items?.length) {
                        this.filter[subFilter][property] = this.appliedFilter.filter_items[key].items;
                    }
                    const filterItem = {
                        id: this.appliedFilter.filter_items[key].name.toLowerCase()
                            .replace(/\s/g, '_')
                            .replace(/\./g, ''),
                        name: this.appliedFilter.filter_items[key].name,
                        visible: true,
                        type: this.appliedFilter.filter_items[key].type,
                        property: this.appliedFilter.filter_items[key].property,
                        value: this.appliedFilter.filter_items[key].value,
                        items: this.appliedFilter.filter_items[key].items,
                        columnName: this.appliedFilter.filter_items[key].column_name,
                        from: this.appliedFilter.filter_items[key].from,
                        to: this.appliedFilter.filter_items[key].to,
                    };
                    this.setFilterItemFromAppliedFilter(filterItem);
                });
                await this.onShowResults();
            }
        }
    },
    computed: {
        ...mapGetters('platforms', {
            topics: getters.GET_TOPICS,
            domainZonesList: getters.GET_DOMAIN_ZONES
        }),
        ...mapGetters('filter', {
            canAddFilterItem: filterGetters.CAN_ADD_FILTER_ITEM,
            additionalFiltersCounter: filterGetters.MAX_AMOUNT_FILTERS,
            columns: filterGetters.GET_VISIBLE_COLUMNS,
            chosenFiltersProperties: filterGetters.CHOSEN_FILTERS_PROPERTIES,
            filterItems: filterGetters.GET_FILTER_ITEMS,
            appliedFilter: filterGetters.GET_APPLIED_USER_FILTER
        }),
        disabledAdditional() {
            return this.additionalFiltersCounter === 5;
        },
        domainZonesFormatted() {
            return this.domainZonesList.map(domainZone => '.' + domainZone);
        },
        priceFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.price_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.price_from.minValue &&
            errors.push('Price from must be more than 0!');
            return errors;
        },
        organicTrafficFromErrors() {
            const errors = [];
            if (!this.$v.filter.platform.organic_traffic_from.$dirty) {
                return errors;
            }
            !this.$v.filter.platform.organic_traffic_from.minValue &&
            errors.push('Organic Traffic from must be more than 0!');
            return errors;
        },
        // Moz Errors
        mozDaFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.da_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.da_from.minValue &&
            errors.push('Moz DA from must be more than 0!');
            return errors;
        },
        mozPaFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.pa_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.pa_from.minValue &&
            errors.push('Moz PA from must be more than 0!');
            return errors;
        },
        mozRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.rank_from.minValue &&
            errors.push('Moz Rank from must be more than 1!');
            return errors;
        },
        mozLinksInFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.links_in_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.links_in_from.minValue &&
            errors.push('Moz Links In from must be more than 1!');
            return errors;
        },
        mozEquityFromErrors() {
            const errors = [];
            if (!this.$v.filter.moz.equity_from.$dirty) {
                return errors;
            }
            !this.$v.filter.moz.equity_from.minValue &&
            errors.push('Moz Ext. Equity from must be more than 0!');
            return errors;
        },
        // Alexa Errors
        alexaRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.alexa.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.alexa.rank_from.minValue &&
            errors.push('Alexa Rank from must be more than 1!');
            return errors;
        },
        alexaCountryRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.alexa.country_rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.alexa.country_rank_from.minValue &&
            errors.push('Alexa Country Rank from must be more than 1!');
            return errors;
        },
        // SemRush Errors
        semRushRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.rank_from.minValue &&
            errors.push('SemRush Rank from must be more than 1!');
            return errors;
        },
        semRushKeywordNumFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.keyword_num_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.keyword_num_from.minValue &&
            errors.push('SemRush Keyword Num from must be more than 0!');
            return errors;
        },
        semRushTrafficCostsFromErrors() {
            const errors = [];
            if (!this.$v.filter.semRush.traffic_costs_from.$dirty) {
                return errors;
            }
            !this.$v.filter.semRush.traffic_costs_from.minValue &&
            errors.push('SemRush Traffic Costs from must be more than 0!');
            return errors;
        },
        // Majestic Errors
        majesticExtBacklinksFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_backlinks_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_backlinks_from.minValue &&
            errors.push('Majestic Ext. BackLinks from must be more than 0!');
            return errors;
        },
        majesticExtGovFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_gov_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_gov_from.minValue &&
            errors.push('Majestic Ext. Gov from must be more than 0!');
            return errors;
        },
        majesticExtEduFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.external_edu_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.external_edu_from.minValue &&
            errors.push('Majestic Ext. Edu from must be more than 0!');
            return errors;
        },
        majesticRefDFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.refd_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.refd_from.minValue &&
            errors.push('Majestic Ref. Domains from must be more than 0!');
            return errors;
        },
        majesticRefDGovFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.refd_gov_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.refd_gov_from.minValue &&
            errors.push('Majestic Ref. Domains Gov from must be more than 0!');
            return errors;
        },
        majesticRefDEduFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.refd_edu_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.refd_edu_from.minValue &&
            errors.push('Majestic Ext. Domains Edu from must be more than 0!');
            return errors;
        },
        majesticTfFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.tf_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.tf_from.minValue &&
            errors.push('Majestic TF from must be more than 0!');
            return errors;
        },
        majesticTfToErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.tf_to.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.tf_to.maxValue &&
            errors.push('Majestic TF to must be less than 100!');
            return errors;
        },
        majesticCfFromErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.cf_from.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.cf_from.minValue &&
            errors.push('Majestic CF from must be more than 0!');
            return errors;
        },
        majesticCfToErrors() {
            const errors = [];
            if (!this.$v.filter.majestic.cf_to.$dirty) {
                return errors;
            }
            !this.$v.filter.majestic.cf_to.maxValue &&
            errors.push('Majestic CF to must be less than 100!');
            return errors;
        },
        // Facebook Errors
        facebookCommentsFromErrors() {
            const errors = [];
            if (!this.$v.filter.facebook.comments_from.$dirty) {
                return errors;
            }
            !this.$v.filter.facebook.comments_from.minValue &&
            errors.push('Facebook Comments from must be more than 0!');
            return errors;
        },
        facebookSharesFromErrors() {
            const errors = [];
            if (!this.$v.filter.facebook.shares_from.$dirty) {
                return errors;
            }
            !this.$v.filter.facebook.shares_from.minValue &&
            errors.push('Facebook Shares from must be more than 0!');
            return errors;
        },
        facebookReactionsFromErrors() {
            const errors = [];
            if (!this.$v.filter.facebook.reactions_from.$dirty) {
                return errors;
            }
            !this.$v.filter.facebook.reactions_from.minValue &&
            errors.push('Facebook Reactions from must be more than 0!');
            return errors;
        },
        // Ahrefs
        ahrefsRankFromErrors() {
            const errors = [];
            if (!this.$v.filter.ahrefs.rank_from.$dirty) {
                return errors;
            }
            !this.$v.filter.ahrefs.rank_from.minValue &&
            errors.push('Ahrefs Rank from must be more than 1!');
            return errors;
        },
        ahrefsDomainRatingFromErrors() {
            const errors = [];
            if (!this.$v.filter.ahrefs.dr_from.$dirty) {
                return errors;
            }
            !this.$v.filter.ahrefs.dr_from.minValue &&
            errors.push('Ahrefs Domain Rating from must be more than 0!');
            return errors;
        },
        ahrefsExtBacklinksFromErrors() {
            const errors = [];
            if (!this.$v.filter.ahrefs.ext_backlinks_from.$dirty) {
                return errors;
            }
            !this.$v.filter.ahrefs.ext_backlinks_from.minValue &&
            errors.push('Ahrefs Ext. Backlinks from must be more than 0!');
            return errors;
        },
        ahrefsRefDFromErrors() {
            const errors = [];
            if (!this.$v.filter.ahrefs.refd_from.$dirty) {
                return errors;
            }
            !this.$v.filter.ahrefs.refd_from.minValue &&
            errors.push('Ahrefs Ref. Domains from must be more than 0!');
            return errors;
        },
        ahrefsDofollowFromErrors() {
            const errors = [];
            if (!this.$v.filter.ahrefs.dofollow_from.$dirty) {
                return errors;
            }
            !this.$v.filter.ahrefs.dofollow_from.minValue &&
            errors.push('Ahrefs Dofollow from from must be more than 0!');
            return errors;
        },
        // Trust
        trustCheckTrustFromErrors() {
            const errors = [];
            if (!this.$v.filter.trust.checktrust_from.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.checktrust_from.minValue &&
            errors.push('CheckTrust from must be more than 0!');
            return errors;
        },
        trustCheckTrustToErrors() {
            const errors = [];
            if (!this.$v.filter.trust.checktrust_to.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.checktrust_to.maxValue &&
            errors.push('CheckTrust to must be less than 100!');
            return errors;
        },
        trustSpamFromErrors() {
            const errors = [];
            if (!this.$v.filter.trust.spam_from.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.spam_from.minValue &&
            errors.push('Spam from must be more than 0!');
            return errors;
        },
        trustSpamToErrors() {
            const errors = [];
            if (!this.$v.filter.trust.spam_to.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.spam_to.maxValue &&
            errors.push('Spam To must be less than 100!');
            return errors;
        },
        trustPowerTrustFromErrors() {
            const errors = [];
            if (!this.$v.filter.trust.powertrust_from.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.powertrust_from.minValue &&
            errors.push('PowerTrust from must be more than 0!');
            return errors;
        },
        trustPowerTrustToErrors() {
            const errors = [];
            if (!this.$v.filter.trust.powertrust_to.$dirty) {
                return errors;
            }
            !this.$v.filter.trust.powertrust_to.maxValue &&
            errors.push('PowerTrust to must be less than 100!');
            return errors;
        }
    }
}
</script>

<style scoped>
@import "../../assets/styles/table.css";
.float-btn-action {
    position: fixed;
    bottom: 25px;
    right: 25px;
}

.chip {
    font-size: 10px;
    font-weight: 400 !important;
}

.v-application--is-ltr .v-input--selection-controls__input {
    margin-right: 0;
}

.v-input--selection-controls {
    margin-top: 0;
    padding-top: 0;
}

.pagination {
    list-style: none;
}

.pagination li {
    cursor: pointer;
    display: inline-block;
    margin-right: 15px;
    transition: 0.5s;
}

.order-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: white;
    box-shadow:
        0 2px 4px 4px rgba(0, 0, 0, 0.2),
        0 4px 5px 5px rgba(0, 0, 0, 0.14),
        0 1px 10px 4px rgba(0, 0, 0, 0.12);
    display: none;
}

.filters {
    border-radius: 10px;
    border: 2px solid #2f80ed;
    padding-left: 30px;
}

.not-uppercase {
    text-transform: none;
}

label {
    font-size: 14px;
    font-weight: 500;
}

.font-14 {
    font-size: 14px;
}

.platform-country-image {
    width: 18px;
    height: 13px;
}
</style>