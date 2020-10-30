<template>
    <VDialog
        v-model="showDialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
    >
        <VCard>
            <VToolbar
                dark
                color="primary"
            >
                <VBtn
                    icon
                    dark
                    @click="showDialog = false"
                >
                    <VIcon>mdi-close</VIcon>
                </VBtn>
                <VToolbarTitle>Platform View</VToolbarTitle>
                <VSpacer></VSpacer>
                <VToolbarItems>
                    <VBtn
                        dark
                        text
                        @click="showDialog = false"
                    >
                        Close
                    </VBtn>
                </VToolbarItems>
            </VToolbar>
            <VContainer>
                <div>
                    <h2>{{ platform.websiteUrl }}</h2>
                </div>
                <VRow>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.id }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>ID</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.protocol }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Protocol</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            <VChip label small
                                                   v-for="(topic, index) in platform.topics"
                                                   :key="index"
                                                   class="mr-1"
                                            >
                                                {{ topic.name }}
                                            </VChip>
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Topics</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.domainZone }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Domain zone</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.createdAt | formatDataFilter }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Created At</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.articleWritingPrice | priceFilter }} $
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Article Writing Price</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.nicheEditLinkPrice | priceFilter }} $
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Niche Edit Link Price</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.price | priceFilter }} $
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Price</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.deadLine }} (days)
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Deadline</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.email }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Email</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="6">
                        <VCard>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.comment }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Comment</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.articleRequirements }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Article Requirements</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.description }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Description</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.wherePosted }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Where Posted</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.contacts }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Contacts</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                </VRow>
                <VRow>
                    <VCol cols="12" md="2">
                        <VCard>
                            <VListItem>
                                <VListItemContent>
                                    <VListItemTitle>DoFollow</VListItemTitle>
                                </VListItemContent>
                                <VListItemIcon>
                                    <VIcon color="green" v-if="platform.doFollowActive">mdi-check</VIcon>
                                    <VIcon color="red" v-else>mdi-close</VIcon>
                                </VListItemIcon>
                            </VListItem>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="2">
                        <VCard>
                            <VListItem>
                                <VListItemContent>
                                    <VListItemTitle>Home Featured</VListItemTitle>
                                </VListItemContent>
                                <VListItemIcon>
                                    <VIcon
                                        color="green"
                                        v-if="platform.freeHomeFeaturedActive"
                                    >
                                        mdi-check
                                    </VIcon>
                                    <VIcon color="red" v-else>mdi-close</VIcon>
                                </VListItemIcon>
                            </VListItem>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="2">
                        <VCard>
                            <VListItem>
                                <VListItemContent>
                                    <VListItemTitle>Niche Edit Link</VListItemTitle>
                                </VListItemContent>
                                <VListItemIcon>
                                    <VIcon
                                        color="green"
                                        v-if="platform.nicheEditLinkActive"
                                    >
                                        mdi-check
                                    </VIcon>
                                    <VIcon color="red" v-else>mdi-close</VIcon>
                                </VListItemIcon>
                            </VListItem>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="2">
                        <VCard>
                            <VListItem>
                                <VListItemContent>
                                    <VListItemTitle>Money Anchor</VListItemTitle>
                                </VListItemContent>
                                <VListItemIcon>
                                    <VIcon
                                        color="green"
                                        v-if="platform.moneyAnchor"
                                    >
                                        mdi-check
                                    </VIcon>
                                    <VIcon color="red" v-else>mdi-close</VIcon>
                                </VListItemIcon>
                            </VListItem>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="2" v-if="platform.inTrash">
                        <VCard>
                            <VListItem>
                                <VListItemContent>
                                    <VListItemTitle>In trash</VListItemTitle>
                                </VListItemContent>
                                <VListItemIcon>
                                    <VIcon>mdi-delete</VIcon>
                                </VListItemIcon>
                            </VListItem>
                        </VCard>
                    </VCol>
                </VRow>
                <VRow>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>CheckTrust</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.checktrust }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Trust</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.spam }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Spam</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.powertrust }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Power Trust</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>Moz</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.moz.pa | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Page Authority</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.moz.da | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Domain Authority</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.moz.rank | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Rank</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.moz.links_in | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Links In</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.moz.equity | formatNumberFilter }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Equity</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>Alexa</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.alexa.rank  | formatNumberFilter }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Rank</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line v-if="countryImage">
                                    <VListItemContent>
                                        <VListItemTitle>
                                            <img
                                                :src="require('../../assets/svg/country-flags/' +
                                                countryImage)"
                                                alt="" width="30" height="15">
                                            {{ platform.alexa.country }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Country</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.alexa.country_rank | formatNumberFilter }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Country Rank</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>SemRush</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.semRush.rank | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Rank</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.semRush.keyword_num | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Keyword Number</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.semRush.trafficCosts | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Traffic Costs</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>Majestic</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.external_backlinks | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>External Backlinks</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.external_edu | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>External BackLinks EDU</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.external_gov | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>External BackLinks GOV</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.refd | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Referring Domains</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.refd_edu | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Referring Domains EDU</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.refd_gov | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Referring Domains GOV</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.tf  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Trust Flow</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.majestic.cf  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Citation Flow</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>Facebook</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.facebook.comments | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Comments</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.facebook.reactions | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Reactions</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.facebook.shares | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Shares</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                    <VCol cols="12" md="3">
                        <VCard>
                            <VCardTitle>Ahrefs</VCardTitle>
                            <VList>
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.ahrefs.rank | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Rank</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.ahrefs.dr | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Domain Rating</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.ahrefs.ext_backlinks | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>External Backlinks</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.ahrefs.refd | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Referring Domains</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                                <VDivider />
                                <VListItem two-line>
                                    <VListItemContent>
                                        <VListItemTitle>
                                            {{ platform.ahrefs.dofollow | formatNumberFilter  }}
                                        </VListItemTitle>
                                        <VListItemSubtitle>
                                            <b>Dofollow</b>
                                        </VListItemSubtitle>
                                    </VListItemContent>
                                </VListItem>
                            </VList>
                        </VCard>
                    </VCol>
                </VRow>
            </VContainer>
            <VDivider></VDivider>
        </VCard>
    </VDialog>
</template>

<script>
export default {
    name: 'ViewPlatformDialog',
    props: {
        visibility: {
            required: true
        },
        platform: {
            required: true
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.visibility;
            },
            set(value) {
                if (!value) {
                    this.$emit('close-dialog');
                }
            }
        },
        countryImage() {
            if (this.platform.alexa?.country)
                return this.platform.alexa?.country.toLowerCase() + '.svg';
            return '';
        }
    }
}
</script>

<style scoped>

</style>