export const platformMapper = Platform => ({
    id: Platform.id,
    websiteUrl: Platform.website_url,
    dr: Platform.dr,
    da: Platform.da,
    organicTraffic: Platform.organic_traffic,
    doFollowActive: Platform.dofollow_active,
    freeHomeFeaturedActive: Platform.free_home_featured_active,
    nicheEditLinkActive: Platform.niche_edit_link_active,
    articleWritingPrice: Platform.article_writing_price,
    nicheEditLinkPrice: Platform.niche_edit_link_price,
    contacts: Platform.contacts,
    price: Platform.price,
    email: Platform.email,
    comment: Platform.comment,
    topics: Platform.topics.map(topicMapper),
    moz: Platform.moz,
    alexa: AlexaMapper(Platform.alexa),
    semrush: SemRushMapper(Platform.semrush),
    majestic: MajesticMapper(Platform.majestic),
    ahrefs: Platform.ahrefs
});

export const MozMapper = Moz => ({
    pa: Moz.pa,
    da: Moz.da,
    rank: Moz.rank,
    linksIn: Moz.links_in
});

export const AlexaMapper = Alexa => ({
    rank: Alexa.rank,
    country: Alexa.country
});

export const SemRushMapper = SemRush => ({
    rank: SemRush.rank,
    keywordNum: SemRush.keyword_num,
    traffic: SemRush.traffic,
    trafficCosts: SemRush.traffic_costs
});

export const MajesticMapper = Majestic => ({
    externalBacklinks: Majestic.external_backlinks,
    externalGov: Majestic.external_gov,
    externalEdu: Majestic.external_edu,
    tf: Majestic.tf,
    cf: Majestic.cf,
});

export const topicMapper = Topic => ({
    name: Topic.name
});

export const platformAPIMapper = PlatformData => ({
    websiteUrl: PlatformData.websiteUrl,
    doFollowActive: PlatformData.dofollow_active,
    freeHomeFeaturedActive: PlatformData.free_home_featured_active,
    nicheEditLinkActive: PlatformData.niche_edit_link_active,
    articleWritingPrice: PlatformData.article_writing_price,
    nicheEditLinkPrice: PlatformData.niche_edit_link_price,
    topics: PlatformData.topics,
    contacts: PlatformData.contacts,
    price: PlatformData.price,
    email: PlatformData.email,
    comment: PlatformData.comment,
    moz: {
        da: PlatformData.moz.da,
        pa: PlatformData.moz.pa,
        links_in: PlatformData.moz.links_in,
        mozrank: PlatformData.moz.mozrank
    },
    alexa: {

    },
    semrush: {

    },
    majestic: {

    }
});